<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoPago extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tipos_pagos';
    protected $fillable = ['nombre', 'descripcion'];

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'tipo_pago_id');
    }
}
