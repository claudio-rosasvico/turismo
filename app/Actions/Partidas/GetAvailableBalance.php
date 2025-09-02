<?php

namespace App\Actions\Partidas;

use App\Models\Partida;

class GetAvailableBalance
{
    /**
     * Devuelve el saldo disponible de una partida según su código.
     */
    public function handle(string $codigo): array
    {
        $partida = Partida::where('CODIGO', $codigo)->first();

        if (!$partida) {
            return [
                'success' => false,
                'message' => "No se encontró la partida con código {$codigo}."
            ];
        }

        return [
            'success' => true,
            'codigo' => $partida->CODIGO,
            'descripcion' => $partida->DESCRIPCION,
            'disponible' => $partida->DISPONIBLE
        ];
    }
}
