<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Familiar - {{ $paciente->nombre }}</title>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap"
          rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root{
            --neuro-cyan:#33c3e1;
            --neuro-cyan-dark:#00acc1;
            --bg-light:#f0faff;
            --sidebar-color:#16222e;
        }

        body{
            background-color:var(--bg-light);
            background-image:
                linear-gradient(rgba(240,250,255,.95), rgba(240,250,255,.95)),
                url('https://www.transparenttextures.com/patterns/cubes.png');

            font-family:'Inter',sans-serif;
        }

        .hero-bg{
            background:var(--sidebar-color);
            height:180px;
            border-bottom:5px solid var(--neuro-cyan);
        }

        .profile-card-offset{
            margin-top:-90px;
        }

        .neuro-card{
            background:rgba(255,255,255,.95);
            backdrop-filter:blur(10px);

            border-radius:30px;
            border:1px solid rgba(51,195,225,.1);

            box-shadow:0 15px 35px rgba(0,0,0,.05);

            margin-bottom:2rem;
        }

        @media print{
            .no-print{
                display:none !important;
            }

            body{
                background:white !important;
            }

            .neuro-card{
                box-shadow:none;
                border:1px solid #eee;
                break-inside:avoid;
            }
        }
    </style>
</head>

<body class="min-h-screen"
      x-data="{ openModal:false }">

{{-- ================= HERO ================= --}}
<div class="hero-bg w-full flex items-center justify-between px-12 no-print">

    <div class="flex items-center gap-4">

        <div class="opacity-20">
            <i class="fas fa-puzzle-piece text-white text-5xl"></i>
        </div>

        <div>
            <h1 class="text-white font-extrabold text-2xl tracking-wide">
                Panel de Seguimiento
            </h1>

            <p class="text-slate-400 text-xs">
                Gestión longitudinal y herramientas visuales
            </p>
        </div>

    </div>

    <div class="flex items-center gap-3">

        <button
            @click="openModal = true"
            class="bg-cyan-500 hover:bg-cyan-600 text-white font-black text-xs px-10 py-5 rounded-xl shadow-lg transition-all">

            <i class="fas fa-plus-circle"></i>
            Registrar Sesión
        </button>

        <button
            onclick="window.print()"
            class="bg-slate-800 hover:bg-slate-700 text-white text-xs px-10 py-5 rounded-xl">

            <i class="fas fa-print"></i>
            Imprimir
        </button>

        <a href="{{ route('dashboard') }}"
           class="bg-slate-800 hover:bg-slate-700 text-white text-xs px-10 py-5 rounded-xl">

            <i class="fas fa-arrow-left"></i>
            Volver
        </a>

    </div>

</div>

