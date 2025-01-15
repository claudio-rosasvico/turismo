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
                ->get();
        }
    }

    public function showInfoPartida($codigo){
        
        $this->codigoModal = $codigo;
        $infoPartida = InfoPartida::where('codigo', $codigo)->first();
        $this->tituloModal = $infoPartida->titulo;
        $this->infoModal = $infoPartida->descripcion;
        $this->modalShow = true;
    }

    public function render()
    {
        return view('livewire.index-partidas');
    }
}
