@extends('layouts.app')

@section('content')
<div class="container py-4">
    {{-- PROCESAMIENTO PHP PARA BÚSQUEDA DE PICTOGRAMAS --}}
    @php
        // 1. Cargar el JSON de pictogramas
        $jsonPath = public_path('pictogramas/index.json');
        $bibliotecaPictos = [];
        if(file_exists($jsonPath)) {
            $bibliotecaPictos = json_decode(file_get_contents($jsonPath), true);
        }

        // 2. Lógica para procesar el texto ingresado (si existe) y buscar rutas reales
        // Nota: Asumimos que $conceptos viene del controlador como un array de términos
        // Si no existe, inicializamos para evitar errores
        $conceptosFinales = [];
        
        if(isset($conceptos) && is_array($conceptos)) {
            foreach($conceptos as $conceptoOriginal) {
                $nombreImagen = strtolower($conceptoOriginal['texto']);
                $rutaEncontrada = 'pictogramas/default.png'; // Imagen por defecto

                foreach($bibliotecaPictos as $picto) {
                    $nombrePictoJson = strtolower($picto['nombre']);
                    
                    // Comparación flexible: ¿el texto buscado está contenido en el nombre del JSON?
                    if(str_contains($nombreImagen, $nombrePictoJson) || str_contains($nombrePictoJson, $nombreImagen)) {
                        // Limpiar ruta para asegurar que asset() funcione correctamente
                        $rutaBase = str_replace('public/', '', $picto['ruta']);
                        $rutaEncontrada = $rutaBase;
                        break;
                    }
                }

                $conceptosFinales[] = [
                    'texto' => $conceptoOriginal['texto'],
                    'ruta' => $rutaEncontrada
                ];
            }
        }
    @endphp

    {{-- SECCIÓN SUPERIOR: GRÁFICO DE PROGRESO Y ANALIZADOR --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8 mt-12">
        
        {{-- BLOQUE: GRÁFICO DE PROGRESO SEMANAL --}}
        <div class="lg:col-span-1">
            <div class="neuro-card p-7 h-full text-center flex flex-col items-center">
                <h4 class="text-[10px] font-black text-cyan-500 uppercase mb-4 tracking-widest flex items-center gap-2">
                    <i class="fas fa-chart-line"></i> Análisis de Progreso Semanal
                </h4>
                
                <div class="relative w-full flex-grow flex items-center justify-center p-3" style="min-height: 250px;">
                    <canvas id="graficoProgreso" class="w-full h-full"></canvas>
                </div>
                
                <div id="resumenEstado" class="mt-5 p-4 bg-slate-50/50 rounded-2xl w-full text-center flex items-center justify-center gap-3">
                    <i id="iconoEstado" class="fas fa-robot text-slate-300 animate-pulse text-2xl"></i>
                    <p id="textoEstado" class="text-xs text-slate-400">Analizando datos...</p>
                </div>
            </div>
        </div>

        {{-- ANALIZADOR DE ACTIVIDADES (Diario de Hoy) --}}
        <div class="lg:col-span-2">
            <div class="neuro-card p-8 h-full">
                <h4 class="text-[10px] font-black text-cyan-500 uppercase mb-6 tracking-widest">
                    <i class="fas fa-magic"></i> Analizador de Actividades
                </h4>

                {{-- Formulario para enviar a la IA --}}
                <form action="{{ route('paciente.analizar', $paciente->id) }}" method="POST" class="mb-6">
                    @csrf
                    <textarea name="actividad_diaria" 
                        class="w-full p-4 rounded-2xl border-none bg-slate-50 text-sm focus:ring-2 focus:ring-cyan-400" 
                        placeholder="Describe la actividad diaria aquí..." rows="3"></textarea>
                    <button type="submit" class="mt-3 w-full bg-cyan-500 text-white py-3 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-cyan-600 transition shadow-lg shadow-cyan-100">
                        <i class="fas fa-wand-sparkles mr-2"></i> Procesar con IA
                    </button>
                </form>

                {{-- BLOQUE DE DEBUG --}}
                @if(count($conceptosFinales) > 0)
                    <div class="mb-6 p-3 bg-amber-50 border border-amber-200 rounded-xl text-[10px] text-amber-800 font-mono">
                        <strong>RUTAS ENCONTRADAS EN JSON:</strong><br>
                        @foreach($conceptosFinales as $cf)
                            • {{ $cf['texto'] }} -> {{ asset($cf['ruta']) }} <br>
                        @endforeach
                    </div>
                @endif

                {{-- VISUALIZACIÓN DE PICTOGRAMAS ENCONTRADOS --}}
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @forelse($conceptosFinales as $concepto)
                        <div class="p-4 bg-white rounded-2xl border border-slate-100 flex flex-col items-center shadow-sm hover:shadow-md transition">
                            <img src="{{ asset($concepto['ruta']) }}" 
                                 alt="{{ $concepto['texto'] }}" 
                                 class="w-20 h-20 object-contain mb-2"
                                 onerror="this.src='{{ asset('pictogramas/default.png') }}';">
                            <span class="text-[10px] font-bold text-slate-500 uppercase text-center">{{ $concepto['texto'] }}</span>
                        </div>
                    @empty
                        <div class="col-span-full py-10 text-center text-slate-300 border-2 border-dashed border-slate-50 rounded-3xl">
                            <i class="fas fa-icons text-4xl mb-2"></i>
                            <p class="text-xs">Los pictogramas aparecerán aquí tras el análisis</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPTS (CHART.JS) --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dias = {!! isset($diasGrafico) ? $diasGrafico : json_encode(['Lun','Mar','Mie','Jue','Vie','Sab','Dom']) !!};
        const puntajes = {!! isset($puntajesGrafico) ? $puntajesGrafico : json_encode([0,0,0,0,0,0,0]) !!};
        
        const ctx = document.getElementById('graficoProgreso').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dias,
                datasets: [{
                    label: 'Puntaje de Mejora',
                    data: puntajes,
                    borderColor: '#33c3e1',
                    borderWidth: 4,
                    pointBackgroundColor: '#00acc1',
                    pointRadius: 6,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { min: 0, max: 100 }
                }
            }
        });

        const resumenTexto = document.getElementById('textoEstado');
        const resumenIcono = document.getElementById('iconoEstado');
        const ultimoDato = puntajes[puntajes.length - 1];
        
        if (ultimoDato > 50) {
            resumenTexto.textContent = "Progreso estable.";
            resumenIcono.className = "fas fa-check-circle text-cyan-400 text-2xl";
        } else {
            resumenTexto.textContent = "Esperando nuevos datos...";
        }
    });
</script>
@endsection