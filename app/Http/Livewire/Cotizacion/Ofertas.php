<?php

namespace App\Http\Livewire\Cotizacion;

use App\Models\ItemCotizacion;
use App\Models\OfertaCotizacion;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Ofertas extends Component
{
    public $cotizacion;
    public $items;
    public $proveedores;
    public $ofertas;
    public $oferta_seleccionada;
    public $precio_total;

    public function mount($cotizacion)
    {
        $this->cotizacion = $cotizacion;
        $this->proveedores = $this->cotizacion->proveedores;
        $this->items = $this->cotizacion->items;
        foreach ($this->items as $item) {
            foreach ($this->proveedores as $proveedor) {
                $this->ofertas[$item->id][$proveedor->id] = OfertaCotizacion::where('item_id', $item->id)
                    ->where('proveedor_id', $proveedor->id)->first();
            }
            $this->oferta_seleccionada[$item->id] = OfertaCotizacion::where('item_id', $item->id)
                ->where('ganador', 1)
                ->first();

            if (!$this->oferta_seleccionada[$item->id]) {
                $this->selectMenor($item->id);
            }
        }
        $this->precioTotal();
    }

    public function selectMenor($item_id)
    {
        OfertaCotizacion::where('item_id', $item_id)->update(['ganador' => 0]);

        $menorOferta = OfertaCotizacion::where('item_id', $item_id)
            ->orderBy('precio_unitario')
            ->first();

        if ($menorOferta) {
            $menorOferta->update(['ganador' => 1]);
            $this->oferta_seleccionada[$item_id] = $menorOferta->fresh(); 
        }
        Log::info($this->oferta_seleccionada[$item_id]);

        $this->precioTotal();
    }

    public function updateOferta($item_id, $proveedor_id, $valor)
    {
        $ofertaActualizada = OfertaCotizacion::where('item_id', $item_id)
            ->where('proveedor_id', $proveedor_id)->first();
        $ofertaActualizada->update(['precio_unitario' => $valor]);
        
        $this->selectMenor($item_id);   
        $this->precioTotal();
    }

    public function selectOferta($item_id, $proveedor_id)
    {
        OfertaCotizacion::where('item_id', $item_id)->update(['ganador' => 0]);
        
        $ofertaCheck = OfertaCotizacion::where('item_id', $item_id)
            ->where('proveedor_id', $proveedor_id)->first();
        
        $ofertaCheck->update(['ganador' => 1]);
        $this->oferta_seleccionada[$item_id] = $ofertaCheck->fresh();

        $this->precioTotal();
    }

    public function precioTotal()
    {
        $this->precio_total = 0;
        foreach ($this->oferta_seleccionada as $oferta) {
            if ($oferta) {
                $this->precio_total += ($oferta->precio_unitario * $oferta->item->cantidad);
            }
        }
        $this->dispatch('refresh');
    }

    public function render()
    {
        $this->proveedores = $this->cotizacion->proveedores;
        $this->items = $this->cotizacion->items;
        return view('livewire.cotizacion.ofertas');
    }
}
