<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\EmbeddingService;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\KnowledgeBasesImport;
use App\Models\KnowledgeBases;

class ImportKnowledgeBase extends Command
{
    protected $signature = 'import:knowledge-base
    {--generate-embeddings : Generar embeddings después de importar}';
    protected $description = 'Importa preguntas y respuestas desde un Excel a la base de conocimiento';

    public function handle()
    {
        $xlsxFile = public_path('documentation\ConsultasChatBot.xlsx');
        $file = $xlsxFile;
        $generateEmbeddings = $this->option('generate-embeddings');

        // 1. Importar el Excel
        $this->info("Importando datos desde: " . $file);
        Excel::import(new KnowledgeBasesImport, $file);
        $this->info("¡Datos importados exitosamente!");

        // 2. Generar embeddings (opcional)
        if ($generateEmbeddings) {
            $this->info("Generando embeddings...");
            $embeddingService = new EmbeddingService();
            $questions = KnowledgeBases::whereNull('embedding')->get();

            $bar = $this->output->createProgressBar($questions->count());
            foreach ($questions as $q) {
                try {
                    $q->embedding = json_encode($embeddingService->getEmbedding($q->question));
                    $q->save();
                } catch (\Exception $e) {
                    $this->error("Error en pregunta ID {$q->id}: " . $e->getMessage());
                }
                $bar->advance();
            }
            $bar->finish();
            $this->info("\n¡Embeddings generados para {$questions->count()} preguntas!");
        }
    }
}
