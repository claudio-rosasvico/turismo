<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contrato extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'contratos';
    protected $fillable = [
        'nombre',
        'expediente',
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

    public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }
}
