<?php

namespace App\Http\Livewire\Cotizacion;

use App\Models\Cotizacion;
use App\Models\OrdenCompra;
use App\Models\Proveedor_cotizacion;
use Livewire\Component;

class OrdenCompraCotizacion extends Component
{
    public $cotizacion_id;
    public $cotizacion;
    public $proveedores;
    public $ordenes_compras;
    public $modalOrdenCompra = false;
    public $numero;
    public $expediente_siaf;
    public $precio_total;
    public $proveedor_id;

    public function mount($cotizacion_id)
    {
        $this->cotizacion_id = $cotizacion_id;
        $this->ordenes_compras = OrdenCompra::where('cotizacion_id', $this->cotizacion_id)->orderBy('created_at', 'asc')->get();
        $this->proveedores = Proveedor_cotizacion::where('cotizacion_id', $this->cotizacion_id)->get();
    }

    public function OrdenCompraCreate()
    {
        $orden_compra = OrdenCompra::create([
            'numero' => $this->numero,
            'expediente_siaf' => $this->expediente_siaf,
            'precio_total' => $this->precio_total,
            'cotizacion_id' => $this->cotizacion_id,
            'proveedor_id' => $this->proveedor_id,

        ]);
        $this->ordenes_compras = OrdenCompra::where('cotizacion_id', $this->cotizacion_id)->get();
        $this->modalOrdenCompra = false;
        $this->reset(['numero', 'expediente_siaf', 'precio_total',]);
    }

    public function closeModal()
    {
        $this->modalOrdenCompra = false;
        $this->reset(['numero', 'expediente_siaf', 'precio_total',]);
    }

    public function delete_orden_compra($orden_compra_id)
    {
        $orden_compra = OrdenCompra::find($orden_compra_id);
        $orden_compra->delete();
        $this->ordenes_compras = OrdenCompra::where('cotizacion_id', $this->cotizacion_id)->get();
    }

    public function render()
    {
        $this->cotizacion = Cotizacion::find($this->cotizacion_id);
        return view('livewire.cotizacion.orden-compra-cotizacion');
    }
}
