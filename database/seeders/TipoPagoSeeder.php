<?php

namespace Database\Seeders;

use App\Models\TipoPago;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos_pagos = [
            ['nombre' => 'Compra directa', 'descripcion' => 'Según monto Secretario'],
            ['nombre' => 'Compra directa (vía excepción)', 'descripcion' => 'De acuerdo a la excepción'],
            ['nombre' => 'Cotización', 'descripcion' => ''],
            ['nombre' => 'Cotización (Contrato)', 'descripcion' => 'Pago mensual'],
            ['nombre' => 'Licitación', 'descripcion' => ''],
        ];

        foreach ($tipos_pagos as $tipo_pago) {
            TipoPago::create($tipo_pago);
        }
    }
}
