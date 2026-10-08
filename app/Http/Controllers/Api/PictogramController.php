<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class PictogramController extends Controller
{
    public function buscar(Request $request)
    {
        $queryTexto = $request->input('query');

        // 1. Obtener Embedding de Ollama
        $response = Http::post('http://localhost:11434/api/embeddings', [
            'model' => 'nomic-embed-text',
            'prompt' => $queryTexto,
        ]);

        $queryEmbedding = $response->json()['embedding'];

        // 2. Traer pictogramas de la BD (Asegúrate que el nombre de la tabla sea 'pictograms')
        $pictogramas = DB::table('pictogramas')
            ->whereNotNull('Embedding')
            ->get(['Id', 'Title', 'ImagePath', 'Embedding']);

        $resultados = [];

        foreach ($pictogramas as $pic) {
            $dbEmbedding = json_decode($pic->Embedding);
            
            if ($dbEmbedding) {
                $score = $this->cosineSimilarity($queryEmbedding, $dbEmbedding);
                
                $resultados[] = [
                    'id' => $pic->Id,
                    'titulo' => $pic->Title,
                    'ruta' => $pic->ImagePath,
                    'score' => $score
                ];
            }
        }

        // 3. Ordenar por similitud (del más alto al más bajo)
        usort($resultados, fn($a, $b) => $b['score'] <=> $a['score']);

        return response()->json(array_slice($resultados, 0, 10));
    }

    private function cosineSimilarity($vec1, $vec2)
    {
        $dotProduct = 0;
        $normA = 0;
        $normB = 0;

        foreach ($vec1 as $i => $val) {
            $dotProduct += $val * $vec2[$i];
            $normA += $val ** 2;
            $normB += $vec2[$i] ** 2;
        }

        return ($normA == 0 || $normB == 0) ? 0 : $dotProduct / (sqrt($normA) * sqrt($normB));
    }
}