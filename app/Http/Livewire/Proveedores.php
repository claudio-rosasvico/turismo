<?php

namespace App\Http\Livewire;

use App\Models\Proveedor;
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

    public function mount()
    {
        $this->proveedores = Proveedor::all();
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

    public function proveedorCreate()
    {
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

        try {
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

            $this->reset(['nombre', 'CUIT', 'domicilio', 'telefono', 'email', 'venc_libre_deuda', 'observaciones']);
            $this->proveedores = Proveedor::all();
            $this->modalShow = false;

            // Mostrar toast de éxito
            $this->emit('mostrarToast', '¡Éxito!', 'El proveedor se creó correctamente.', 'success');
        } catch (ValidationException $e) {
            // Capturar errores de validación
            $errors = $e->validator->errors()->all(); // Obtener todos los mensajes de error
            $errorMessage = implode('<br>', $errors); // Unir los mensajes en un solo string

            // Mostrar toast de error con los mensajes de validación
            $this->emit('mostrarToast', 'Error de validación', $errorMessage, 'error');
        } catch (\Exception $e) {
            // Mostrar toast de error en caso de excepción
            $this->emit('mostrarToast', 'Error', 'Hubo un problema al crear el proveedor.', 'error');
        }
    }

    public function render()
    {
        return view('livewire.proveedores');
    }
}
