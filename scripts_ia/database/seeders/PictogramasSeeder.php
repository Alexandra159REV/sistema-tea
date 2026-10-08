<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pictograma; 
use Illuminate\Support\Facades\DB;

class PictogramasSeeder extends Seeder
{
    /**
     * Ejecuta el seeder para poblar la biblioteca de pictogramas.
     */
    public function run(): void
    {
        // Desactivamos revisiones de llaves foráneas para limpiar la tabla si es necesario
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Pictograma::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Lista completa de pictogramas base para que tu buscador tenga contenido
        $datos = [
            ['Title' => 'Lavar manos', 'ImagePath' => 'pictogramas/lavar_manos.png'],
            ['Title' => 'Cepillar dientes', 'ImagePath' => 'pictogramas/cepillar_dientes.png'],
            ['Title' => 'Comer', 'ImagePath' => 'pictogramas/comer.png'],
            ['Title' => 'Ir al baño', 'ImagePath' => 'pictogramas/baño.png'],
            ['Title' => 'Dormir', 'ImagePath' => 'pictogramas/dormir.png'],
            ['Title' => 'Vestirse', 'ImagePath' => 'pictogramas/vestirse.png'],
            ['Title' => 'Jugar', 'ImagePath' => 'pictogramas/jugar.png'],
            ['Title' => 'Escuela', 'ImagePath' => 'pictogramas/escuela.png'],
            ['Title' => 'Tarea', 'ImagePath' => 'pictogramas/tarea.png'],
            ['Title' => 'Ver TV', 'ImagePath' => 'pictogramas/tv.png'],
        ];

        foreach ($datos as $item) {
            // Usamos updateOrCreate para evitar duplicados si lo corres varias veces
            Pictograma::updateOrCreate(
                ['Title' => $item['Title']], 
                ['ImagePath' => $item['ImagePath']]
            );
        }

        $this->command->info('¡Biblioteca de pictogramas poblada con éxito!');
    }
}