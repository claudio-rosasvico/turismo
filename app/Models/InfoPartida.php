<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InfoPartida extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'info_partidas';
    protected $fillable = ['codigo', 'titulo', 'descripcion'];

    public function partida(){
        return $this->hasMany(Partida::class, 'CODIGO', 'codigo');
    }
}
