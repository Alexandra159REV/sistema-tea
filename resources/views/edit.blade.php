<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Paciente - {{ $paciente->nombre }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-blue-50 p-4 md:p-8">

<div class="max-w-5xl mx-auto p-4"> 
    <div class="flex items-center mb-8">
        <a href="{{ route('index') }}" class="mr-4 text-slate-500 hover:text-blue-600 transition">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Editar Perfil de Paciente</h1>
            <p class="text-slate-500">Actualizando información de {{ $paciente->nombre }}</p>
        </div>
    </div>

    {{-- FORMULARIO PRINCIPAL DE EDICIÓN --}}
    <form action="{{ route('update', $paciente->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Nombre Completo</label>
                <input type="text" name="nombre" value="{{ $paciente->nombre }}" 
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition shadow-sm" required>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Edad</label>
                <input type="number" name="edad" value="{{ $paciente->edad }}"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition shadow-sm">
            </div>
            
            <div class="md:col-span-2 mt-6">
                <h2 class="text-xl font-extrabold border-l-4 border-blue-500 pl-4 mb-6">2. Preferencias Visuales</h2>
                <div class="space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Brillo</label>
                            <input type="range" name="brillo_pref" min="0" max="100" value="50" class="w-full h-2 bg-gray-200 rounded-lg cursor-pointer accent-blue-600">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Contraste</label>
                            <input type="range" name="contraste_pref" min="0" max="100" value="50" class="w-full h-2 bg-gray-200 rounded-lg cursor-pointer accent-blue-600">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Color de Fondo</label>
                        <input type="color" name="color_fondo" value="#f0faff" class="w-full h-12 rounded-xl border-none shadow">
                    </div>
                </div>
            </div>
        </div>

        {{-- Botones de Guardar (Ahora sí está dentro del formulario de edición) --}}
        <div class="flex items-center justify-end gap-4 mt-10 pt-6 border-t border-slate-100">
            <a href="{{ route('index') }}" class="px-6 py-3 rounded-xl text-slate-500 font-bold hover:bg-slate-100 transition">Cancelar</a>
            <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-xl font-bold shadow-lg shadow-blue-200 hover:bg-blue-700 transition-all">
                <i class="fas fa-save mr-2"></i> Guardar Cambios
            </button>
        </div>
    </form>

    {{-- BUSCADOR INTELIGENTE (Fuera del form anterior) --}}
    <div class="mt-8 p-6 bg-white rounded-2xl border border-slate-200 shadow-sm">
        <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">
            Buscador Inteligente de Pictogramas
        </label>
        <div class="flex gap-2">
            <input type="text" id="queryInput" 
                   class="flex-1 px-4 py-3 rounded-xl border border-slate-200 shadow-sm focus:ring-2 focus:ring-blue-500 outline-none" 
                   placeholder="Ej: comer...">
            <button type="button" onclick="buscarPictograma()" 
                    class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-indigo-700 transition">
                Buscar
            </button>
        </div>
        <div id="resultadoBusqueda" class="mt-4">
            <img id="imagenPictograma" src="" style="display:none; max-width: 200px;" class="rounded-xl border shadow-lg">
        </div>
    </div>
</div>

<script>
    function buscarPictograma() {
        let texto = document.getElementById('queryInput').value;
        let url = '{{ route("pictograma.buscar") }}';
        console.log("Intentando conectar a:", url); // Útil para depurar en la consola (F12)

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ query: texto }) 
        })
        .then(response => {
            // Verificamos si la respuesta es OK antes de intentar leer el JSON
            if (!response.ok) {
                return response.text().then(text => { throw new Error(text) });
            }
            return response.json();
        })
        .then(data => {
            if(data.ruta_imagen) { 
                let img = document.getElementById('imagenPictograma');
                img.src = data.ruta_imagen;
                img.style.display = 'block';
            } else {
                console.error('La respuesta no contiene ruta_imagen:', data);
            }
        })
        .catch(error => {
            console.error('Error detallado:', error);
            alert('Error al conectar con el servidor de IA. Revisa la consola (F12) para más detalles.');
        });
    }
</script>

</body>
</html>