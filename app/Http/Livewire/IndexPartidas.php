<?php

namespace App\Http\Livewire;

use App\Models\InfoPartida;
use App\Models\Partida;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class IndexPartidas extends Component
{
    public $searchPartida;
    public $partidas;
    public $modalShow = false;
    public $codigoModal;
    public $infoModal;
    public $tituloModal = 'titulo';

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

    public function render()
    {
        return view('livewire.index-partidas');
    }
}
