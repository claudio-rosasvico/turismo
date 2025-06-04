<?php

namespace App\Imports;

use App\Models\KnowledgeBases;
use Exception;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KnowledgeBasesImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Validar campos mínimos
        if (empty($row['question']) || empty($row['answer'])) {
            throw new Exception("Fila inválida: pregunta o respuesta vacía");
        }

        // Procesar metadata (convertir a JSON string)
        $metadata = $this->parseMetadata($row['metadata'] ?? '{}');

        return new KnowledgeBases([
            'question' => $row['question'],
            'answer'   => $row['answer'],
            'category' => $row['category'] ?? 'general',
            'metadata' => json_encode($metadata), 
        ]);
    }

    protected function parseMetadata($input): array
    {
        if (is_string($input)) {
            $decoded = json_decode($input, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("Metadata inválida: " . json_last_error_msg());
            }
            return $decoded;
        }

        return is_array($input) ? $input : [];
    }
}
