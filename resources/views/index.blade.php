<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida - Centro de Neurodesarrollo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        body { 
            background: #f4f7f6; 
            height: 100vh; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-family: 'Inter', sans-serif;
            margin: 0;
        }
        .welcome-card { 
            background: white; 
            padding: 50px 40px; 
            border-radius: 24px; 
            box-shadow: 0 20px 40px rgba(0,0,0,0.05); 
            text-align: center; 
            max-width: 450px; 
            width: 90%;
        }
        .icon-box {
            font-size: 64px;
            margin-bottom: 20px;
            display: inline-block;
        }
        .btn-custom { 
            padding: 14px 24px; 
            font-size: 16px; 
            font-weight: 700;
            border-radius: 12px; 
            transition: all 0.3s ease;
        }
        .btn-primary-custom {
            background-color: #33c3e1; /* El cyan que usamos en la gestión */
            border: none;
            color: white;
        }
        .btn-primary-custom:hover {
            background-color: #00acc1;
            transform: translateY(-2px);
            color: white;
        }
        .btn-outline-custom {
            border: 2px solid #e1e8ed;
            color: #64748b;
        }
        .btn-outline-custom:hover {
            background-color: #f8fafc;
            border-color: #cbd5e1;
        }
    </style>
</head>
<body>
    <div class="welcome-card">
        <div class="icon-box">🧠</div>
        <h1 class="fw-bold mb-2">Bienvenido</h1>
        <p class="text-muted mb-5">Centro de Neurodesarrollo y Seguimiento TEA</p>
        
        <div class="d-grid gap-3">
            {{-- En Laravel, usamos route() o url() --}}
            <a href="{{ route('login') }}" class="btn btn-primary-custom btn-custom shadow-sm">
                Iniciar Sesión
            </a>
            
            <a href="{{ url('/registro') }}" class="btn btn-outline-custom btn-custom">
                Crear Perfil (Nuevo Paciente)
            </a>
        </div>
        
        <p class="mt-5 mb-0 text-muted small">
            © 2026 NeuroCentro
        </p>
    </div>
</body>
</html>