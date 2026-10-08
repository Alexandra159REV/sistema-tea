<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería de Pictogramas - NeuroCentro</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: #f4f7f6; 
            padding: 20px; 
        }
        h1 { 
            text-align: center; 
            color: #2c3e50; 
            margin-bottom: 30px;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 25px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 15px;
            text-align: center;
            transition: transform 0.2s;
            border: 2px solid #3498db; /* Azul: Todo está bien */
        }
        .card:hover { 
            transform: translateY(-5px); 
        }
        .card img {
            width: 100%;
            height: 140px;
            object-fit: contain;
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
            background-color: #fafafa;
        }
        .title { 
            font-weight: bold; 
            color: #34495e; 
            text-transform: capitalize; 
            margin-bottom: 8px;
            font-size: 16px;
        }
        /* Estilos para la auditoría del Paso 6 */
        .debug-info {
            background: #f8f9fa;
            font-size: 11px;
            color: #666;
            padding: 8px;
            margin-top: 10px;
            border-radius: 6px;
            text-align: left;
            border-top: 1px dashed #ddd;
            line-height: 1.4;
        }
        .debug-info code {
            color: #e74c3c;
            word-break: break-all;
        }
    </style>
</head>
<body>

    <h1> Biblioteca de Pictogramas Inteligentes</h1>

    <div class="grid-container">
        @foreach($pictos as $picto)
            <div class="card">
                <!-- Verificación de Imagen usando la carpeta storage -->
                
                <img src="{{ asset('storage/pictogramas/' . ltrim(str_replace('img/', '', $picto->ImagePath), '/')) }}">
                     alt="{{ $picto->Title }}"
                     onerror="this.onerror=null; this.src='https://via.placeholder.com/150?text=Error+en+Ruta'; this.parentElement.style.borderColor='#e74c3c';">
                
                <div class="title">{{ str_replace('_', ' ', $picto->Title) }}</div>
                
                <!-- Panel de Auditoría corregido con mayúsculas de la DB -->
                <div class="debug-info">
                    <strong>ID:</strong> {{ $picto->Id }} <br>
                    <strong>Archivo:</strong> <code>{{ $picto->ImagePath }}</code> <br>
                    <strong>Tags IA:</strong> {{ $picto->SearchText ?? 'Sin etiquetas' }} <br>
                    <strong>Score:</strong> {{ number_format($picto->Score ?? 0, 4) }}
                </div>
            </div>
        @endforeach
    </div>

</body>
</html>