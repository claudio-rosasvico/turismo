<?php

namespace App\Services;

use GuzzleHttp\Client;
use Exception;

class EmbeddingService {
    private $client;
    private $apiUrl = 'https://api-inference.huggingface.co/pipeline/feature-extraction/sentence-transformers/all-MiniLM-L6-v2';

    public function __construct() {
        $this->client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . env('HF_API_KEY'),
                'Content-Type' => 'application/json',
            ]
        ]);
    }

    public function getEmbedding(string $text): array {
        try {
            $response = $this->client->post($this->apiUrl, [
                'json' => ['inputs' => $text]
            ]);
            return json_decode($response->getBody(), true);
        } catch (Exception $e) {
            throw new Exception("Error al generar embedding: " . $e->getMessage());
        }
    }
}