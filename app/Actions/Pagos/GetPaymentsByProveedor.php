<?php

namespace App\Actions\Pagos;

use App\Models\Proveedor;

class GetPaymentsByProveedor
{
    /**
     * Devuelve los pagos realizados a un proveedor (por nombre o CUIT).
     */
    public function handle(string $proveedor): array
    {
        $proveedorModel = Proveedor::where('nombre', 'LIKE', '%' . $proveedor . '%')
            ->orWhere('CUIT', $proveedor)
            ->first();

        if (!$proveedorModel) {
            return [
                'success' => false,
                'message' => "No se encontró el proveedor {$proveedor}."
            ];
        }

        $pagos = $proveedorModel->pagos()->get()->map(function ($pago) {
            return [
                'fecha' => $pago->fecha_comprobante,
                'monto' => $pago->monto,
                'partida_codigo' => $pago->partida_codigo,
                'estado' => $pago->pagado ? 'Pagado' : 'Pendiente',
                'observacion' => $pago->observacion,
            ];
        });

        return [
            'success' => true,
            'proveedor' => $proveedorModel->nombre,
            'CUIT' => $proveedorModel->CUIT,
            'pagos' => $pagos
        ];
    }
}
