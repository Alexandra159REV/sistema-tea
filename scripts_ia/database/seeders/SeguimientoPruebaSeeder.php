<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seguimiento;
use App\Models\Paciente;

class SeguimientoPruebaSeeder extends Seeder
{
    public function run()
    {
        // Buscamos al primer paciente
        $paciente = Paciente::first();

        if ($paciente) {
            $datos = [
                ['aut' => 40, 'com' => 30, 'comp' => 50, 'est' => 40, 'fecha' => now()->subDays(2)],
                ['aut' => 60, 'com' => 55, 'comp' => 65, 'est' => 50, 'fecha' => now()->subDays(1)],
                ['aut' => 85, 'com' => 75, 'comp' => 80, 'est' => 70, 'fecha' => now()],
            ];

            foreach ($datos as $d) {
                Seguimiento::create([
                    'paciente_id' => $paciente->id,
                    'puntaje_autonomia' => $d['aut'],
                    'puntaje_comunicacion' => $d['com'],
                    'compromiso' => $d['comp'],
                    'estabilidad_emocional' => $d['est'],
                    'consistencia' => ($d['aut'] + $d['com'] + $d['comp'] + $d['est']) / 4,
                    'created_at' => $d['fecha']
                ]);
            }
        }
    }
}