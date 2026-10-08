<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ (isset($paciente) && $paciente->exists) ? 'Editar' : 'Paso 2' }}: Perfil Sensorial - NeuroCentro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --accent: #06b6d4; --text-slate: #1e293b; }
        body {
            background-image: linear-gradient(rgba(248, 250, 252, 0.9), rgba(248, 250, 252, 0.9)), 
                              url('https://www.transparenttextures.com/patterns/cubes.png');
            background-color: #f8fafc;
            font-family: 'Segoe UI', sans-serif; color: var(--text-slate);
        }
        .glass-card { background: white; border-radius: 1.5rem; border: 1px solid #e2e8f0; box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
        .input-modern { background: #f1f5f9; border: 2px solid transparent; border-radius: 0.75rem; padding: 0.6rem 1rem; width: 100%; outline: none; }
        .input-modern:focus { border-color: var(--accent); background: white; }
        .section-title { font-size: 1.25rem; font-weight: 800; border-left: 4px solid var(--accent); padding-left: 1rem; margin-bottom: 1.5rem; }
        .btn-finish { background: var(--accent); color: white; padding: 1rem; border-radius: 1rem; font-weight: 800; width: 100%; transition: 0.3s; border: none; cursor: pointer; }
        .btn-finish:hover { opacity: 0.9; transform: translateY(-2px); }
        
        .calibration-box {
            border: 2px dashed #cbd5e1;
            border-radius: 1rem;
            padding: 1.5rem;
            transition: all 0.4s ease;
            display: inline-block;
            width: 100%;
            max-width: 42rem;
        }
        #rana-target {
            transition: filter 0.1s ease;
        }
    </style>
</head>
<body class="py-10 px-4">
<div class="max-w-5xl mx-auto">
    
    <div class="text-center mb-10">
        <h1 class="text-4xl font-black text-slate-900">
            {{ (isset($paciente) && $paciente->exists) ? 'Editar Perfil de ' . $paciente->nombre : 'Configuración Sensorial' }}
        </h1>
        <div class="text-cyan-600 font-bold mt-2 uppercase tracking-widest text-sm">
            {{ (isset($paciente) && $paciente->exists) ? 'Actualización de preferencias' : 'Paso 2: Preferencias y Entorno' }}
        </div>
    </div>

    @php
        $esEdicion = (isset($paciente) && $paciente->exists && Route::currentRouteName() == 'edit');
        $rutaFormulario = $esEdicion ? route('update', $paciente->id) : route('agenda.store', $paciente->id);
    @endphp

    <form action="{{ $rutaFormulario }}" 
          method="POST" 
          class="glass-card p-8 space-y-8">
        
        @csrf 
        @if($esEdicion)
            @method('PUT')
        @endif

        <h2 class="section-title">2. Ajustes Sensoriales</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <label class="block font-bold mb-2 text-slate-700">Nivel de Brillo Preferido</label>
                <input type="range" id="brillo_range" name="brillo_pref" min="0" max="100" 
                       value="{{ $paciente->brillo_pref ?? '50' }}" 
                       class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-cyan-600">
            </div>

            <div>
                <label class="block font-bold mb-2 text-slate-700">Nivel de Contraste</label>
                <input type="range" id="contraste_range" name="contraste_pref" min="0" max="100" 
                       value="{{ $paciente->contraste_pref ?? '50' }}" 
                       class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-cyan-600">
            </div>

            <div>
                <label class="block font-bold mb-2 text-sm uppercase text-slate-700">Color favorito (Fondo)</label>
                <input type="color" id="color_gusta" name="color_fondo" 
                       value="{{ $paciente->color_fondo ?? '#f0faff' }}" 
                       class="w-full h-12 rounded-lg cursor-pointer border-none shadow-sm p-1 bg-white">
                <p class="text-[10px] text-gray-400 mt-1 italic">Este color se aplicará al fondo de los pictogramas.</p>
            </div>

            <div>
                <label class="block font-bold mb-2 text-sm uppercase text-red-600">Color que le molesta</label>
                <input type="color" name="color_molesta" 
                       value="{{ $paciente->color_molesta ?? '#ff0000' }}" 
                       class="w-full h-12 rounded-lg cursor-pointer border-none shadow-sm p-1 bg-white">
            </div>
        </div>

        <div class="mb-10 text-center">
            <h3 class="text-lg font-bold text-slate-700 mb-4 text-left">
                <i class="fas fa-frog me-2 text-green-500"></i>Prueba Visual de la Rana
            </h3>
            <div id="rana_container" class="calibration-box shadow-inner bg-white">
                <img id="rana-target" 
                     src="{{ asset('images/rana_prueba.png') }}" 
                     alt="Imagen de calibración Rana" 
                     class="mx-auto rounded mb-4" 
                     style="max-height: 250px; object-fit: contain;">
                <p id="instrucciones-texto" class="text-sm text-slate-500 italic">
                    Ajuste los controles. Así es como el niño verá sus pictogramas de manzana, cebolla, etc.
                </p>
            </div>
        </div>

        <h2 class="section-title mt-10">3. Agenda Semanal (Pictogramas)</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach(['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'] as $dia)
            <div>
                <label class="text-sm font-bold block mb-1 uppercase text-slate-500">{{ $dia }}</label>
                <input type="text" name="agenda_{{ $dia }}" 
                       class="input-modern" 
                       placeholder="Actividad..."
                       value="{{ $paciente->{'agenda_'.$dia} ?? '' }}">
            </div>
            @endforeach
        </div>

        <div class="pt-6 border-t mt-10">
            <button type="submit" class="btn-finish">
                <i class="fas fa-check-circle me-2"></i> 
                {{ $esEdicion ? 'GUARDAR CAMBIOS' : 'FINALIZAR Y GUARDAR PERFIL' }}
            </button>
        </div>
    </form>
</div>

<script>
    const brilloInput = document.getElementById('brillo_range');
    const contrasteInput = document.getElementById('contraste_range');
    const colorInput = document.getElementById('color_gusta');
    const ranaImg = document.getElementById('rana-target');
    const ranaContainer = document.getElementById('rana_container');
    const textoInstrucciones = document.getElementById('instrucciones-texto');

    function actualizarVistaPrevia() {
        const b = brilloInput.value / 50; 
        const c = contrasteInput.value / 50; 
        ranaImg.style.filter = `brightness(${b}) contrast(${c})`;

        const colorSeleccionado = colorInput.value;
        ranaContainer.style.backgroundColor = colorSeleccionado;

        const rgb = hexToRgb(colorSeleccionado);
        if(rgb) {
            const luma = 0.2126 * rgb.r + 0.7152 * rgb.g + 0.0722 * rgb.b; 
            textoInstrucciones.style.color = luma < 128 ? 'white' : '#64748b';
        }
    }

    function hexToRgb(hex) {
        const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
        return result ? {
            r: parseInt(result[1], 16),
            g: parseInt(result[2], 16),
            b: parseInt(result[3], 16)
        } : null;
    }

    brilloInput.addEventListener('input', actualizarVistaPrevia);
    contrasteInput.addEventListener('input', actualizarVistaPrevia);
    colorInput.addEventListener('input', actualizarVistaPrevia);

    actualizarVistaPrevia();
</script>
</body>
</html>