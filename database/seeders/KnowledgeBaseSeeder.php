<?php

namespace Database\Seeders;

use App\Models\KnowledgeBases;
use Illuminate\Database\Seeder;


class KnowledgeBaseSeeder extends Seeder {
    public function run() {
        $csvPath = storage_path('documents/ConsultasChatBot.csv');
        $csvData = array_map('str_getcsv', file($csvPath));
        $headers = array_shift($csvData);

        foreach ($csvData as $row) {
            KnowledgeBases::create([
                'question' => $row[0],
                'answer' => $row[1],
                'category' => $row[2],
                'metadata' => json_decode($row[3], true),
            ]);
        }
    }
}