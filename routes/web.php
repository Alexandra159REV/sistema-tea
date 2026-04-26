<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\PacienteIAController; // <--- Punto y coma añadido

/*
|--------------------------------------------------------------------------
| NeuroCentro - Sistema de Rutas Unificado
|--------------------------------------------------------------------------
*/

// --- FLUJO DE REGISTRO ---
Route::get('/', function () {
    return view('registro_nino'); 
})->name('paso1');

Route::get('/registro-sensorial', function () {
    return view('registro'); 
})->name('paso2');


// --- PANELES PRINCIPALES ---
Route::get('/dashboard', function () {
    return view('panel_principal');
})->name('dashboard');

Route::get('/perfil-profesional', function () {
    return view('perfil_medico');
})->name('medico.index');


// --- GESTIÓN DE PACIENTES (CRUD) ---
Route::controller(PacienteController::class)->group(function () {
    Route::get('/gestion-pacientes', 'index')->name('index'); 
    Route::post('/guardar', 'store')->name('store');
    Route::get('/{paciente}/edit', 'edit')->name('edit');
    Route::put('/{paciente}', 'update')->name('update');
    Route::delete('/{paciente}', 'destroy')->name('destroy');
    
    // Perfil del padre
    Route::get('/perfil-padre/{paciente}', 'perfilPadre')->name('perfil');
    Route::get('/paciente/{id}/buscar', 'buscarPictogramas')->name('buscar.pictogramas');

    // NUEVA RUTA: El análisis semántico que conecta con Python
    // Esta es la que debe usar tu formulario en perfil_padre.blade.php
    Route::post('/paciente/{paciente}/analizar-ia', 'analizarIA')->name('ia.analizar');
});


// --- MÓDULO IA (Ollama + Prism) ---
Route::controller(PacienteIAController::class)->group(function () {
    Route::get('/ia/consejo/{paciente}', 'obtenerConsejo')->name('ia.consejo');
    
    // Si necesitas el análisis de diario que tenías antes en otro controlador:
    Route::post('/ia/analizar-diario-completo/{id}', 'analizarDiario')->name('ia.diario.completo');
    
    Route::post('/ia/segmentar-texto', 'segmentarTexto')->name('ia.segmentar');
});


// --- LOGOUT ---
Route::post('/logout', function () {
    return redirect()->route('paso1');
})->name('logout');