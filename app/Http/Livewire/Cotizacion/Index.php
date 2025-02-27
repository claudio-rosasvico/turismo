<?php

namespace App\Http\Livewire\Cotizacion;

use App\Models\Cotizacion;
use App\Models\Proveedor;
use App\Models\Proveedor_cotizacion;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Barryvdh\Snappy\PdfFaker;
use Barryvdh\DomPDF\Facade\Pdf as DomPDF;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Smalot\PdfParser\Parser;

class Index extends Component
{
    public $cotizaciones;
    public $proveedores;
    public $searchCotizacion;
    public $cotizacion_id;
    public $cotizacion_contrato;
    public $proveedores_cotizacion;
    public $modalShow = false;
    public $modalShowContrato = false;
    public $proveedoresFiltrados; // Lista filtrada de proveedores
    public $busquedaProveedor = ''; // Término de búsqueda
    public $proveedorSeleccionado; // Proveedor seleccionado

    public function mount()
    {
        $this->cotizaciones = Cotizacion::all();
        $this->proveedores = Proveedor::all();
        $this->proveedoresFiltrados = $this->proveedores;
    }

    public function updatedSearchCotizacion()
    {
        if ($this->searchCotizacion == '') {
            $this->cotizaciones = Cotizacion::all();
        } else {
            $this->cotizaciones = Cotizacion::where('nombre', 'LIKE', '%' . $this->searchCotizacion . '%')
                ->get();
        }
    }

    public function delete_cotizacion($cotizacion_id)
    {
        $cotizacion = Cotizacion::find($cotizacion_id);
        $cotizacion->delete();
        $this->cotizaciones = Cotizacion::all();
    }

    public function showModal($id_cotizacion)
    {
        $this->cotizacion_id = $id_cotizacion;
        $this->proveedores_cotizacion = Cotizacion::find($this->cotizacion_id)->proveedores;
        $this->modalShow = true;
    }
    
    public function showModalContrato($id_cotizacion)
    {
        $this->cotizacion_contrato = Cotizacion::find($id_cotizacion);
        $this->modalShowContrato = true;
    }

    public function updatedBusquedaProveedor()
    {
        // Filtrar proveedores según el término de búsqueda
        $this->proveedoresFiltrados = $this->proveedores->filter(function ($proveedor) {
            return stripos($proveedor->nombre, $this->busquedaProveedor) !== false;
        });
    }

    public function addProveedor($proveedorId)
    {

        Proveedor_cotizacion::create([
            'proveedor_id' => $proveedorId,
            'cotizacion_id' => $this->cotizacion_id
        ]);
        $this->proveedores_cotizacion = Cotizacion::find($this->cotizacion_id)->proveedores;
    }

    public function closeModal()
    {
        $this->modalShow = false;
        $this->modalShowContrato = false;
        $this->reset(['busquedaProveedor', 'proveedorSeleccionado', 'cotizacion_contrato']); 
    }

    public function generarRecibidos($cotizacion_id)
    {
        $cotizacion = Cotizacion::find($cotizacion_id);
        $proveedores = $cotizacion->proveedores;

        $pdf = SnappyPdf::loadView('cotizaciones.recibidos', compact('cotizacion', 'proveedores'));
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->inline();
        }, 'Recibidos Expte ' . $cotizacion->expediente . ' - Cotización Nº ' . $cotizacion->numero . '.pdf');
    }


    public function delete_proveedor_cotizacion($proveedor_cotizacion_id)
    {
        $proveedor_cotizacion = Proveedor_cotizacion::find($proveedor_cotizacion_id);
        $proveedor_cotizacion->delete();
        $this->proveedores_cotizacion = Cotizacion::find($this->cotizacion_id)->proveedores;
    }

    public function render()
    {
        return view('livewire.cotizacion.index');
    }
}
