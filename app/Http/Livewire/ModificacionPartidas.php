<?php

namespace App\Http\Livewire;

use App\Models\ModificacionPresupuestaria;
use App\Models\Partida;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ModificacionPartidas extends Component
{
    public $searchModificacion;
    public $modificaciones;
    public $modalShow = false;
    public $partidaModal;
    public $pg = '01';
    public $ac = '01';
    public $monto;
    public $disponibleModal;
    public $accion;
    public $descripcion;
    public $fecha_solicitud;
    public $modalShowInfo = false;
    public $modalInfoDescripcion;

    public function mount()
    {
        $this->modificaciones = ModificacionPresupuestaria::all();
    }

    public function updatedSearchModificacion()
    {
        if ($this->searchModificacion == '') {
            $this->modificaciones = ModificacionPresupuestaria::all();
        } else {
            $this->modificaciones = ModificacionPresupuestaria::where('partida', 'LIKE', '%' . $this->searchModificacion . '%')
                ->get();
        }
        
    }

    public function disponiblePartida()
    {
        if (empty($this->partidaModal) || empty($this->pg) || empty($this->ac)) {
            $this->disponibleModal = 'Faltan Datos';
        } else {
            $partida = Partida::where('CODIGO', $this->partidaModal)
                ->where('PG', $this->pg)
                ->where('AC', $this->ac)
                ->first();
            if ($partida) {
                $this->disponibleModal = $partida->DISPONIBLE;
            } else {
                $this->disponibleModal = 'No existe partida';
            }
        }
    }

    public function modificacionCreate()
    {

        $this->validate([
            'partidaModal' => 'required|string|max:255',
            'pg' => 'required|string|max:2',
            'ac' => 'required|string|max:2',
            'accion' => 'required|in:0,1',
            'descripcion' => '',
            'fecha_solicitud' => 'required|date',
        ]);

        $partida = Partida::where('CODIGO', $this->partidaModal)
            ->where('PG', $this->pg)
            ->where('AC', $this->ac)
            ->first();

        $ModificacionPresupuestaria = ModificacionPresupuestaria::create([
            'partida' => $this->partidaModal,
            'pg' => $this->pg,
            'ac' => $this->ac,
            'monto' => $this->monto,
            'accion' => $this->accion,
            'descripcion' => $this->descripcion,
            'fecha_solicitud' => $this->fecha_solicitud,
            'partida_id' => $partida->id,
        ]);

        $this->reset(['partidaModal', 'pg', 'ac', 'accion', 'descripcion', 'fecha_solicitud']);
        $this->modificaciones = ModificacionPresupuestaria::all();
        $this->modalShow = false;
        
    }

    public function showInfo($modificacion_id)
    {
        $modificacion = ModificacionPresupuestaria::find($modificacion_id);
        $this->modalInfoDescripcion = $modificacion->descripcion;
        $this->modalShowInfo = true;
    }

    public function deactivateModificacion($modificacion_id)
    {
        $modificacion = ModificacionPresupuestaria::find($modificacion_id);
        $modificacion->activo = 0;
        $modificacion->save();
        $this->modificaciones = ModificacionPresupuestaria::all();
    }

    public function render()
    {
        return view('livewire.modificacion-partidas');
    }
}
