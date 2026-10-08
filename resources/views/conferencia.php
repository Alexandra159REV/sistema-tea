<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conferencias y Entrevistas - Dr. Jorge Reque</title>
    
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- CSS Personalizado en la parte superior -->
    <style>
        .page-hero {
            background-color: #16222e;
        }
        .btn-custom-orange {
            background-color: #E67E22;
            color: white;
        }
        .btn-custom-orange:hover {
            background-color: #cf6d1b;
            color: white;
        }
        /* Estilos para las tarjetas con efecto translúcido / moderno de las capturas */
        .card-custom-interview {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid #eaeaea;
            border-radius: 12px;
            transition: transform 0.2s ease-in-out;
        }
        .card-custom-interview:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.08);
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

<!-- SECCIÓN HERO / ENCABEZADO -->
<section class="page-hero position-relative text-white text-center py-5" style="background: linear-gradient(rgba(22, 34, 46, 0.7), rgba(22, 34, 46, 0.7)), url('{{ asset('images/hospital-bg.jpg') }}') center/cover no-repeat; min-height: 350px; display: flex; align-items: center; justify-content: center;">
    <div class="container position-relative">
        <h1 class="fw-bold display-4 mb-2">Conferencias</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0 bg-transparent p-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white text-decoration-none">Inicio</a></li>
                <li class="breadcrumb-item text-white-50 active text-white" aria-current="page">Conferencias</li>
            </ol>
        </nav>
    </div>
</section>

<!-- SECCIÓN 1: CONFERENCIAS DEL DR. JORGE REQUE (Imagen izquierda y texto derecha) -->
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            <!-- Columna Izquierda: Imagen del Congreso / Presentación -->
            <div class="col-lg-6">
                <div class="rounded-4 overflow-hidden shadow-sm">
                    <img src="{{ asset('images/conferencia-congreso.jpg') }}" alt="Conferencias Dr. Jorge Reque" class="img-fluid w-100 object-fit-cover" style="max-height: 400px;">
                </div>
            </div>
            <!-- Columna Derecha: Títulos y Descripción -->
            <div class="col-lg-6">
                <h2 class="fw-bold text-dark display-6 mb-3">Conferencias del Dr. Jorge Reque</h2>
                <p class="text-muted mb-3">
                    Hace poco estuve Representando a Bolivia en el XXIII Congreso Nacional de Psiquiatría Infantil de México.
                </p>
                <p class="text-muted mb-4">
                    Volví a encontrarme con maestros y colegas. A contarles que mi formación fue de la mejor, y que en Bolivia la psiquiatría infantil está creciendo. Algún día podremos organizar un evento de esta magnitud.
                </p>
                
                <!-- Tarjeta o miniatura del video de YouTube o red social -->
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden" style="max-width: 450px;">
                    <div class="position-relative">
                        <img src="{{ asset('images/video-thumb.jpg') }}" alt="Video preview" class="img-fluid w-100">
                        <div class="position-absolute top-50 start-50 translate-middle text-white bg-dark bg-opacity-50 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="bi bi-play-fill fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECCIÓN 2: TODAS LAS ENTREVISTAS (Fondo con temática/banner translúcido y tarjetas de contenido) -->
<section class="py-5 position-relative text-dark" style="background: linear-gradient(rgba(255,255,255,0.92), rgba(255,255,255,0.92)), url('{{ asset('images/fondo-entrevistas.jpg') }}') center/cover no-repeat;">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            
            <!-- Columna Izquierda: Título y bajada -->
            <div class="col-lg-5">
                <span class="text-uppercase text-muted small fw-bold tracking-wider">Psiquiatría Infantil</span>
                <h2 class="fw-bold display-5 text-dark mb-3">Todas las Entrevistas del Dr. Jorge Reque</h2>
                <p class="text-muted mb-3">
                    En esta sección podrás visualizar las presentaciones, entrevistas que realizo, para volverlas a ver y seguir aprendiendo juntos.
                </p>
                <p class="text-muted mb-0">
                    En esta sección podrás visualizar las presentaciones, entrevistas que realizo, para volverlas a ver y seguir aprendiendo juntos.
                </p>
            </div>

            <!-- Columna Derecha: Tarjetas de Entrevistas Estilizadas -->
            <div class="col-lg-7">
                <div class="row g-3">
                    <!-- Tarjeta 1 -->
                    <div class="col-md-6">
                        <div class="card-custom-interview p-4 h-100 shadow-sm">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-file-earmark-medical fs-4 text-warning me-2"></i>
                                <h5 class="fw-bold text-dark mb-0 fs-6">Paternidad Positiva</h5>
                            </div>
                            <a href="#" class="text-decoration-none small fw-bold" style="color: #E67E22;">Ver Entrevista Completa &rarr;</a>
                        </div>
                    </div>

                    <!-- Tarjeta 2 -->
                    <div class="col-md-6">
                        <div class="card-custom-interview p-4 h-100 shadow-sm">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-heart-pulse fs-4 text-warning me-2"></i>
                                <h5 class="fw-bold text-dark mb-0 fs-6">Cuida de Tu Salud Mental Antes de Subirte Al Coche</h5>
                            </div>
                            <p class="text-muted small mb-0 mt-2">Comparto tips que debes conocer antes de subirte a un coche.</p>
                        </div>
                    </div>

                    <!-- Tarjeta 3 (Ancha abajo) -->
                    <div class="col-12">
                        <div class="card-custom-interview p-4 shadow-sm">
                            <div class="d-flex align-items-center mb-1">
                                <i class="bi bi-mic fs-4 text-warning me-2"></i>
                                <h5 class="fw-bold text-dark mb-0 fs-6">Entrevista Radio Compañera Fm 106.3</h5>
                            </div>
                            <p class="text-muted small mb-0">En esta ocasión fui entrevistado en Radio Compañera, escucha toda la entrevista.</p>
                        </div>
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
                    <img src="{{ asset('images/logo.png') }}" alt="Dr. Jorge Reque" style="max-height: 50px;" class="me-2">
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
                    <a href="#" class="text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; background-color: #E67E22;"><i class="bi bi-facebook small"></i></a>
                    <a href="#" class="text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; background-color: #E67E22;"><i class="bi bi-instagram small"></i></a>
                    <a href="#" class="text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; background-color: #E67E22;"><i class="bi bi-tiktok small"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>