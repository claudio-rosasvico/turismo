<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModificacionPresupuestaria extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'modificacion_presupuestarias';
    protected $fillable = ['partida', 'pg', 'ac', 'monto', 'accion', 'activo', 'fecha_solicitud', 'fecha_ejecutada', 'descripcion'];
}
