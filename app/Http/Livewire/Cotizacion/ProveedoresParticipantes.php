<?php

namespace App\Http\Livewire\Cotizacion;

use App\Models\Proveedor;
use App\Models\Proveedor_cotizacion;
use Livewire\Component;

class ProveedoresParticipantes extends Component
{
    public $proveedores;
    public $cotizacion_id;
    public $proveedores_participantes;

    public function mount()
    {
        $this->proveedores = Proveedor::all();
        if($this->cotizacion_id){
            $this->proveedores_participantes = Proveedor::whereHas('proveedoresCotizaciones', function($query) {
                                            $query->where('cotizacion_id', $this->cotizacion_id);
                                            })->get();
        }
    }

    public function addProveedorParticipante($proveedor_id){

        $proveedor = Proveedor::find($proveedor_id);
        if($this->cotizacion_id){
            Proveedor_cotizacion::create([
                'cotizacion_id' => $this->cotizacion_id,
                'proveedor_id' => $this->proveedor_id
            ]);
            $this->proveedores_participantes = Proveedor::whereHas('proveedoresCotizaciones', function($query) {
                $query->where('cotizacion_id', $this->cotizacion_id);
                })->get();
        } else {
            $this->proveedores_participantes[] = $proveedor;
        }
    }

    public function render()
    {
        return view('livewire.cotizacion.proveedores-participantes');
    }
}
