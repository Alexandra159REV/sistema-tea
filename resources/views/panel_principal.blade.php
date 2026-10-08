<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dr. Jorge Reque - Psiquiatría Infantil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root { 
            --doctor-orange: #E67E22;
            --doctor-orange-hover: #D35400;
            --doctor-hero-bg: #E3F2FD;
            --text-dark: #333333;
            --text-gray: #4b5563;
            --neuro-dark: #16222e;
        }
        
        body { 
            font-family: 'Inter', sans-serif; 
            margin: 0; padding: 0;
            min-height: 100vh;
            background-color: #ffffff;
            color: var(--text-dark);
        }

        /* --- BARRA DE NAVEGACIÓN SUPERIOR --- */
        .navbar-custom {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            padding: 15px 0;
        }

        .navbar-brand-text {
            font-weight: 700;
            color: var(--text-dark);
            text-decoration: none;
            font-size: 1.1rem;
        }

        .nav-link-custom {
            color: var(--text-dark) !important;
            font-weight: 500;
            margin: 0 10px;
            text-decoration: none;
            transition: color 0.2s;
        }

        .nav-link-custom:hover {
            color: var(--doctor-orange) !important;
        }

        .btn-agendar {
            background-color: var(--doctor-orange);
            color: white !important;
            padding: 10px 22px;
            border-radius: 6px;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.2s;
        }

        .btn-agendar:hover {
            background-color: var(--doctor-orange-hover);
        }

        /* --- SECCIÓN HERO PRINCIPAL --- */
        .hero-section {
            background-color: var(--doctor-hero-bg);
            padding: 80px 0;
            overflow: hidden;
        }

        .hero-title {
            font-weight: 800;
            font-size: 3.2rem;
            color: #2C3E50;
            line-height: 1.15;
            margin-bottom: 20px;
        }

        .hero-subtitle {
            font-size: 1.05rem;
            color: var(--text-gray);
            line-height: 1.6;
            margin-bottom: 30px;
            max-width: 500px;
        }

        .btn-recorrido {
            background-color: var(--doctor-orange);
            color: white;
            padding: 12px 30px;
            border-radius: 6px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.2s;
        }

        .btn-recorrido:hover {
            background-color: var(--doctor-orange-hover);
            color: white;
        }

        /* --- NAVEGACIÓN TIPO DASHBOARD SECUNDARIA --- */
        .nav-wrapper {
            position: relative; z-index: 20;
            width: 90%; max-width: 900px;
            margin: -40px auto 40px auto; 
        }

        .quick-nav-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            border: 1px solid rgba(227, 242, 253, 0.8);
            padding: 10px;
        }

        .nav-btn {
            border: none; background: none;
            padding: 20px 10px; text-align: center;
            color: var(--text-gray); text-decoration: none;
            display: flex; flex-direction: column; align-items: center;
            font-size: 0.75rem; font-weight: 700;
            transition: all 0.3s ease;
        }

        .nav-btn:hover { 
            transform: translateY(-3px);
            color: var(--doctor-orange);
        }
        
        .nav-btn i { font-size: 1.8rem; margin-bottom: 8px; color: var(--doctor-orange); }

        /* --- SECCIÓN FORMACIÓN / ACERCA DE MI --- */
        .about-section {
            padding: 60px 0;
            background-color: #fff;
        }
        .doctor-profile-img {
            width: 100%;
            border-radius: 12px;
            object-fit: cover;
            max-height: 480px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        /* --- SERVICIOS --- */
        .service-card {
            background: #ffffff;
            border: 1px solid #eaeaea;
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            transition: all 0.3s;
            height: 100%;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        }
        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            border-color: var(--doctor-orange);
        }
        .service-icon {
            font-size: 2.2rem;
            color: var(--doctor-orange);
            margin-bottom: 15px;
        }

        /* --- ESTILOS PARA LA NUEVA SECCIÓN DE AGENDA (BASADA EN IMAGEN) --- */
        .cta-consulta-section {
            position: relative;
            background: linear-gradient(rgba(15, 23, 42, 0.75), rgba(15, 23, 42, 0.75)), url('{{ asset("static/uploads/medico_imagen_fondo_consulta.jpg") }}') center/cover no-repeat;
            color: white;
            padding: 90px 0;
            overflow: hidden;
        }
        
        .cta-consulta-content {
            max-width: 600px;
        }

        .cta-consulta-title {
            font-weight: 800;
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #ffffff;
        }

        .cta-consulta-text {
            font-size: 1.05rem;
            line-height: 1.6;
            color: #e2e8f0;
            margin-bottom: 30px;
        }

        .jorgeReque {
            width: 100%;        /* Hace que ocupe todo el ancho de su columna de Bootstrap */
            max-width: 450px;   /* Limita el tamaño máximo para que no crezca de más */
            height: auto;       /* Mantiene la proporción original */
        }

        .cerebro1 {
            width: 100%;        /* Hace que ocupe todo el ancho de su columna de Bootstrap */
            max-width: 350px;   /* Limita el tamaño máximo para que no crezca de más */
            height: auto;       /* Mantiene la proporción original */
        }

        .testimonio1 {
            width: 100%;        /* Hace que ocupe todo el ancho de su columna de Bootstrap */
            max-width: 120px;   /* Limita el tamaño máximo para que no crezca de más */
            height: auto;       /* Mantiene la proporción original */
        }

        .testimonio2 {
            width: 100%;        /* Hace que ocupe todo el ancho de su columna de Bootstrap */
            max-width: 180px;   /* Limita el tamaño máximo para que no crezca de más */
            height: auto;       /* Mantiene la proporción original */
        }

        .testimonio3 {
            width: 100%;        /* Hace que ocupe todo el ancho de su columna de Bootstrap */
            max-width: 180px;   /* Limita el tamaño máximo para que no crezca de más */
            height: auto;       /* Mantiene la proporción original */
        }

        .testimonio4 {
            width: 100%;        /* Hace que ocupe todo el ancho de su columna de Bootstrap */
            max-width: 180px;   /* Limita el tamaño máximo para que no crezca de más */
            height: auto;       /* Mantiene la proporción original */
        }

        .testimonioimg1 {
            width: 100%;        /* Hace que ocupe todo el ancho de su columna de Bootstrap */
            max-width: 500px;   /* Limita el tamaño máximo para que no crezca de más */
            height: auto;       /* Mantiene la proporción original */
        }

        .testimonioimg2 {
            width: 100%;        /* Hace que ocupe todo el ancho de su columna de Bootstrap */
            max-width: 80px;   /* Limita el tamaño máximo para que no crezca de más */
            height: auto;       /* Mantiene la proporción original */
        }

        /* Estilo para que el fondo del footer sea blanco/claro como en la referencia */
        footer, .site-footer {
            background-color: #f8f9fa !important; /* Fondo claro */
            color: #4a5568 !important;            /* Texto gris oscuro */
        }

        /* Controla el tamaño grande y proporcional del logo en el footer */
        .footer-logo {
            width: 520px;       /* Ajusta este valor si lo quieres un poco más grande o pequeño */
            height: auto;       /* Mantiene la proporción original para que no se deforme */
            max-width: 100%;
        }

        /* --- FOOTER --- */
        footer { background: var(--neuro-dark); color: #94a3b8; padding: 60px 0 30px 0; }
        .footer-title { color: white; font-weight: 700; margin-bottom: 20px; font-size: 0.9rem; text-transform: uppercase; }
        .footer-link { color: #94a3b8; text-decoration: none; transition: 0.3s; display: block; margin-bottom: 10px; }
        .footer-link:hover { color: var(--doctor-orange); padding-left: 5px; }
    </style>
</head>
<body>

    <!-- 1. BARRA DE NAVEGACIÓN SUPERIOR -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <i class="bi bi-brain text-primary fs-3" style="color: var(--doctor-orange) !important;"></i>
                
                <div class="col-lg-5 mb-4 mb-lg-0">
                    
                    <img src="{{ asset('images/cerebroo1.png') }}" class="cerebroo1" alt="cerebroo1" class="img-fluid mb-3" style="max-height: 180px; object-fit: contain;" >
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarNav">
                <ul class="navbar-nav align-items-center gap-3 mb-3 mb-lg-0">
                    
                   <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-purple fw-semibold" href="#" id="psicoeducacionDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Psicoeducación
                        </a>
                        
                        <ul class="dropdown-menu shadow border-0 rounded-3 p-2" aria-labelledby="psicoeducacionDropdown">
                            
                            <!-- Submenú de Crianza -->
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle py-2 rounded" href="#" id="crianzaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Crianza
                                </a>
                                <ul class="dropdown-menu shadow border-0 rounded-3 p-2">
                                    <li><a class="dropdown-item py-2 rounded" href="#">Cuida Tu Sueño</a></li>
                                    <li><a class="dropdown-item py-2 rounded" href="#">Adolescencia</a></li>
                                    <li><a class="dropdown-item py-2 rounded" href="#">Trastorno de conducta</a></li>
                                    <li><a class="dropdown-item py-2 rounded" href="#">Los famosos dispositivos</a></li>
                                    <li><a class="dropdown-item py-2 rounded" href="#">Auxilio!, me estoy divorciando...</a></li>
                                </ul>
                            </li>

                            
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle py-2 rounded" href="#" id="trastornosdelneurodesarrolloDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Trastornos del Neurodesarrollo
                                </a>
                                <ul class="dropdown-menu shadow border-0 rounded-3 p-2">
                                    <li><a class="dropdown-item py-2 rounded" href="#">Cuida Tu Sueño</a></li>
                                    <li><a class="dropdown-item py-2 rounded" href="#">Adolescencia</a></li>
                                    <li><a class="dropdown-item py-2 rounded" href="#">Trastorno de conducta</a></li>
                                    <li><a class="dropdown-item py-2 rounded" href="#">Los famosos dispositivos</a></li>
                                    <li><a class="dropdown-item py-2 rounded" href="#">Auxilio!, me estoy divorciando...</a></li>
                                </ul>
                            </li>


                            
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle py-2 rounded" href="#" id="emocioneDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Emocione
                                </a>
                                <ul class="dropdown-menu shadow border-0 rounded-3 p-2">
                                    <li><a class="dropdown-item py-2 rounded" href="#">Cuida Tu Sueño</a></li>
                                    <li><a class="dropdown-item py-2 rounded" href="#">Adolescencia</a></li>
                                    <li><a class="dropdown-item py-2 rounded" href="#">Trastorno de conducta</a></li>
                                    <li><a class="dropdown-item py-2 rounded" href="#">Los famosos dispositivos</a></li>
                                    <li><a class="dropdown-item py-2 rounded" href="#">Auxilio!, me estoy divorciando...</a></li>
                                </ul>
                            </li>



                            
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle py-2 rounded" href="#" id="trastornosdealimentaciónDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Trastornos de Alimentación
                                </a>
                                <ul class="dropdown-menu shadow border-0 rounded-3 p-2">
                                    <li><a class="dropdown-item py-2 rounded" href="#">Cuida Tu Sueño</a></li>
                                    <li><a class="dropdown-item py-2 rounded" href="#">Adolescencia</a></li>
                                    <li><a class="dropdown-item py-2 rounded" href="#">Trastorno de conducta</a></li>
                                    <li><a class="dropdown-item py-2 rounded" href="#">Los famosos dispositivos</a></li>
                                    <li><a class="dropdown-item py-2 rounded" href="#">Auxilio!, me estoy divorciando...</a></li>
                                </ul>
                            </li>



                            
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle py-2 rounded" href="#" id="enfermedadmentalDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Enfermedad Mental
                                </a>
                                <ul class="dropdown-menu shadow border-0 rounded-3 p-2">
                                    <li><a class="dropdown-item py-2 rounded" href="#">Cuida Tu Sueño</a></li>
                                    <li><a class="dropdown-item py-2 rounded" href="#">Adolescencia</a></li>
                                    <li><a class="dropdown-item py-2 rounded" href="#">Trastorno de conducta</a></li>
                                    <li><a class="dropdown-item py-2 rounded" href="#">Los famosos dispositivos</a></li>
                                    <li><a class="dropdown-item py-2 rounded" href="#">Auxilio!, me estoy divorciando...</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>


                    <a href="{{ url('/conferencia') }}" class="btn-recorrido">Conferencias</a>
                    <a href="{{ url('/contacto') }}" class="btn-recorrido">Contacto</a>
                    
                
                    
                    
                </ul>
                <div class="ms-lg-3">
                    <a href="#" class="btn-agendar">Agendar Cita</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- 2. SECCIÓN HERO / INICIO -->
    <header class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <span class="badge bg-light text-dark border mb-3 px-3 py-2 fw-semibold"><i class="bi bi-cpu-fill text-info me-1"></i> TECNOLOGÍA IA PARA NEURODESARROLLO</span>
                    <h1 class="hero-title">Dr. Jorge Reque<br>Psiquiatra<br>Infantil</h1>
                    <p class="hero-subtitle">Especialista y sub especialista en el diagnóstico y tratamiento de niños, adolescentes y adultos que requieren atención psiquiátrica en La Paz - Bolivia.</p>
                    <a href="{{ url('/pacientes') }}" class="btn-recorrido">Iniciar Recorrido</a>
                </div>

                <div class="col-lg-5 text-center mt-4 mt-lg-0">
                    <div class="p-4 bg-white rounded-4 shadow-sm border">
                        
                        <!-- Reemplazamos el icono por tu imagen con un ancho controlado -->
                        <img src="{{ asset('images/autismo.png') }}" class="img-fluid mb-3" style="max-height: 300px; object-fit: contain;" alt="Autismo">
                        
                        <h5 class="mt-3 fw-bold text-dark">Adaptación Pictográfica IA</h5>
                        <p class="small text-muted mb-0">Soporte visual personalizado para el espectro autista y comunicación aumentativa.</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- NAVEGACIÓN INTERNA RÁPIDA (Sistema / Dashboard) -->
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

    <!-- 3. SECCIÓN FORMACIÓN Y ACERCA DE MÍ -->
    <section class="about-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <img src="{{ asset('images/jorgeReque.png') }}" class="jorgeReque" alt="Dr. Jorge Reque">
                   
                </div>
                <div class="col-lg-7 ps-lg-5">
                    <span class="text-uppercase small fw-bold text-muted">Información sobre mí</span>
                    <h2 class="fw-bold display-6 mb-3 text-dark">¡Hola!<br>Soy el Dr. Jorge Reque</h2>
                    <h5 class="fw-semibold text-secondary mb-4">Conoce un poco de mi formación.</h5>
                    
                    <ul class="list-unstyled text-muted small lh-lg">
                        <li class="mb-2"><i class="bi bi-dot text-dark fs-5"></i> Estudié medicina en la Facultad de la U.M.S.A. – La Paz[cite: 14].</li>
                        <li class="mb-2"><i class="bi bi-dot text-dark fs-5"></i> Realicé mi especialidad de Psiquiatría General en la Caja Nacional de Salud y la Especialidad en Psiquiatría Forense con sede en la Universidad San Francisco Xavier de Chuquisaca.</li>
                        <li class="mb-2"><i class="bi bi-dot text-dark fs-5"></i> Cuento con la sub-especialidad en psiquiatría de niños y adolescentes, misma que realicé en el Hospital Psiquiátrico Infantil «Dr. Juan N. Navarro» de la ciudad de México.</li>
                        <li class="mb-2"><i class="bi bi-dot text-dark fs-5"></i> Tengo formación en varios cursos y diplomados como Certificación para el diagnóstico de autismo, Psicopedagogía, neurodesarrollo infantil, y diplomado en educación sexual infantil.</li>
                        <li class="mb-2"><i class="bi bi-dot text-dark fs-5"></i> Actualmente me desempeño como docente de Pre y Posgrado en diferentes universidades del país.</li>
                        <li><i class="bi bi-dot text-dark fs-5"></i> Soy miembro de la Sociedad Paceña de Psiquiatría y Pediatría (Bolivia) y de la Asociación Mexicana de Psiquiatría Infantil (AMPI).</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Quien es el doctor -->
    <section class="py-5 bg-white">
        <div class="container py-4">
            <div class="row align-items-center g-5">
                <!-- Columna Izquierda: Títulos y Descripciones -->
                <div class="col-lg-5">
                    <span class="text-uppercase fw-bold small text-muted tracking-wider" style="color: #8c7ae6; letter-spacing: 1px;">Preguntas Frecuentes</span>
                    <h2 class="fw-bold display-5 text-dark mt-2 mb-4" style="line-height: 1.2;">
                        ¿Quién es el<br>Psiquiatra<br>Infantil?
                    </h2>
                    <p class="text-muted mb-4" style="font-size: 0.95rem; line-height: 1.6;">
                        Es un médico que se especializa en el diagnóstico y el tratamiento de los desórdenes del pensamiento, las emociones y/o el comportamiento que afecta a los niños, adolescentes y sus familias.
                    </p>
                    <p class="text-muted" style="font-size: 0.95rem; line-height: 1.6;">
                        Para atender la salud mental de los niños y adolescentes, se requiere estudiar 6 años de medicina, luego se debe especializar (3 años) en psiquiatría general con adultos y finalmente se debe hacer una sub especialidad de (2 años), que en este caso se lo debe realizar en el exterior, porque en Bolivia no existe esta formación especializada.
                    </p>
                </div>

                <!-- Columna Derecha: Acordeón Interactivo -->
                <div class="col-lg-7">
                    <div class="accordion custom-accordion" id="faqAccordion">
                        
                        <!-- Item 1: Abierto por defecto -->
                        <div class="accordion-item mb-3 border-0 shadow-sm rounded-3 overflow-hidden">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button fw-bold text-dark bg-light px-4 py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="font-size: 1.05rem;">
                                    Conocimientos
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                <div class="accordion-body bg-light px-4 pb-4 text-muted" style="font-size: 0.95rem; line-height: 1.6;">
                                    El psiquiatra infantil cuenta con los conocimientos del desarrollo normal y biológicos del niño y adolescente, que le permiten evaluar los componentes físicos, genéticos, de desarrollo emocionales, educacionales, familiares y sociales que intervienen en el desarrollo de enfermedades psiquiátricas en la infancia y adolescencia.
                                </div>
                            </div>
                        </div>

                        <!-- Item 2: Cerrado -->
                        <div class="accordion-item border-0 shadow-sm rounded-3 overflow-hidden">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed fw-bold text-dark bg-light px-4 py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="font-size: 1.05rem;">
                                    ¿Cuándo debo pedir una valoración por el psiquiatra infantil?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                <div class="accordion-body bg-light px-4 pb-4 text-muted" style="font-size: 0.95rem; line-height: 1.6;">
                                    Debes considerar una valoración cuando notes cambios persistentes en el comportamiento, rendimiento escolar, estado de ánimo desregulado, problemas severos de sueño, ansiedad extrema o dificultades significativas en las relaciones sociales de tu hijo o hija.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. SECCIÓN SERVICIOS DE ATENCIÓN -->
    <section class="py-5 bg-light border-top">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-7">
                    <h2 class="fw-bold text-dark display-6">Conoce los servicios de atención</h2>
                    <p class="text-muted">Ahora que conoces un poco más de mí, puedo ayudarte en los siguientes aspectos:</p>

                    <section class="servicios-section">
                        <div class="container">
                            <div class="row align-items-center">
                                
                                <!-- Columna Izquierda: Textos y botones -->
                                <div class="col-lg-5 text-content">
                                    <h2>Conoce los servicios de atención</h2>
                                    <p>Ahora que conoces un poco más de mí, puedo ayudarte en los siguientes aspectos.</p>
                                    <a href="#" class="btn btn-warning">Agendar Cita</a>
                                </div>

                                <!-- Columna Derecha: Imagen con efecto difuminado -->
                                <div class="col-lg-7 image-container">
                                    <img src="{{ asset('images/cerebroo1.png') }}" class="fade-image" alt="Servicios médicos">
                                </div>

                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-lg-5 text-lg-end">
                    <a href="#" class="btn-agendar">Agendar Cita</a>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="service-card">
                        <i class="bi bi-people service-icon"></i>
                        <h5 class="fw-bold text-dark">Diagnóstico de Autismo</h5>
                        <p class="small text-muted mb-0">Tengo la certificación de PROCEDDA - México, para realizar el diagnóstico.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="service-card">
                        <i class="bi bi-person-badge service-icon"></i>
                        <h5 class="fw-bold text-dark">Diagnóstico de TDAH</h5>
                        <p class="small text-muted mb-0">Identificar el diagnóstico de la hiperactividad, inatención e impulsividad.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="service-card">
                        <i class="bi bi-heart-pulse service-icon"></i>
                        <h5 class="fw-bold text-dark">Ansiedad</h5>
                        <p class="small text-muted mb-0">Tratamiento especializado y abordaje integral para trastornos de ansiedad infantil.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="service-card">
                        <i class="bi bi-shield-check service-icon"></i>
                        <h5 class="fw-bold text-dark">Depresión</h5>
                        <p class="small text-muted mb-0">Evaluación y contención profesional para cuadros depresivos en la infancia y adolescencia.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

  

            <!-- SECCIÓN DE TESTIMONIOS Y GALERÍA DE FOTOS -->
        <section class="py-5 bg-white">
            <div class="container">
                <h2 class="fw-bold text-dark mb-5">Testimonios</h2>
                <div class="row align-items-center g-4">
                    
                    <!-- Columna Izquierda: Galería de fotos en cuadrícula (2x2) -->
                    <div class="col-lg-6">
                        <div class="row g-3">
                            <div class="col-6">
                                <img src="{{ asset('images/testimonio1.png') }}" alt="Testimonio 1" class="img-fluid rounded-4 shadow-sm w-100" style="height: 180px; object-fit: cover;">
                            </div>
                            <div class="col-6">
                                <img src="{{ asset('images/testimonio2.png') }}" alt="Testimonio 2" class="img-fluid rounded-4 shadow-sm w-100" style="height: 180px; object-fit: cover;">
                            </div>
                            <div class="col-6">
                                <img src="{{ asset('images/testimonio3.png') }}" alt="Testimonio 3" class="img-fluid rounded-4 shadow-sm w-100" style="height: 180px; object-fit: cover;">
                            </div>
                            <div class="col-6">
                                <img src="{{ asset('images/testimonio4.png') }}" alt="Testimonio 4" class="img-fluid rounded-4 shadow-sm w-100" style="height: 180px; object-fit: cover;">
                            </div>
                        </div>
                    </div>

                    <!-- Columna Derecha: Texto y Estadísticas -->
                    <div class="col-lg-6 ps-lg-5">
                        <p class="text-muted mb-4">Con la formación profesional que conociste, puedo brindarte una excelente atención.</p>
                        <div class="mb-4">
                            <a href="#" class="btn-agendar">Contacto</a>
                        </div>

                        <div class="container py-4">
                            <div class="row align-items-center justify-content-center text-center g-4">
                                
                                <!-- Logo 1 -->
                                <div class="col-6 col-md-3">
                                    <img src="{{ asset('images/testimonioimg1.png') }}" class="img-fluid" style="max-height: 80px; object-fit: contain;" alt="Logo Sociedad Boliviana de Pediatría">
                                </div>

                                <!-- Logo 2 -->
                                <div class="col-6 col-md-3">
                                    <img src="{{ asset('images/logo2.png') }}" class="img-fluid" style="max-height: 80px; object-fit: contain;" alt="Logo Amssac">
                                </div>

                                <!-- Logo 3 -->
                                <div class="col-6 col-md-3">
                                    <img src="{{ asset('images/logo3.png') }}" class="img-fluid" style="max-height: 80px; object-fit: contain;" alt="Logo Ampi">
                                </div>

                                <!-- Logo 4 -->
                                <div class="col-6 col-md-3">
                                    <img src="{{ asset('images/logo4.png') }}" class="img-fluid" style="max-height: 80px; object-fit: contain;" alt="Logo Universidad">
                                </div>

                            </div>
                        </div>
                        


                        <div class="row text-center mt-4 g-4">
                            <div class="col-6">
                                <div class="p-3 border rounded-4 bg-light shadow-sm">
                                    <i class="bi bi-person-check fs-2" style="color: var(--doctor-orange) !important;"></i>
                                    <h3 class="fw-bold text-dark mt-2 mb-0">5,013</h3>
                                    <small class="text-muted">Pacientes Satisfechos</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 border rounded-4 bg-light shadow-sm">
                                    <i class="bi bi-award fs-2" style="color: var(--doctor-orange) !important;"></i>
                                    <h3 class="fw-bold text-dark mt-2 mb-0">5+</h3>
                                    <small class="text-muted">Años de Experiencia</small>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>


            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="p-3 bg-light rounded-4 border text-center">
                        <p class="text-muted italic small mb-0">📸 Espacio para galería de fotos y experiencias de pacientes satisfechos.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <p class="text-muted mb-4">Con la formación profesional que conociste, puedo brindarte una excelente atención.</p>
                    <div class="mb-4">
                        <a href="#" class="btn-agendar">Contacto</a>
                    </div>
                    <div class="row text-center mt-4 g-4">
                        <div class="col-6">
                            <div class="p-3 border rounded bg-light">
                                <i class="bi bi-person-check fs-2 text-primary" style="color: var(--doctor-orange) !important;"></i>
                                <h3 class="fw-bold text-dark mt-2 mb-0">5,013</h3>
                                <small class="text-muted">Pacientes Satisfechos</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 border rounded bg-light">
                                <i class="bi bi-award fs-2 text-primary" style="color: var(--doctor-orange) !important;"></i>
                                <h3 class="fw-bold text-dark mt-2 mb-0">5+</h3>
                                <small class="text-muted">Años de Experiencia</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. SECCIÓN "AGENDA TU PRIMERA CONSULTA" (NUEVA SECCIÓN DEBAJO DE TESTIMONIOS - REF: image_7d38f9) -->
    <section class="cta-consulta-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 cta-consulta-content">
                    <h2 class="cta-consulta-title">Agenda Tu Primera Consulta</h2>
                    <p class="cta-consulta-text">Si necesitas mi ayuda como Psiquiatra Infantil, puedes agendar tu cita a través del siguiente botón.<br>Me encuentro en La Paz - Bolivia, pero gracias a internet puedo brindarte apoyo mediante videollamadas.<br>Utiliza el Calendario para Agendar tu Cita.</p>
                    <a href="#" class="btn-agendar btn-lg px-4 py-3">Agenda Tu Cita</a>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. FOOTER INSTITUCIONAL -->
    <footer>
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">

                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <!-- Agregamos la clase footer-logo -->
                        <img src="{{ asset('images/cerebroo1.png') }}" class="footer-logo mb-3" alt="Logo Dr. Jorge Reque">
                        <p class="text-muted mb-1">¡Gracias por visitarme!</p>
                        <p class="text-muted">Me dedico a cuidar de la salud mental de niños, niñas y adolescentes.</p>
                    </div>

                  
                    <div class="d-flex gap-3 mt-4">
                        <a href="#" class="text-white fs-5"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white fs-5"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-white fs-5"><i class="bi bi-tiktok"></i></a>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 offset-lg-1">
                    <h5 class="footer-title">Apoyo Psiquiátrico</h5>
                    <a href="#" class="footer-link">WhatsApp</a>
                    <a href="#" class="footer-link">Agendar Cita</a>
                    <a href="#" class="footer-link">Agendar Videollamada</a>
                    <a href="#" class="footer-link">Contacto</a>
                </div>
                <div class="col-md-4 col-lg-4">
                    <h5 class="footer-title">Contacto</h5>
                    <p class="small"><i class="bi bi-geo-alt-fill me-2" style="color: var(--doctor-orange);"></i> Irpavi, Av. Altamirano, entre calles 6 y 7, N° 6545</p>
                    <p class="small"><i class="bi bi-envelope-fill me-2" style="color: var(--doctor-orange);"></i> drjorgerequepsiquiatrainfantil@gmail.com</p>
                    <p class="small"><i class="bi bi-telephone-fill me-2" style="color: var(--doctor-orange);"></i> +59161170309</p>
                </div>
            </div>
            <div class="text-center mt-5 pt-4 border-top border-secondary">
                <p class="small m-0 opacity-75">Copyright © 2026 Dr. Jorge Reque Psiquiatria Infantil Todos los Derechos Reservados.</p>
                <p class="small m-0 opacity-50 mt-1">Diseñado para Proyecto de Grado - Alexandra Revilla</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>