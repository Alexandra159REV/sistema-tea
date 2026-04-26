<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Médico - Centro de Neurodesarrollo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --bg-main: #f8fafc;
            --accent: #3b82f6;
            --text-slate: #1e293b;
        }

        body {
            background-color: var(--bg-main);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            color: var(--text-slate);
        }

        .glass-card {
            background: #ffffff;
            border-radius: 2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.02);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        .input-modern {
            background: #f1f5f9;
            border: 2px solid transparent;
            border-radius: 1.25rem;
            padding: 1rem 1.5rem;
            transition: all 0.2s;
            outline: none;
        }

        .input-modern:focus {
            background: #ffffff;
            border-color: var(--accent);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-slate);
            letter-spacing: -0.025em;
        }

        .medical-badge {
            background: #eff6ff;
            color: #1d4ed8;
            padding: 0.25rem 1rem;
            border-radius: 9999px;
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
        }

        .accordion-item-modern {
            border: none;
            background: #f8fafc;
            border-radius: 1.25rem !important;
            margin-bottom: 1rem;
            overflow: hidden;
        }

        .btn-action {
            padding: 0.75rem 1.5rem;
            border-radius: 1rem;
            font-weight: 700;
            transition: all 0.3s;
        }

        /* Estilo para la previsualización de la IA */
        .ia-preview-card {
            background: linear-gradient(135deg, #ffffff 0%, #eff6ff 100%);
            border: 2px solid #dbeafe;
        }
    </style>
</head>
<body class="p-4 md:p-8">

<div class="max-w-7xl mx-auto">
    {{-- Encabezado --}}
    <div class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-3xl font-black text-slate-800 tracking-tighter">NeuroDashboard</h1>
            <p class="text-slate-400 font-medium">Gestión Clínica y Seguimiento de Pacientes</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ url('/formulario') }}" class="bg-blue-600 text-white btn-action hover:bg-blue-700 shadow-lg shadow-blue-100">
                <i class="fas fa-plus me-2"></i> Nuevo Paciente
            </a>
            
            <a href="{{ route('logout') }}" class="bg-slate-200 text-slate-600 btn-action hover:bg-slate-300" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </div>

    {{-- Buscador --}}
    <div class="glass-card p-6 mb-8">
        <form action="{{ url('/dashboard') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="relative flex-grow">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" name="search" class="input-modern w-full pl-12" 
                       placeholder="Buscar por nombre del paciente..." value="{{ request('search') }}">
            </div>
            <button type="submit" class="bg-slate-800 text-white btn-action hover:bg-slate-900 px-10">
                Consultar Historial
            </button>
        </form>
    </div>

    @if(isset($paciente))
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        {{-- Columna Izquierda: Perfil y Recurso IA --}}
        <div class="lg:col-span-4 space-y-6">
            <div class="glass-card p-8 text-center">
                <div class="relative inline-block">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($paciente->nombre) }}&background=3b82f6&color=fff&size=128" 
                         class="rounded-3xl mb-4 mx-auto shadow-md" alt="Avatar">
                    <span class="absolute -bottom-2 -right-2 bg-green-500 border-4 border-white w-6 h-6 rounded-full"></span>
                </div>
                <h2 class="text-2xl font-bold text-slate-800">{{ $paciente->nombre }}</h2>
                <span class="medical-badge mt-2 inline-block">TEA {{ $paciente->nivel_tea }}</span>
                
                <div class="grid grid-cols-2 gap-4 mt-8 text-left">
                    <div class="bg-slate-50 p-3 rounded-2xl">
                        <p class="text-[10px] uppercase font-black text-slate-400">Edad</p>
                        <p class="font-bold text-slate-700">{{ $paciente->edad }} años</p>
                    </div>
                    <div class="bg-slate-50 p-3 rounded-2xl">
                        <p class="text-[10px] uppercase font-black text-slate-400">ID Paciente</p>
                        <p class="font-bold text-slate-700">#{{ str_pad($paciente->id, 3, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>
            </div>

            {{-- NUEVA SECCIÓN: Previsualización del Recurso Generado por IA --}}
            <div class="glass-card p-6 ia-preview-card">
                <h3 class="font-bold text-slate-800 mb-4 flex items-center text-sm">
                    <i class="fas fa-robot me-2 text-blue-600"></i> Recurso Sensorial Generado
                </h3>
                
                @if($paciente->imagen_personalizada)
                    <div class="rounded-2xl p-4 flex flex-col items-center" 
                         style="background-color: {{ $paciente->color_preferido ?? '#ffffff' }}; border: 1px solid #e2e8f0;">
                        <img src="{{ asset($paciente->imagen_personalizada) }}" 
                             alt="Pictograma Personalizado" 
                             class="w-32 h-32 object-contain mix-blend-multiply mb-3">
                        <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest">Estado: Activo</p>
                    </div>
                @else
                    <div class="bg-white/50 border-2 border-dashed border-slate-200 rounded-2xl p-8 text-center">
                        <i class="fas fa-spinner fa-spin text-slate-300 text-2xl mb-2"></i>
                        <p class="text-xs text-slate-400">No se ha generado ningún pictograma personalizado aún.</p>
                    </div>
                @endif
            </div>

            <div class="glass-card p-8">
                <h3 class="font-bold text-slate-800 mb-6 flex items-center">
                    <i class="fas fa-chart-pie me-2 text-blue-500"></i> Análisis Sensorial
                </h3>
                <canvas id="radarChart"></canvas>
            </div>
        </div>

        {{-- Columna Derecha: Historia Clínica --}}
        <div class="lg:col-span-8">
            <div class="glass-card p-10 h-full">
                <div class="flex justify-between items-start mb-8 border-b border-slate-100 pb-6">
                    <div>
                        <h2 class="text-2xl font-black text-blue-600 uppercase tracking-tight">Historia Clínica Digital</h2>
                        <p class="text-slate-400 text-sm">Registro Longitudinal de Evolución Terapéutica</p>
                    </div>
                    <button onclick="window.print()" class="text-slate-400 hover:text-blue-500 transition-colors">
                        <i class="fas fa-print text-xl"></i>
                    </button>
                </div>

                <div class="space-y-4">
                    <details class="group accordion-item-modern" open>
                        <summary class="list-none p-5 cursor-pointer flex justify-between items-center font-bold text-slate-700">
                            <span><i class="fas fa-file-medical me-3 text-blue-500"></i> I. Evaluación y Antecedentes</span>
                            <i class="fas fa-chevron-down text-xs group-open:rotate-180 transition-transform"></i>
                        </summary>
                        <div class="p-6 pt-0 text-slate-600 leading-relaxed text-sm">
                            <p class="mb-3"><strong>Detalle Visual:</strong> {{ $paciente->detalle_visual }}</p>
                            <p class="mb-3"><strong>Detalle Auditivo:</strong> {{ $paciente->detalle_auditivo }}</p>
                            <p><strong>Detonantes:</strong> {{ $paciente->detonantes }}</p>
                        </div>
                    </details>

                    <details class="group accordion-item-modern">
                        <summary class="list-none p-5 cursor-pointer flex justify-between items-center font-bold text-slate-700">
                            <span><i class="fas fa-stethoscope me-3 text-blue-500"></i> II. Diagnóstico Clínico</span>
                            <i class="fas fa-chevron-down text-xs group-open:rotate-180 transition-transform"></i>
                        </summary>
                        <div class="p-6 pt-0 text-slate-600 text-sm">
                            Manifestaciones compatibles con <strong>TEA Nivel {{ $paciente->nivel_tea }}</strong>. 
                            Hipersensibilidad detectada. Preferencia por contraste: <strong>{{ $paciente->contraste }}</strong>.
                        </div>
                    </details>

                    <div class="accordion-item-modern border-l-4 border-green-500 bg-green-50">
                        <div class="p-5 font-bold text-green-700 flex justify-between">
                            <span><i class="fas fa-chart-line me-3"></i> III. Evolución Clínica</span>
                            <span class="text-[10px] bg-green-200 px-2 py-1 rounded">SISTEMA INTELIGENTE ACTIVO</span>
                        </div>
                        <div class="p-6 pt-0 text-green-800 text-sm">
                            <p>Sugerencias generadas por la IA para este paciente: <br>
                               <span class="italic text-slate-600">{{ $paciente->sugerencias_pictogramas }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Almacén de datos para JS --}}
    <div id="dataStore" 
         data-com="{{ $paciente->p_comunicacion ?? 5 }}" 
         data-soc="{{ $paciente->p_social ?? 5 }}" 
         data-rut="{{ $paciente->p_rutina ?? 5 }}" 
         data-aut="{{ $paciente->p_autonomia ?? 5 }}" 
         class="hidden"></div>

    @elseif(request('search'))
    <div class="glass-card p-10 text-center mt-8">
        <div class="text-5xl mb-4">🔍</div>
        <h3 class="text-xl font-bold text-slate-700">Paciente no encontrado</h3>
        <p class="text-slate-400">Verifique el nombre o intente con el ID del paciente.</p>
    </div>
    @endif

    {{-- Lista de Pacientes --}}
    <div class="mt-12">
        <h2 class="section-title mb-6">Pacientes en Seguimiento</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach ($pacientes as $p)
            <div class="glass-card p-5 flex items-center hover:shadow-lg transition-all cursor-pointer" 
                 onclick="location.href='{{ url('/dashboard?search='.$p->nombre) }}'">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($p->nombre) }}&background=f1f5f9&color=3b82f6" 
                     class="w-12 h-12 rounded-2xl me-4" alt="Avatar">
                <div>
                    <h4 class="font-bold text-slate-700 text-sm">{{ $p->nombre }}</h4>
                    <p class="text-[11px] text-slate-400 uppercase font-black">Nivel {{ $p->nivel_tea }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    // Inicialización del Gráfico Radar
    if (document.getElementById('radarChart')) {
        const store = document.getElementById('dataStore');
        const ctx = document.getElementById('radarChart').getContext('2d');
        
        new Chart(ctx, {
            type: 'radar',
            data: {
                labels: ['Comunicación', 'Social', 'Rutinas', 'Autonomía'],
                datasets: [{
                    label: 'Estado Actual',
                    data: [
                        store.getAttribute('data-com'),
                        store.getAttribute('data-soc'),
                        store.getAttribute('data-rut'),
                        store.getAttribute('data-aut')
                    ],
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 3,
                    pointBackgroundColor: 'rgba(59, 130, 246, 1)',
                    pointRadius: 4
                }]
            },
            options: {
                scales: {
                    r: {
                        min: 0,
                        max: 10,
                        ticks: { display: false },
                        grid: { color: '#e2e8f0' }
                    }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });
    }
</script>

</body>
</html>