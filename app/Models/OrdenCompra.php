<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrdenCompra extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'ordenes_compras';
    protected $fillable = [
        'numero',
        'expediente_siaf',
        'precio_total',
        'cotizacion_id',
        'compensacion_id',
        'proveedor_id'
    ];

    public function cotizacion(){
        return $this->belongsTo(Cotizacion::class, 'cotizacion_id');
    }

    public function proveedor(){
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

}
