<?php

namespace App\Http\Livewire\Cotizacion;

use App\Models\Cotizacion;
use App\Models\OfertaCotizacion;
use App\Models\Proveedor;
use App\Models\Proveedor_cotizacion;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Mpdf\Mpdf;

class Index extends Component
{
    public $cotizaciones;
    public $proveedores;
    public $searchCotizacion;
    public $cotizacion_id;
    public $cotizacion_contrato;
    public $proveedores_cotizacion;
    public $items_cotizacion;
    public $descripcion_anexo;
    public $modalShow = false;
    public $modalAnexo = false;
    public $modalShowContrato = false;
    public $modalShowOfertas = false;
    public $proveedoresFiltrados; // Lista filtrada de proveedores
    public $busquedaProveedor = ''; // Término de búsqueda
    public $proveedorSeleccionado; // Proveedor seleccionado
    public $proveedorBotonId;
    public $showInputOfertas = false;
    public $precio_unitario;
    public $precio_total;
    public $ofertas_proveedor;

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

    public function delete_cotizacion($id_cotizacion)
    {
        $cotizacion = Cotizacion::find($id_cotizacion);
        $cotizacion->delete();
        $this->cotizaciones = Cotizacion::all();
    }

    public function showModal($id_cotizacion)
    {

        $this->cotizacion_id = $id_cotizacion;
        $this->proveedores_cotizacion = Proveedor_cotizacion::where('cotizacion_id', $this->cotizacion_id)->get();
        $this->updatedBusquedaProveedor();
        $this->modalShow = true;
    }

    public function showModalContrato($id_cotizacion)
    {
        $this->cotizacion_contrato = Cotizacion::find($id_cotizacion);
        $this->proveedores_cotizacion = $this->cotizacion_contrato->proveedores;
        $this->modalShowContrato = true;
    }

    public function updatedBusquedaProveedor()
    {
        $proveedoresSeleccionadosIds = $this->proveedores_cotizacion->pluck('proveedor_id')->toArray();

        $this->proveedoresFiltrados = $this->proveedores->reject(function ($proveedor) use ($proveedoresSeleccionadosIds) {
            return in_array($proveedor->id, $proveedoresSeleccionadosIds);
        })->filter(function ($proveedor) {
            return stripos($proveedor->nombre, $this->busquedaProveedor) !== false;
        });
    }

    public function addProveedor($proveedorId)
    {
        Proveedor_cotizacion::create([
            'proveedor_id' => $proveedorId,
            'cotizacion_id' => $this->cotizacion_id
        ]);
        $items = Cotizacion::find($this->cotizacion_id)->items;
        foreach ($items as $item) {
            $oferta = OfertaCotizacion::create([
                'item_id' => $item->id,
                'proveedor_id' => $proveedorId
            ]);
            Log::info($oferta);
        }
        $this->proveedores_cotizacion = Proveedor_cotizacion::where('cotizacion_id', $this->cotizacion_id)->get();
        $this->updatedBusquedaProveedor();
    }

    public function showModalOfertas($id_cotizacion)
    {

        $this->cotizacion_id = $id_cotizacion;
        $this->proveedores_cotizacion = Cotizacion::find($this->cotizacion_id)->proveedores;
        $this->modalShowOfertas = true;
    }

    public function selectProveedorOfertas($proveedorId)
    {

        $this->proveedorBotonId = $proveedorId;
        $this->ofertas_proveedor = OfertaCotizacion::where('proveedor_id', $proveedorId)
            ->whereIn('item_id', function ($query) {
                $query->select('id')
                    ->from('items_cotizaciones')
                    ->where('cotizacion_id', $this->cotizacion_id);
            })->get();

        $this->showInputOfertas = true;
    }

    public function updateOferta($ofertaId, $campo, $valor)
    {
        $oferta = OfertaCotizacion::find($ofertaId);

        $oferta->update([
            $campo => $valor
        ]);
        if ($campo == 'precio_unitario') {
            $oferta->update([
                'precio_total' => ($valor * $oferta->item->cantidad)
            ]);
        };
        $this->ofertas_proveedor = OfertaCotizacion::where('proveedor_id', $oferta->proveedor_id)
            ->whereIn('item_id', function ($query) {
                $query->select('id')
                    ->from('items_cotizaciones')
                    ->where('cotizacion_id', $this->cotizacion_id);
            })->get();
    }

