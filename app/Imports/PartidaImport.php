<?php

namespace App\Imports;

use App\Models\Partida;
use Maatwebsite\Excel\Concerns\ToModel;

class PartidaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row[14] == '_2' || $row[14] == '_3' || $row[14] == '_4' || $row[14] == '_5') {
            return new Partida([

                'DA' => (intval(str_replace('_', '', $row[0]))),
                'CODIGO' => (intval(str_replace('_', '', $row[14])) . '.' . intval(str_replace('_', '', $row[15])) . '.' . intval(str_replace('_', '', $row[16]))),
                'CA' => (intval(str_replace('_', '', $row[1]))),
                'JU' => (intval(str_replace('_', '', $row[2]))),
                'SJ' => (intval(str_replace('_', '', $row[3]))),
                'ENT' => (intval(str_replace('_', '', $row[4]))),
                'PG' => (intval(str_replace('_', '', $row[5]))),
                'SP' => (intval(str_replace('_', '', $row[6]))),
                'PY' => (intval(str_replace('_', '', $row[7]))),
                'AC' => (intval(str_replace('_', '', $row[8]))),
                'OB' => (intval(str_replace('_', '', $row[9]))),
                'FI' => (intval(str_replace('_', '', $row[10]))),
                'FU' => (intval(str_replace('_', '', $row[11]))),
                'FTE' => (intval(str_replace('_', '', $row[12]))),
                'SFTE' => (intval(str_replace('_', '', $row[13]))),
                'INCISO' => (intval(str_replace('_', '', $row[14]))),
                'PRINCIPAL' => (intval(str_replace('_', '', $row[15]))),
                'PARCIAL' => (intval(str_replace('_', '', $row[16]))),
                'SUBPARC' => (intval(str_replace('_', '', $row[17]))),
                'DPTO' => (intval(str_replace('_', '', $row[18]))),
                'UG' => (intval(str_replace('_', '', $row[19]))),
                'DESCRIPCION' => $row[20],
                'CREDITO_ORIGINAL' => $row[21],
                'VARIACIONES' => $row[22],
                'CREDITO_ACTUAL' => $row[23],
                'RESERVADO' => $row[24],
                'COMPROMISO' => $row[25],
                'DEVENGADO' => $row[26],
                'PAGADO' => $row[27],
                'DISPONIBLE' => $row[28],
                'PASIVO' => $row[29],

            ]);
        }
    }
}
