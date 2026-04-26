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
            max-width: 420px;
            width: 90%;
            padding: 3rem;
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

        .alert-error {
            background-color: #fff5f5;
            color: #c53030;
            border: 1px solid #feb2b2;
            border-radius: 1rem;
            padding: 0.75rem;
            font-size: 0.85rem;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="glass-card">
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-50 rounded-3xl mb-4">
            <span style="font-size: 40px;">🧠</span>
        </div>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight leading-tight">
            NeuroCentro
        </h2>
        <p class="text-slate-400 font-medium mt-1">Plataforma de Seguimiento</p>
    </div>

    {{-- En Laravel, la ruta suele ser route('login') --}}
    <form action="{{ route('login') }}" method="POST" class="space-y-5">
        @csrf {{-- Token de seguridad obligatorio --}}

        <div>
            <label for="email"><i class="fa-solid fa-envelope me-2"></i>Correo Electrónico</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" class="input-modern" placeholder="ejemplo@correo.com" required autofocus>
            @error('email')
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
        
        {{-- Manejo de errores globales o de sesión --}}
        @if (session('status'))
            <div class="alert-error">
                {{ session('status') }}
            </div>
        @endif

        <button type="submit" class="btn-modern w-full mt-4">
            Entrar al Panel
        </button>
    </form>
    
    <div class="text-center mt-8">
        <a href="{{ url('/') }}" class="text-slate-400 hover:text-blue-500 font-bold text-sm transition-colors">
            <i class="fa-solid fa-arrow-left me-1"></i> Volver a la página principal
        </a>
    </div>
</div>

</body>
</html>