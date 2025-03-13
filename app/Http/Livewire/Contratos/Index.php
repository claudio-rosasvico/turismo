<?php

namespace App\Http\Livewire\Contratos;

use App\Models\Contrato;
use App\Models\Proveedor;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Validation\ValidationException;

class Index extends Component
{
    public $contratos;
    public $proveedores;
    public $searchContrato;
    public $modalShowEdit;
    public $contrato_id;
    public $nombre;
    public $expediente;
    public $proveedor_id;
    public $fecha_inicio;
    public $fecha_fin;
    public $monto_total;
    public $monto_mensual;
    public $nro_resolucion;
    public $cotizacion_id;
    public $activo;
    public $observacion;

    public function mount()
    {
        $this->proveedores = Proveedor::all();
        $this->contratos = Contrato::all();
    }

    public function updatedSearchContrato()
    {
        if ($this->searchContrato == '') {
            $this->contratos = Contrato::all();
        } else {
            $this->contratos = Contrato::where('nombre', 'LIKE', '%' . $this->searchContrato . '%')
                ->orWhere('expediente', 'LIKE', '%' . $this->searchContrato . '%')
                ->get();
        }
    }

    public function editContrato($id_contrato)
    {
        $this->contrato_id = $id_contrato;
        $contrato = Contrato::find($this->contrato_id);

        $this->nombre = $contrato->nombre;
        $this->expediente = $contrato->expediente;
        $this->proveedor_id = $contrato->proveedor_id;
        $this->fecha_inicio = $contrato->fecha_inicio;
        $this->fecha_fin = $contrato->fecha_fin;
        $this->monto_total = $contrato->monto_total;
        $this->monto_mensual = $contrato->monto_mensual;
        $this->nro_resolucion = $contrato->nro_resolucion;
        $this->cotizacion_id = $contrato->cotizacion_id;
        $this->activo = $contrato->activo;
        $this->observacion = $contrato->observacion;

        $this->modalShowEdit = true;
    }

    public function closeModal()
    {
        $this->modalShowEdit = false;
        $this->reset(['nombre', 'expediente', 'proveedor_id', 'fecha_inicio','fecha_fin',
            'monto_total', 'monto_mensual', 'nro_resolucion', 'cotizacion_id', 'activo',
            'observacion', 'contrato_id']);
    }

    public function contratoUpdate(){

        try {
            $this->validate([
                'nombre' => 'required|string|max:255',
                'expediente' => 'required|string|max:255',
                'proveedor_id' => 'required|integer',
                'fecha_inicio' => 'required|date',
                'fecha_fin' => 'required|date',
                'monto_total' => 'required|numeric',
                'monto_mensual' => 'required|numeric',
                'nro_resolucion' => 'required|string|max:255',
                'cotizacion_id' => 'required|integer',
                'activo' => 'boolean',
                'observacion' => 'nullable|string|max:255',
            ], [
                'nombre.required' => 'El nombre es obligatorio.',
                'nombre.string' => 'El nombre debe ser una cadena de texto.',
                'nombre.max' => 'El nombre no debe exceder los 255 caracteres.',
                'expediente.required' => 'El expediente es obligatorio.',
                'expediente.string' => 'El expediente debe ser una cadena de texto.',
                'expediente.max' => 'El expediente no debe exceder los 255 caracteres.',
                'proveedor_id.required' => 'El ID del proveedor es obligatorio.',
                'proveedor_id.integer' => 'El ID del proveedor debe ser un número entero.',
                'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
                'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
                'fecha_fin.required' => 'La fecha de fin es obligatoria.',
                'fecha_fin.date' => 'La fecha de fin debe ser una fecha válida.',
                'monto_total.required' => 'El monto total es obligatorio.',
                'monto_total.numeric' => 'El monto total debe ser un número.',
                'monto_mensual.required' => 'El monto mensual es obligatorio.',
                'monto_mensual.numeric' => 'El monto mensual debe ser un número.',
                'nro_resolucion.required' => 'El número de resolución es obligatorio.',
                'nro_resolucion.string' => 'El número de resolución debe ser una cadena de texto.',
                'nro_resolucion.max' => 'El número de resolución no debe exceder los 255 caracteres.',
                'cotizacion_id.required' => 'El ID de cotización es obligatorio.',
                'cotizacion_id.integer' => 'El ID de cotización debe ser un número entero.',
                'activo.boolean' => 'El campo activo debe ser verdadero o falso.',
                'observacion.string' => 'La observación debe ser una cadena de texto.',
                'observacion.max' => 'La observación no debe exceder los 255 caracteres.',
            ]);

            $contrato = Contrato::find($this->contrato_id);
            Log::info($contrato);
            $contrato->update([
                'nombre' => $this->nombre,
                'expediente' => $this->expediente,
                'proveedor_id' => $this->proveedor_id,
                'fecha_inicio' => $this->fecha_inicio,
                'fecha_fin' => $this->fecha_fin,
                'monto_total' => $this->monto_total,
                'monto_mensual' => $this->monto_mensual,
                'nro_resolucion' => $this->nro_resolucion,
                'observacion' => $this->observacion,
            ]);
            
            $this->dispatch('mostrarToast', ['titulo' => 'Éxito', 'mensaje' => 'Se actualizó el contrato correctamente.', 'tipo' => 'success']);
            $this->contratos = Contrato::all();
            $this->closeModal();
            $this->reset(['nombre', 'expediente', 'proveedor_id', 'fecha_inicio','fecha_fin',
            'monto_total', 'monto_mensual', 'nro_resolucion', 'cotizacion_id', 'activo',
            'observacion', 'contrato_id']);

        } catch (ValidationException $e) {

            $errors = $e->validator->errors()->all();
            $errorMessage = implode('<br>', $errors);

            $this->dispatch('mostrarToast', ['titulo' => 'Error de validación', 'mensaje' => $errorMessage, 'tipo' => 'error']);
        } catch (\Exception $e) {
            $this->dispatch('mostrarToast', ['titulo' => 'Error', 'mensaje' => 'Hubo un problema al actualizar el Contrato.', 'tipo' => 'error']);
            Log::error('Error al crear el proveedor: ' . $e->getMessage());
        }
    }

    public function delete_contrato($id_contrato){

        $contrato = Contrato::find($id_contrato);
        $contrato->delete();
        $this->contratos = Contrato::all();
    }

    public function render()
    {
        return view('livewire.contratos.index');
    }
}
