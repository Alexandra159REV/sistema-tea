<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PictogramasMasivoSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Limpiamos la tabla física 'pictogramas'
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('pictogramas')->truncate(); 
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 2. Ruta exacta a tus archivos
        $rutaBase = storage_path('app/public/pictogramas'); 

        if (!File::exists($rutaBase)) {
            $this->command->error("No se encontró la carpeta en: $rutaBase");
            return;
        }

        $directorios = File::directories($rutaBase);
        $totalCargados = 0;

        foreach ($directorios as $directorio) {
            $categoriaNombre = basename($directorio);
            $imagenes = File::files($directorio);

            $this->command->info("Procesando categoría: $categoriaNombre...");

            foreach ($imagenes as $imagen) {
                // Solo archivos de imagen
                if (!in_array($imagen->getExtension(), ['png', 'jpg', 'jpeg', 'svg', 'webp'])) {
                    continue;
                }

                $nombreArchivo = pathinfo($imagen->getFilename(), PATHINFO_FILENAME);
                
                // Limpieza: lavar_manos -> Lavar manos
                $tituloLimpio = Str::ucfirst(str_replace(['_', '-'], ' ', $nombreArchivo));
                $rutaRelativa = 'storage/pictogramas/' . $categoriaNombre . '/' . $imagen->getFilename();

                // 3. INSERCIÓN MANUAL (Solo las columnas que SEGURO tienes)
                DB::table('pictogramas')->insert([
                    'Title'          => $tituloLimpio,
                    'ImagePath'      => $rutaRelativa,
                    'SearchText'     => strtolower($tituloLimpio . ' ' . $categoriaNombre),
                    'Embedding'      => null, 
                    'EmbeddingModel' => 'text-embedding-3-small',
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ]);
                
                $totalCargados++;
            }
        }

        $this->command->info("¡POR FIN! Se registraron $totalCargados pictogramas.");
    }
}