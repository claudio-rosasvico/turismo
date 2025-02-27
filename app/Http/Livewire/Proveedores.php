<?php

namespace App\Http\Livewire;

use App\Models\Proveedor;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Proveedores extends Component
{
    public $proveedores;
    public $searchProveedor;
    public $nombre;
    public $CUIT;
    public $domicilio;
    public $telefono;
    public $email;
    public $venc_libre_deuda;
    public $observaciones;
    public $modalShow;
    public $proveedor_id;
    public $sortField = 'nombre';
    public $sortDirection = 'asc';

    public function mount()
    {
        $this->proveedores = Proveedor::orderBy($this->sortField, $this->sortDirection)->get();
    }

    public function updatedSearchProveedor()
    {
        if ($this->searchProveedor == '') {
            $this->proveedores = Proveedor::all();
        } else {
            $this->proveedores = Proveedor::where('nombre', 'LIKE', '%' . $this->searchProveedor . '%')
                ->orWhere('CUIT', 'like', '%' . $this->searchProveedor . '%')
                ->orWhere('observaciones', 'like', '%' . $this->searchProveedor . '%')
                ->get();
        }
    }

    public function showModal($proveedor_id = null)
    {
        if ($proveedor_id) {
            $proveedor = Proveedor::find($proveedor_id);
            $this->proveedor_id = $proveedor->id;
            $this->nombre = $proveedor->nombre;
            $this->CUIT = $proveedor->CUIT;
            $this->domicilio = $proveedor->domicilio;
            $this->telefono = $proveedor->telefono;
            $this->email = $proveedor->email;
            $this->venc_libre_deuda = $proveedor->venc_libre_deuda;
            $this->observaciones = $proveedor->observaciones;
        } else {
            $this->reset(['nombre', 'CUIT', 'domicilio', 'telefono', 'email', 'venc_libre_deuda', 'observaciones', 'proveedor_id']);
        }

        $this->modalShow = true;
    }

    public function proveedorCreate()
    {
        // Validar los datos
        try {
            $this->validate([
                'nombre' => 'required|string|max:255',
                'CUIT' => 'required|string|min:11',
                'domicilio' => 'required|string|max:255',
            ], [
                'nombre.required' => 'El campo nombre es obligatorio.',
                'nombre.max' => 'El nombre no debe exceder los 255 caracteres.',
                'CUIT.required' => 'El campo CUIT es obligatorio.',
                'CUIT.min' => 'El CUIT debe tener al menos 11 caracteres.',
                'domicilio.required' => 'El campo domicilio es obligatorio.',
                'domicilio.max' => 'El domicilio no debe exceder los 255 caracteres.',
            ]);

            if ($this->proveedor_id) {
                $proveedor = Proveedor::find($this->proveedor_id);
                $proveedor->update([
                    'nombre' => $this->nombre,
                    'CUIT' => $this->CUIT,
                    'domicilio' => $this->domicilio,
                    'telefono' => $this->telefono,
                    'email' => $this->email,
                    'venc_libre_deuda' => $this->venc_libre_deuda,
                    'observaciones' => $this->observaciones,
                ]);
                $this->dispatch('mostrarToast', ['titulo' => '¡Éxito!', 'mensaje' => 'El proveedor se actualizó correctamente.', 'tipo' => 'success']);

            } else {
                $proveedor = Proveedor::create([
                    'nombre' => $this->nombre,
                    'CUIT' => $this->CUIT,
                    'domicilio' => $this->domicilio,
                    'telefono' => $this->telefono,
                    'email' => $this->email,
                    'estado' => true,
                    'venc_libre_deuda' => $this->venc_libre_deuda,
                    'observaciones' => $this->observaciones,
                ]);

                $this->dispatch('mostrarToast', ['titulo' => '¡Éxito!', 'mensaje' => 'El proveedor se creó correctamente.', 'tipo' => 'success']);
            }
            $this->proveedores = Proveedor::all();
            $this->modalShow = false;
        } catch (ValidationException $e) {

            $errors = $e->validator->errors()->all();
            $errorMessage = implode('<br>', $errors);

            $this->dispatch('mostrarToast', ['titulo' => 'Error de validación', 'mensaje' => $errorMessage, 'tipo' => 'error']);
        } catch (\Exception $e) {
            $this->dispatch('mostrarToast', ['titulo' => 'Error', 'mensaje' => 'Hubo un problema al crear el proveedor.', 'tipo' => 'error']);
            Log::error('Error al crear el proveedor: ' . $e->getMessage());
        }
    }

    public function deactivateproveedor($proveedor_id)
    {
        $proveedor = Proveedor::find($proveedor_id);
        $proveedor->update([
            'estado' => false,
        ]);
        $this->proveedores = Proveedor::all();
        $this->dispatch('mostrarToast', ['titulo' => '¡Éxito!', 'mensaje' => 'El proveedor se eliminó correctamente.', 'tipo' => 'success']);
    }

    public function sortBy($field)
    {

        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
        $this->proveedores = Proveedor::orderBy($this->sortField, $this->sortDirection)->get();

    }

    public function render()
    {
        return view('livewire.proveedores');
    }
}
