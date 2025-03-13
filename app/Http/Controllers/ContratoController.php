<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('contratos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $contrato = $request->validate([
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

        $contrato = Contrato::create($contrato);
        $reserva = ReservaController

        return redirect('/contratos/show/'.$contrato->id);
    }

    /**
     * Display the specified resource.
     */
    public function show($contrato_id)
    {
        Log::info('show: ' . $contrato_id);
        $contrato = Contrato::find($contrato_id);

        return view('contratos.show', compact('contrato'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contrato $contrato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contrato $contrato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contrato $contrato)
    {
        //
    }
}
