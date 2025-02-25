<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor_cotizacion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'proveedores_cotizacion';
    protected $fillable = ['proveedor_id', 'cotizacion_id'];

    public function proveedor(){
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    public function cotizacion(){
        return $this->belongsTo(Cotizacion::class, 'cotizacion_id');
    }
}
