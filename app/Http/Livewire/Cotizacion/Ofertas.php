<?php

namespace App\Http\Livewire\Cotizacion;

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
                if (!empty($this->oferta_seleccionada[$item->id])) {
                    if ($this->oferta_seleccionada[$item->id]->precio_unitario > $this->ofertas[$item->id][$proveedor->id]->precio_unitario) {
                        $this->oferta_seleccionada[$item->id] = $this->ofertas[$item->id][$proveedor->id];
                    }
                } else {
                    $this->oferta_seleccionada[$item->id] = $this->ofertas[$item->id][$proveedor->id];
                }
            }
        }
        $this->precioTotal();
    }

    public function updateOfertas($item_id, $proveedor_id, $valor)
    {
        $ofertaActualizada = OfertaCotizacion::where('item_id', $item_id)
        ->where('proveedor_id', $proveedor_id)->first();
        if ($ofertaActualizada) {
            $ofertaActualizada->precio_unitario = $valor;
            $ofertaActualizada->save();
            
        }

        if ($this->oferta_seleccionada[$item_id]->precio_unitario > $ofertaActualizada->precio_unitario) {
            $this->oferta_seleccionada[$item_id] = $ofertaActualizada;
        }
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

    }

    public function render()
    {
        return view('livewire.cotizacion.ofertas');
    }
}
