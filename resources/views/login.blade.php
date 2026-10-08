<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Centro de Neurodesarrollo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --bg-main: #f8fafc; 
            --accent: #3b82f6; 
        }

        body {
            background-color: var(--bg-main);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        .glass-card {
            background: white;
            max-width: 440px;
            width: 90%;
            padding: 2.5rem;
            border-radius: 2rem; 
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(226, 232, 240, 0.7);
        }

        .input-modern {
            background: #f1f5f9;
            border: 2px solid transparent;
            border-radius: 1rem;
            padding: 0.85rem 1rem;
            transition: all 0.2s;
            width: 100%;
            outline: none;
        }

        .input-modern:focus {
            background: white;
            border-color: var(--accent);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        label {
            font-weight: 700;
            font-size: 0.8rem;
            color: #64748b;
            margin-bottom: 0.5rem;
            display: block;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .btn-modern {
            background-color: var(--accent);
            color: white;
            padding: 1rem;
            border-radius: 1.25rem;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
            border: none;
            cursor: pointer;
        }

        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
            filter: brightness(1.1);
        }

        /* Estilos para las pestañas (Tabs) */
        .tab-btn {
            padding: 0.75rem 1rem;
            font-weight: 700;
            font-size: 0.9rem;
            color: #94a3b8;
            border-bottom: 2px solid transparent;
            transition: all 0.3s;
            cursor: pointer;
        }

        .tab-btn.active {
            color: var(--accent);
            border-bottom-color: var(--accent);
        }
    </style>
</head>
<body>

<div class="glass-card">
    <div class="text-center mb-6">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-50 rounded-3xl mb-4">
            <span style="font-size: 40px;">🧠</span>
        </div>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight leading-tight">
            NeuroCentro
        </h2>
        <p class="text-slate-400 font-medium mt-1">Plataforma de Seguimiento</p>
    </div>

    <div class="flex justify-center border-b border-slate-100 mb-6">
        <button type="button" id="tab-padre" class="tab-btn active w-1/2 text-center" onclick="setRole('padre')">
            <i class="fa-solid fa-user-group mr-2"></i>Padre / Tutor
        </button>
        <button type="button" id="tab-doctor" class="tab-btn w-1/2 text-center" onclick="setRole('doctor')">
            <i class="fa-solid fa-user-md mr-2"></i>Especialista
        </button>
    </div>

    <form action="{{ route('login') }}" method="POST" class="space-y-5">
        @csrf

        <input type="hidden" id="rol-input" name="rol" value="{{ old('rol', 'padre') }}">

        <div>
            <label id="label-identity" for="identity">
                <i class="fa-solid fa-envelope me-2"></i>Correo del Padre
            </label>
            <input type="email" id="identity" name="identity" value="{{ old('identity') }}" class="input-modern" placeholder="ejemplo@correo.com" required autofocus>
            @error('identity')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password"><i class="fa-solid fa-lock me-2"></i>Contraseña</label>
            <input type="password" id="password" name="password" class="input-modern" placeholder="••••••••" required>
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        {{-- Errores globales de credenciales incorrectas --}}
        @if ($errors->any() && !$errors->has('identity') && !$errors->has('password'))
            <div class="bg-red-50 text-red-600 border border-red-200 rounded-xl p-3 text-sm text-center font-semibold">
                {{ $errors->first() }}
            </div>
        @endif

        <button type="submit" class="btn-modern w-full mt-2">
            Entrar al Panel
        </button>
    </form>
    
    <div class="text-center mt-6">
        <a href="{{ url('/') }}" class="text-slate-400 hover:text-blue-500 font-bold text-sm transition-colors">
            <i class="fa-solid fa-arrow-left me-1"></i> Volver a la página principal
        </a>
    </div>
</div>

<script>
    function setRole(role) {
        // Campos de la vista
        const roleInput = document.getElementById('rol-input');
        const labelIdentity = document.getElementById('label-identity');
        const inputIdentity = document.getElementById('identity');
        const tabPadre = document.getElementById('tab-padre');
        const tabDoctor = document.getElementById('tab-doctor');

        // Guardamos el rol seleccionado para pasárselo a Laravel
        roleInput.value = role;

        if (role === 'padre') {
            // Activar visualmente pestaña Padre
            tabPadre.classList.add('active');
            tabDoctor.classList.remove('active');
            // Cambiar textos correspondientes
            labelIdentity.innerHTML = '<i class="fa-solid fa-envelope me-2"></i>Correo del Padre / Tutor';
            inputIdentity.placeholder = 'padre@correo.com';
        } else {
            // Activar visualmente pestaña Especialista
            tabDoctor.classList.add('active');
            tabPadre.classList.remove('active');
            // Cambiar textos correspondientes
            labelIdentity.innerHTML = '<i class="fa-solid fa-user-md me-2"></i>Correo del Especialista';
            inputIdentity.placeholder = 'doctor@neurocentro.com';
        }
    }

    // Mantener la pestaña correcta activa si Laravel devuelve un error de validación
    document.addEventListener("DOMContentLoaded", function() {
        const currentRole = document.getElementById('rol-input').value;
        setRole(currentRole);
    });
</script>

</body>
</html>