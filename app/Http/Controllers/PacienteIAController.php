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
    private const PICTOGRAMS_CACHE_KEY = 'pictograms_with_embeddings_v1';
    private const PICTOGRAMS_CACHE_TTL_SECONDS = 3600;
    private const TOP_K = 3;
    private const SIMILARITY_THRESHOLD = 0.75;

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

        $pictograms = $this->loadPictogramsWithEmbeddings();
        $actionEmbeddings = $this->generateEmbeddingsBatch($actions);
        $results = [];

        foreach ($actions as $action) {
            $embedding = $actionEmbeddings[$action] ?? [];
            $topPictograms = $this->matchTopPictogramsByEmbedding($embedding, $pictograms);

            $results[] = [
                'accion' => $action,
                'pictogramas' => $topPictograms,
            ];
        }

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
            if (!$this->isValidEmbedding($embedding)) {
                return [];
            }

            return array_map(static fn ($v): float => (float) $v, $embedding);
        } catch (\Throwable $e) {
            Log::warning('Error generando embedding con Ollama', ['text' => $text, 'error' => $e->getMessage()]);
            return [];
        }
    }

    private function generateEmbeddingsBatch(array $texts): array
    {
        $results = [];
        $uniqueTexts = array_values(array_unique(array_filter(array_map('trim', $texts))));

        // Preparado para batch real si Ollama expone endpoint vectorizado.
        foreach ($uniqueTexts as $text) {
            $results[$text] = $this->generateEmbedding($text);
        }

        return $results;
    }

    private function matchTopPictogramsByEmbedding(array $inputEmbedding, array $pictograms): array
    {
        if (!$this->isValidEmbedding($inputEmbedding)) {
            return [];
        }

        $scored = [];
        foreach ($pictograms as $pictogram) {
            $score = $this->cosineSimilarity($inputEmbedding, $pictogram['embedding']);
            if ($score === null || $score < self::SIMILARITY_THRESHOLD) {
                continue;
            }

            $scored[] = [
                'id' => $pictogram['id'],
                'category_id' => $pictogram['category_id'],
                'title' => $pictogram['title'],
                'image_path' => $pictogram['image_path'],
                'search_text' => $pictogram['search_text'],
                'similarity' => $score,
            ];
        }

        usort($scored, static fn (array $a, array $b): int => $b['similarity'] <=> $a['similarity']);

        return array_slice($scored, 0, self::TOP_K);
    }

    private function cosineSimilarity(array $a, array $b): ?float
    {
        $lenA = count($a);
        $lenB = count($b);
        if ($lenA === 0 || $lenB === 0 || $lenA !== $lenB) {
            return null;
        }

        $dot = 0.0;
        $normA = 0.0;
        $normB = 0.0;

        for ($i = 0; $i < $lenA; $i++) {
            $ai = (float) $a[$i];
            $bi = (float) $b[$i];
            $dot += $ai * $bi;
            $normA += $ai * $ai;
            $normB += $bi * $bi;
        }

        if ($normA <= 0.0 || $normB <= 0.0) {
            return null;
        }

        return $dot / (sqrt($normA) * sqrt($normB));
    }

    private function loadPictogramsWithEmbeddings(): array
    {
        return Cache::remember(self::PICTOGRAMS_CACHE_KEY, self::PICTOGRAMS_CACHE_TTL_SECONDS, function (): array {
            $rows = DB::table('Pictograms')
                ->select(['Id', 'CategoryId', 'Title', 'ImagePath', 'SearchText', 'Embedding'])
                ->get();

            $result = [];
            foreach ($rows as $row) {
                $embedding = $this->parseEmbedding($row->Embedding);
                if (empty($embedding)) {
                    continue;
                }

                $result[] = [
                    'id' => (int) $row->Id,
                    'category_id' => $row->CategoryId !== null ? (int) $row->CategoryId : null,
                    'title' => (string) ($row->Title ?? ''),
                    'image_path' => (string) ($row->ImagePath ?? ''),
                    'search_text' => (string) ($row->SearchText ?? ''),
                    'embedding' => $embedding,
                ];
            }

            return $result;
        });
    }

    private function parseEmbedding(mixed $raw): array
    {
        if (is_array($raw)) {
            return $this->isValidEmbedding($raw)
                ? array_map(static fn ($v): float => (float) $v, $raw)
                : [];
        }

        if (!is_string($raw) || trim($raw) === '') {
            return [];
        }

        $decoded = json_decode($raw, true);
        if (!$this->isValidEmbedding($decoded)) {
            return [];
        }

        return array_map(static fn ($v): float => (float) $v, $decoded);
    }

    private function parseActionArray(string $raw): array
    {
        $text = trim($raw);
        if ($text === '') {
            return [];
        }

        // Limpieza simple de fences o bloques.
        $text = preg_replace('/^```(?:json)?\s*|\s*```$/m', '', $text) ?? $text;
        $text = trim($text);

        $decoded = json_decode($text, true);
        if (is_array($decoded)) {
            return $decoded;
        }

        return $this->decodeJsonArrayFromText($text);
    }

    private function decodeJsonArrayFromText(string $text): array
    {
        $text = trim($text);
        if ($text === '') {
            return [];
        }

        $decoded = json_decode($text, true);
        if (is_array($decoded)) {
            return $decoded;
        }

        if (preg_match('/\[[\s\S]*\]/', $text, $matches) !== 1) {
            return [];
        }

        $decoded = json_decode($matches[0], true);
        return is_array($decoded) ? $decoded : [];
    }

    private function isValidEmbedding(mixed $embedding): bool
    {
        if (!is_array($embedding) || empty($embedding)) {
            return false;
        }

        foreach ($embedding as $value) {
            if (!is_numeric($value)) {
                return false;
            }
        }

        return true;
    }

    private function fallbackActions(string $input): array
    {
        $cleaned = mb_strtolower($input);
        $cleaned = preg_replace('/[;:]/', ',', $cleaned);
        $parts = preg_split('/\b(y luego|luego|después|despues|y|e|,|\.)\b/u', $cleaned);

        $actions = [];
        foreach ($parts as $part) {
            $action = trim((string) $part);
            if ($action !== '') {
                $actions[] = $action;
            }
        }

        return array_values(array_slice(array_unique($actions), 0, 8));
    }
}