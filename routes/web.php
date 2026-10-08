<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB; 
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\PacienteIAController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PictogramaController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| NeuroCentro - Sistema de Rutas Unificado
|--------------------------------------------------------------------------
*/

// --- 1. FLUJO DE INICIO, SECUENCIA Y NAVEGACIÓN (REGISTRO PASO A PASO) ---

// 1. --registrar a los pacientess
//La raíz de tu aplicación ahora cargará el Login / crear_perfil unificado
Route::get('/', function () {
    return view('crear_perfil');
})->name('login');


// Entrar colocando la direccion
Route::get('/crear_perfil', function () {
    return view('crear_perfil');
})->name('login');



//  -- 2. Conectar el login a la base de datos


// Carga de la pantalla de Login unificado (Raíz)
//Route::get('/', [AuthController::class, 'showLogin'])->name('login');  Para loguear con el usuario

// Procesa el formulario del Login mediante POST para validar credenciales
Route::post('/login-validar', [AuthController::class, 'login'])->name('login.procesar');




//  -- 3. del registro de pacientes al dashboard

// Asegúrate de que la ruta /dashboard exista
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');




//  -- 4. Del Dashboard a gestion_pacientes

// --- GESTIÓN DE PACIENTES (CRUD Y PERFILES) ---
Route::controller(PacienteController::class)->group(function () {
    // Esta es la ruta a la que apunta el botón "Pacientes"
    Route::get('/gestion-pacientes', 'index')->name('index'); 
    
    Route::post('/guardar', 'store')->name('store');
    Route::get('/paciente/{paciente}/edit', 'edit')->name('edit');
    Route::put('/paciente/{paciente}', 'update')->name('update');
    Route::delete('/paciente/{paciente}', 'destroy')->name('destroy');
    
    // Perfiles y Seguimiento
    Route::get('/perfil-padre/{paciente}', 'perfilPadre')->name('perfil');
    Route::get('/perfil-nino/{id}', 'perfilPadre')->name('perfil.nino');
    Route::get('/paciente/{id}/buscar', 'buscarPictogramas')->name('buscar.pictogramas');
    Route::post('/seguimiento/{id}', 'guardarSeguimiento')->name('seguimiento.store');
    Route::post('/paciente/{paciente}/analizar-ia', 'analizarIA')->name('ia.analizar');
});




// Esta línea asocia la URL /pacientes con la función index() que acabamos de configurar
Route::get('/pacientes', [PacienteController::class, 'index'])->name('index');




// -- 5. Redireccionar de paciente a nuevo apciente

// Asegúrate de que el nombre asignado al final coincida con el del botón
Route::get('/registrar-paciente', [PacienteController::class, 'crearPaso1'])->name('paso1');





// -- 6. enviar la informacion al crear el perfil a al base de datos

Route::get('/pacientes', [PacienteController::class, 'index'])
    ->name('index');

Route::get('/registrar-paciente', [PacienteController::class, 'crearPaso1'])
    ->name('crear.paciente');

Route::post('/pacientes/store-basico', [PacienteController::class, 'storeBasico'])
    ->name('store.basico');

Route::post('/pacientes/store-agenda/{id}', [PacienteController::class, 'storeAgenda'])
    ->name('agenda.store');

Route::get('/perfil/{id}', [PacienteController::class, 'perfilPadre'])
    ->name('perfil');

Route::post('/seguimiento/{id}', [PacienteController::class, 'guardarSeguimiento'])
    ->name('seguimiento.store');

Route::get('/paciente/{paciente}/edit', [PacienteController::class, 'edit'])
    ->name('edit');

Route::put('/paciente/{paciente}', [PacienteController::class, 'update'])
    ->name('update');

Route::delete('/paciente/{paciente}', [PacienteController::class, 'destroy'])
    ->name('destroy');




// -- 7. Sincronizar los pronts de la semana con el Ollama para dar los pictogramsa en el perfil del niño

// 1. Ruta para abrir la vista de creación de perfil/agenda (Asegúrate de pasar el ID del Paciente)
Route::get('/paciente/{id}/crear-perfil', function($id) {
    $paciente = \App\Models\Paciente::findOrFail($id);
    return view('tea-laravel.crear_perfil', compact('paciente'));
})->name('paciente.crear_perfil');

// 2. Ruta POST que procesará la IA y actualizará los pictogramas en la BD
Route::post('/paciente/{id}/procesar-agenda', [PacienteIAController::class, 'analizarAgendaSemanal'])
     ->name('paciente.procesar_agenda');


//Conectar el Diffuser
//Route::post('/buscar-pictograma', [PictogramaController::class, 'buscar']);
//Route::post('/buscar-pictograma', [PictogramaController::class, 'buscar']);
//Route::post('/buscar', [PictogramaController::class, 'buscar'])->name('pictograma.buscar');

