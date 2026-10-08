<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PacienteIAController extends Controller
{
    private const OLLAMA_BASE_URL = 'http://localhost:11434';
    private const ACTION_MODEL = 'llama3';
    private const EMBEDDING_MODEL = 'nomic-embed-text';
    private const OLLAMA_TIMEOUT_SECONDS = 30;
    private const PICTOGRAMAS_CACHE_KEY = 'pictogramas_with_embeddings_v1';
    private const PICTOGRAMAS_CACHE_TTL_SECONDS = 3600;
    private const TOP_K = 3;
    private const SIMILARITY_THRESHOLD = 0.45;

    public function analizarDiario(Request $request, $id): JsonResponse
    {
        $paciente = Paciente::findOrFail($id);
        $inputActivity = trim((string) $request->input('actividad_diaria', ''));

        if ($inputActivity === '') {
            return response()->json([
                'paciente_id' => $paciente->id,
                'resultados' => [],
                'error' => 'actividad_diaria es requerida',
            ], 422);
        }

        // 1. Extracción de acciones mediante LLM (Ollama)
        $actions = $this->extractActions($inputActivity);
        
        if (empty($actions)) {
            $actions = $this->fallbackActions($inputActivity);
        }

        if (empty($actions)) {
            return response()->json([
                'paciente_id' => $paciente->id,
                'actividad_diaria' => $inputActivity,
                'resultados' => [],
            ]);
        }

        // 2. Carga de pictogramas y generación de embeddings para las acciones extraídas
        $pictogramas = $this->loadpictogramasWithEmbeddings();
        $actionEmbeddings = $this->generateEmbeddingsBatch($actions);
        $results = [];

        foreach ($actions as $action) {
            $embedding = $actionEmbeddings[$action] ?? [];
            $toppictogramas = $this->matchToppictogramasByEmbedding($embedding, $pictogramas);

            $results[] = [
                'accion' => $action,
                'pictogramas' => $toppictogramas,
            ];
        }

        // 3. Persistencia de resultados en el paciente
        $paciente->update([
            'sugerencias_pictogramas' => json_encode($results, JSON_UNESCAPED_UNICODE),
        ]);

        return response()->json([
            'paciente_id' => $paciente->id,
            'actividad_diaria' => $inputActivity,
            'resultados' => $results,
        ]);
    }

    private function extractActions(string $input): array
    {
        $prompt = implode("\n", [
            'Eres un extractor de acciones para agenda terapéutica.',
            'Tu tarea es convertir texto libre en una lista corta de acciones útiles.',
            '',
            'Reglas obligatorias:',
            '1) Responde SIEMPRE con JSON array válido, sin markdown ni texto adicional.',
            '2) Cada elemento debe ser una acción breve en español (verbo base o infinitivo).',
            '3) Incluye acciones explícitas e implícitas relevantes para la rutina.',
            '4) Elimina ruido, opiniones, conectores y detalles no accionables.',
            '5) Máximo 8 acciones, sin duplicados, en minúsculas.',
            '',
            'Ejemplo válido:',
            '["levantarse","prepararse","ir a clase","almorzar"]',
            '',
            'Texto de entrada:',
            $input,
            '',
            'Devuelve solo el JSON array.',
        ]);

        try {
            $response = Http::timeout(self::OLLAMA_TIMEOUT_SECONDS)->post(self::OLLAMA_BASE_URL . '/api/generate', [
                'model' => self::ACTION_MODEL,
                'prompt' => $prompt,
                'stream' => false,
                'options' => [
                    'temperature' => 0,
                ],
            ]);

            if (!$response->successful()) {
                Log::warning('Ollama action extraction failed', ['status' => $response->status()]);
                return [];
            }

            $raw = (string) ($response->json()['response'] ?? '');
            $decoded = $this->parseActionArray($raw);

            if (empty($decoded)) {
                return [];
            }

            $normalized = [];
            foreach ($decoded as $item) {
                $value = trim((string) $item);
                if ($value !== '') {
                    $normalized[] = mb_strtolower($value);
                }
            }

            return array_values(array_slice(array_unique($normalized), 0, 8));
        } catch (\Throwable $e) {
            Log::warning('Error extrayendo acciones con Ollama', ['error' => $e->getMessage()]);
            return [];
        }
    }

    private function generateEmbedding(string $text): array
    {
        try {
            $response = Http::timeout(self::OLLAMA_TIMEOUT_SECONDS)->post(self::OLLAMA_BASE_URL . '/api/embeddings', [
                'model' => self::EMBEDDING_MODEL,
                'prompt' => $text,
            ]);

            if (!$response->successful()) {
                Log::warning('Ollama embedding failed', ['status' => $response->status(), 'text' => $text]);
                return [];
            }

            $embedding = $response->json()['embedding'] ?? [];
            return $this->isValidEmbedding($embedding) ? array_map(fn($v) => (float)$v, $embedding) : [];
        } catch (\Throwable $e) {
            Log::error('Error generating embedding', ['text' => $text, 'error' => $e->getMessage()]);
            return [];
        }
    }

    private function generateEmbeddingsBatch(array $texts): array
    {
        $results = [];
        $uniqueTexts = array_values(array_unique(array_filter(array_map('trim', $texts))));

        foreach ($uniqueTexts as $text) {
            $results[$text] = $this->generateEmbedding($text);
        }

        return $results;
    }

    private function matchToppictogramasByEmbedding(array $inputEmbedding, array $pictogramas): array
    {
        if (!$this->isValidEmbedding($inputEmbedding)) {
            return [];
        }

        $scored = [];
        foreach ($pictogramas as $pictogram) {
            $score = $this->cosineSimilarity($inputEmbedding, $pictogram['embedding']);
            
            if ($score !== null && $score >= self::SIMILARITY_THRESHOLD) {
                $scored[] = array_merge($pictogram, [
                    'similarity' => $score,
                    'url' => asset('storage/app/public/' . $pictogram['image_path']) // Generación de URL pública
                ]);
            }
        }

        usort($scored, static fn ($a, $b) => $b['similarity'] <=> $a['similarity']);

        return array_slice($scored, 0, self::TOP_K);
    }

    private function cosineSimilarity(array $a, array $b): ?float
    {
        $len = count($a);
        if ($len === 0 || $len !== count($b)) return null;

        $dot = 0.0; $normA = 0.0; $normB = 0.0;

        for ($i = 0; $i < $len; $i++) {
            $dot += $a[$i] * $b[$i];
            $normA += $a[$i] ** 2;
            $normB += $b[$i] ** 2;
        }

        return ($normA > 0 && $normB > 0) ? ($dot / (sqrt($normA) * sqrt($normB))) : null;
    }

    private function loadpictogramasWithEmbeddings(): array
    {
        return Cache::remember(self::PICTOGRAMAS_CACHE_KEY, self::PICTOGRAMAS_CACHE_TTL_SECONDS, function () {
            $rows = DB::table('pictogramas')
                ->select(['Id', 'CategoryId', 'Title', 'ImagePath', 'SearchText', 'Embedding'])
                ->get();

            $result = [];
            foreach ($rows as $row) {
                $embedding = $this->parseEmbedding($row->Embedding);
                if (empty($embedding)) continue;

                $result[] = [
                    'id' => (int) $row->Id,
                    'category_id' => $row->CategoryId ? (int) $row->CategoryId : null,
                    'title' => (string) $row->Title,
                    'image_path' => (string) $row->ImagePath,
                    'search_text' => (string) $row->SearchText,
                    'embedding' => $embedding,
                ];
            }
            return $result;
        });
    }

    private function parseEmbedding(mixed $raw): array
    {
        if (is_array($raw)) return $raw;
        $decoded = json_decode($raw, true);
        return is_array($decoded) ? $decoded : [];
    }

    private function parseActionArray(string $raw): array
    {
        $text = trim($raw);
        $text = preg_replace('/^```(?:json)?\s*|\s*```$/m', '', $text);
        $decoded = json_decode($text, true);

        return is_array($decoded) ? $decoded : $this->decodeJsonArrayFromText($text);
    }

    private function decodeJsonArrayFromText(string $text): array
    {
        if (preg_match('/\[[\s\S]*\]/', $text, $matches)) {
            $decoded = json_decode($matches[0], true);
            return is_array($decoded) ? $decoded : [];
        }
        return [];
    }

    private function isValidEmbedding(mixed $embedding): bool
    {
        return is_array($embedding) && !empty($embedding) && is_numeric($embedding[0]);
    }

    private function fallbackActions(string $input): array
    {
        $cleaned = mb_strtolower($input);
        $parts = preg_split('/\b(y luego|luego|después|despues|y|e|,|\.)\b/u', $cleaned);

        return array_values(array_slice(array_unique(array_filter(array_map('trim', $parts))), 0, 8));
    }



    public function analizarAgendaSemanal(Request $request, $id): \Illuminate\Http\JsonResponse
{
    // Buscar al paciente
    $paciente = Paciente::findOrFail($id);

    // Listado de días que vienen desde la interfaz de la agenda semanal
    $dias = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'];
    $resultadosAgenda = [];

    // Cargar tus pictogramas indexados (con tu lógica de caché existente)
    $pictogramas = $this->loadpictogramasWithEmbeddings();

    foreach ($dias as $dia) {
        // Sanitizar el input de cada textarea de la vista
        $inputActivity = trim((string) $request->input($dia, ''));

        if ($inputActivity === '') {
            $resultadosAgenda[$dia] = [];
            continue;
        }

        // 1. Extracción de acciones usando tu LLM (Llama3)
        $actions = $this->extractActions($inputActivity);
        
        if (empty($actions)) {
            $actions = $this->fallbackActions($inputActivity);
        }

        if (empty($actions)) {
            $resultadosAgenda[$dia] = [];
            continue;
        }

        // 2. Generar embeddings para las acciones de este día
        $actionEmbeddings = $this->generateEmbeddingsBatch($actions);
        $pictogramasDelDia = [];

        foreach ($actions as $action) {
            $embedding = $actionEmbeddings[$action] ?? [];
            // Comparar distancias vectoriales con tu similitud coseno
            $toppictogramas = $this->matchToppictogramasByEmbedding($embedding, $pictogramas);

            if (!empty($toppictogramas)) {
                $pictogramasDelDia = array_merge($pictogramasDelDia, $toppictogramas);
            }
        }

        // Limpiar duplicados por ID por si varias acciones sugieren el mismo pictograma
        $pictogramasDelDia = array_values(array_reduce($pictogramasDelDia, function ($carry, $item) {
            $carry[$item['id']] = $item;
            return $carry;
        }, []));

        // Guardar las sugerencias limitadas al TOP_K configurado
        $resultadosAgenda[$dia] = array_slice($pictogramasDelDia, 0, self::TOP_K);
    }

    // 3. Persistencia de resultados serializados en tu base de datos
    $paciente->update([
        'sugerencias_pictogramas' => json_encode($resultadosAgenda, JSON_UNESCAPED_UNICODE),
    ]);

    return response()->json([
        'paciente_id' => $paciente->id,
        'resultados' => $resultadosAgenda,
    ]);
}

}