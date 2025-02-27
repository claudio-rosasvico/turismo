<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reserva extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'reservas';
    protected $fillable = [
        'expediente',
        'nro_expte_siaf',
        
        'proveedor_id',
        'fecha_inicio',
        'fecha_fin',
        'monto_total',
        'monto_mensual',
        'nro_resolucion',
        'cotizacion_id',
        'activo',
        'observacion',
    ];
}
