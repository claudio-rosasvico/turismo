<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cotizacion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'cotizaciones';
    protected $fillable = ['nombre', 'expediente', 'numero', 'precio_estimado', 'fecha_llamado', 'hora_llamado', 'proveedor_ganador_id', 'precio_total', 'fecha_auorizacion', 'fecha_contaduria_llamado', 'fecha_reso_llamado', 'fecha_contaduria_adjudicacion', 'fecha_reso_adjudicacion', 'fecha_OC', 'fecha_OP', 'activo', 'descripcion'];

    public function items(){
        return $this->hasMany(ItemCotizacion::class, 'cotizacion_id');
    }

    public function proveedores(){
        return $this->hasMany(Proveedor_cotizacion::class, 'cotizacion_id');
    }

    public function proveedorGanador(){
        return $this->belongsTo(Proveedor::class, 'proveedor_ganador_id');
    }
}