<div class="max-w-6xl mx-auto px-4 pb-12">

    {{-- ALERTAS --}}
    @if(session('success'))
        <div class="mt-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    {{-- ================= PERFIL ================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 mb-8 profile-card-offset">

        {{-- FOTO --}}
        <div class="lg:col-span-1">

            <div class="neuro-card p-7 h-full flex flex-col items-center justify-center">

                <h3 class="text-slate-400 text-xs font-black uppercase tracking-widest mb-6">
                    Identificador Personal
                </h3>

                <div
                    class="bg-white p-5 rounded-[30px] shadow-inner border-2 border-dashed border-cyan-100 flex items-center justify-center"
                    style="background-color: {{ $paciente->color_fondo ?? '#ffffff' }};
                           width:160px;
                           height:160px;">

                    @if(isset($paciente->imagen_personalizada) && $paciente->imagen_personalizada)

                        <img
                            src="{{ asset($paciente->imagen_personalizada) }}"
                            class="w-32 h-32 object-contain">

                    @else

                        <i class="fas fa-child text-slate-200 text-6xl"></i>

                    @endif

                </div>

                <div class="mt-5 text-center">

                    <h2 class="font-black text-xl text-slate-800">
                        {{ $paciente->nombre }}
                    </h2>

                    <p class="text-slate-400 text-sm">
                        {{ $paciente->edad }} años
                    </p>

                </div>

            </div>

        </div>

        {{-- RADAR --}}
        <div class="lg:col-span-2">

            <div class="neuro-card p-3 h-full">

                <h3 class="text-slate-900 font-extrabold text-xl mb-4">
                    Progreso de Capacidades
                </h3>

                <div style="height:350px;">
                    <canvas id="radarProgreso"></canvas>
                </div>

            </div>

        </div>

        {{-- INDICADORES --}}
        <div class="lg:col-span-1">

            <div class="neuro-card p-6 h-full">

                <div class="space-y-4">

                    <div class="bg-white p-4 rounded-2xl border">

                        <p class="font-black text-slate-800 text-sm">
                            Autonomía
                        </p>

                        <p class="text-cyan-600 text-2xl font-black">
                            {{ optional($ultimoSeguimiento)->autonomia ?? 0 }}%
                        </p>

                    </div>

                    <div class="bg-white p-4 rounded-2xl border">

                        <p class="font-black text-slate-800 text-sm">
                            Comunicación
                        </p>

                        <p class="text-blue-500 text-2xl font-black">
                            {{ optional($ultimoSeguimiento)->comunicacion ?? 0 }}%
                        </p>

                    </div>

                    <div class="bg-white p-4 rounded-2xl border">

                        <p class="font-black text-slate-800 text-sm">
                            Estabilidad
                        </p>

                        <p class="text-indigo-500 text-2xl font-black">
                            {{ optional($ultimoSeguimiento)->estabilidad ?? 0 }}%
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- ================= GRAFICO ================= --}}

    <div class="mt-12"> 
        <h2 class="text-2xl font-black text-slate-800 mb-6">Grafico de progreso</h2>
    </div>

    <div class="h-64 mt-4">
        <canvas id="lineaEvolucion"></canvas>
    </div>

    @isset($reporteProgreso, $mensajeAnalisis)
        <div class="mt-8 p-6 bg-white border-l-4 border-green-800 rounded-2xl shadow-sm">  
        <h4 class="font-black text-green-900 uppercase text-xs tracking-widest mb-2">
            Análisis de Progreso
        </h4>
            <p class="text-sm text-slate-600 leading-relaxed italic">
                {{ $mensajeAnalisis }}
            </p>
        </div>
    @endisset




    
{{-- ================= INFORME DE EVOLUCIÓN TERAPÉUTICA ================= --}}
<div class="mt-8 p-6 bg-white shadow-lg rounded-xl border border-slate-100">
    <h2 class="text-2xl font-black text-slate-800 mb-6">Informe de Evolución Terapéutica</h2>
    



    {{-- Indicadores de Progreso --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="p-4 bg-blue-50 rounded-lg border border-blue-100">
            <p class="font-bold text-blue-800">Autonomía</p>
            <p class="text-3xl font-black text-blue-900">{{ $diferenciaAutonomia > 0 ? '+' : '' }}{{ $diferenciaAutonomia }}%</p>
        </div>
        
        <div class="p-4 bg-green-50 rounded-lg border border-green-100">
            <p class="font-bold text-green-800">Comunicación</p>
            <p class="text-3xl font-black text-green-900">{{ $diferenciaComunicacion > 0 ? '+' : '' }}{{ $diferenciaComunicacion }}%</p>
        </div>
        
        <div class="p-4 bg-purple-50 rounded-lg border border-purple-100">
            <p class="font-bold text-purple-800">Estabilidad</p>
            <p class="text-3xl font-black text-purple-900">{{ $diferenciaEstabilidad > 0 ? '+' : '' }}{{ $diferenciaEstabilidad }}%</p>
        </div>
    </div>

    {{-- Interpretación del Especialista --}}
    <div class="space-y-4">
        <h3 class="font-bold text-lg text-slate-800">Interpretación del Especialista:</h3>
        <div class="text-slate-700 bg-slate-50 p-4 rounded-lg space-y-2">
            <p><strong>Autonomía:</strong> {{ $textoAutonomia }}</p>
            <p><strong>Comunicación:</strong> {{ $textoComunicacion }}</p>
            <p><strong>Estabilidad:</strong> {{ $textoEstabilidad }}</p>
        </div>
    </div>

    {{-- Sugerencia del Sistema --}}
    @php
        $resultados = [
            'Autonomía' => $diferenciaAutonomia,
            'Comunicación' => $diferenciaComunicacion,
            'Estabilidad' => $diferenciaEstabilidad
        ];
        $minimo = min($resultados);
        $areaCritica = array_search($minimo, $resultados);
    @endphp

    <div class="mt-6 p-4 border-l-4 border-amber-500 bg-amber-50 rounded-r-lg">
        <p class="text-amber-900">
            <strong>Sugerencia clínica:</strong> 
            Considerando el progreso actual, el área que requiere mayor atención esta semana es <strong>{{ $areaCritica }}</strong>. 
            Se recomienda ajustar los objetivos terapéuticos para potenciar este aspecto.
        </p>
    </div>
</div>

<div class="mt-12"> 
    <h2 class="text-2xl font-black text-slate-800 mb-6"></h2>
</div>


    {{-- ================= AGENDA ================= --}}
    <h2 class="text-2xl font-black text-slate-800 mb-6">
        Planificación Semanal
    </h2>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

        @php
            $diasConfig = [
                'lunes' => '#10b981',
                'martes' => '#f59e0b',
                'miercoles' => '#3b82f6',
                'jueves' => '#8b5cf6',
                'viernes' => '#ec4899',
                'sabado' => '#6366f1',
                'domingo' => '#f43f5e',
            ];
        @endphp 

           
            @foreach($diasConfig as $dia => $color)

            <div class="neuro-card p-6 border-t-[8px]"
                style="border-top-color: {{ $color }}">

                <h3 class="font-black uppercase text-lg mb-4">
                    {{ $dia }}
                </h3>

                @php

                    // =====================================================
                    // TEXTO DEL DÍA
                    // =====================================================

                    $textoAgenda = $paciente->{"agenda_$dia"} ?? '';

                    // =====================================================
                    // DIVIDIR ACTIVIDADES
                    // =====================================================

                    $actividades = preg_split(
                        '/(?=\d+\.)/',
                        $textoAgenda,
                        -1,
                        PREG_SPLIT_NO_EMPTY
                    );

                    // =====================================================
                    // STOPWORDS
                    // =====================================================

                    $stopWords = [
                        'de','la','el','los','las',
                        'y','en','con','para',
                        'una','un','sus','del',
                        'al','se','que','por',
                        'antes','despues','durante',
                        'sobre','desde','hasta',
                        'realiza','realizando',
                        'dedica','actividad',
                        'actividades',
                        'donde',
                        'mientras',
                        'otros',
                        'procede',
                        'luego',
                        'después',
                        'finalmente',
                        'ademas',
                        'tambien',
                        'parte',
                        'momento',
                        'tiempo',
                        'cosas',
                        'algo',
                        'todo',
                        'toda',
                        'este',
                        'esta',
                        'estas',
                        'estos',
                        'muy',
                        'más',
                        'menos',
                        'tener',
                        'hacer',
                        'cada',
                        'entre',
                        'sobre',
                        'tras',
                        'día',
                        'tarde',
                        'noche'
                    ];

                    // =====================================================
                    // SINÓNIMOS
                    // =====================================================

                    $sinonimos = [
                        'estudiantes' => 'estudiante',
                        'alumnos' => 'estudiante',
                        'profesores' => 'profesor',
                        'maestros' => 'profesor',
                        'niños' => 'niño',
                        'niñas' => 'niña',
                        'lavando' => 'lavar',
                        'comiendo' => 'comer',
                        'corriendo' => 'correr',
                        'jugando' => 'jugar',
                        'caminando' => 'caminar',
                        'durmiendo' => 'dormir',
                        'escribiendo' => 'escribir',
                        'leyendo' => 'leer',
                        'hablando' => 'hablar',
                        'estudiando' => 'estudiar',
                    ];

                    // =====================================================
                    // EXTRAER PALABRAS CLAVE
                    // =====================================================

                    $palabrasClave = [];

                    foreach($actividades as $act){

                        // quitar "1."
                        $textoLimpio = preg_replace(
                            '/^\d+\.\s*/',
                            '',
                            trim($act)
                        );

                        // minúsculas
                        $textoLimpio = mb_strtolower(
                            $textoLimpio,
                            'UTF-8'
                        );

                        // quitar símbolos raros
                        $textoLimpio = preg_replace(
                            '/[^a-záéíóúñü0-9 ]/iu',
                            '',
                            $textoLimpio
                        );

                        // dividir palabras
                        $palabras = explode(' ', $textoLimpio);

                        foreach($palabras as $p){

                            $p = trim($p);

                            if(isset($sinonimos[$p])){
                                $p = $sinonimos[$p];
                            }

                            if(
                                strlen($p) > 3 &&
                                !in_array($p, $stopWords)
                            ){
                                $palabrasClave[] = $p;
                            }
                        }
                    }

                    // quitar repetidos
                    $palabrasClave = array_unique($palabrasClave);

                @endphp

                <div class="grid grid-cols-3 gap-3">

                    @foreach($palabrasClave as $palabra)
                        @php
                            $rutaFinal = '';
                            $pictoEnBD = null;
                            $palabraBuscar = trim(mb_strtolower($palabra, 'UTF-8'));

                            // 1. BUSCAR COINCIDENCIA EXACTA EN TITLE
                            $pictoEnBD = $bibliotecaPictos->first(function($p) use ($palabraBuscar){
                                return trim(mb_strtolower($p->Title, 'UTF-8')) === $palabraBuscar;
                            });

                            // 2. BUSCAR EN SEARCHTEXT
                            if(!$pictoEnBD){
                                $pictoEnBD = $bibliotecaPictos->first(function($p) use ($palabraBuscar){
                                    $tags = array_map('trim', explode(',', mb_strtolower($p->SearchText ?? '', 'UTF-8')));
                                    return in_array($palabraBuscar, $tags);
                                });
                            }

                            // 3. BUSQUEDA PARCIAL
                            if(!$pictoEnBD){
                                $pictoEnBD = $bibliotecaPictos->first(function($p) use ($palabraBuscar){
                                    return str_contains(trim(mb_strtolower($p->Title, 'UTF-8')), $palabraBuscar);
                                });
                            }

                            // GENERAR RUTA
                            if($pictoEnBD){
                                $rutaFinal = asset(ltrim($pictoEnBD->ImagePath, '/'));
                            }
                        @endphp

                        <div class="flex flex-col items-center">
                            <div class="bg-white border-2 border-dashed border-slate-100 rounded-2xl mb-1 w-full aspect-square flex items-center justify-center overflow-hidden shadow-sm">
                                @if($rutaFinal)
                                    <img 
                                        src="{{ $rutaFinal }}" 
                                        alt="{{ $palabra }}" 
                                        class="w-full h-full object-contain p-1"
                                    >
                                @else
                                    <div class="text-center p-1">
                                        <p class="text-[9px] text-orange-500 leading-tight">NO ENCONTRADO</p>
                                    </div>
                                @endif
                            </div>

                            <p class="text-[8px] leading-tight text-center font-bold text-slate-500 uppercase w-full break-words">
                                {{ $palabra }}
                            </p>
                        </div>
                    @endforeach

                   
                    <div class="mt-8 p-6 bg-slate-50 border border-slate-200 rounded-2xl w-full col-span-3 shadow-sm">
                        <h5 class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-3">Texto original:</h5>
                        <p class="text-base leading-relaxed text-slate-700 italic">
                            {{ $textoAgenda }}
                        </p>
                    </div>

                </div>

            </div>

        @endforeach


</div>

    </div>

</div>

{{-- ================= MODAL ================= --}}
<div x-show="openModal"
     class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4"
     style="display:none;">

    <div
        class="bg-white max-w-lg w-full p-8 rounded-[2.5rem] shadow-2xl"
        @click.away="openModal = false">

        <div class="text-center mb-6">

            <h2 class="text-2xl font-black text-slate-900">
                Reporte de Sesión
            </h2>

            <p class="text-slate-500 text-sm">
                Registrar seguimiento semanal
            </p>

        </div>

        {{-- ================= FORMULARIO ================= --}}
        <form action="{{ route('seguimiento.store', $paciente->id) }}"
              method="POST"
              class="space-y-4">

            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block font-bold text-xs mb-1">
                        Autonomía
                    </label>

                    <select name="autonomia"
                            class="w-full p-3 rounded-xl border"
                            required>

                        <option value="20">Apoyo Total</option>
                        <option value="40">Apoyo Parcial</option>
                        <option value="60">Apoyo Verbal</option>
                        <option value="80">Supervisión</option>
                        <option value="100">Independiente</option>

                    </select>
                </div>

                <div>
                    <label class="block font-bold text-xs mb-1">
                        Comunicación
                    </label>

                    <select name="comunicacion"
                            class="w-full p-3 rounded-xl border"
                            required>

                        <option value="20">Baja</option>
                        <option value="60">Uso de pictogramas</option>
                        <option value="100">Fluida</option>

                    </select>
                </div>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block font-bold text-xs mb-1">
                        Estabilidad
                    </label>

                    <select name="estabilidad"
                            class="w-full p-3 rounded-xl border"
                            required>

                        <option value="20">Desregulado</option>
                        <option value="60">Intermedio</option>
                        <option value="100">Calmo</option>

                    </select>
                </div>

                <div>
                    <label class="block font-bold text-xs mb-1">
                        Compromiso
                    </label>

                    <select name="compromiso"
                            class="w-full p-3 rounded-xl border"
                            required>

                        <option value="20">Rechazo</option>
                        <option value="60">Parcial</option>
                        <option value="100">Excelente</option>

                    </select>
                </div>

            </div>

            <div>

                <label class="block font-bold text-xs mb-1">
                    Consistencia
                </label>

                <select name="consistencia"
                        class="w-full p-3 rounded-xl border"
                        required>

                    <option value="20">No completó</option>
                    <option value="60">Parcial</option>
                    <option value="100">Completó todo</option>

                </select>

            </div>

            <div>

                <label class="block font-bold text-xs mb-1">
                    Observaciones
                </label>

                <textarea
                    name="observacion_padre"
                    class="w-full p-4 rounded-2xl border h-24 resize-none"
                    placeholder="Comentarios..."></textarea>

            </div>

            <div class="flex gap-3 pt-2">

                <button
                    type="button"
                    @click="openModal = false"
                    class="flex-1 py-4 font-bold text-slate-400">

                    Cancelar
                </button>

                <button
                    type="submit"
                    class="flex-[2] bg-cyan-500 text-white py-4 rounded-2xl font-black">

                    Guardar Reporte
                </button>

            </div>

        </form>

    </div>

</div>

{{-- ================= SCRIPTS ================= --}}
<script>

document.addEventListener('DOMContentLoaded', function(){

    // ================= RADAR =================
    const ctxRadar =
        document.getElementById('radarProgreso').getContext('2d');

    const datosRadar =
        {!! json_encode($dataRadar ?? [0,0,0,0,0]) !!};

    new Chart(ctxRadar, {

        type:'radar',

        data:{
            labels:[
                'Autonomía',
                'Comunicación',
                'Estabilidad',
                'Compromiso',
                'Consistencia'
            ],

            datasets:[{
                label:'Evaluación Actual',
                data:datosRadar,
                backgroundColor:'rgba(34,211,238,.2)',
                borderColor:'#22d3ee',
                pointBackgroundColor:'#22d3ee',
                borderWidth:2
            }]
        },

        options:{
            responsive:true,
            maintainAspectRatio:false,

            scales:{
                r:{
                    suggestedMin:0,
                    suggestedMax:100,

                    ticks:{
                        stepSize:20
                    }
                }
            }
        }
    });

    // ================= LINEA =================
    const ctxLinea =
        document.getElementById('lineaEvolucion').getContext('2d');

    const datosAutonomia =
        {!! json_encode($datosAutonomia ?? [null,null,null,null]) !!};

    const datosComunicacion =
        {!! json_encode($datosComunicacion ?? [null,null,null,null]) !!};

    const datosEstabilidad =
        {!! json_encode($datosEstabilidad ?? [null,null,null,null]) !!};

    new Chart(ctxLinea, {

        type:'line',

        data:{

            labels:[
                'Semana 1',
                'Semana 2',
                'Semana 3',
                'Semana 4'
            ],

            datasets:[

                {
                    label:'Autonomía',
                    data:datosAutonomia,
                    borderColor:'#22d3ee',
                    tension:.3
                },

                {
                    label:'Comunicación',
                    data:datosComunicacion,
                    borderColor:'#3b82f6',
                    tension:.3
                },

                {
                    label:'Estabilidad',
                    data:datosEstabilidad,
                    borderColor:'#6366f1',
                    tension:.3
                }

            ]
        },

        options:{
            responsive:true,
            maintainAspectRatio:false,

            scales:{
                y:{
                    min:0,
                    max:100,

                    ticks:{
                        stepSize:20
                    }
                }
            }
        }

    });

});

</script>

</body>
</html>