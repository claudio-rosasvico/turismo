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
        Schema::create('knowledge_bases', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes(); // Para eliminar registros sin borrarlos físicamente

            $table->string('question');  // Ej: "¿Cómo registrar un pago?"
            $table->text('answer');      // Respuesta detallada
            $table->string('category')->default('contable'); // partidas, pagos, etc.
            $table->json('metadata')->nullable(); // Tags, ej: ["pagos", "proveedores"]
            $table->json('embedding')->nullable();
            $table->string('created_by')->nullable(); // Usuario que creó la entrada
            $table->string('updated_by')->nullable(); // Usuario que actualizó la entrada
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('knowledge_bases');
    }
};
