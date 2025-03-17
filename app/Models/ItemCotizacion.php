<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemCotizacion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'items_cotizaciones';
    protected $fillable = ['cotizacion_id', 'descripcion', 'cantidad', 'unidad'];

    public function cotizacion(){
        return $this->belongsTo(Cotizacion::class, 'cotizacion_id');
    }
}
