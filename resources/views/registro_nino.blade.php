<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paso 1: Identidad - TEA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --accent: #3b82f6; --text-slate: #1e293b; }
        body {
            background-image: linear-gradient(rgba(248, 250, 252, 0.85), rgba(248, 250, 252, 0.85)), 
                              url('https://images.unsplash.com/photo-1587582423116-ec07293f0395?q=80&w=2070&auto=format&fit=crop');
            background-size: cover; background-position: center; background-attachment: fixed;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif; color: var(--text-slate);
        }
        .glass-card { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(12px); border-radius: 1.5rem; border: 1px solid rgba(255, 255, 255, 0.3); box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07); }
        .input-modern { background: rgba(241, 245, 249, 0.8); border: 2px solid transparent; border-radius: 1rem; padding: 0.75rem 1rem; width: 100%; outline: none; transition: all 0.2s; }
        .input-modern:focus { background: #ffffff; border-color: var(--accent); box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1); }
        label { font-weight: 700; font-size: 0.85rem; color: #475569; margin-bottom: 0.5rem; display: block; text-transform: uppercase; }
        .section-title { font-size: 1.25rem; font-weight: 800; border-left: 4px solid var(--accent); padding-left: 1rem; margin-bottom: 1.5rem; }
        .btn-step { background: var(--accent); color: white; padding: 1rem 2rem; border-radius: 1rem; font-weight: 800; transition: all 0.3s; cursor: pointer; text-align: center; display: block; width: 100%; border: none; }
        .btn-step:hover { transform: translateY(-2px); filter: brightness(1.1); }
        .progress-bar { height: 8px; background: #e2e8f0; border-radius: 4px; margin-bottom: 2rem; overflow: hidden; }
        .progress-fill { height: 100%; background: var(--accent); width: 50%; transition: width 0.4s ease; }
    </style>
</head>
<body class="py-10 px-4">
<div class="max-w-5xl mx-auto">
    <div class="text-center mb-10">
        <h1 class="text-4xl font-black text-slate-900 tracking-tight">Registro Clínico Especializado</h1>
        <div class="text-blue-600 font-bold mt-2 uppercase tracking-widest text-sm">Paso 1: Información del Niño</div>
    </div>

    <div class="progress-bar">
        <div class="progress-fill"></div>
    </div>

    {{-- BLOQUE CORREGIDO: Usando el nombre de ruta plural 'paso2' --}}
    <form action="{{ route('paso2') }}" method="GET" class="glass-card p-8 space-y-8">
        <h2 class="section-title">1. Perfil de Identidad</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label><i class="fas fa-user me-2"></i>Nombre del Niño</label>
                <input type="text" name="nombre" class="input-modern" placeholder="Ej. Mateo" required>
            </div>
            <div>
                <label><i class="fas fa-calendar me-2"></i>Edad</label>
                <input type="number" name="edad" class="input-modern" placeholder="Ej. 6" required>
            </div>
            <div>
                <label><i class="fas fa-layer-group me-2"></i>Nivel de TEA</label>
                <select name="nivel_tea" class="input-modern">
                    <option value="Grado 1">Grado 1: Soporte leve</option>
                    <option value="Grado 2">Grado 2: Soporte moderado</option>
                    <option value="Grado 3">Grado 3: Soporte intenso</option>
                </select>
            </div>
            <div>
                <label><i class="fas fa-comments me-2"></i>Comunicación</label>
                <select name="comunicacion_verbal" class="input-modern">
                    <option value="Verbal">Verbal</option>
                    <option value="Frases cortas">Frases cortas</option>
                    <option value="No verbal">No verbal</option>
                </select>
            </div>
        </div>

        <div class="mt-10 flex justify-end">
            <button type="submit" class="btn-step shadow-lg shadow-blue-200">
                Siguiente: Configuración Sensorial <i class="fas fa-arrow-right ms-2"></i>
            </button>
        </div>
    </form>

    <div class="mt-8 text-center">
        <a href="{{ route('index') }}" class="text-slate-400 hover:text-blue-500 font-bold transition-colors">
            <i class="fas fa-chevron-left me-2"></i> Volver a la Lista de Pacientes
        </a>
    </div>
</div>
</body>
</html>