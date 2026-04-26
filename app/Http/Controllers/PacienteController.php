<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use Illuminate\Support\Facades\Http; 
use Illuminate\Support\Facades\Log;

class PacienteController extends Controller
{
    public function index()
    {
        $lista_pacientes = Paciente::orderBy('created_at', 'desc')->get(); 
        return view('gestion_pacientes', compact('lista_pacientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'edad'   => 'required|numeric',
        ]);

        $paciente = new Paciente();
        $this->asignarDatos($paciente, $request);
        $paciente->save();

        $this->procesarAgendaConIA($paciente);
        $this->generarPictogramaConIA($paciente);

        return redirect()->route('index')
                         ->with('success', '¡Paciente registrado y agenda procesada con éxito!');
    }

    public function edit(Paciente $paciente)
    {
        return view('edit', compact('paciente'));
    }

    public function update(Request $request, Paciente $paciente)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'edad'   => 'required|numeric',
        ]);

        $this->asignarDatos($paciente, $request);
        $paciente->save();

        $this->procesarAgendaConIA($paciente);
        $this->generarPictogramaConIA($paciente);

        return redirect()->route('index')
                         ->with('success', 'Perfil y agenda actualizados correctamente');
    }

    public function perfilPadre(Paciente $paciente)
    {
        return view('perfil_padre', compact('paciente'));
    }

    public function destroy(Paciente $paciente)
    {
        $paciente->delete();
        return redirect()->route('index')
                         ->with('success', 'Paciente eliminado correctamente');
    }

    /**
     * NUEVO MÉTODO: Conecta con tu script de Python para el Diario del Padre.
     */
    public function analizarIA(Request $request, $id)
    {
        $paciente = Paciente::findOrFail($id);
        $textoPadre = $request->input('comentario_padre');

        if (!empty($textoPadre)) {
            // Llamamos a tu script de búsqueda semántica
            $nombreImagen = $this->ejecutarBuscadorSemantico($textoPadre);
            
            // Guardamos el resultado en las sugerencias para que aparezca en el perfil
            $paciente->sugerencias_pictogramas = $nombreImagen;
            $paciente->save();
        }

        return back()->with('success', 'IA analizó el comentario correctamente');
    }

    /**
     * Lógica para ejecutar el script de Python que creamos.
     */
    private function ejecutarBuscadorSemantico($palabra)
    {
        // Ruta absoluta a tu script en Laragon
        $scriptPath = 'D:\laragon\www\TEA web\tea-laravel\public\pictogramas\aseo_personal\buscador_semantico.py';
        $pythonPath = 'python'; // Asegúrate que python esté en tu PATH

        // Ejecutamos el comando y capturamos la salida (ej: "pastilla_jabon")
        $comando = "$pythonPath " . escapeshellarg($scriptPath) . " " . escapeshellarg($palabra);
        $resultado = shell_exec($comando);

        return $resultado ? trim($resultado) : 'default';
    }

    private function asignarDatos($paciente, $request) {
        $paciente->nombre = $request->nombre;
        $paciente->edad = $request->edad;
        $paciente->nivel_tea = $request->nivel_tea;
        $paciente->p_comunicacion = $request->comunicacion_verbal;
        $paciente->comunicacion_verbal = $request->comunicacion_verbal; 
        
        $paciente->brillo_pref = $request->brillo_pref ?? 50;
        $paciente->contraste_pref = $request->contraste_pref ?? 50;
        $paciente->color_fondo = $request->color_fondo ?? '#f0faff';
        
        $paciente->interaccion_social = $request->interaccion_social;

        // Numeración automática de agendas
        $paciente->agenda_lunes = $this->formatearDiaConIA($request->agenda_lunes);
        $paciente->agenda_martes = $this->formatearDiaConIA($request->agenda_martes);
        $paciente->agenda_miercoles = $this->formatearDiaConIA($request->agenda_miercoles);
        $paciente->agenda_jueves = $this->formatearDiaConIA($request->agenda_jueves);
        $paciente->agenda_viernes = $this->formatearDiaConIA($request->agenda_viernes);
        $paciente->agenda_sabado = $this->formatearDiaConIA($request->agenda_sabado);
        $paciente->agenda_domingo = $this->formatearDiaConIA($request->agenda_domingo);
    }

    private function formatearDiaConIA($texto) {
        if (empty($texto)) return null;
        try {
            $response = Http::timeout(20)->post('http://localhost:11434/api/generate', [
                'model' => 'llama3',
                'prompt' => "Convierte este texto en una lista numerada (1., 2., 3.) con tareas cortas de aseo o comida. Responde SOLO la lista sin introducciones: '{$texto}'",
                'stream' => false,
            ]);
            if ($response->successful()) {
                return trim($response->json()['response']);
            }
        } catch (\Exception $e) {
            Log::error("Error formateando agenda: " . $e->getMessage());
        }
        return $texto;
    }

    private function generarPictogramaConIA($paciente) {
        try {
            Http::timeout(60)->post('http://127.0.0.1:5000/', [
                'id'    => $paciente->id,
                'color' => $paciente->color_fondo,
            ]);
        } catch (\Exception $e) {
            Log::error("Error conectando con api_ia.py: " . $e->getMessage());
        }
    }

    private function procesarAgendaConIA($paciente) {
        $agendaTexto = "";
        $dias = ['lunes','martes','miercoles','jueves','viernes','sabado','domingo']; 
        
        foreach($dias as $d) {
            $campo = "agenda_".$d;
            if(!empty($paciente->$campo)) {
                $agendaTexto .= $paciente->$campo . " ";
            }
        }

        if (!empty($agendaTexto)) {
            try {
                // Aquí usamos a Ollama para extraer términos clave que coincidan con tus archivos
                $response = Http::timeout(15)->post('http://localhost:11434/api/generate', [
                    'model' => 'llama3',
                    'prompt' => "De esta lista de tareas: '{$agendaTexto}', extrae solo palabras simples que representen objetos (ej: toalla, jabon, cepillo). Devuelve palabras separadas por comas en minúsculas.",
                    'stream' => false,
                ]);

                if ($response->successful()) {
                    $paciente->sugerencias_pictogramas = strtolower(trim($response->json()['response'], " ."));
                    $paciente->save();
                }
            } catch (\Exception $e) {
                Log::error("Error con Ollama en procesamiento: " . $e->getMessage());
            }
        }
    }
}