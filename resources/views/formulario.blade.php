<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Clínico - Proyecto TEA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --accent: #3b82f6;
            --text-slate: #e46802;
        }

        body {
            background-image: linear-gradient(rgba(248, 250, 252, 0.85), rgba(248, 250, 252, 0.85)), 
                              url('https://images.unsplash.com/photo-1587582423116-ec07293f0395?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            color: var(--text-slate);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 1.5rem;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .input-modern {
            background: rgba(241, 245, 249, 0.8);
            border: 2px solid transparent;
            border-radius: 1rem;
            padding: 0.75rem 1rem;
            transition: all 0.2s;
            width: 100%;
            outline: none;
        }

        .input-modern:focus {
            background: #ffffff;
            border-color: var(--accent);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .btn-ia-small {
            background: #8b5cf6;
            color: white;
            padding: 4px 10px;
            border-radius: 8px;
            font-size: 0.65rem;
            font-weight: 800;
            transition: all 0.2s;
            cursor: pointer;
            text-transform: uppercase;
        }

        .btn-ia-small:hover {
            transform: scale(1.05);
            background: #7c3aed;
        }

        .step-hidden { display: none; }
        
        .progress-fill {
            height: 100%;
            background: var(--accent);
            width: 50%;
            transition: width 0.4s ease;
        }

        .loading-ia {
            animation: pulse 1.5s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            opacity: 0.6;
            pointer-events: none;
            border: 2px solid #8b5cf6 !important;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: .5; }
        }
    </style>
</head>
<body class="py-10 px-4">

<div class="max-w-6xl mx-auto">
    <div class="text-center mb-10">
        <h1 class="text-4xl font-black text-slate-900 tracking-tight">Registro Clínico Especializado</h1>
        <div id="stepIndicator" class="text-blue-600 font-bold mt-2 uppercase tracking-widest text-sm">Paso 1: Información del Niño</div>
    </div>

    <div class="h-2 bg-slate-200 rounded-full mb-10 overflow-hidden">
        <div id="progressBar" class="progress-fill"></div>
    </div>

    <form action="{{ url('/perfil/crear') }}" method="POST" id="multiStepForm" class="space-y-8">
        @csrf
        
        <div id="step1" class="glass-card p-8">
            <h2 class="text-xl font-extrabold border-l-4 border-blue-500 pl-4 mb-6">1. Perfil de Identidad</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Nombre del Niño</label>
                    <input type="text" name="nombre" class="input-modern" placeholder="Ej. Mateo" required>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Edad</label>
                    <input type="number" name="edad" class="input-modern" placeholder="Ej. 6" required>
                </div>
            </div>
            <div class="mt-10 flex justify-end">
                <button type="button" onclick="goToStep(2)" class="bg-blue-600 text-white px-8 py-3 rounded-2xl font-bold hover:bg-blue-700 transition-all shadow-lg">
                    Siguiente: Configuración Visual <i class="fas fa-arrow-right ms-2"></i>
                </button>
            </div>
        </div>

        <div id="step2" class="step-hidden space-y-8">
            <div class="glass-card p-8">
                <h2 class="text-xl font-extrabold border-l-4 border-blue-500 pl-4 mb-6">2. Preferencias Visuales</h2>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Brillo</label>
                                <input type="range" id="preferencia_brillo" name="brillo_pref" min="0.5" max="1.5" step="0.1" value="1" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-blue-600">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Contraste</label>
                                <input type="range" id="nivel_contraste" name="contraste_nivel" min="0.5" max="2" step="0.1" value="1" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-blue-600">
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col items-center justify-center border-2 border-dashed border-slate-300 rounded-3xl p-4 bg-white/40">
                        <p class="text-[10px] font-bold text-slate-400 uppercase mb-4 tracking-tighter">Previsualización Sensorial</p>
                        <img id="GatoMariposa" src="{{ asset('img/GatoMariposa.jpg') }}" alt="Preview" class="max-w-[120px] rounded-lg transition-all duration-300">
                    </div>
                </div>
            </div>

            <div class="glass-card p-8">
                <h2 class="text-xl font-extrabold border-l-4 border-blue-500 pl-4 mb-2">3. Agenda Semanal Inteligente</h2>
                <p class="text-xs text-slate-500 mb-6 italic">Escribe las actividades. La IA las organizará automáticamente al guardar.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    @php $dias = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo']; @endphp
                    @foreach($dias as $dia)
                    <div class="bg-white/60 p-4 rounded-2xl border border-slate-200">
                        <div class="flex justify-between items-center mb-2">
                            <label class="text-[10px] font-black text-blue-600 uppercase">{{ ucfirst($dia) }}</label>
                        </div>
                        <textarea 
                            id="txt-{{ $dia }}"
                            name="agenda[{{ $dia }}]" 
                            class="input-modern h-40 text-xs resize-none" 
                            placeholder="Escribe actividades..."
                        ></textarea>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-between items-center mt-10">
                <button type="button" onclick="goToStep(1)" class="text-slate-500 font-bold hover:text-slate-800 text-sm">
                    <i class="fas fa-arrow-left me-2"></i> Volver
                </button>
                <button type="button" id="btnGuardar" onclick="procesarTodoYEnviar()" class="bg-green-600 text-white px-10 py-4 rounded-2xl font-black shadow-xl hover:bg-green-700 hover:scale-105 transition-all">
                    FINALIZAR Y GUARDAR PERFIL <i class="fas fa-save ms-2"></i>
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    // Navegación entre pasos
    function goToStep(step) {
        const s1 = document.getElementById('step1');
        const s2 = document.getElementById('step2');
        const bar = document.getElementById('progressBar');
        const indicator = document.getElementById('stepIndicator');

        if (step === 2) {
            s1.classList.add('step-hidden');
            s2.classList.remove('step-hidden');
            bar.style.width = '100%';
            indicator.innerText = "Paso 2: Configuración Visual y Agenda";
        } else {
            s1.classList.remove('step-hidden');
            s2.classList.add('step-hidden');
            bar.style.width = '50%';
            indicator.innerText = "Paso 1: Información del Niño";
        }
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // LÓGICA DE PROCESAMIENTO MASIVO (AUTOMÁTICO)
    async function procesarTodoYEnviar() {
        const dias = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'];
        const btn = document.getElementById('btnGuardar');
        const originalText = btn.innerHTML;
        
        // Bloquear botón para evitar clics repetidos
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> PROCESANDO CON IA...';
        btn.classList.replace('bg-green-600', 'bg-slate-500');

        // Procesar cada día que tenga texto y no esté ya numerado
        for (const dia of dias) {
            const textarea = document.getElementById('txt-' + dia);
            if (textarea && textarea.value.trim().length > 5 && !textarea.value.includes('1.')) {
                await organizarConIA(dia);
            }
        }

        // Una vez terminada la IA, enviar el formulario a Laravel
        document.getElementById('multiStepForm').submit();
    }

    // CONEXIÓN CON IA (Python/Flask)
    async function organizarConIA(diaId) {
        const textarea = document.getElementById('txt-' + diaId);
        const textoOriginal = textarea.value;

        textarea.classList.add('loading-ia');

        try {
            // Intento conectar con tu servidor de Python en el puerto 5000
            const response = await fetch('http://127.0.0.1:5000/api/segmentar', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ texto: textoOriginal })
            });

            if (!response.ok) throw new Error('Servidor IA no disponible');

            const data = await response.json();
            textarea.value = data.resultado;

        } catch (error) {
            console.warn("IA no respondió para " + diaId + ", usando respaldo local.");
            // Respaldo local si Python está apagado
            const segmentos = textoOriginal.split(/[,.\n]+/).filter(t => t.trim().length > 0);
            let enumerado = "";
            segmentos.forEach((s, i) => { enumerado += `${i + 1}. ${s.trim()}\n`; });
            textarea.value = enumerado;
        } finally {
            textarea.classList.remove('loading-ia');
        }
    }

    // Filtros Visuales
    const b = document.getElementById('preferencia_brillo');
    const c = document.getElementById('nivel_contraste');
    const img = document.getElementById('GatoMariposa');

    function updateFilters() { 
        img.style.filter = `brightness(${b.value}) contrast(${c.value})`; 
    }
    b.addEventListener('input', updateFilters);
    c.addEventListener('input', updateFilters);
</script>

</body>
</html>