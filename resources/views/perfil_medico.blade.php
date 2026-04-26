<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Profesional - NeuroCentro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root { 
            --primary-blue: #007bff; 
            --dark-navy: #1a252f; 
            --medilink-blue: #3b71ed;
            --bg-light: #f4f7f6;
        }
        
        body { 
            font-family: 'Inter', sans-serif; 
            margin: 0; 
            overflow-x: hidden;
            background-color: var(--bg-light);
            background-image: linear-gradient(rgba(244, 247, 246, 0.75), rgba(244, 247, 246, 0.75));
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .medical-banner {
            background-color: var(--primary-blue);
            background-image: linear-gradient(rgba(0,0,0,0.4), rgba(244, 247, 246, 0));
            background-size: cover;
            background-position: center;
            height: 400px; 
        }

        .profile-header { margin-top: -120px; position: relative; z-index: 10; padding-bottom: 50px; }

        .avatar-container {
            width: 180px; height: 180px;
            background: white; border-radius: 30px;
            display: flex; align-items: center; justify-content: center;
            font-size: 4rem; font-weight: 800; color: var(--primary-blue);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            border: 8px solid white;
        }

        .stat-box, .welcome-card, .contact-card, .map-container {
            background: rgba(255, 255, 255, 0.8) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.4) !important;
            border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.04) !important;
        }

        .stat-box { padding: 30px 15px; text-align: center; transition: all 0.3s ease; }
        .stat-box:hover { transform: translateY(-8px); background: white !important; }

        .welcome-card { padding: 45px; }

        .action-item {
            background-color: var(--medilink-blue);
            color: white;
            padding: 22px 28px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-bottom: 20px;
            border: none;
            box-shadow: 0 8px 20px rgba(59, 113, 237, 0.15);
        }

        .action-item:hover {
            background-color: #2a56c6;
            transform: scale(1.02);
            color: white;
        }

        /* ESTILO DEL MAPA */
        #map {
            width: 100%;
            height: 300px;
            border-radius: 20px;
        }
        .map-container {
            padding: 15px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="medical-banner w-100"></div>

    <div class="container profile-header">
        <div class="row g-5"> 
            <div class="col-lg-4">
                <div class="text-center text-lg-start mb-5">
                    <div class="avatar-container mx-auto mx-lg-0 mb-4">JR</div>
                    <h2 class="fw-bold text-dark">Dr. Jorge Reque</h2>
                    <p class="text-muted">
                        <i class="bi bi-patch-check-fill text-primary"></i> 
                        Especialista en Neurodesarrollo y TEA
                    </p>
                    
                    <div class="d-grid gap-3 mt-4">
                        <button class="btn btn-primary rounded-pill py-3 fw-bold shadow-sm">Editar Perfil</button>
                        <a href="{{ url('/dashboard') }}" class="btn btn-light rounded-pill py-3 shadow-sm text-dark fw-bold">
                            Volver al Panel
                        </a>
                    </div>
                </div>

                <div class="contact-card p-4">
                    <h6 class="text-uppercase fw-bold text-muted small border-bottom pb-3 mb-3">Contacto Directo</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3 d-flex align-items-center">
                            <i class="bi bi-envelope me-3 text-primary fs-5"></i> 
                            <span class="small">drjorgereque@neurocentro.com</span>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="bi bi-telephone me-3 text-primary fs-5"></i> 
                            <span>+591 987 654 321</span>
                        </li>
                        <li class="d-flex align-items-start">
                            <i class="bi bi-geo-alt me-3 text-primary fs-5"></i> 
                            <span class="small">Irpavi, entre calles 6 y 7, N6545, La Paz</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="row g-4 mb-5">
                    @php
                        $stats = [
                            ['val' => '24', 'label' => 'Pacientes'],
                            ['val' => '12', 'label' => 'Reportes'],
                            ['val' => '12', 'label' => 'Consultas'],
                            ['val' => '98%', 'label' => 'Éxito'],
                        ];
                    @endphp
                    @foreach($stats as $stat)
                    <div class="col-6 col-md-3">
                        <div class="stat-box">
                            <h3 class="fw-bold text-primary mb-1">{{ $stat['val'] }}</h3>
                            <small class="text-muted fw-bold text-uppercase" style="font-size: 0.65rem;">{{ $stat['label'] }}</small>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="row g-4">
                    <div class="col-md-6 mb-4">
                        <div class="welcome-card h-100 d-flex flex-column">
                            <h3 class="fw-bold mb-4">Bienvenida</h3>
                            <p class="text-muted lh-lg mb-4">
                                Lideramos un espacio de vanguardia especializado en terapias para niños con TEA. Nuestro compromiso es el desarrollo integral.
                            </p>
                            
                            <div class="mt-auto pt-4 border-top">
                                <p class="mb-0 fw-bold text-primary">Dr. Jorge Reque</p>
                                <small class="text-muted fw-semibold">Director Médico</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="action-item">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-hospital fs-4 me-3"></i>
                                <div><span class="fw-bold d-block">Sede Central</span><small class="opacity-75">San Martín 450</small></div>
                            </div>
                            <i class="bi bi-chevron-right"></i>
                        </div>

                        <div class="map-container">
                            <div id="map"></div>
                        </div>

                        <div class="action-item" style="background-color: var(--dark-navy); margin-top: 25px;">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-whatsapp fs-4 me-3 text-success"></i>
                                <div><span class="fw-bold d-block">Urgencias</span><small class="opacity-75">Atención 24 Horas</small></div>
                            </div>
                            <i class="bi bi-chevron-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function initMap() {
            // Coordenadas de ejemplo (La Paz, Irpavi)
            const ubicacion = { lat: -16.5255, lng: -68.0964 }; 
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: ubicacion,
                styles: [ /* Estilo minimalista para que combine con tu diseño */
                    { "featureType": "administrative", "elementType": "geometry", "stylers": [{ "visibility": "off" }] },
                    { "featureType": "poi", "stylers": [{ "visibility": "off" }] },
                    { "featureType": "road", "elementType": "labels.icon", "stylers": [{ "visibility": "off" }] },
                    { "featureType": "transit", "stylers": [{ "visibility": "off" }] }
                ]
            });
            const marker = new google.maps.Marker({
                position: ubicacion,
                map: map,
                title: "NeuroCentro - Sede Central"
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=TU_API_KEY&callback=initMap" async defer></script>

</body>
</html>