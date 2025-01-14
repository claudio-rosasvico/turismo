<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partida extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'partidas';
    protected $fillable = [
        'DA',
        'CODIGO',
        'CA',
        'JU',
        'SJ',
        'ENT',
        'PG',
        'SP',
        'PY',
        'AC',
        'OB',
        'FI',
        'FU',
        'FTE',
        'SFTE',
        'INCISO',
        'PRINCIPAL',
        'PARCIAL',
        'SUBPARC',
        'DPTO',
        'UG',
        'DESCRIPCION',
        'CREDITO_ORIGINAL',
        'VARIACIONES',
        'CREDITO_ACTUAL',
        'RESERVADO',
        'COMPROMISO',
        'DEVENGADO',
        'PAGADO',
        'DISPONIBLE',
        'PASIVO',
    ];

    public function info_partida(){
        return $this->belongsTo(InfoPartida::class, 'CODIGO', 'codigo');
    }
}
