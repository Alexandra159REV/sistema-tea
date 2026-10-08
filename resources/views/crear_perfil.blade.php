<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NeuroCentro - Acceso al Sistema</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f0f4f8 0%, #e2e8f0 100%);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
        .tab-active {
            border-bottom: 3px solid #0284c7;
            color: #0284c7;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

<div class="w-full max-w-md">
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-sky-600 text-white shadow-lg shadow-sky-200 mb-3">
            <i class="fa-solid fa-brain text-2xl"></i>
        </div>
        <h1 class="text-2xl font-black text-slate-800 tracking-tight">NeuroCentro</h1>
        <p class="text-sm font-medium text-slate-500">Tecnología IA para Neurodesarrollo</p>
    </div>

    <div class="glass-card rounded-3xl shadow-xl overflow-hidden p-8">
        
        <div class="flex border-b border-slate-200 mb-6 text-center">
            <button type="button" id="tabPadre" onclick="switchRole('padre')" class="w-1/2 pb-3 font-bold text-sm tracking-wide text-slate-400 transition-all tab-active">
                <i class="fa-solid fa-user-shield mr-2"></i>PADRES
            </button>
            <button type="button" id="tabDoctor" onclick="switchRole('doctor')" class="w-1/2 pb-3 font-bold text-sm tracking-wide text-slate-400 transition-all">
                <i class="fa-solid fa-user-doctor mr-2"></i>ESPECIALISTAS
            </button>
        </div>

        <form action="{{ route('login.procesar') }}" method="POST" class="space-y-5">
            @csrf
            
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded-xl text-xs font-medium">
                    {{ $errors->first() }}
                </div>
            @endif

            <input type="hidden" name="rol" id="userRole" value="padre">

            <div id="roleAlert" class="bg-sky-50 border border-sky-100 rounded-xl p-3 text-xs text-sky-700 flex items-center gap-2">
                <i class="fa-solid fa-circle-info text-sky-500"></i>
                <span id="roleAlertText">Ingresando al panel de seguimiento familiar de pictogramas.</span>
            </div>

            <div>
                <label id="labelName" class="block text-[11px] font-black text-slate-500 uppercase tracking-wider mb-2">Nombre del usuario</label>
                <div class="relative rounded-xl shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-user" id="iconName"></i>
                    </div>
                    <input type="text" name="name" id="inputName" required value="{{ old('name') }}"
                        class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-sky-500 focus:ring-4 focus:ring-sky-100 transition-all text-sm text-slate-700 placeholder-slate-400" 
                        placeholder="Ej. Juan Duran">
                </div>
            </div>

            <div>
                <label id="labelIdentity" class="block text-[11px] font-black text-slate-500 uppercase tracking-wider mb-2">Clave de Acceso o Correo</label>
                <div class="relative rounded-xl shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-envelope" id="iconIdentity"></i>
                    </div>
                    <input type="text" name="identity" id="inputIdentity" required value="{{ old('identity') }}"
                        class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-sky-500 focus:ring-4 focus:ring-sky-100 transition-all text-sm text-slate-700 placeholder-slate-400" 
                        placeholder="Ej. correo@centro.com o código">
                </div>
            </div>

            <div>
                <label class="block text-[11px] font-black text-slate-500 uppercase tracking-wider mb-2">Contraseña Código</label>
                <div class="relative rounded-xl shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <input type="password" name="password" required
                        class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-sky-500 focus:ring-4 focus:ring-sky-100 transition-all text-sm text-slate-700 placeholder-slate-400" 
                        placeholder="••••••••">
                </div>
            </div>

            <div class="flex items-center justify-between text-xs font-semibold text-slate-500">
                <label class="flex items-center gap-2 cursor-pointer select-none">
                    <input type="checkbox" class="rounded border-slate-300 text-sky-600 focus:ring-sky-500"> Recordarme
                </label>
                <a href="#" class="text-sky-600 hover:underline">¿Olvidaste tu clave?</a>
            </div>

            <button type="submit" class="w-full bg-slate-800 text-white font-bold py-3 px-4 rounded-xl shadow-lg hover:bg-slate-900 active:scale-[0.98] transition-all flex items-center justify-center gap-2 mt-2">
                Ingresar al Sistema <i class="fa-solid fa-arrow-right-to-bracket text-sm"></i>
            </button>
        </form>
    </div>
</div>

<script>
    function switchRole(role) {
        const tabPadre = document.getElementById('tabPadre');
        const tabDoctor = document.getElementById('tabDoctor');
        const userRole = document.getElementById('userRole');
        const roleAlert = document.getElementById('roleAlert');
        const roleAlertText = document.getElementById('roleAlertText');
        
        const labelName = document.getElementById('labelName');
        const inputName = document.getElementById('inputName');
        const labelIdentity = document.getElementById('labelIdentity');
        const inputIdentity = document.getElementById('inputIdentity');
        
        const iconName = document.getElementById('iconName');
        const iconIdentity = document.getElementById('iconIdentity');

        userRole.value = role;

        if (role === 'padre') {
            tabPadre.classList.add('tab-active');
            tabDoctor.classList.remove('tab-active');
            
            roleAlert.className = "bg-sky-50 border border-sky-100 rounded-xl p-3 text-xs text-sky-700 flex items-center gap-2";
            roleAlertText.innerText = "Ingresando al panel de seguimiento familiar de pictogramas.";
            
            if(labelName) labelName.innerText = "Nombre del Padre / Tutor";
            if(inputName) inputName.placeholder = "Ej. Juan Duran";
            if(labelIdentity) labelIdentity.innerText = "Correo del Padre / Tutor";
            if(inputIdentity) inputIdentity.placeholder = "padre@correo.com";
            
            if(iconName) iconName.className = "fa-solid fa-user";
            if(iconIdentity) iconIdentity.className = "fa-solid fa-envelope";
        } else {
            tabDoctor.classList.add('tab-active');
            tabPadre.classList.remove('tab-active');
            
            roleAlert.className = "bg-purple-50 border border-purple-100 rounded-xl p-3 text-xs text-purple-700 flex items-center gap-2";
            roleAlertText.innerText = "Módulo exclusivo para Doctores, Psicopedagogos y Terapeutas.";
            
            if(labelName) labelName.innerText = "Nombre del Especialista";
            if(inputName) inputName.placeholder = "Ej. Dr. Jorge Reque";
            if(labelIdentity) labelIdentity.innerText = "Correo del Especialista";
            if(inputIdentity) inputIdentity.placeholder = "doctor@neurocentro.com";
            
            if(iconName) iconName.className = "fa-solid fa-user-md";
            if(iconIdentity) iconIdentity.className = "fa-solid fa-at";
        }
    }
</script>


</body>
</html>