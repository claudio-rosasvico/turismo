<?php

namespace App\Http\Livewire;

use App\Models\Partida;
use Livewire\Component;

class IndexPartidas extends Component
{
    public $searchPartida;
    public $partidas;

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

    public function render()
    {
        return view('livewire.index-partidas');
    }
}
