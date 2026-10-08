<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pictogramas_personalizados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paciente_id');
            $table->unsignedBigInteger('pictograma_id');
            $table->string('nombre_archivo');
            $table->text('ruta_archivo');
            $table->timestamps();

            // Asegúrate de que los nombres 'pacientes' y 'pictogramas' 
            // coincidan exactamente con tus tablas ya existentes
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
            $table->foreign('pictograma_id')->references('id')->on('pictogramas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pictogramas_personalizados');
    }
};