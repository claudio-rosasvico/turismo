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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->string('expediente');
            $table->integer('proveedor_id');
            $table->string('sucursal');
            $table->string('nro_comprobante');
            $table->date('fecha_comprobante');
            $table->decimal('monto', 10, 2);
            $table->date('fecha_imputacion');
            $table->string('partida_codigo');
            $table->integer('tipo_pago_id');
            $table->string('nro_OP')->nullable();
            $table->string('nro_expte_siaf')->nullable();
            $table->string('nro_solicitud')->nullable();
            $table->boolean('pagado')->default(false);
            $table->string('observacion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
