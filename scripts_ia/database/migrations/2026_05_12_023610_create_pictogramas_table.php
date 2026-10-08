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
        Schema::table('pictogramas', function (Blueprint $table) {
            // AQUÍ VA EL CÓDIGO
            $table->text('SearchText')->after('ImagePath')->nullable();
            $table->longText('Embedding')->after('SearchText')->nullable();
            $table->string('EmbeddingModel')->after('Embedding')->default('text-embedding-3-small');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pictogramas', function (Blueprint $table) {
            // Esto es para revertir los cambios si fuera necesario
            $table->dropColumn(['SearchText', 'Embedding', 'EmbeddingModel']);
        });
    }
};