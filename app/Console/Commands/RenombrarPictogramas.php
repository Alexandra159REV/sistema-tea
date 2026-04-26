<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RenombrarPictogramas extends Command
{
    // Este es el nombre del comando que usaremos en la terminal
    protected $signature = 'pictos:renombrar';
    protected $description = 'Cambia los nombres de números a palabras clave para la IA';

    public function handle()
    {
        // Diccionario basado en tus imágenes de ARASAAC
        $mapeo = [
            '2246' => 'aceite',
            '2248' => 'agua',
            '2266' => 'arroz',
            '2274' => 'batidora',
            '2320' => 'cucharon',
            '2323' => 'cebolla',
            '2329' => 'cerezas',
            '2341' => 'cocina',
            '2342' => 'cocinar',
            '2349' => 'comer',
            '2362' => 'cuchara',
            '2363' => 'cuchara_grande',
            '2382' => 'colador',
            '2384' => 'esparragos',
            '2399' => 'lavaplatos',
            '2400' => 'fresa',
            '2438' => 'judias',
            '2445' => 'leche',
            '2446' => 'lechuga',
            '2462' => 'manzana',
            '2468' => 'durazno',
            '2469' => 'melon',
            '2473' => 'microondas',
            '2483' => 'naranja',
            '2494' => 'pan',
            '2503' => 'papa',
            '2525' => 'pina',
            '2530' => 'platano',
            '2532' => 'plato',
            '2554' => 'sal',
            '2557' => 'sandia',
            '2558' => 'sarten',
            '2561' => 'pera',
            '2588' => 'tenedor',
            '2594' => 'tomate',
            '2598' => 'tostadora',
            '2610' => 'vaso',
            '2619' => 'zanahoria',
            '2656' => 'bandeja',
        ];

        $directorio = public_path('pictogramas');

        if (!File::exists($directorio)) {
            $this->error("Error: La carpeta 'public/pictogramas' no existe.");
            return;
        }

        $this->info("Iniciando proceso de renombrado...");
        $contador = 0;

        foreach ($mapeo as $numero => $nuevoNombre) {
            $rutaVieja = $directorio . '/' . $numero . '.png'; // O .jpg segun tus archivos
            $rutaNueva = $directorio . '/' . $nuevoNombre . '.png';

            if (File::exists($rutaVieja)) {
                File::move($rutaVieja, $rutaNueva);
                $this->line("Renombrado: {$numero} -> {$nuevoNombre}");
                $contador++;
            }
        }

        $this->info("¡Finalizado! Se renombraron {$contador} imágenes.");
    }
}