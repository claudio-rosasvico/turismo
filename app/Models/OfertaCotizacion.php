<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfertaCotizacion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'ofertas_cotizaciones';
    protected $fillable = ['item_id', 'proveedor_id', 'precio_unitario', 'precio_total', 'ganador'];

    public function item()
    {
        return $this->belongsTo(ItemCotizacion::class, 'item_id');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

}
