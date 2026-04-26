<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Profesional - NeuroCentro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root { 
            --primary-blue: #007bff; 
            --relaxing-blue: #f0f9ff; 
            --light-blue-banner: #33c1e3;
            --text-gray: #4b5563;
            --neuro-dark: #16222e;
        }
        
        body { 
            font-family: 'Inter', sans-serif; 
            margin: 0; padding: 0;
            min-height: 100vh;
            background-color: var(--relaxing-blue);
        }

        /* --- HEADER DINÁMICO --- */
        .header-banner {
            width: 100%; height: 400px;
            background-image: linear-gradient(rgba(22, 34, 46, 0.6), rgba(22, 34, 46, 0.4)), url("{{ asset('static/uploads/medico_imagen_5.jpg') }}");
            background-size: cover; background-position: center;
            display: flex; align-items: center; justify-content: center;
            color: white; text-align: center;
        }

        .header-content h1 { font-weight: 800; font-size: 3rem; letter-spacing: -1px; }

        /* --- NAVEGACIÓN TIPO DASHBOARD --- */
        .nav-wrapper {
            position: relative; z-index: 20;
            width: 90%; max-width: 900px;
            margin: -50px auto 0 auto; 
        }

        .quick-nav-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            border: 1px solid rgba(51, 193, 227, 0.2);
            padding: 10px;
        }

        .nav-btn {
            border: none; background: none;
            padding: 25px 10px; text-align: center;
            color: var(--text-gray); text-decoration: none;
            display: flex; flex-direction: column; align-items: center;
            font-size: 0.8rem; font-weight: 800;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-btn:hover { 
            transform: translateY(-5px);
            color: var(--light-blue-banner);
        }
        
        .nav-btn i { font-size: 2rem; margin-bottom: 12px; color: var(--light-blue-banner); }

        /* --- SECCIÓN ESPECIALISTAS --- */
        .doctor-card-mini {
            position: relative; overflow: hidden; height: 280px;
            border-radius: 24px; transition: 0.4s;
            border: 4px solid white;
        }

        .doctor-card-mini:hover { transform: scale(1.03); box-shadow: 0 15px 30px rgba(0,0,0,0.15); }
        .doctor-card-mini img { width: 100%; height: 100%; object-fit: cover; }

        .doctor-info-overlay {
            position: absolute; bottom: 0; left: 0; right: 0;
            background: rgba(22, 34, 46, 0.85);
            backdrop-filter: blur(5px);
            color: white; padding: 15px; text-align: center;
        }

        /* --- SECCIÓN IA Y SERVICIOS --- */
        .ia-badge {
            background: #e0f7fa; color: #00acc1;
            padding: 5px 15px; border-radius: 50px;
            font-size: 0.7rem; font-weight: 800; display: inline-block;
            margin-bottom: 15px;
        }

        .btn-neuro {
            background: var(--light-blue-banner); color: white;
            padding: 12px 30px; border-radius: 15px;
            font-weight: 700; text-decoration: none;
            display: inline-block; transition: 0.3s;
        }
        .btn-neuro:hover { background: #00acc1; color: white; transform: translateX(5px); }

        /* --- FOOTER --- */
        footer { background: var(--neuro-dark); color: #94a3b8; padding: 80px 0 40px 0; }
        .footer-title { color: white; font-weight: 800; margin-bottom: 25px; font-size: 0.9rem; text-transform: uppercase; }
        .footer-link { color: #94a3b8; text-decoration: none; transition: 0.3s; display: block; margin-bottom: 12px; }
        .footer-link:hover { color: var(--light-blue-banner); padding-left: 5px; }
    </style>
</head>
<body>

    <header class="header-banner">
        <div class="header-content">
            <span class="ia-badge shadow-sm"><i class="bi bi-cpu-fill"></i> TECNOLOGÍA IA PARA NEURODESARROLLO</span>
            <h1>Centro de Apoyo Especializado</h1>
            <p class="fs-5 opacity-75">Transformando el seguimiento pediátrico con recursos visuales inteligentes</p>
        </div>
    </header>

    <div class="nav-wrapper">
        <div class="quick-nav-card">
            <div class="row g-0">
                <a href="{{ url('/pacientes') }}" class="col-3 nav-btn"><i class="bi bi-person-lines-fill"></i> PACIENTES</a>
                <a href="{{ url('/registro') }}" class="col-3 nav-btn"><i class="bi bi-plus-circle-fill"></i> NUEVO</a>
                <a href="#" class="col-3 nav-btn"><i class="bi bi-clipboard-pulse"></i> ANALÍTICA</a>
                <a href="#" class="col-3 nav-btn"><i class="bi bi-gear-wide-connected"></i> SISTEMA</a>
            </div>
        </div>
    </div>

    <section class="py-5 mt-5">
        <div class="container">
            <div class="d-flex align-items-center gap-3 mb-5">
                <div style="width: 50px; height: 5px; background: var(--light-blue-banner); border-radius: 10px;"></div>
                <h2 class="fw-800 m-0" style="font-weight: 800; color: var(--neuro-dark);">Nuestros Especialistas</h2>
            </div>
            
            <div class="row g-4">
                @php
                    $doctores = [
                        ['nombre' => 'Dra. Alexandra Revilla', 'especialidad' => 'Ingeniería de Sistemas / IA'],
                        ['nombre' => 'Dr. Roberto Paz', 'especialidad' => 'Neurología Infantil'],
                        ['nombre' => 'Dra. Lucía Méndez', 'especialidad' => 'Psicopedagogía'],
                        ['nombre' => 'Dra. Elena Soliz', 'especialidad' => 'Terapia Ocupacional'],
                    ];
                @endphp

                @foreach($doctores as $index => $doc)
                <div class="col-6 col-md-3">
                    <div class="doctor-card-mini shadow-sm">
                        <img src="https://i.pravatar.cc/400?u={{ $index + 20 }}" alt="{{ $doc['nombre'] }}">
                        <div class="doctor-info-overlay">
                            <p class="doctor-name-mini" style="font-size: 0.8rem;">{{ $doc['nombre'] }}</p>
                            <p class="doctor-specialty-mini" style="font-size: 0.65rem; opacity: 0.8;">{{ $doc['especialidad'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-5 bg-white border-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="pe-lg-5">
                        <span class="text-primary fw-bold text-uppercase small tracking-widest">Innovación en Terapia</span>
                        <h2 class="display-6 fw-800 mt-2 mb-4" style="font-weight: 800; color: var(--neuro-dark);">Pictogramas Generados por IA</h2>
                        <p class="text-muted fs-5 mb-4">
                            Nuestro sistema utiliza redes neuronales para crear pictogramas personalizados basados en el perfil sensorial único de cada niño.
                        </p>
                        <ul class="list-unstyled mb-5">
                            <li class="mb-3"><i class="bi bi-check-circle-fill text-info me-2"></i> Adaptación automática de colores</li>
                            <li class="mb-3"><i class="bi bi-check-circle-fill text-info me-2"></i> Estilo visual simplificado para TEA</li>
                            <li><i class="bi bi-check-circle-fill text-info me-2"></i> Seguimiento longitudinal del progreso</li>
                        </ul>
                        <a href="{{ url('/registro') }}" class="btn-neuro">Explorar Plataforma <i class="bi bi-arrow-right ms-2"></i></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1551847677-1824a6639591?auto=format&fit=crop&q=80&w=800" class="img-fluid rounded-5 shadow-lg" alt="Niño con tablet">
                        <div class="position-absolute bottom-0 start-0 m-4 bg-white p-3 rounded-4 shadow-sm d-flex align-items-center gap-3">
                            <div class="bg-info bg-opacity-10 p-2 rounded-3">
                                <i class="bi bi-lightning-charge-fill text-info"></i>
                            </div>
                            <div>
                                <p class="m-0 fw-bold small">Procesamiento Real-Time</p>
                                <p class="m-0 text-muted extra-small">Jupyter-Laravel Bridge</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <h5 class="footer-title">NeuroCentro IA</h5>
                    <p class="small opacity-50">Plataforma líder en la generación de recursos visuales personalizados para el apoyo en el neurodesarrollo infantil mediante inteligencia artificial.</p>
                    <div class="d-flex gap-3 mt-4">
                        <a href="#" class="text-white fs-5"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white fs-5"><i class="bi bi-linkedin"></i></a>
                        <a href="#" class="text-white fs-5"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
                <div class="col-md-4 col-lg-2 offset-lg-2">
                    <h5 class="footer-title">Accesos</h5>
                    <a href="{{ url('/pacientes') }}" class="footer-link">Gestión de Pacientes</a>
                    <a href="{{ url('/registro') }}" class="footer-link">Registro de Datos</a>
                    <a href="#" class="footer-link">Ayuda Técnica</a>
                </div>
                <div class="col-md-4 col-lg-4">
                    <h5 class="footer-title">Ubicación y Contacto</h5>
                    <p class="small"><i class="bi bi-geo-alt-fill text-info me-2"></i> Irpavi, Calle N6545, La Paz - Bolivia</p>
                    <p class="small"><i class="bi bi-telephone-fill text-info me-2"></i> +591 2 1234567</p>
                    <p class="small"><i class="bi bi-envelope-fill text-info me-2"></i> soporte@neurocentro.com</p>
                </div>
            </div>
            <div class="text-center mt-5 pt-4 border-top border-secondary">
                <p class="extra-small m-0">© 2026 Desarrollado por Alexandra Revilla - Proyecto de Grado</p>
            </div>
        </div>
    </footer>

</body>
</html>