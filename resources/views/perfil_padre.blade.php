<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Familiar - {{ $paciente->nombre }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --neuro-cyan: #33c3e1;
            --neuro-cyan-dark: #00acc1;
            --bg-light: #f0faff;
            --sidebar-color: #16222e;
        }
        
        body {
            background-color: var(--bg-light);
            background-image: linear-gradient(rgba(240, 250, 255, 0.95), rgba(240, 250, 255, 0.95)),
                              url('https://www.transparenttextures.com/patterns/cubes.png');
            font-family: 'Inter', sans-serif;
        }

        .hero-bg {
            background: var(--sidebar-color);
            height: 180px;
            border-bottom: 5px solid var(--neuro-cyan);
        }

        .profile-card-offset { margin-top: -90px; }

        .neuro-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            border: 1px solid rgba(51, 195, 225, 0.1);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
        }

        .avatar-main {
            width: 150px; height: 150px;
            background: white;
            border-radius: 25px;
            border: 6px solid white;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            display: flex; align-items: center; justify-content: center;
            font-size: 3.5rem; font-weight: 800; color: var(--neuro-cyan);
        }

        .slot-grid {
            transition: all 0.3s ease;
        }
        
        .slot-grid:hover {
            border-color: var(--neuro-cyan) !important;
            transform: translateY(-2px);
        }

        @media print {
            .no-print { display: none; }
            body { background: white !important; }
            .neuro-card { box-shadow: none; border: 1px solid #eee; }
        }
    </style>
</head>
<body class="min-h-screen">

    <div class="hero-bg w-full flex items-center px-12 no-print">
        <div class="opacity-20">
            <i class="fas fa-puzzle-piece text-white text-5xl"></i>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 pb-12">
        <div class="profile-card-offset text-center mb-10">
            <div class="relative inline-block mb-4">
                <div class="avatar-main mx-auto">
                    {{ strtoupper(substr($paciente->nombre, 0, 2)) }}
                </div>
                <div class="absolute bottom-4 right-0 bg-green-500 w-7 h-7 rounded-full border-4 border-white shadow-sm"></div>
            </div>
            <h1 class="text-4xl font-extrabold text-slate-800 tracking-tight">{{ $paciente->nombre }}</h1>
            <p class="text-cyan-600 font-semibold mt-2">Programa de Neurodesarrollo Personalizado • {{ $paciente->edad }} años</p>

            <div class="flex justify-center gap-4 mt-8 no-print">
                <a href="{{ route('index') }}" class="px-7 py-3 rounded-2xl font-bold flex items-center border-2 border-slate-200 text-slate-500 hover:border-cyan-500 hover:text-cyan-500 transition-all">
                    <i class="fas fa-chevron-left me-2"></i> Volver a Gestión
                </a>
                <button onclick="window.print()" class="bg-[#33c3e1] text-white px-8 py-3 rounded-2xl font-bold flex items-center shadow-lg hover:bg-cyan-500 transition-all">
                    <i class="fas fa-print me-2"></i> Imprimir Reporte
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
            <div class="lg:col-span-1">
                <div class="neuro-card p-7 h-full">
                    <div class="flex items-center justify-between mb-6 border-b pb-2">
                        <h3 class="text-slate-400 text-xs font-black uppercase tracking-[0.2em]">Apoyo Visual Sensorial</h3>
                        <i class="fas fa-robot text-cyan-200"></i>
                    </div>
                    
                    <div class="bg-white p-5 rounded-[30px] text-center shadow-inner border-2 border-dashed border-cyan-100">
                        @if($paciente->imagen_personalizada)
                            <div class="rounded-2xl p-4 mx-auto mb-3 flex items-center justify-center"
                                 style="background-color: {{ $paciente->color_fondo ?? '#f8fafc' }}; width: 180px; height: 180px;">
                                <img src="{{ asset($paciente->imagen_personalizada) }}"
                                     alt="Pictograma IA"
                                     class="w-full h-full object-contain mix-blend-multiply">
                            </div>
                            <p class="text-[11px] text-slate-500 italic">Identificador único generado por IA</p>
                        @else
                            <div class="w-[180px] h-[180px] bg-slate-100 rounded-2xl mx-auto mb-3 flex items-center justify-center">
                                <i class="fas fa-spinner fa-spin text-cyan-300 text-4xl"></i>
                            </div>
                            <p class="text-[11px] text-slate-400">Procesando imagen sensorial...</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="neuro-card p-8 h-full flex flex-col">
                    <div class="mb-6">
                        <h2 class="text-2xl font-extrabold text-slate-800">Diario del Niño (Analizador IA)</h2>
                        <p class="text-slate-400 text-sm">Describe la actividad para buscar el pictograma adecuado</p>
                    </div>

                    <form action="{{ route('ia.analizar', $paciente->id) }}" method="POST" class="flex-grow flex flex-col no-print">
                        @csrf
                        <textarea name="comentario_padre" rows="5"
                            class="w-full p-6 rounded-3xl border-2 border-slate-100 focus:border-cyan-400 focus:ring-0 text-slate-600 text-sm transition-all resize-none bg-slate-50/50"
                            placeholder="Ejemplo: Necesito un pictograma para lavarse los dientes con pasta roja..."></textarea>
                        
                        <button type="submit" class="mt-4 bg-cyan-500 text-white px-8 py-4 rounded-2xl font-bold shadow-lg hover:bg-cyan-600 transition-all flex items-center justify-center">
                            <i class="fas fa-search-plus me-2"></i> Analizar Actividad con IA
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <h2 class="text-3xl font-black text-slate-800 mb-8 flex items-center gap-3 px-4">
            <i class="fas fa-calendar-check text-cyan-500"></i>
            Planificación Semanal de Apoyos
        </h2>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            @php 
                $diasConfig = [
                    'lunes'     => ['color' => '#10b981', 'icon' => 'fa-sun'],
                    'martes'    => ['color' => '#f59e0b', 'icon' => 'fa-bolt'],
                    'miercoles' => ['color' => '#3b82f6', 'icon' => 'fa-water'],
                    'jueves'    => ['color' => '#8b5cf6', 'icon' => 'fa-leaf'],
                    'viernes'   => ['color' => '#ec4899', 'icon' => 'fa-star'],
                    'sabado'    => ['color' => '#6366f1', 'icon' => 'fa-gamepad'],
                    'domingo'   => ['color' => '#f43f5e', 'icon' => 'fa-heart'],
                ];

                // Lista completa basada en tu estructura de carpetas
                $carpetasPictos = [
                    'acciones', 'animales', 'aseo_personal', 'comida', 'deberes',
                    'emociones', 'higiene', 'instrumentos_musicales', 'jardineria',
                    'lugares', 'necesidades_basicas', 'ordenar_habitacion', 'parientes',
                    'preparar_merienda', 'regulacion_emocional', 'rutinas_terapia',
                    'seguridad_salud', 'social', 'tareas_escolares', 'tareas_hogar',
                    'tecnologia', 'transporte', 'vestirse', 'prueba' 
                ];
            @endphp
                
            @foreach($diasConfig as $dia => $config)
                <div class="neuro-card p-8 border-t-[10px] w-full flex flex-col" style="border-top-color: {{ $config['color'] }}">
                    <div class="flex items-center gap-4 mb-5 border-b pb-3">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-white shadow-lg" style="background-color: {{ $config['color'] }}">
                            <i class="fas {{ $config['icon'] }} text-xl"></i>
                        </div>
                        <h3 class="font-black text-slate-800 uppercase text-xl tracking-tight">{{ $dia }}</h3>
                    </div>

                    <div class="bg-slate-50 p-4 rounded-2xl mb-6 border border-slate-100 min-h-[80px]">
                        <p class="text-sm text-slate-600 font-medium italic">
                            {{ $paciente->{"agenda_$dia"} ?? 'Sin actividades asignadas' }}
                        </p>
                    </div>

                    @php
                        $textoAgenda = $paciente->{"agenda_$dia"};
                        $actividades = preg_split('/(?=\d+\.)/', $textoAgenda, -1, PREG_SPLIT_NO_EMPTY);
                    @endphp

                    <div class="grid grid-cols-3 gap-4"> 
                        @for($i = 1; $i <= 6; $i++)
                            @php
                                $tareaActual = '';
                                $nombreImagen = '';
                                $rutaFinal = '';

                                foreach($actividades as $act) {
                                    if(str_starts_with(trim($act), $i . ".")) {
                                        $tareaActual = trim($act);
                                        // 1. Limpiamos el nombre: quitamos el número inicial y espacios
                                        $crudo = trim(preg_replace('/^\d+\.\s*/', '', $tareaActual));
                                        
                                        // 2. Normalización para búsqueda de archivos:
                                        // Convertimos a minúsculas y manejamos caracteres especiales
                                        $nombreImagen = strtolower($crudo);
                                        $buscar = array('á', 'é', 'í', 'ó', 'ú', 'ñ', ' ');
                                        $reemplazar = array('a', 'e', 'i', 'o', 'u', 'n', '_');
                                        $nombreImagen = str_replace($buscar, $reemplazar, $nombreImagen);
                                        break;
                                    }
                                }

                                if($nombreImagen) {
                                    foreach($carpetasPictos as $carpeta) {
                                        // Intentamos buscar el archivo con .png
                                        $archivo = "pictogramas/{$carpeta}/{$nombreImagen}.png";
                                        if(file_exists(public_path($archivo))) {
                                            $rutaFinal = asset($archivo);
                                            break;
                                        }
                                    }
                                }
                            @endphp

                            <div class="flex flex-col items-center">
                                <div class="slot-grid bg-white border-2 border-dashed border-slate-200 rounded-2xl mb-2 w-full aspect-square flex items-center justify-center overflow-hidden bg-slate-50/30">
                                    @if($rutaFinal)
                                        <img src="{{ $rutaFinal }}" alt="{{ $nombreImagen }}" class="w-full h-full object-contain p-2">
                                    @else
                                        <span class="text-3xl text-slate-200 font-bold">{{ $i }}</span>
                                    @endif
                                </div>
                                @if($tareaActual)
                                    <p class="text-[10px] leading-tight text-center font-bold text-slate-500 uppercase truncate w-full">
                                        {{ trim(preg_replace('/^\d+\.\s*/', '', $tareaActual)) }}
                                    </p>
                                @endif
                            </div>
                        @endfor
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>