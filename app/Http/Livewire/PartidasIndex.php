<?php

namespace App\Http\Livewire;

use App\Models\ModificacionPresupuestaria;
use App\Models\Partida;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class PartidasIndex extends Component
{
    public $searchPartida;
    public $partidas;
    public $modalShow = false;
    public $codigoModal;
    public $infoModal;
    public $tituloModal = 'titulo';
    public $modalModificacion = false;
    public $monto_modificacion;
    public $fecha_modificacion;
    public $descripcion_modificacion;

    public function mount()
    {
        $this->partidas = Partida::all();
    }

    public function updatedSearchPartida()
    {
        if ($this->searchPartida == '') {
            $this->partidas = Partida::all();
        } else {
            $this->partidas = Partida::where('DESCRIPCION', 'LIKE', '%' . $this->searchPartida . '%')
                ->orWhere('CODIGO', 'like', '%' . $this->searchPartida . '%')
                ->orWhereHas('infoPartida', function ($query) {
                    $query->where('titulo', 'LIKE', '%' . $this->searchPartida . '%')
                        ->orWhere('descripcion', 'LIKE', '%' . $this->searchPartida . '%');
                })
                ->get();
        }
    }

    public function showInfoPartida($codigo)
    {
        $partida = Partida::where('CODIGO', $codigo)->first();
        $this->tituloModal = $partida->infoPartida->titulo;
        $this->infoModal = $partida->infoPartida->descripcion;
        $this->codigoModal = $partida->infoPartida->codigo;
        $this->modalShow = true;
        
    }
    
    public function showModificacionPartida($modificacion_id)
    {
        $modificacion = ModificacionPresupuestaria::find($modificacion_id);
        $this->monto_modificacion = $modificacion->monto;
        $this->fecha_modificacion = $modificacion->fecha_solicitud;
        $this->descripcion_modificacion = $modificacion->descripcion;
        $this->modalModificacion = true;
        
    }

    public function render()
    {
        return view('livewire.partidas-index');
    }
}
