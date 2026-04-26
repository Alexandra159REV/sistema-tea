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

    <div class="max-w-3xl mx-auto">
        <div class="flex items-center mb-8">
            {{-- SE CORRIGIÓ: Ahora apunta a la ruta 'index' --}}
            <a href="{{ route('index') }}" class="mr-4 text-slate-500 hover:text-blue-600 transition">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Editar Perfil de Paciente</h1>
                <p class="text-slate-500">Actualizando información de {{ $paciente->nombre }}</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-blue-100 overflow-hidden">
            <div class="bg-blue-600 p-4">
                <h2 class="text-white font-semibold flex items-center">
                    <i class="fas fa-user-edit mr-2"></i> Datos Principales
                </h2>
            </div>
            
            {{-- SE CORRIGIÓ: Usamos la ruta nominal 'update' que es más segura --}}
            <form action="{{ route('update', $paciente->id) }}" method="POST" class="p-8">
                @csrf
                @method('PUT') {{-- Laravel requiere PUT para actualizaciones --}}
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Nombre Completo</label>
                        <input type="text" name="nombre" value="{{ $paciente->nombre }}" 
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition shadow-sm" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Edad</label>
                        <input type="number" name="edad" value="{{ $paciente->edad }}" 
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition shadow-sm" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Nivel de TEA</label>
                        <div class="relative">
                            <select name="nivel_tea" 
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition shadow-sm appearance-none bg-white">
                                <option value="Grado 1" @selected($paciente->nivel_tea == 'Grado 1')>Grado 1 (Leve)</option>
                                <option value="Grado 2" @selected($paciente->nivel_tea == 'Grado 2')>Grado 2 (Moderado)</option>
                                <option value="Grado 3" @selected($paciente->nivel_tea == 'Grado 3')>Grado 3 (Severo)</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="flex items-center justify-end gap-4 mt-10 pt-6 border-t border-slate-100">
                    {{-- SE CORRIGIÓ: Cancelar también vuelve a la lista plural --}}
                    <a href="{{ route('index') }}" 
                        class="px-6 py-3 rounded-xl text-slate-500 font-bold hover:bg-slate-100 transition">
                        Cancelar
                    </a>
                    <button type="submit" 
                        class="bg-blue-600 text-white px-8 py-3 rounded-xl font-bold shadow-lg shadow-blue-200 hover:bg-blue-700 hover:-translate-y-0.5 transition-all">
                        <i class="fas fa-save mr-2"></i> Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>