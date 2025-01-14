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
        Schema::create('partidas', function (Blueprint $table) {
            $table->id();
            $table->string('DA', 10);
            $table->string('CODIGO', 10);
            $table->string('CA', 10);
            $table->string('JU', 10);
            $table->string('SJ', 10);
            $table->string('ENT', 10);
            $table->string('PG', 10);
            $table->string('SP', 10);
            $table->string('PY', 10);
            $table->string('AC', 10);
            $table->string('OB', 10);
            $table->string('FI', 10);
            $table->string('FU', 10);
            $table->string('FTE', 10);
            $table->string('SFTE', 10);
            $table->string('INCISO', 10);
            $table->string('PRINCIPAL', 10);
            $table->string('PARCIAL', 10);
            $table->string('SUBPARC', 10);
            $table->string('DPTO', 10);
            $table->string('UG', 10);
            $table->string('DESCRIPCION', 200);
            $table->decimal('CREDITO_ORIGINAL', 12, 2); // Ajusta la precisión y escala según tus necesidades
            $table->decimal('VARIACIONES', 12, 2);
            $table->decimal('CREDITO_ACTUAL', 12, 2);
            $table->decimal('RESERVADO', 12, 2);
            $table->decimal('COMPROMISO', 12, 2);
            $table->decimal('DEVENGADO', 12, 2);
            $table->decimal('PAGADO', 12, 2);
            $table->decimal('DISPONIBLE', 12, 2);
            $table->decimal('PASIVO', 12, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partidas');
    }
};
