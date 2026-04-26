<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();

            // --- Datos Personales y Clínicos ---
            $table->string('nombre');
            $table->integer('edad');
            $table->string('nivel_tea')->nullable();
            $table->string('comunicacion_verbal')->nullable();

            // --- Perfil Sensorial ---
            $table->integer('brillo_pref')->default(50);
            $table->integer('contraste_pref')->default(50);
            $table->string('color_fondo')->default('#f0faff');
            $table->string('interaccion_social')->nullable();

            // --- Agenda Semanal ---
            // He dejado los días como 'text' en lugar de 'string' por si el padre escribe mucho
            $table->text('agenda_lunes')->nullable();
            $table->text('agenda_martes')->nullable();
            $table->text('agenda_miercoles')->nullable();
            $table->text('agenda_jueves')->nullable();
            $table->text('agenda_viernes')->nullable();
            $table->text('agenda_sabado')->nullable();
            $table->text('agenda_domingo')->nullable();

            // --- INTELIGENCIA ARTIFICIAL (LA PIEZA FALTANTE) ---
            // Aquí guardaremos las palabras separadas por comas que genere Ollama
            $table->text('sugerencias_pictogramas')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};