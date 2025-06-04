<?php

namespace App\Http\Livewire;

use App\Models\ModificacionPresupuestaria;
use App\Models\Partida;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class PartidasIndex extends Component
{
    use WithPagination;

    public $searchPartida = '';
   /*  public $partidas; */
    public $modalShow = false;
    public $codigoModal;
    public $infoModal;
    public $tituloModal = 'titulo';
    public $modalModificacion = false;
    public $monto_modificacion;
    public $fecha_modificacion;
    public $descripcion_modificacion;
    public $sortField = 'CODIGO';
    public $sortDirection = 'asc';

    public function mount()
    {
        
    }

    public function updatedSearchPartida()
    {
        $this->resetPage();
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

    public function sortBy($field)
    {

        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'desc';
        }
        $this->resetPage();

    }

    public function render()
    {
        $query = Partida::query();

        if (!empty($this->searchPartida)) {
            $query->where('DESCRIPCION', 'LIKE', '%' . $this->searchPartida . '%')
                ->orWhere('CODIGO', 'like', '%' . $this->searchPartida . '%')
                ->orWhereHas('infoPartida', function ($q) { 
                    $q->where('titulo', 'LIKE', '%' . $this->searchPartida . '%')
                        ->orWhere('descripcion', 'LIKE', '%' . $this->searchPartida . '%');
                });
        }
        if (in_array($this->sortField, ['CODIGO', 'CREDITO_ACTUAL', 'RESERVADO', 'DISPONIBLE'])) {
            $query->orderBy($this->sortField, $this->sortDirection);
        } else {
            $query->orderBy('CODIGO', 'asc');
        }
        
        return view('livewire.partidas-index', [
            'partidas' => $query->paginate(15) 
        ]);
    }
}
