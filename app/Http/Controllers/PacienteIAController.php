<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;

class PacienteIAController extends Controller
{
    public function analizarDiario(Request $request, $id)
    {
        $paciente = Paciente::findOrFail($id);
        $inputUsuario = $request->input('actividad_diaria');

        // 1. PETICIÓN A OLLAMA (Extraer palabra y categoría en formato JSON)
        // $systemPrompt = "Eres un extractor de pictogramas. Tu tarea es recibir un texto y devolver ÚNICAMENTE un objeto JSON " .
        //                 "con la palabra clave y su categoría. Categorías permitidas: [acciones, animales, aseo_personal, comida, " .
        //                 "deberes, emociones, higiene, instrumentos_musicales, lugares, social, transporte, vestirse]. " .
        //                 "Ejemplo de respuesta: {\"palabra\": \"fresa\", \"categoria\": \"comida\"}".
        //                 "para mas coherencia busca las palabras que concideres claves en el index.json";

        // try {
        //     $responseIA = Http::post('http://localhost:11434/api/chat', [
        //         'model' => 'llama3',
        //         'messages' => [
        //             ['role' => 'system', 'content' => $systemPrompt],
        //             ['role' => 'user', 'content' => $inputUsuario],
        //         ],
        //         'stream' => false,
        //         'options' => ['temperature' => 0]
        //     ]);

        //     $contenidoIA = json_decode($responseIA->json()['message']['content'], true);
        //     $palabraClave = $contenidoIA['palabra'] ?? $inputUsuario;
        //     $categoriaIA = $contenidoIA['categoria'] ?? 'comida';
        // } catch (\Exception $e) {
        //     // Fallback si la IA falla
        //     $palabraClave = $inputUsuario;
        //     $categoriaIA = 'comida';
        // }

#*----------------------------------------------------------------------------------------------------------------------------------------------------*



        // 1. LEER EL INDEX.JSON PARA DARLE CONTEXTO A LA IA
    $jsonPath = public_path('pictogramas/index.json');
    $contextoIndex = "";

    if (file_exists($jsonPath)) {
        // Leemos el JSON y lo pasamos a string para el prompt
        $contextoIndex = file_get_contents($jsonPath);
    }



     //1. PETICIÓN A OLLAMA (Extraer palabra y categoría en formato JSON)
         $systemPrompt = "Eres un extractor de pictogramas. Tu tarea es recibir un texto y devolver ÚNICAMENTE un objeto JSON " .
                         "con la palabra clave y su categoría. Categorías permitidas: [acciones, animales, aseo_personal, comida, " .
                         "deberes, emociones, higiene, instrumentos_musicales, lugares, social, transporte, vestirse]. " .
                         "Ejemplo de respuesta: {\"palabra\": \"fresa\", \"categoria\": \"comida\"}".
                         "para mas coherencia busca las palabras que concideres claves en el index.json";
        
        // Mantenemos tu prompt tal cual, pero le concatenamos el contenido del index
        $systemPromptFull = $systemPrompt . "\n\nEste es el catálogo oficial de categorías y rutas que debes usar como referencia:\n" . $contextoIndex;

    try {
        $responseIA = Http::post('http://localhost:11434/api/chat', [
            'model' => 'llama3',
            'messages' => [
                ['role' => 'system', 'content' => $systemPromptFull], // Enviamos el prompt con el JSON incluido
                ['role' => 'user', 'content' => $inputUsuario],
            ],
            'stream' => false,
            'options' => [
                'temperature' => 0,
                'format' => 'json' // Forzamos a Ollama a que la salida sea un JSON válido
            ]
        ]);

        // 2. PROCESAR RESPUESTA
        $respuestaRaw = $responseIA->json()['message']['content'] ?? "{}";
        
        // A veces Ollama devuelve el JSON dentro de bloques de código (```json ... ```)
        // Limpiamos la respuesta para asegurar que json_decode no falle
        $respuestaLimpia = preg_replace('/^```json|```$/m', '', $respuestaRaw);
        $contenidoIA = json_decode(trim($respuestaLimpia), true);

        $palabraClave = $contenidoIA['palabra'] ?? $inputUsuario;
        $categoriaIA = $contenidoIA['categoria'] ?? 'comida';

        // 3. VALIDACIÓN DE CATEGORÍA
        // Verificamos si la categoría que inventó la IA existe realmente en nuestro index.json
        if (!empty($contextoIndex)) {
            $config = json_decode($contextoIndex, true);
            $categoriasReales = array_column($config['fuentes_datos']['archivos_csv'], 'categoria');
            
            if (!in_array($categoriaIA, $categoriasReales)) {
                // Si la IA se inventó una categoría, buscamos la más parecida o asignamos una por defecto
                $categoriaIA = 'comida'; 
            }
        }

    } catch (\Exception $e) {
        // Fallback en caso de error de conexión o parseo
        $palabraClave = $inputUsuario;
        $categoriaIA = 'comida';
    }


#*----------------------------------------------------------------------------------------------------------------------------------------*

        // 2. LÓGICA DE BÚSQUEDA EN CSV USANDO EL INDEX.JSON
        $conceptos = [];
        $jsonPath = public_path('pictogramas/index.json');
        $imagenFinal = 'pictogramas/default.png'; 

        if (File::exists($jsonPath)) {
            $config = json_decode(File::get_contents($jsonPath), true);
            $directorioBase = $config['configuracion_sistema']['directorio_raiz'];
            
            // Buscar el archivo CSV correspondiente a la categoría que dio Ollama
            $csvInfo = collect($config['fuentes_datos']['archivos_csv'])
                        ->where('categoria', $categoriaIA)
                        ->first();

            if ($csvInfo) {
                $rutaCsv = public_path('pictogramas/' . $csvInfo['archivo']);
                
                if (File::exists($rutaCsv)) {
                    // Abrir y leer el CSV
                    $filas = array_map('str_getcsv', file($rutaCsv));
                    $cabecera = array_shift($filas); // Quitar id, nombre, ruta...

                    foreach ($filas as $fila) {
                        // Supongamos: columna 0 = id, columna 1 = nombre, columna 2 = ruta
                        if (isset($fila[1]) && str_contains(strtolower($fila[1]), strtolower($palabraClave))) {
                            // Limpiar la ruta para que sea accesible vía web
                            $imagenFinal = str_replace('public/', '', $fila[2]);
                            break;
                        }
                    }
                }
            }
        }

        $conceptos[] = [
            'texto' => $palabraClave,
            'ruta' => $imagenFinal
        ];

        // 3. ACTUALIZAR BASE DE DATOS (Para que Jupyter vea la sugerencia)
        $paciente->update(['sugerencias_pictogramas' => $palabraClave]);

        // 4. DATOS PARA EL GRÁFICO (Ejemplo)
        $diasSemana = ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'];
        $puntajesProgreso = [40, 60, 45, 80, 50, 90, 70]; 

        return view('analisis_diario', [
            'paciente'        => $paciente,
            'relatoOriginal'  => "Actividad detectada: " . $palabraClave,
            'conceptos'       => $conceptos,
            'diasGrafico'     => json_encode($diasSemana),
            'puntajesGrafico' => json_encode($puntajesProgreso)
        ]);
    }
}