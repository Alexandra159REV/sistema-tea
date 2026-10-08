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

            // 🔹 DATOS BÁSICOS
            $table->string('nombre');
            $table->integer('edad')->nullable();
            $table->string('diagnostico')->nullable();

            // 🔹 NIVEL TEA Y COMUNICACIÓN
            $table->string('nivel_tea')->nullable();
            $table->string('p_comunicacion')->nullable();
            $table->string('comunicacion_verbal')->nullable();

            // 🔹 PREFERENCIAS VISUALES
            $table->string('brillo_pref')->nullable();
            $table->string('contraste_pref')->nullable();
            $table->string('color_fondo')->nullable();

            // 🔹 INTERACCIÓN SOCIAL
            $table->text('interaccion_social')->nullable();

            // 🔹 AGENDAS SEMANALES
            $table->text('agenda_lunes')->nullable();
            $table->text('agenda_martes')->nullable();
            $table->text('agenda_miercoles')->nullable();
            $table->text('agenda_jueves')->nullable();
            $table->text('agenda_viernes')->nullable();
            $table->text('agenda_sabado')->nullable();
            $table->text('agenda_domingo')->nullable();

            // 🔹 RESULTADOS IA
            $table->longText('sugerencias_pictogramas')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};