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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('nombre');
            $table->string('CUIT');
            $table->string('domicilio');
            $table->string('telefono')->default('sin telefono');
            $table->string('email')->default('sin email');
            $table->boolean('estado')->default(true);
            $table->date('venc_libre_deuda')->nullable();
            $table->string('observaciones')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};
