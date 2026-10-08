<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log; // Importante para tu tesis
use Symfony\Component\Process\Process;

class PictogramaController extends Controller
{
    // --- NUEVA FUNCIÓN (Recomendada) ---
    public function buscarConApi(Request $request) 
    {
        $consulta = $request->input('query');

        // 1. Llamamos a Flask
        $response = Http::post('http://127.0.0.1:5000/buscar', [
            'query' => $consulta
        ]);

        // 2. Si Flask responde bien, devolvemos JSON
        if ($response->successful()) {
            return response()->json([
                'ruta_imagen' => $response->json()['ruta_imagen']
            ]);
        }

        // 3. Si algo falla, devolvemos un JSON de error, NUNCA una vista HTML
        return response()->json(['error' => 'Error en el servidor de IA'], 500);
    }

    // --- ANTIGUA FUNCIÓN (Como respaldo) ---
    public function buscarConScript(Request $request) 
    {
        // Esta función se mantiene como referencia histórica para tu tesis
        return "Método antiguo desactivado.";
    }
}