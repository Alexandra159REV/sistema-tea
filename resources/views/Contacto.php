<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Dr. Jorge Reque</title>
    
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- CSS Personalizado en la parte superior -->
    <style>
        .navbar-custom {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .navbar-brand img {
            max-height: 40px;
        }
        .nav-link {
            color: #333 !important;
            font-weight: 500;
        }
        .nav-link:hover {
            color: #E67E22 !important;
        }
        .btn-agendar {
            background-color: #E67E22;
            color: white;
            border-radius: 4px;
            font-weight: 500;
        }
        .btn-agendar:hover {
            background-color: #cf6d1b;
            color: white;
        }
        .page-hero {
            background: linear-gradient(rgba(22, 34, 46, 0.65), rgba(22, 34, 46, 0.65)), url('{{ asset('images/hospital-bg.jpg') }}') center/cover no-repeat;
            min-height: 320px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .social-icon-btn {
            width: 40px;
            height: 40px;
            background-color: #E67E22;
            color: white;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: background-color 0.2s;
        }
        .social-icon-btn:hover {
            background-color: #cf6d1b;
            color: white;
        }
        .card-help {
            background-color: #E67E22;
            border-radius: 12px;
            color: white;
        }
        .footer-section {
            background-color: #ffffff;
            border-top: 1px solid #eaeaea;
        }
        .footer-link {
            color: #6c757d;
            text-decoration: none;
            display: block;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }
        .footer-link:hover {
            color: #E67E22;
        }
    </style>
</head>
<body>

<!-- BARRA DE NAVEGACIÓN SUPERIOR -->
<nav class="navbar navbar-expand-lg navbar-custom sticky-top py-3">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Dr. Jorge Reque">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center gap-3">
                <li class="nav-item"><a class="nav-link" href="#">Psicoeducación</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Conferencias</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/contacto') }}">Contacto</a></li>
                <li class="nav-item"><a class="nav-link text-muted small" href="#">Tu cita fue agendada con éxito!</a></li>
                <li class="nav-item">
                    <a href="#" class="btn btn-agendar px-4 py-2">Agendar Cita</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- SECCIÓN HERO / ENCABEZADO DE CONTACTO -->
<section class="page-hero text-white text-center py-5">
    <div class="container position-relative">
        <h1 class="fw-bold display-4 mb-2">Contacto</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0 bg-transparent p-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white text-decoration-none">Inicio</a></li>
                <li class="breadcrumb-item text-white-50 active text-white" aria-current="page">Contacto</li>
            </ol>
        </nav>
    </div>
</section>

<!-- SECCIÓN PRINCIPAL: ¿CÓMO ENCONTRARME? Y TARJETA LATERAL DE AYUDA -->
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="row align-items-start justify-content-between g-5">
            
            <!-- Columna Izquierda: Información de Ubicación y Redes Sociales -->
            <div class="col-lg-7">
                <h2 class="fw-bold text-dark mb-3">¿Cómo encontrarme?</h2>
                <p class="text-muted mb-4">
                    Si necesitas mi ayuda como Psiquiatra Infantil, me encuentro en La Paz – Bolivia, pero gracias a internet puedo brindarte apoyo mediante videollamadas.
                </p>

                <h3 class="fw-bold text-dark h4 mb-3">La Paz - Bolivia</h3>
                <ul class="list-unstyled text-muted mb-4">
                    <li class="mb-2 d-flex align-items-center">
                        <i class="bi bi-telephone-fill me-2" style="color: #E67E22;"></i> 
                        <a href="tel:+59161170309" class="text-decoration-none text-muted">+59161170309</a>
                    </li>
                    <li class="d-flex align-items-center">
                        <i class="bi bi-envelope-fill me-2" style="color: #E67E22;"></i> 
                        <a href="mailto:drjorgerequepsiquiatrainfantil@gmail.com" class="text-decoration-none text-muted">drjorgerequepsiquiatrainfantil@gmail.com</a>
                    </li>
                </ul>

                <h3 class="fw-bold text-dark h4 mb-3">Sígueme en las Redes Sociales</h3>
                <p class="text-muted mb-3">
                    Constantemente comparto información, tips y publico videos muy interesantes para ayudarte con la salud de tus niños.
                </p>

                <!-- Botones de Redes Sociales -->
                <div class="d-flex gap-3">
                    <a href="#" class="social-icon-btn"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-icon-btn"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-icon-btn"><i class="bi bi-tiktok"></i></a>
                    <a href="#" class="social-icon-btn"><i class="bi bi-twitter"></i></a>
                </div>
            </div>

            <!-- Columna Derecha: Tarjeta Naranja Destacada -->
            <div class="col-lg-4">
                <div class="card card-help border-0 p-4 text-center shadow-lg">
                    <div class="card-body py-4">
                        <h3 class="fw-bold mb-3">¿Necesitas Ayuda?</h3>
                        <div class="mx-auto bg-white mb-4" style="width: 50px; height: 2px;"></div>
                        <p class="mb-4 small text-white-50">
                            ¡No perdamos tiempo y pongámonos en contacto!<br><br>
                            Debajo te dejo el enlace para comunicarte conmigo.
                        </p>
                        <h4 class="fw-bold mb-0 text-white">+591 61170309</h4>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- PIE DE PÁGINA (FOOTER) -->
<footer class="footer-section pt-5 pb-3">
    <div class="container">
        <div class="row g-4 justify-content-between">
            
            <!-- Columna 1: Logo y descripción -->
            <div class="col-lg-4 mb-4">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Dr. Jorge Reque" style="max-height: 45px;" class="me-2">
                </div>
                <p class="fw-bold text-dark mb-2">¡Gracias por visitarme!</p>
                <p class="text-muted small mb-0">
                    Me dedico a cuidar de la salud mental de niños, niñas y adolescentes.
                </p>
            </div>

            <!-- Columna 2: Apoyo Psiquiátrico -->
            <div class="col-lg-3 mb-4">
                <h5 class="fw-bold text-dark fs-6 mb-3">Apoyo Psiquiátrico</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="footer-link">WHATSAPP</a></li>
                    <li><a href="#" class="footer-link">AGENDAR CITA</a></li>
                    <li><a href="#" class="footer-link">AGENDAR VIDEOLLAMADA</a></li>
                    <li><a href="#" class="footer-link">CONTACTO</a></li>
                </ul>
            </div>

            <!-- Columna 3: Contacto -->
            <div class="col-lg-4 mb-4">
                <h5 class="fw-bold text-dark fs-6 mb-3">Contacto</h5>
                <ul class="list-unstyled text-muted small">
                    <li class="mb-2 d-flex align-items-start">
                        <i class="bi bi-geo-alt-fill me-2" style="color: #E67E22;"></i> Irpavi, Av. Altamirano, entre calles 6 y 7, N° 6545
                    </li>
                    <li class="mb-2 d-flex align-items-center">
                        <i class="bi bi-envelope-fill me-2" style="color: #E67E22;"></i> drjorgerequepsiquiatrainfantil@gmail.com
                    </li>
                    <li class="d-flex align-items-center">
                        <i class="bi bi-telephone-fill me-2" style="color: #E67E22;"></i> +59161170309
                    </li>
                </ul>
            </div>

        </div>

        <!-- Línea divisoria inferior e información de Copyright -->
        <hr class="text-muted my-4">
        <div class="row align-items-center">
            <div class="col-md-8 text-muted small">
                <p class="mb-0">Copyright © 2026 Dr. Jorge Reque Psiquiatra Infantil Todos los Derechos Reservados.</p>
                <p class="mb-0">Diseñado por Alcancía Digital.</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <div class="d-flex justify-content-md-end gap-2">
                    <a href="#" class="social-icon-btn" style="width: 30px; height: 30px; font-size: 0.8rem;"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-icon-btn" style="width: 30px; height: 30px; font-size: 0.8rem;"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-icon-btn" style="width: 30px; height: 30px; font-size: 0.8rem;"><i class="bi bi-tiktok"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>