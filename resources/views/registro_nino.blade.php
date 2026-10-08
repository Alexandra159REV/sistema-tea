<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del Niño - {{ $paciente->nombre ?? 'Nuevo Registro' }}</title>
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root { --accent: #33c3e1; --text-slate: #1e293b; }
        body {
            background-color: #f8fafc;
            background-image: radial-gradient(#e2e8f0 0.5px, transparent 0.5px);
            background-size: 24px 24px;
            font-family: 'Segoe UI', system-ui, sans-serif;
            color: var(--text-slate);
        }
        .avatar-main {
            width: 120px; height: 120px;
            background: white;
            border-radius: 35px;
            display: flex; align-items: center; justify-content: center;
            font-size: 3rem; font-weight: 800; color: #33c3e1;
            box-shadow: 0 15px 30px -5px rgba(0,0,0,0.1);
            border: 5px solid #fff;
        }
        .glass-card { 
            background: rgba(255, 255, 255, 0.9); 
            backdrop-filter: blur(10px); 
            border-radius: 2.5rem; 
            border: 1px solid rgba(255, 255, 255, 0.5); 
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.05); 
        }
        .input-modern { 
            background: #f1f5f9; 
            border: 2px solid transparent; 
            border-radius: 1.25rem; 
            padding: 0.85rem 1.25rem; 
            width: 100%; 
            transition: all 0.2s; 
        }
        .input-modern:focus { 
            background: #ffffff; 
            border-color: #33c3e1; 
            box-shadow: 0 0 0 4px rgba(51, 195, 225, 0.1); 
        }
        .modal-overlay { background: rgba(15, 23, 42, 0.8); backdrop-filter: blur(8px); }
        
        @media print { .no-print { display: none !important; } }
    </style>
</head>
<body class="py-10 px-4" x-data="{ openModal: false }">

<div class="max-w-5xl mx-auto">
    
    <div class="text-center mb-12">
        <div class="relative inline-block mb-6">
            <div class="avatar-main mx-auto">
                {{ strtoupper(substr($paciente->nombre ?? 'N', 0, 2)) }}
            </div>
            <div class="absolute -bottom-2 -right-2 bg-green-500 w-8 h-8 rounded-full border-4 border-white shadow-lg"></div>
        </div>
        <h1 class="text-4xl font-black text-slate-800 tracking-tight">{{ $paciente->nombre ?? 'Nuevo Paciente' }}</h1>
        <p class="text-cyan-600 font-bold mt-2 uppercase tracking-widest text-xs">Paciente • {{ $paciente->edad ?? '0' }} años</p>

        <div class="flex flex-wrap justify-center gap-4 mt-10 no-print">
            <a href="{{ route('index') }}" class="px-8 py-3 rounded-2xl font-bold border-2 border-slate-200 text-slate-500 hover:border-cyan-500 hover:text-cyan-500 transition-all flex items-center">
                <i class="fas fa-chevron-left me-2"></i> Volver
            </a>

            <button @click="openModal = true" class="bg-slate-900 text-white px-10 py-4 rounded-2xl font-black shadow-xl hover:bg-black transition-all flex items-center transform hover:scale-105">
                <i class="fas fa-clipboard-check me-3 text-cyan-400"></i> Reportar Sesión Hoy
            </button>

            <button onclick="window.print()" class="bg-white text-slate-700 px-8 py-3 rounded-2xl font-bold shadow-md hover:shadow-lg border border-slate-100 transition-all">
                <i class="fas fa-print me-2"></i> Imprimir Plan
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
        
        <div class="lg:col-span-1 space-y-8">
            <div class="glass-card p-8 text-center">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-6">Identificador</h3>
                <div class="aspect-square bg-slate-50 rounded-[2.5rem] border-4 border-dashed border-slate-200 flex items-center justify-center mb-6 overflow-hidden relative">
                    @if(isset($paciente->imagen_personalizada) && $paciente->imagen_personalizada)
                        <img src="{{ asset($paciente->imagen_personalizada) }}" class="w-full h-full object-contain p-4">
                    @else
                        <i class="fas fa-user text-6xl text-slate-200"></i>
                    @endif
                </div>
                <p class="text-sm text-slate-400 italic px-4">Espacio de trabajo de {{ $paciente->nombre ?? 'Nuevo Paciente' }}</p>
            </div>

            <div class="glass-card p-6">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest text-center mb-4">Progreso de Capacidades</h3>
                <div class="h-64">
                    <canvas id="radarProgreso"></canvas>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="glass-card p-10 h-full">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 bg-cyan-100 rounded-2xl flex items-center justify-center text-cyan-600">
                        <i class="fas fa-id-card text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-extrabold text-slate-800">Registro de Paciente</h2>
                        <p class="text-slate-500 text-sm font-medium">Paso 1: Información básica general</p>
                    </div>
                </div>
                
                <form action="{{ route('paciente.storeBasico') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block font-black text-[11px] text-slate-400 uppercase mb-2 tracking-wider">Nombre Completo</label>
                        <input type="text" name="nombre" class="input-modern text-base font-semibold text-slate-700" 
                            placeholder="Ej: Mateo Alejandro Ramos" value="{{ $paciente->nombre ?? '' }}" required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-black text-[11px] text-slate-400 uppercase mb-2 tracking-wider">Edad (Años)</label>
                            <input type="number" name="edad" min="0" max="18" class="input-modern text-base font-semibold text-slate-700" 
                                placeholder="Ej: 6" value="{{ $paciente->edad ?? '' }}" required>
                        </div>

                        <div>
                            <label class="block font-black text-[11px] text-slate-400 uppercase mb-2 tracking-wider">Grado / Nivel de TEA</label>
                            <select name="nivel_tea" class="input-modern text-base font-bold text-slate-700" required>
                                <option value="" disabled {{ !isset($paciente->nivel_tea) ? 'selected' : '' }} hidden>Selecciona un grado</option>
                                <option value="Grado 1" {{ (isset($paciente->nivel_tea) && $paciente->nivel_tea == 'Grado 1') ? 'selected' : '' }}>Grado 1 (Necesita ayuda superficial)</option>
                                <option value="Grado 2" {{ (isset($paciente->nivel_tea) && $paciente->nivel_tea == 'Grado 2') ? 'selected' : '' }}>Grado 2 (Necesita ayuda notable)</option>
                                <option value="Grado 3" {{ (isset($paciente->nivel_tea) && $paciente->nivel_tea == 'Grado 3') ? 'selected' : '' }}>Grado 3 (Necesita ayuda muy notable)</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="pt-4">
                        <button type="submit" class="w-full bg-[#33c3e1] text-white py-5 rounded-[1.5rem] font-black text-xl shadow-lg shadow-cyan-100 hover:bg-cyan-500 transition-all flex items-center justify-center gap-3 group">
                            <span>Continuar al Paso 2</span>
                            <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div x-show="openModal" 
         class="fixed inset-0 z-[100] flex items-center justify-center modal-overlay p-4"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         style="display: none;">
        
        <div class="bg-white max-w-lg w-full p-10 rounded-[3rem] shadow-2xl relative max-h-[90vh] overflow-y-auto" @click.away="openModal = false">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-black text-slate-900 mb-2">Reporte de Sesión</h2>
                <p class="text-slate-500 text-sm font-medium">Califica el desempeño de hoy para el gráfico</p>
            </div>

            <form action="{{ route('seguimiento.store', $paciente->id ?? 0) }}" method="POST" class="space-y-5">
                @csrf
                
                <div class="grid grid-cols-1 gap-5">
                    <div>
                        <label class="block font-black text-[10px] text-slate-400 uppercase mb-1">Autonomía (Apoyo)</label>
                        <select name="autonomia" class="input-modern text-sm font-bold" required>
                            <option value="20">Apoyo Físico Total</option>
                            <option value="40">Apoyo Físico Parcial</option>
                            <option value="60">Apoyo Verbal/Visual</option>
                            <option value="80">Supervisión Mínima</option>
                            <option value="100">Totalmente Independiente</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-black text-[10px] text-slate-400 uppercase mb-1">Comunicación</label>
                        <select name="comunicacion" class="input-modern text-sm font-bold" required>
                            <option value="20">Nula/Retraído</option>
                            <option value="40">Solo Necesidades Básicas</option>
                            <option value="60">Uso de Pictogramas/Señas</option>
                            <option value="80">Lenguaje Espontáneo</option>
                            <option value="100">Interacción Fluida</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-black text-[10px] text-slate-400 uppercase mb-1">Estabilidad Emocional</label>
                        <select name="estabilidad" class="input-modern text-sm font-bold" required>
                            <option value="20">Crisis / Desregulación</option>
                            <option value="60">Inquieto pero regulable</option>
                            <option value="100">Muy Calmo / Enfocado</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-black text-[10px] text-slate-400 uppercase mb-1">Compromiso / Motivación</label>
                        <select name="compromiso" class="input-modern text-sm font-bold" required>
                            <option value="20">Rechazo a la actividad</option>
                            <option value="60">Participación Pasiva</option>
                            <option value="100">Muy Entusiasta</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-black text-[10px] text-slate-400 uppercase mb-1">Consistencia en Tareas</label>
                        <select name="consistencia" class="input-modern text-sm font-bold" required>
                            <option value="20">No terminó ninguna tarea</option>
                            <option value="60">Completó la mayoría</option>
                            <option value="100">Completó todo el plan</option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center justify-between p-4 bg-rose-50 rounded-2xl border border-rose-100">
                    <span class="text-xs font-bold text-slate-700">¿Hubo molestias físicas o malestar?</span>
                    <input type="checkbox" name="molestia_fisica" value="1" class="w-6 h-6 rounded-lg accent-rose-500">
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="button" @click="openModal = false" class="flex-1 py-4 font-bold text-slate-400 hover:text-slate-600 transition-colors">Cancelar</button>
                    <button type="submit" class="flex-[2] bg-cyan-500 text-white py-4 rounded-2xl font-black shadow-lg hover:bg-cyan-600 transition-all">
                        Guardar Reporte
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const datosProgreso = [
                {{ $ultimoSeguimiento->autonomia ?? 50 }},
                {{ $ultimoSeguimiento->comunicacion ?? 50 }},
                {{ $ultimoSeguimiento->estabilidad ?? 50 }},
                {{ $ultimoSeguimiento->compromiso ?? 50 }},
                {{ $ultimoSeguimiento->consistencia ?? 50 }}
            ];

            const ctxRadar = document.getElementById('radarProgreso').getContext('2d');
            if(ctxRadar) {
                new Chart(ctxRadar, {
                    type: 'radar',
                    data: {
                        labels: ['Autonomía', 'Comunicación', 'Estabilidad', 'Compromiso', 'Consistencia'],
                        datasets: [{
                            label: 'Nivel Actual',
                            data: datosProgreso,
                            backgroundColor: 'rgba(51, 195, 225, 0.2)',
                            borderColor: '#33c3e1',
                            borderWidth: 3,
                            pointBackgroundColor: '#33c3e1',
                            pointBorderColor: '#fff',
                            pointHoverBackgroundColor: '#fff',
                            pointHoverBorderColor: '#33c3e1',
                            pointRadius: 4
                        }]
                    },
                    options: {
                        scales: {
                            r: {
                                min: 0,
                                max: 100,
                                beginAtZero: true,
                                ticks: { display: false, stepSize: 20 },
                                grid: { color: '#e2e8f0' },
                                angleLines: { color: '#e2e8f0' },
                                pointLabels: {
                                    font: { size: 11, weight: '700', family: 'system-ui' },
                                    color: '#64748b'
                                }
                            }
                        },
                        plugins: {
                            legend: { display: false },
                            tooltip: { enabled: true }
                        },
                        maintainAspectRatio: false
                    }
                });
            }
        });
    </script>
</div>
</body>
</html>