<?php

namespace App\Http\Livewire\Cotizacion;

use App\Models\ItemCotizacion;
use Livewire\Component;

class Item extends Component
{
    public $items;
    public $cotizacion_id;
    public $modalItem = false;
    public $descripcion;
    public $cantidad;
    public $unidad = 'Unid.';

    public function mount($cotizacion_id){
        $this->cotizacion_id = $cotizacion_id;
        $this->items = ItemCotizacion::where('cotizacion_id', $this->cotizacion_id)->get();
    }

    public function ItemCreate(){

        $item = ItemCotizacion::create([
            'descripcion' => $this->descripcion,
            'cantidad' => $this->cantidad,
            'cotizacion_id' => $this->cotizacion_id,
            'unidad' => $this->unidad,
        ]);
        $this->items = ItemCotizacion::where('cotizacion_id', $this->cotizacion_id)->get();
        $this->modalItem = false;
        $this->reset(['descripcion', 'cantidad', 'unidad']);
        
    }
    
    public function closeModal(){
        $this->modalItem = false;
        $this->reset(['descripcion', 'cantidad']);
    }
    
    public function delete_item($item_id){
        $item = ItemCotizacion::find($item_id);
        $item->delete();
        $this->items = ItemCotizacion::where('cotizacion_id', $this->cotizacion_id)->get();
    }

    public function render()
    {
        
        return view('livewire.cotizacion.item');
    }
}
