<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('unanswered_questions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('question'); // Pregunta original del usuario
            $table->json('metadata')->nullable(); // Contexto: usuario, fecha, etc.
            $table->boolean('reviewed')->default(false); // ¿Ya se revisó?
            $table->integer('user_id')->nullable(); // Opcional: quien hizo la pregunta
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unanswered_questions');
    }
};
