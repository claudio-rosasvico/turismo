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
    ];

    public function cotizacion(){
        return $this->hasOne(Cotizacion::class, 'cotizacion_id');
    }

}
