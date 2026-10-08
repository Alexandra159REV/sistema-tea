<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportPictograms extends Command
{
    protected $signature = 'import:pictos';
    protected $description = 'Importar pictogramas desde carpeta';

    public function handle()
    {
        $basePath = public_path('pictogramas');

        $categorias = scandir($basePath);

        foreach ($categorias as $categoria) {

            if ($categoria == '.' || $categoria == '..') continue;

            $rutaCategoria = $basePath . '/' . $categoria;

            if (!is_dir($rutaCategoria)) continue;

            // 🔹 Crear o buscar categoría
            $cat = DB::table('Categories')->where('Name', $categoria)->first();

            if (!$cat) {
                $catId = DB::table('Categories')->insertGetId([
                    'Name' => $categoria
                ]);
            } else {
                $catId = $cat->Id;
            }

            // 🔹 Leer imágenes
            $imagenes = glob($rutaCategoria . '/*.png');

            foreach ($imagenes as $img) {

                $nombre = pathinfo($img, PATHINFO_FILENAME);

                // evitar duplicados
                $existe = DB::table('Pictograms')->where('Title', $nombre)->first();

                if ($existe) continue;

                DB::table('Pictograms')->insert([
                    'CategoryId' => $catId,
                    'Title' => $nombre,
                    'ImagePath' => 'pictogramas/' . $categoria . '/' . basename($img),
                    'CreatedAt' => now(),
                    'UpdatedAt' => now()
                ]);

                $this->info("✔ Insertado: $nombre");
            }
        }

        $this->info(" Importación completada");
    }
}