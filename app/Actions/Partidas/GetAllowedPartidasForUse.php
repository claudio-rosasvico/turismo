<?php

namespace App\Actions\Partidas;

use App\Models\InfoPartida;

class GetAllowedPartidasForUse
{
    /**
     * Devuelve partidas que pueden usarse para un fin específico
     * buscando en la descripción de InfoPartida.
     */
    public function handle(string $uso): array
    {
        $infoPartidas = InfoPartida::where('descripcion', 'LIKE', '%' . $uso . '%')->get();

        if ($infoPartidas->isEmpty()) {
            return [
                'success' => false,
                'message' => "No se encontraron partidas que permitan el uso: {$uso}."
            ];
        }

        $result = $infoPartidas->map(function ($info) {
            return [
                'codigo' => $info->codigo,
                'titulo' => $info->titulo,
                'descripcion' => $info->descripcion
            ];
        });

        return [
            'success' => true,
            'uso' => $uso,
            'partidas' => $result
        ];
    }
}