    public function closeModal()
    {
        $this->modalShow = false;
        $this->modalShowContrato = false;
        $this->modalShowOfertas = false;
        $this->showInputOfertas = false;
        $this->modalAnexo = false;
        $this->reset(['busquedaProveedor', 'proveedorSeleccionado', 'cotizacion_contrato', 'proveedorBotonId', 'cotizacion_id']);
    }

    public function generarRecibidos($cotizacion_id)
    {
        $cotizacion = Cotizacion::find($cotizacion_id);
        $proveedores = $cotizacion->proveedores;

        $pdf = Pdf::loadView('cotizaciones.recibidos', compact('cotizacion', 'proveedores'))
            ->setPaper('a4', 'portrait');

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'Recibidos Expte ' . $cotizacion->expediente . ' - Cotización Nº ' . $cotizacion->numero . '.pdf');
    }   

    public function generarSobres($cotizacion_id)
    {
        $cotizacion = Cotizacion::find($cotizacion_id);
        $proveedores = $cotizacion->proveedores;

        $pdf = Pdf::loadView('cotizaciones.sobres', compact('cotizacion', 'proveedores'))
            ->setOption('margin-left', '50mm')
            ->setOption('margin-right', '50mm')
            ->setOption('margin-top', '25mm')
            ->setOption('margin-bottom', '25mm')
            ->setPaper('a4', 'landscape');
        Log::info('impreso en mm');

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'Sobres Expte ' . $cotizacion->expediente . ' - Cotización Nº ' . $cotizacion->numero . '.pdf');
    }


    public function delete_proveedor_cotizacion($proveedor_cotizacion_id)
    {
        $proveedor_cotizacion = Proveedor_cotizacion::find($proveedor_cotizacion_id);
        $proveedorId = $proveedor_cotizacion->proveedor_id;
        OfertaCotizacion::where('proveedor_id', $proveedorId)
            ->whereIn('item_id', function ($query) {
                $query->select('id')
                    ->from('items_cotizaciones')
                    ->where('cotizacion_id', $this->cotizacion_id);
            })
            ->delete();
        $proveedor_cotizacion->delete();
        $this->proveedores_cotizacion = Proveedor_cotizacion::where('cotizacion_id', $this->cotizacion_id)->get();
        $this->updatedBusquedaProveedor();
    }

    public function showDescripcionAnexo($id_cotizacion){
        $this->cotizacion_id = $id_cotizacion;
        $cotizacion = Cotizacion::find($id_cotizacion);
        $this->descripcion_anexo = $cotizacion->descripcion_anexo;
        $this->modalAnexo = true;
    }

    public function generarAnexo()
    {
        $cotizacion = Cotizacion::find($this->cotizacion_id);
        $cotizacion->update([
            'descripcion_anexo' => $this->descripcion_anexo
        ]);
        $this->modalAnexo = false;
        $proveedores = $cotizacion->proveedores;

        if ($cotizacion->proveedores->count() > 2 && $cotizacion->fecha_llamado) {
            $pdf = Pdf::loadView('cotizaciones.pliego', compact('cotizacion', 'proveedores'))
                ->setOption('margin-left', '20mm')
                ->setOption('margin-top', '20mm');
            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->stream();
            }, 'Anexo Expte ' . $cotizacion->expediente . ' - Cotización Nº ' . $cotizacion->numero . '.pdf');
        } else {
            $pdf = Pdf::loadView('cotizaciones.pliegoSinProveedor', compact('cotizacion'))
                ->setOption('margin-left', '20mm')
                ->setOption('margin-top', '20mm');
            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->stream();
            }, 'Anexo Expte ' . $cotizacion->expediente . ' - Cotización Nº ' . $cotizacion->numero . '.pdf');
        }
    }

    public function updateActivo($activo, $id_cotizacion)
    {
        $cotizacion = Cotizacion::find($id_cotizacion);
        
        $cotizacion->update([
            'activo' => $activo
        ]);
        $this->cotizaciones = Cotizacion::all();
    }

    public function render()
    {
        return view('livewire.cotizacion.index');
    }
}
