<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'proveedores';
    protected $fillable = [
        'nombre',
        'CUIT',
        'domicilio',
        'telefono',
        'email',
        'estado',
        'venc_libre_deuda',
        'observaciones'
    ];

    public function ofertas()
    {
        return $this->hasMany(OfertaCotizacion::class, 'proveedor_id');
    }
    
    public function cotizaciones()
    {
        return $this->hasMany(Cotizacion::class, 'proveedor_id');
    }
    
    public function pagos()
    {
        return $this->hasMany(Pago::class, 'proveedor_id');
    }

    public function contratos()
    {
        return $this->hasMany(Contrato::class, 'proveedor_id');
    }
}
