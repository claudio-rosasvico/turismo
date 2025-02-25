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
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->string('nombre'); 
            $table->string('expediente'); 
            $table->string('numero', 5)->nullable(); 
            $table->float('precio_estimado', 10, 2, true); 
            $table->date('fecha_llamado')->nullable(); 
            $table->time('hora_llamado')->nullable(); 
            $table->integer('proveedor_ganador_id')->nullable(); 
            $table->float('precio_total', 10, 2, true)->nullable(); 
            $table->date('fecha_auorizacion')->nullable(); 
            $table->date('fecha_contaduria_llamado')->nullable(); 
            $table->date('fecha_reso_llamado')->nullable(); 
            $table->date('fecha_contaduria_adjudicacion')->nullable(); 
            $table->date('fecha_reso_adjudicacion')->nullable(); 
            $table->date('fecha_OC')->nullable(); 
            $table->date('fecha_OP')->nullable(); 
            $table->boolean('activo')->default(true); 
            $table->string('descripcion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotizaciones');
    }
};
