<?php

namespace App\Http\Livewire\Pagos;

use App\Models\Pago;
use App\Models\Proveedor;
use App\Models\TipoPago;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $searchPago = '';
    public $pago_id = null;
    public $modalShow = false;
    public $busquedaProveedor = '';
    public $proveedores;
    public $proveedoresFiltrados;
    public $proveedorSeleccionado;
    public $tipos_pagos;
    public $expediente;
    public $proveedor_id;
    public $sucursal;
    public $nro_comprobante;
    public $fecha_comprobante;
    public $monto;
    public $fecha_imputacion;
    public $partida_codigo;
    public $tipo_pago_id;
    public $nro_OP;
    public $nro_expte_siaf;
    public $nro_solicitud;
    public $pagado;
    public $observacion;
    public $sortField;
    public $sortDirection = 'asc';
    public $id_solicitud;
    public $nro_solicitudes = [];
    public $advertencia = 'Ya existe ese pago';

    public function mount()
    {

        $this->proveedores = Proveedor::all();
        $this->proveedoresFiltrados = $this->proveedores;
        $this->tipos_pagos = TipoPago::all();
        $this->id_solicitud;
    }

    public function updatedSearchPago()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {

        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
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
        if ($this->proveedorSeleccionado) {
            $this->dispatch('mostrarToast', ['titulo' => 'Error', 'mensaje' => 'Ya existe un proveedor seleccionado', 'tipo' => 'error']);
        } else {
            $this->proveedorSeleccionado = Proveedor::find($proveedorId);
        }
    }

    public function pagoCreate()
    {
        if (!$this->proveedorSeleccionado) {
            $this->dispatch('mostrarToast', ['titulo' => 'Error', 'mensaje' => 'Debe seleccionar un proveedor', 'tipo' => 'error']);
            return;
        } else {
            try {

                $this->validate([
                    'expediente' => 'required',
                    'sucursal' => 'required',
                    'nro_comprobante' => 'required',
                    'fecha_comprobante' => 'required | date',
                    'monto' => 'required | numeric',
                    'fecha_imputacion' => 'required | date',
                    'partida_codigo' => 'required',
                    'tipo_pago_id' => 'required',
                    'nro_OP' => '',
                    'nro_expte_siaf' => '',
                    'nro_solicitud' => '',
                    'pagado' => '',
                    'observacion' => 'nullable|string',
                ], [
                    'expediente.required' => 'El campo expediente es obligatorio.',
                    'sucursal.required' => 'El campo sucursal es obligatorio.',
                    'nro_comprobante.required' => 'El campo número de comprobante es obligatorio.',
                    'fecha_comprobante.required' => 'El campo fecha de comprobante es obligatorio.',
                    'fecha_comprobante.date' => 'El campo fecha de comprobante debe ser una fecha válida.',
                    'monto.required' => 'El campo monto es obligatorio.',
                    'monto.numeric' => 'El campo monto debe ser un número.',
                    'fecha_imputacion.required' => 'El campo fecha de imputación es obligatorio.',
                    'fecha_imputacion.date' => 'El campo fecha de imputación debe ser una fecha válida.',
                    'tipo_pago_id.required' => 'El campo tipo de pago es obligatorio.',
                    'observacion.string' => 'El campo observación debe ser una cadena de texto.',
                ]);

                if ($this->pago_id) {
                    $pago = Pago::find($this->pago_id);
                    $pago->update([
                        'expediente' => $this->expediente,
                        'proveedor_id' => $this->proveedorSeleccionado->id,
                        'sucursal' => $this->sucursal,
                        'nro_comprobante' => $this->nro_comprobante,
                        'fecha_comprobante' => $this->fecha_comprobante,
                        'monto' => $this->monto,
                        'fecha_imputacion' => $this->fecha_imputacion,
                        'partida_codigo' => $this->partida_codigo,
                        'tipo_pago_id' => $this->tipo_pago_id,
                        'nro_OP' => $this->nro_OP,
                        'nro_expte_siaf' => $this->nro_expte_siaf,
                        'nro_solicitud' => $this->nro_solicitud,
                        'pagado' => $this->pagado ? true : false,
                        'observacion' => $this->observacion,
                    ]);
                    $this->dispatch('mostrarToast', ['titulo' => 'Éxito', 'mensaje' => 'Pago actualizado correctamente', 'tipo' => 'success']);
                } else {
                    $pagoExistente = Pago::where('proveedor_id', $this->proveedorSeleccionado->id)
                        ->where('sucursal', $this->sucursal)
                        ->where('nro_comprobante', $this->nro_comprobante)
                        ->where('partida_codigo', $this->partida_codigo)
                        ->first();

                    $pagoAvertencia = Pago::where('proveedor_id', $this->proveedorSeleccionado->id)
                        ->where('sucursal', $this->sucursal)
                        ->where('nro_comprobante', $this->nro_comprobante)
                        ->first();

                    if ($pagoExistente) {
                        $this->dispatch('mostrarToast', ['titulo' => 'Error', 'mensaje' => 'Ya existe un pago con el mismo proveedor, sucursal, número de comprobante y partida.', 'tipo' => 'error']);
                        return;
                    } else {
                        if ($pagoAvertencia) {
                            $this->dispatch('mostrarToast', ['titulo' => 'Atención', 'mensaje' => 'Ya existe un pago con el mismo proveedor y comprobante', 'tipo' => 'warning']);
                        }
                        Pago::create([
                            'expediente' => $this->expediente,
                            'proveedor_id' => $this->proveedorSeleccionado->id,
                            'sucursal' => $this->sucursal,
                            'nro_comprobante' => $this->nro_comprobante,
                            'fecha_comprobante' => $this->fecha_comprobante,
                            'monto' => $this->monto,
                            'fecha_imputacion' => $this->fecha_imputacion,
                            'partida_codigo' => $this->partida_codigo,
                            'tipo_pago_id' => $this->tipo_pago_id,
                            'nro_OP' => $this->nro_OP,
                            'nro_expte_siaf' => $this->nro_expte_siaf,
                            'nro_solicitud' => $this->nro_solicitud,
                            'pagado' => $this->pagado ? true : false,
                            'observacion' => $this->observacion,
                        ]);
                        $this->dispatch('mostrarToast', ['titulo' => 'Éxito', 'mensaje' => 'Pago creado correctamente', 'tipo' => 'success']);
                    }
                }

                $this->updatedSearchPago();
                $this->modalShow = false;
                $this->reset(['pago_id', 'expediente', 'proveedorSeleccionado', 'sucursal', 'nro_comprobante', 'fecha_comprobante', 'monto', 'fecha_imputacion', 'partida_codigo', 'tipo_pago_id', 'nro_OP', 'nro_expte_siaf', 'nro_solicitud', 'pagado', 'observacion', 'nro_solicitudes']);
            } catch (ValidationException $e) {

                $errors = $e->validator->errors()->all();
                $errorMessage = implode('<br>', $errors);

                $this->dispatch('mostrarToast', ['titulo' => 'Error de validación', 'mensaje' => $errorMessage, 'tipo' => 'error']);
            } catch (\Exception $e) {
                $this->dispatch('mostrarToast', ['titulo' => 'Error', 'mensaje' => 'Hubo un problema al crear el proveedor.', 'tipo' => 'error']);
                Log::error('Error al crear el proveedor: ' . $e->getMessage());
            }
        }
    }

    public function createPago()
    {
        $this->reset(['pago_id', 'expediente', 'proveedorSeleccionado', 'sucursal', 'nro_comprobante', 'fecha_comprobante', 'monto', 'fecha_imputacion', 'partida_codigo', 'tipo_pago_id', 'nro_OP', 'nro_expte_siaf', 'nro_solicitud', 'pagado', 'observacion']);
        $this->modalShow = true;
    }

    public function editPago($pago_id)
    {
        $this->pago_id = $pago_id;
        $pago = Pago::find($this->pago_id);

        if ($pago) {
            $this->expediente = $pago->expediente;
            $this->proveedorSeleccionado = Proveedor::find($pago->proveedor_id);
            $this->sucursal = $pago->sucursal;
            $this->nro_comprobante = $pago->nro_comprobante;
            $this->fecha_comprobante = $pago->fecha_comprobante;
            $this->monto = $pago->monto;
            $this->fecha_imputacion = $pago->fecha_imputacion;
            $this->partida_codigo = $pago->partida_codigo;
            $this->tipo_pago_id = $pago->tipo_pago_id;
            $this->nro_OP = $pago->nro_OP;
            $this->nro_expte_siaf = $pago->nro_expte_siaf;
            $this->nro_solicitud = $pago->nro_solicitud;
            $this->pagado = $pago->pagado;
            $this->observacion = $pago->observacion;
            $this->modalShow = true;
        } else {
            $this->dispatch('mostrarToast', ['titulo' => 'Error', 'mensaje' => 'Pago no encontrado', 'tipo' => 'error']);
        }
    }

    public function closeModal()
    {
        $this->modalShow = false;
        $this->reset(['expediente', 'proveedorSeleccionado', 'sucursal', 'nro_comprobante', 'fecha_comprobante', 'monto', 'fecha_imputacion', 'partida_codigo', 'tipo_pago_id', 'nro_OP', 'nro_expte_siaf', 'nro_solicitud', 'pagado', 'observacion']);
    }

    public function deletePago($pago_id)
    {
        $pago = Pago::find($pago_id);
        if ($pago) {
            $pago->delete();
            $this->updatedSearchPago();
            $this->dispatch('mostrarToast', ['titulo' => 'Éxito', 'mensaje' => 'Pago eliminado correctamente', 'tipo' => 'success']);
        } else {
            $this->dispatch('mostrarToast', ['titulo' => 'Error', 'mensaje' => 'Pago no encontrado', 'tipo' => 'error']);
        }

        $this->pago_id = null;
    }

    public function confirmarPago($pago_id)
    {
        $pago = Pago::find($pago_id);
        if ($pago) {
            if (!$pago->fecha_imputacion) {
                $this->dispatch('mostrarToast', ['titulo' => 'Error', 'mensaje' => 'El pago debe estar imputado', 'tipo' => 'error']);
            } elseif (!$pago->nro_OP) {
                $this->dispatch('mostrarToast', ['titulo' => 'Error', 'mensaje' => 'El pago no tiene OP', 'tipo' => 'error']);
            } elseif (!$pago->nro_solicitud) {
                $this->dispatch('mostrarToast', ['titulo' => 'Error', 'mensaje' => 'El pago no está agregado a una solicitud de fondos', 'tipo' => 'error']);
            } else {
                $pago->update([
                    'pagado' => true
                ]);
                $this->updatedSearchPago();
                $this->dispatch('mostrarToast', ['titulo' => 'Éxito', 'mensaje' => 'Pago confirmado correctamente', 'tipo' => 'success']);
            }
        } else {
            $this->dispatch('mostrarToast', ['titulo' => 'Error', 'mensaje' => 'Pago no encontrado', 'tipo' => 'error']);
        }
    }

    public function cancelarPago($pago_id)
    {
        $pago = Pago::find($pago_id);
        if ($pago) {
            $pago->update([
                'pagado' => false
            ]);
            $this->updatedSearchPago();
            $this->dispatch('mostrarToast', ['titulo' => 'Éxito', 'mensaje' => 'Pago cancelado correctamente', 'tipo' => 'success']);
        } else {
            $this->dispatch('mostrarToast', ['titulo' => 'Error', 'mensaje' => 'Pago no encontrado', 'tipo' => 'error']);
        }
    }

    public function updateSolicitud($id_pago)
    {
        $pago = Pago::find($id_pago);
        Log::info($id_pago);
        if ($pago) {
            $pago->update([
                'nro_solicitud' => isset($this->nro_solicitudes[$id_pago]) ? $this->nro_solicitudes[$id_pago] : ''
            ]);
            $this->updatedSearchPago();
            $this->dispatch('mostrarToast', ['titulo' => 'Éxito', 'mensaje' => 'Nº de Solicitud actualizada correctamente', 'tipo' => 'success']);
        } else {
            $this->dispatch('mostrarToast', ['titulo' => 'Error', 'mensaje' => 'Pago no encontrado', 'tipo' => 'error']);
        }
        $this->reset(['id_solicitud']);
    }

    public function render()
    {
        $query = Pago::query()->select('pagos.*');

        if (!empty($this->searchPago)) {
            $query->where('observacion', 'LIKE', '%' . $this->searchPago . '%')
                ->orWhere('partida_codigo', 'like', '%' . $this->searchPago . '%')
                ->orWhere('expediente', 'like', '%' . $this->searchPago . '%')
                ->orWhereHas('proveedor', function ($q) {
                    $q->where('nombre', 'LIKE', '%' . $this->searchPago . '%');
                });
        }

        if (!empty($this->sortField)) {
            $query->join('proveedores', 'pagos.proveedor_id', '=', 'proveedores.id');
            $orderByField = ($this->sortField === 'proveedor_id') ? 'proveedores.nombre' : $this->sortField;
            $query->orderBy($orderByField, $this->sortDirection);
        } else {
            $query->orderBy('id', 'desc');
        }

        return view('livewire.pagos.index', [
            'pagos' => $query->paginate(15)
        ]);
    }
}
