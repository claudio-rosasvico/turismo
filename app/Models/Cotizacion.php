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
    protected $fillable = [
        'nombre',
        'expediente',
        'numero',
        'precio_estimado',
        'fecha_reso_llamado',
        'fecha_llamado',
        'hora_llamado',
        'fecha_autorizacion',
        'fecha_reso_adjudicacion',
        'nro_reso_adjudicacion',
        'activo',
        'descripcion',
        'descripcion_anexo'
    ];

    public function items()
    {
        return $this->hasMany(ItemCotizacion::class, 'cotizacion_id');
    }

    public function proveedores()
{
    return $this->hasManyThrough(
        Proveedor::class,           // Modelo final que quieres obtener
        Proveedor_cotizacion::class, // Modelo intermedio
        'cotizacion_id',            // FK en la tabla intermedia
        'id',                       // FK en la tabla final
        'id',                       // Clave local en Cotizacion
        'proveedor_id'              // Clave en intermedia que apunta a final
    );
}
    
    public function OrdenesCompra()
    {
        return $this->hasMany(OrdenCompra::class, 'cotizacion_id');
    }

    public function proveedorGanador()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_ganador_id');
    }

    public function contrato()
    {
        return $this->hasOne(Contrato::class);
    }
}
