<?php

namespace App\Console\Commands;

use App\Models\KnowledgeBases;
use App\Services\EmbeddingService;
use Illuminate\Console\Command;

class GenerateEmbeddings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:embeddings';
    

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Genera embeddings para preguntas existentes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $embeddingService = new EmbeddingService();
        $questions = KnowledgeBases::whereNull('embedding')->get();

        foreach ($questions as $q) {
            $q->embedding = json_encode($embeddingService->getEmbedding($q->question));
            $q->save();
        }
        $this->info('Embeddings generados para ' . $questions->count() . ' preguntas.');
    }
}
