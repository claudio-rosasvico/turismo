<?php

namespace App\Http\Livewire\Contratos;

use App\Models\Cotizacion;
use App\Models\OrdenCompra;
use App\Models\Pago;
use App\Models\TipoPago;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Validation\ValidationException;

class Pagos extends Component
{
    public $cotizacion_id;
    public $contrato;
    public $pagos;
    public $total_OC;
    public $total_pagos;
    public $modalPago = false;
    public $proveedor_id;
    public $expediente;
    public $sucursal;
    public $nro_comprobante;
    public $fecha_comprobante;
    public $monto;
    public $partida_codigo;
    public $fecha_imputacion;
    public $tipo_pago_id;
    public $nro_OP;
    public $nro_expte_siaf;
    public $nro_solicitud;
    public $pagado;
    public $observacion;
    public $pago_id;

    public $sortField;
    public $sortDirection = 'asc';

    public function mount($contrato)
    {
        $this->contrato = $contrato;
        $this->cotizacion_id = $contrato->cotizacion_id;
        $this->pagos = Pago::where('cotizacion_id', $this->cotizacion_id)->orderBy('created_at', 'asc')->get();
        $this->total_OC = OrdenCompra::where('cotizacion_id', $this->cotizacion_id)->sum('precio_total');
        $this->total_pagos = $this->pagos->sum('monto');
        $this->tipo_pago_id = TipoPago::where('nombre', 'Cotización (Contrato)')->first()->id;
    }

    public function pagoCreate()
    {
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
                    'proveedor_id' => $this->contrato->proveedor_id,
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
                    'cotizacion_id' => $this->cotizacion_id,
                    'observacion' => $this->observacion,
                ]);
                $this->dispatch('mostrarToast', ['titulo' => 'Éxito', 'mensaje' => 'Pago actualizado correctamente', 'tipo' => 'success']);
            } else {
                Pago::create([
                    'expediente' => $this->expediente,
                    'proveedor_id' => $this->contrato->proveedor_id,
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
                    'cotizacion_id' => $this->cotizacion_id,
                    'observacion' => $this->observacion,
                ]);
                $this->dispatch('mostrarToast', ['titulo' => 'Éxito', 'mensaje' => 'Pago creado correctamente', 'tipo' => 'success']);
            }

            $this->pagos = Pago::where('cotizacion_id', $this->cotizacion_id)->get();
            $this->modalPago = false;
            $this->reset(['expediente', 'sucursal', 'nro_comprobante', 'fecha_comprobante', 'monto', 'fecha_imputacion', 'partida_codigo', 'nro_OP', 'nro_expte_siaf', 'nro_solicitud', 'pagado', 'observacion', 'pago_id']);
        } catch (ValidationException $e) {

            $errors = $e->validator->errors()->all();
            $errorMessage = implode('<br>', $errors);

            $this->dispatch('mostrarToast', ['titulo' => 'Error de validación', 'mensaje' => $errorMessage, 'tipo' => 'error']);
        } catch (\Exception $e) {
            $this->dispatch('mostrarToast', ['titulo' => 'Error', 'mensaje' => 'Hubo un problema al crear el proveedor.', 'tipo' => 'error']);
            Log::error('Error al crear el proveedor: ' . $e->getMessage());
        }
    }

    public function editPago($pago_id)
    {
        $this->pago_id = $pago_id;
        $pago = Pago::find($this->pago_id);

        if ($pago) {
            $this->expediente = $pago->expediente;
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
            $this->modalPago = true;
        } else {
            $this->dispatch('mostrarToast', ['titulo' => 'Error', 'mensaje' => 'Pago no encontrado', 'tipo' => 'error']);
        }
    }

    public function deletePago($pago_id)
    {
        $pago = Pago::find($pago_id);
        if ($pago) {
            $pago->delete();
            $this->pagos = Pago::where('cotizacion_id', $this->cotizacion_id)->get();
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
            if(!$pago->fecha_imputacion){
                $this->dispatch('mostrarToast', ['titulo' => 'Error', 'mensaje' => 'El pago debe estar imputado', 'tipo' => 'error']);
            } elseif (!$pago->nro_OP) {
                $this->dispatch('mostrarToast', ['titulo' => 'Error', 'mensaje' => 'El pago no tiene OP', 'tipo' => 'error']);
            } elseif (!$pago->nro_solicitud) {
                $this->dispatch('mostrarToast', ['titulo' => 'Error', 'mensaje' => 'El pago no está agregado a una solicitud de fondos', 'tipo' => 'error']);
            } else {
                $pago->update([
                    'pagado' => true
                ]);
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
            $this->dispatch('mostrarToast', ['titulo' => 'Éxito', 'mensaje' => 'Pago cancelado correctamente', 'tipo' => 'success']);
        } else {
            $this->dispatch('mostrarToast', ['titulo' => 'Error', 'mensaje' => 'Pago no encontrado', 'tipo' => 'error']);
        }
    }

    public function render()
    {
        $this->total_OC = OrdenCompra::where('cotizacion_id', $this->cotizacion_id)->sum('precio_total');
        $this->total_pagos = $this->pagos->sum('monto');
        $this->pagos = Pago::where('cotizacion_id', $this->cotizacion_id)->get();
        return view('livewire.contratos.pagos');
    }
}
