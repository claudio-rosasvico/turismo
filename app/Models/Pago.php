<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pago extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pagos';
    protected $fillable = [
        'expediente',
        'proveedor_id',
        'sucursal',
        'nro_comprobante',
        'fecha_comprobante',
        'monto',
        'fecha_imputacion',
        'partida_codigo',
        'tipo_pago_id',
        'nro_OP',
        'nro_expte_siaf',
        'nro_solicitud',
        'pagado',
        'observacion'
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function tipo_pago()
    {
        return $this->belongsTo(TipoPago::class);
    }
}