// Usa esta única línea, es la correcta
Route::post('/buscar', [PictogramaController::class, 'buscarConApi'])->name('pictograma.buscar');



// Muestra la lista de pacientes
Route::get('/pacientes', [PacienteController::class, 'index'])->name('index');

// Carga tu ventana 'formulario.blade.php'
Route::get('/registrar-paciente', [PacienteController::class, 'crearPaso1'])->name('paso1');

// Procesa el envío de datos de ese formulario
Route::post('/registrar-paciente/guardar', [PacienteController::class, 'storeBasico'])->name('store.basico');

// Carga la agenda (Paso 2)
//Route::get('/registrar-paciente/agenda/{id}', function($id) {
//    return view('registro_agenda', ['id' => $id]); // Asegúrate de que tu vista de agenda se llame así
//})->name('paso2');





// Cambiamos 'buscar' por 'buscarConApi'





// Código que tienes en las líneas 53-55:
Route::get('/analisis-diario', function () {
    return view('analis_diario'); // Asegúrate de que el archivo se llame...
})->name('analis.diario');  // <--- ¡AQUÍ ESTÁ EL PROBLEMA!


// Paso 1: Carga inicial del formulario vacío (Evita errores de variables en la vista)
//Route::get('/', [PacienteController::class, 'crearPaso1'])->name('paso1');

// Paso 1: Procesa el formulario básico, guarda en la BD y redirige al Paso 2
Route::post('/paciente/registro-paso1', [PacienteController::class, 'storeBasico'])->name('paciente.storeBasico');




// Paso 2: Vista de la Agenda/Registro Semanal (Buscamos al paciente completo para evitar fallos en la vista)
//Route::get('/registro-sensorial/{id}', function ($id) {
//    $paciente = App\Models\Paciente::findOrFail($id);
//    return view('registro', compact('paciente')); 
//})->name('paso2');



// Paso 2: Guarda la agenda semanal y redirige finalmente a la tabla de gestión
Route::post('/pacientes/{id}/guardar-agenda', [PacienteController::class, 'storeAgenda'])->name('agenda.store');


// --- 2. PANELES DE CONTROL (DASHBOARD) ---
Route::view('/dashboard', 'panel_principal')->name('dashboard');
Route::view('/perfil-profesional', 'perfil_medico')->name('medico.index');


// --- 3. GESTIÓN DE PACIENTES (CRUD Y PERFILES) ---
Route::controller(PacienteController::class)->group(function () {
    Route::get('/gestion-pacientes', 'index')->name('index'); 
    Route::post('/guardar', 'store')->name('store');
    Route::get('/paciente/{paciente}/edit', 'edit')->name('edit');
    Route::put('/paciente/{paciente}', 'update')->name('update');
    Route::delete('/paciente/{paciente}', 'destroy')->name('destroy');
    
    // Perfil del Padre / General
    Route::get('/perfil-padre/{paciente}', 'perfilPadre')->name('perfil');
    
    // PERFIL DEL NIÑO (Esta ruta carga registro_nino con datos de un niño ya existente)
    Route::get('/perfil-nino/{id}', 'perfilPadre')->name('perfil.nino');

    // Gestión de Pictogramas y Seguimiento
    Route::get('/paciente/{id}/buscar', 'buscarPictogramas')->name('buscar.pictogramas');
    Route::post('/seguimiento/{id}', 'guardarSeguimiento')->name('seguimiento.store');

    // Análisis semántico con IA
    Route::post('/paciente/{paciente}/analizar-ia', 'analizarIA')->name('ia.analizar');
});


// --- 4. MÓDULO DE INTELIGENCIA ARTIFICIAL (Ollama / OpenAI) ---
Route::controller(PacienteIAController::class)->group(function () {
    Route::get('/ia/consejo/{paciente}', 'obtenerConsejo')->name('ia.consejo');
    Route::post('/ia/segmentar-texto', 'segmentarTexto')->name('ia.segmentar');
    
    // Ruta para el análisis de la agenda en el perfil padre
    Route::post('/paciente/{id}/analizar-agenda', 'analizarActividad')->name('paciente.analizar');
    
    // Análisis del diario
    Route::post('/ia/analizar-diario-completo/{id}', 'analizarDiario')->name('ia.diario.completo');
});


use App\Http\Controllers\ConferenciaController;

Route::get('/conferencia', [ConferenciaController::class, 'index']);



Route::get('/contacto', function () {
    return view('contacto'); // Asegúrate de que tu archivo en views se llame contacto.blade.php
});


// --- 5. BIBLIOTECA DE PICTOGRAMAS ---
Route::get('/pictogramas', function () {
    $pictos = DB::table('Pictograms')
        ->orderBy('Id', 'asc')
        ->get();
    return view('pictogramas', compact('pictos'));
})->name('pictogramas.index');


// --- 6. CIERRE DE SESIÓN ---
Route::post('/logout', function () {
    return redirect()->route('index');
})->name('logout');



