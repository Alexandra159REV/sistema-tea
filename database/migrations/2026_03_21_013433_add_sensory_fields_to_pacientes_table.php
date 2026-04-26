<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración para añadir los campos sensoriales.
     */
    public function up(): void
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->integer('brillo_pref')->default(50);   // Nivel de brillo
            $table->integer('contraste_pref')->default(50); // Nivel de contraste
            $table->string('color_fondo')->default('#f0faff'); // Color de fondo
            
        });
    }

    /**
     * Revierte la migración eliminando las columnas.
     */
    public function down(): void
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->dropColumn(['brillo_pref', 'contraste_pref', 'color_fondo']);
        });
    }
};