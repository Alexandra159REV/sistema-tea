<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración para crear la tabla de seguimientos.
     */
    public function up(): void
    {
        Schema::create('seguimientos', function (Blueprint $table) {
            $table->id();
            // Relación con la tabla pacientes
            $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');
            
            // Métricas para el gráfico de Radar (0 a 100)
            $table->integer('puntaje_autonomia')->default(0);
            $table->integer('puntaje_comunicacion')->default(0);
            $table->integer('compromiso')->default(0);
            $table->integer('estabilidad_emocional')->default(0);
            $table->integer('consistencia')->default(0);
            
            // Datos adicionales del reporte del padre
            $table->boolean('mejora_percibida')->default(false);
            $table->text('observacion_padre')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Revierte la migración.
     */
    public function down(): void
    {
        Schema::dropIfExists('seguimientos');
    }
};