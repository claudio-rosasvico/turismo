<?php

namespace App\Services;

use App\Models\KnowledgeBase;
use App\Models\KnowledgeBases;
use App\Models\UnansweredQuestion;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotService
{
    /**
     * Procesa una pregunta del usuario y devuelve una respuesta.
     *
     * @param string $userQuestion
     * @param int|null $userId
     * @return string
     */
    public function handleQuestion(string $userQuestion, $userId = null): string {
        Log::info("Buscando respuesta para: '$userQuestion'");
    
        // 1. Búsqueda en embeddings
        $localAnswer = $this->searchInKnowledgeBase($userQuestion);
        if ($localAnswer) {
            Log::info("Respuesta local encontrada: " . substr($localAnswer, 0, 50) . "...");
            return $localAnswer;
        }
    
        // 2. Fallback a DeepSeek
        try {
            $deepSeekAnswer = $this->askDeepSeek($userQuestion);
            Log::info("Respuesta DeepSeek: " . $deepSeekAnswer);
            return $deepSeekAnswer;
        } catch (\Exception $e) {
            Log::error("Error en DeepSeek: " . $e->getMessage());
            return "Lo siento, no pude obtener una respuesta en este momento.";
        }
    }

    /**
     * Busca en la base de conocimiento local (knowledge_bases).
     *
     * @param string $question
     * @return string|null
     */
    protected function searchInKnowledgeBase(string $question): ?string
    {
        $embeddingService = new EmbeddingService();
        $queryEmbedding = $embeddingService->getEmbedding($question);

        $bestMatch = KnowledgeBases::all()
            ->map(function ($kb) use ($queryEmbedding) {
                return [
                    'answer' => $kb->answer,
                    'similarity' => $this->cosineSimilarity($queryEmbedding, json_decode($kb->embedding, true))
                ];
            })
            ->sortByDesc('similarity')
            ->first();

        return ($bestMatch['similarity'] > 0.75) ? $bestMatch['answer'] : null;
    }

    private function cosineSimilarity(array $vecA, array $vecB): float
    {
        $dotProduct = array_sum(array_map(fn($a, $b) => $a * $b, $vecA, $vecB));
        $normA = sqrt(array_sum(array_map(fn($a) => $a ** 2, $vecA)));
        $normB = sqrt(array_sum(array_map(fn($b) => $b ** 2, $vecB)));
        return $dotProduct / ($normA * $normB);
    }

    /**
     * Registra preguntas no contestadas en la DB.
     *
     * @param string $question
     * @param int|null $userId
     * @return void
     */
    protected function logUnansweredQuestion(string $question, ?int $userId = null): void
    {
        try {
            UnansweredQuestion::create([
                'question' => $question,
                'user_id' => $userId,
                'metadata' => json_encode([
                    'date' => now()->toDateTimeString(),
                    'suggested_category' => $this->predictCategory($question),
                    'occurrences' => $this->countSimilarQuestions($question),
                ]),
            ]);
        } catch (\Exception $e) {
            Log::error("Error registrando pregunta no contestada: " . $e->getMessage());
        }
    }

    /**
     * Predice categoría para preguntas no contestadas.
     *
     * @param string $question
     * @return string
     */
    protected function predictCategory(string $question): string
    {
        $keywords = [
            'pago' => 'pagos',
            'factura' => 'pagos',
            'partida' => 'partidas',
            'contrato' => 'contratos',
            'proveedor' => 'proveedores',
        ];

        foreach ($keywords as $keyword => $category) {
            if (str_contains(strtolower($question), $keyword)) {
                return $category;
            }
        }

        return 'general';
    }

    /**
     * Cuenta preguntas similares no contestadas.
     *
     * @param string $newQuestion
     * @return int
     */
    protected function countSimilarQuestions(string $newQuestion): int
    {
        return UnansweredQuestion::where('question', 'like', "%{$newQuestion}%")
            ->count();
    }

    /**
     * Consulta a DeepSeek para respuestas genéricas.
     *
     * @param string $question
     * @return string
     */
    protected function askDeepSeek(string $question): string
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.deepseek.api_key'),
                'Content-Type' => 'application/json',
            ])->post('https://api.deepseek.com/v1/chat', [
                'model' => 'deepseek-chat',
                'messages' => [
                    ['role' => 'user', 'content' => $question],
                ],
            ]);

            return $response->json('choices.0.message.content')
                ?? 'Lo siento, no pude obtener una respuesta en este momento.';
        } catch (\Exception $e) {
            Log::error("Error llamando a DeepSeek: " . $e->getMessage());
            return 'Error al conectar con el servicio de IA. Por favor, intente más tarde.';
        }
    }
}
