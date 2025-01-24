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
        Schema::create('modificacion_presupuestarias', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('partida');
            $table->string('pg');
            $table->string('ac');
            $table->decimal('monto');
            $table->boolean('accion');
            $table->date('fecha_solicitud');
            $table->date('fecha_ejecutada')->nullable();
            $table->string('descripcion', 300)->nullable();
            $table->boolean('activo')->default(1);
            $table->integer('partida_id')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modificacion_presupuestarias');
    }
};
