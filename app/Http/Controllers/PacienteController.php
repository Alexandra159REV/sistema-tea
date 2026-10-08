<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Pictograma;
use App\Models\Seguimiento;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PacienteController extends Controller
{
    /**
     * LISTA DE PACIENTES
     */
    public function index()
    {
        $lista_pacientes = Paciente::orderBy('created_at', 'desc')->get();

        return view('gestion_pacientes', compact('lista_pacientes'));
    }

    /**
     * FORMULARIO PASO 1
     */
    public function crearPaso1()
    {
        $paciente = new Paciente();

        return view('formulario', compact('paciente'));
    }

    /**
     * GUARDAR DATOS BÁSICOS
     */
    public function storeBasico(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'edad'   => 'required|numeric',
        ]);

        $paciente = new Paciente();

        $paciente->nombre = $request->nombre;
        $paciente->edad = $request->edad;

        $paciente->brillo_pref = $request->brillo_pref ?? 50;
        $paciente->contraste_pref = $request->contraste_pref ?? 50;
        $paciente->color_fondo = $request->color_fondo ?? '#f0faff';

        // AGENDAS
        $paciente->agenda_lunes = $request->agenda_lunes;
        $paciente->agenda_martes = $request->agenda_martes;
        $paciente->agenda_miercoles = $request->agenda_miercoles;
        $paciente->agenda_jueves = $request->agenda_jueves;
        $paciente->agenda_viernes = $request->agenda_viernes;
        $paciente->agenda_sabado = $request->agenda_sabado;
        $paciente->agenda_domingo = $request->agenda_domingo;

        $paciente->save();

        return redirect()->route('perfil', $paciente->id)
            ->with('success', 'Paciente registrado correctamente');
    }

    /**
     * GUARDAR AGENDA SEMANAL
     */
    public function storeAgenda(Request $request, $id)
    {
        $paciente = Paciente::findOrFail($id);

        // ===============================
        // AQUÍ ESTABA TU PROBLEMA
        // ===============================

        $paciente->agenda_lunes = $request->agenda_lunes;
        $paciente->agenda_martes = $request->agenda_martes;
        $paciente->agenda_miercoles = $request->agenda_miercoles;
        $paciente->agenda_jueves = $request->agenda_jueves;
        $paciente->agenda_viernes = $request->agenda_viernes;
        $paciente->agenda_sabado = $request->agenda_sabado;
        $paciente->agenda_domingo = $request->agenda_domingo;

        $paciente->save();

        // IA
        $this->procesarAgendaConIA($paciente);
        $this->generarPictogramaConIA($paciente);

        return redirect()->route('perfil', $paciente->id)
            ->with('success', 'Agenda semanal guardada correctamente');
    }

    /**
     * CREAR PACIENTE COMPLETO
     */
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

        return redirect()->route('perfil', $paciente->id)
            ->with('success', 'Paciente registrado correctamente');
    }

    /**
     * EDITAR
     */
    public function edit(Paciente $paciente)
    {
        return view('edit', compact('paciente'));
    }

    /**
     * ACTUALIZAR
     */
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

        return redirect()->route('perfil', $paciente->id)
            ->with('success', 'Perfil actualizado correctamente');
    }

    /**
     * PERFIL PADRE
     */
    public function perfilPadre($id)
    {
        $paciente = Paciente::findOrFail($id);

        $bibliotecaPictos = DB::table('pictogramas')->get();

        $historialSeguimientos = Seguimiento::where('paciente_id', $id)
            ->orderBy('created_at', 'asc')
            ->get();

        $ultimoSeguimiento = $historialSeguimientos->last();

        if ($ultimoSeguimiento) {

            $dataRadar = [
                (int) $ultimoSeguimiento->autonomia,
                (int) $ultimoSeguimiento->comunicacion,
                (int) $ultimoSeguimiento->estabilidad,
                (int) $ultimoSeguimiento->compromiso,
                (int) $ultimoSeguimiento->consistencia,
            ];

        } else {

            $dataRadar = [0,0,0,0,0];
        }

        // ======================================================
        // EVOLUCIÓN 4 SEMANAS
        // ======================================================

        $labelsEvolucion = [
            'Semana 1',
            'Semana 2',
            'Semana 3',
            'Semana 4'
        ];

        $seguimientosMesActual = Seguimiento::where('paciente_id', $id)
            ->orderBy('created_at', 'asc')
            ->get();

        $datosAutonomia = [null,null,null,null];
        $datosComunicacion = [null,null,null,null];
        $datosEstabilidad = [null,null,null,null];

        if (!$seguimientosMesActual->isEmpty()) {

            $semanasAgrupadas = $seguimientosMesActual->groupBy(function($item){

                $dia = $item->created_at->day;

                if ($dia <= 7) return 0;
                if ($dia <= 14) return 1;
                if ($dia <= 21) return 2;

                return 3;
            });

            for($i = 0; $i <= 3; $i++){

                if(isset($semanasAgrupadas[$i])){

                    $datosAutonomia[$i] =
                        (int) $semanasAgrupadas[$i]->avg('autonomia');

                    $datosComunicacion[$i] =
                        (int) $semanasAgrupadas[$i]->avg('comunicacion');

                    $datosEstabilidad[$i] =
                        (int) $semanasAgrupadas[$i]->avg('estabilidad');
                }
            }
        }

        // ======================================================
        // CÁLCULO DE DIFERENCIAS E INTERPRETACIÓN
        // ======================================================
        $diferenciaAutonomia = 0;
        $diferenciaComunicacion = 0;
        $diferenciaEstabilidad = 0;

        $ultimosCuatro = $paciente->seguimientos()->latest()->take(4)->get();
        if ($ultimosCuatro->count() >= 2) {
            $primera = $ultimosCuatro->last();
            $ultima = $ultimosCuatro->first();

            $diferenciaAutonomia = $ultima->autonomia - $primera->autonomia;
            $diferenciaComunicacion = $ultima->comunicacion - $primera->comunicacion;
            $diferenciaEstabilidad = $ultima->estabilidad - $primera->estabilidad;
        }

        $textoAutonomia = $this->obtenerInterpretacion($diferenciaAutonomia, 'autonomía');
        $textoComunicacion = $this->obtenerInterpretacion($diferenciaComunicacion, 'comunicación');
        $textoEstabilidad = $this->obtenerInterpretacion($diferenciaEstabilidad, 'estabilidad emocional');

        return view('perfil_padre', compact(
            'paciente', 'bibliotecaPictos', 'historialSeguimientos', 'ultimoSeguimiento',
            'dataRadar', 'labelsEvolucion', 'datosAutonomia', 'datosComunicacion', 
            'datosEstabilidad', 'diferenciaAutonomia', 'diferenciaComunicacion', 
            'diferenciaEstabilidad', 'textoAutonomia', 'textoComunicacion', 'textoEstabilidad'
        ));
    




        // ======================================================
        // REPORTE INTELIGENTE
        // ======================================================

        $reporteProgreso = null;

        if ($seguimientosMesActual->count() >= 4) {

            $primerSeguimiento = $seguimientosMesActual->first();
            $ultimoSeguimientoMes = $seguimientosMesActual->last();

            $difAutonomia =
                $ultimoSeguimientoMes->autonomia -
                $primerSeguimiento->autonomia;

            $difComunicacion =
                $ultimoSeguimientoMes->comunicacion -
                $primerSeguimiento->comunicacion;

            $difEstabilidad =
                $ultimoSeguimientoMes->estabilidad -
                $primerSeguimiento->estabilidad;

            $reporteProgreso = [

                'autonomia' => [
                    'inicial' => $primerSeguimiento->autonomia,
                    'final'   => $ultimoSeguimientoMes->autonomia,
                    'cambio'  => $difAutonomia
                ],

                'comunicacion' => [
                    'inicial' => $primerSeguimiento->comunicacion,
                    'final'   => $ultimoSeguimientoMes->comunicacion,
                    'cambio'  => $difComunicacion
                ],

                'estabilidad' => [
                    'inicial' => $primerSeguimiento->estabilidad,
                    'final'   => $ultimoSeguimientoMes->estabilidad,
                    'cambio'  => $difEstabilidad
                ],
            ];
        }

        // ======================================================
        // PROMEDIO MENSUAL
        // ======================================================

        $promedioMes = Seguimiento::where('paciente_id', $id)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->selectRaw('
                AVG(autonomia) as aut,
                AVG(comunicacion) as com,
                AVG(estabilidad) as est,
                AVG(compromiso) as comp,
                AVG(consistencia) as con
            ')
            ->first();

        return view('perfil_padre', compact(
            'paciente',
            'bibliotecaPictos',
            'ultimoSeguimiento',
            'historialSeguimientos',
            'dataRadar',
            'labelsEvolucion',
            'datosAutonomia',
            'datosComunicacion',
            'datosEstabilidad',
            'promedioMes',
            'reporteProgreso'
        ));
    }

    /**
     * GUARDAR SEGUIMIENTO
     */
    public function guardarSeguimiento(Request $request, $id)
    {
        $nuevoSeguimiento = new Seguimiento();

        $nuevoSeguimiento->paciente_id = $id;

        $nuevoSeguimiento->autonomia = $request->autonomia;
        $nuevoSeguimiento->comunicacion = $request->comunicacion;
        $nuevoSeguimiento->estabilidad = $request->estabilidad;
        $nuevoSeguimiento->compromiso = $request->compromiso;
        $nuevoSeguimiento->consistencia = $request->consistencia;

        $nuevoSeguimiento->mejora_percibida = (
            $request->autonomia +
            $request->comunicacion +
            $request->estabilidad +
            $request->compromiso +
            $request->consistencia
        ) / 5;

        $nuevoSeguimiento->observacion_padre =
            $request->observacion_padre;

        // SIMULACIÓN DE SEMANAS

        $cantidadSeguimientos = Seguimiento::where('paciente_id', $id)
            ->whereMonth('created_at', now()->month)
            ->count();

        if($cantidadSeguimientos == 0){

            $nuevoSeguimiento->created_at =
                now()->setDate(now()->year, now()->month, 5);

        } elseif($cantidadSeguimientos == 1){

            $nuevoSeguimiento->created_at =
                now()->setDate(now()->year, now()->month, 10);

        } elseif($cantidadSeguimientos == 2){

            $nuevoSeguimiento->created_at =
                now()->setDate(now()->year, now()->month, 18);

        } else {

            $nuevoSeguimiento->created_at =
                now()->setDate(now()->year, now()->month, 25);
        }

        $nuevoSeguimiento->save();

        return redirect()->back()
            ->with('success', 'Seguimiento guardado correctamente');
    }

    /**
     * ELIMINAR
     */
    public function destroy(Paciente $paciente)
    {
        $paciente->delete();

        return redirect()->route('index')
            ->with('success', 'Paciente eliminado');
    }





    public function solicitarPictograma(Request $request) {
        $rutaPersonalizada = public_path("pictogramas/procesados/{$request->nombre_archivo}.png");

        // Lógica de "On-Demand": Si ya existe, no gastes GPU
        if (file_exists($rutaPersonalizada)) {
            return response()->json(['url' => asset("pictogramas/procesados/{$request->nombre_archivo}.png")]);
        }

        // Si no existe, preparamos el JSON para Python
        $datosPython = json_encode([
            "imagen" => $request->ruta_original,
            "prompt" => "high quality pictogram, clean design",
            "brillo" => 1.1,
            "contraste" => 1.1,
            "fondo" => "#ffffff",
            "palabra" => $request->nombre_archivo
        ]);

        // Ejecutamos Python
        $comando = "python " . base_path("python/generar_pictograma.py") . " " . escapeshellarg($datosPython);
        $salida = shell_exec($comando);

        return response()->json(['url' => $salida]);
    }


    public function generarPictogramaPersonalizado(Request $request) {
        // 1. Obtener datos del paciente desde tu BD
        $paciente = Paciente::find($request->paciente_id);
        
        // 2. Aquí llamarías a tu script de búsqueda semántica (Fase 2)
        // Supongamos que recibes el texto del padre y obtienes la ruta:
        $comandoBusqueda = "python " . base_path("scripts_ia/buscar_pictograma.py") . " " . escapeshellarg($request->input_padre);
        $rutaImagenOriginal = trim(shell_exec($comandoBusqueda));

        // 3. Preparar el JSON "inteligente" (Fase 3)
        $datosIA = [
            "imagen" => $rutaImagenOriginal,
            "prompt" => "pictogram, simple, educational, clean icon",
            "brillo" => $paciente->preferencia_brillo,   // Valores de tu BD
            "contraste" => $paciente->preferencia_contraste,
            "fondo" => $paciente->color_fondo,
            "palabra" => $paciente->nombre . "_" . $request->nombre_pictograma
        ];

        // 4. Llamar al script de generación (que ya tienes en /python/generar_pictograma.py)
        $comandoIA = "python " . base_path("python/generar_pictograma.py") . " " . escapeshellarg(json_encode($datosIA));
        $rutaFinal = trim(shell_exec($comandoIA));

        // 5. Retornar la ruta para mostrarla en la vista
        return response()->json(['url' => asset('pictogramas_procesados/' . basename($rutaFinal))]);
    }


    


    /**
     * IA
     */
    public function analizarIA(Request $request, $id)
    {
        $paciente = Paciente::findOrFail($id);

        $textoPadre = $request->input('comentario_padre');

        if (!empty($textoPadre)) {

            $nombreImagen =
                $this->ejecutarBuscadorSemantico($textoPadre);

            $paciente->sugerencias_pictogramas =
                $nombreImagen;

            $paciente->save();
        }

        return back()->with(
            'success',
            'Comentario analizado correctamente'
        );
    }

    /**
     * BUSCADOR SEMÁNTICO
     */
    private function ejecutarBuscadorSemantico($palabra)
    {
        $scriptPath =
            public_path(
                'pictogramas/aseo_personal/buscador_semantico.py'
            );

        $pythonPath = 'python';

        $comando =
            "$pythonPath " .
            escapeshellarg($scriptPath) .
            " " .
            escapeshellarg($palabra);

        $resultado = shell_exec($comando);

        return $resultado
            ? trim($resultado)
            : 'default';
    }

    /**
     * ASIGNAR DATOS
     */
    private function asignarDatos($paciente, $request)
    {
        $paciente->nombre = $request->nombre;
        $paciente->edad = $request->edad;

        $paciente->nivel_tea = $request->nivel_tea;

        $paciente->p_comunicacion =
            $request->comunicacion_verbal;

        $paciente->comunicacion_verbal =
            $request->comunicacion_verbal;

        $paciente->brillo_pref =
            $request->brillo_pref ?? 50;

        $paciente->contraste_pref =
            $request->contraste_pref ?? 50;

        $paciente->color_fondo =
            $request->color_fondo ?? '#f0faff';

        $paciente->interaccion_social =
            $request->interaccion_social;

        // =====================================
        // GUARDAR TEXTO NORMAL
        // =====================================

        $paciente->agenda_lunes =
            $request->agenda_lunes;

        $paciente->agenda_martes =
            $request->agenda_martes;

        $paciente->agenda_miercoles =
            $request->agenda_miercoles;

        $paciente->agenda_jueves =
            $request->agenda_jueves;

        $paciente->agenda_viernes =
            $request->agenda_viernes;

        $paciente->agenda_sabado =
            $request->agenda_sabado;

        $paciente->agenda_domingo =
            $request->agenda_domingo;
    }





    public function show($id)
    {
        $paciente = Paciente::findOrFail($id);
        $seguimientos = $paciente->seguimientos()->latest()->take(4)->get();
        $ultimoSeguimiento = $seguimientos->first(); 

        $diferenciaAutonomia = 0;
        $diferenciaComunicacion = 0;
        $diferenciaEstabilidad = 0;

        if ($seguimientos->count() >= 2) {
            $primera = $seguimientos->last();
            $ultima = $seguimientos->first();

            $diferenciaAutonomia = $ultima->autonomia - $primera->autonomia;
            $diferenciaComunicacion = $ultima->comunicacion - $primera->comunicacion;
            $diferenciaEstabilidad = $ultima->estabilidad - $primera->estabilidad;
        } 

        // 1. Calculamos los textos ANTES del return
        $textoAutonomia = $this->obtenerInterpretacion($diferenciaAutonomia, 'autonomía');
        $textoComunicacion = $this->obtenerInterpretacion($diferenciaComunicacion, 'comunicación');
        $textoEstabilidad = $this->obtenerInterpretacion($diferenciaEstabilidad, 'estabilidad emocional');

        // IMPORTANTE: Debes incluir estas variables aquí abajo
        return view('perfil_padre', compact(
            'paciente', 'ultimoSeguimiento', 
            'diferenciaAutonomia', 'diferenciaComunicacion', 'diferenciaEstabilidad',
            'textoAutonomia', 'textoComunicacion', 'textoEstabilidad'
            // ... otras variables que ya tenías
        ));


        // 2. Enviamos TODO en un solo return
        return view('perfil_padre', compact(
            'paciente', 
            'ultimoSeguimiento', 
            'diferenciaAutonomia', 
            'diferenciaComunicacion', 
            'diferenciaEstabilidad',
            'textoAutonomia',
            'textoComunicacion',
            'textoEstabilidad'
        ));
    } 

    private function obtenerInterpretacion($dif, $area)
    {
        if ($dif >= 20) return "Se observa una mejora significativa en $area.";
        if ($dif > 0) return "La $area muestra una leve mejoría.";
        return "La $area se mantiene estable, se recomienda reforzar rutinas.";
    }
    






    /**
     * FORMATEAR IA
     */
    private function formatearDiaConIA($texto)
    {
        if(empty($texto)) return null;

        try {

            $response = Http::timeout(20)->post(
                'http://localhost:11434/api/generate',
                [
                    'model' => 'llama3',
                    'prompt' =>
                        "Convierte este texto en tareas cortas: {$texto}",
                    'stream' => false
                ]
            );

            if($response->successful()){

                return trim(
                    $response->json()['response']
                );
            }

        } catch (\Exception $e){

            Log::error(
                "Error IA agenda: " .
                $e->getMessage()
            );
        }

        return $texto;
    }

    /**
     * GENERAR PICTOGRAMA IA
     */
    private function generarPictogramaConIA($paciente)
    {
        try {

            Http::timeout(60)->post(
                'http://127.0.0.1:5000/',
                [
                    'id' => $paciente->id,
                    'color' => $paciente->color_fondo,
                ]
            );

        } catch (\Exception $e){

            Log::error(
                "Error api_ia.py: " .
                $e->getMessage()
            );
        }
    }

    /**
     * PROCESAR AGENDA CON IA
     */
    private function procesarAgendaConIA($paciente)
    {
        $agendaTexto = "";

        $dias = [
            'lunes',
            'martes',
            'miercoles',
            'jueves',
            'viernes',
            'sabado',
            'domingo'
        ];

        foreach($dias as $d){

            $campo = "agenda_" . $d;

            if(!empty($paciente->$campo)){

                $agendaTexto .=
                    $paciente->$campo . " ";
            }
        }

        if(!empty($agendaTexto)){

            try {

                $response = Http::timeout(15)->post(
                    'http://localhost:11434/api/generate',
                    [
                        'model' => 'llama3',
                        'prompt' =>
                            "Extrae palabras clave de: {$agendaTexto}",
                        'stream' => false,
                    ]
                );

                if($response->successful()){

                    $paciente->sugerencias_pictogramas =
                        strtolower(
                            trim(
                                $response->json()['response']
                            )
                        );

                    $paciente->save();
                }

            } catch (\Exception $e){

                Log::error(
                    "Error Ollama: " .
                    $e->getMessage()
                );
            }
        }
    }
}