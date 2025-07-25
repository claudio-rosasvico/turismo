<?php

namespace App\Http\Controllers;

use App\Models\Cotizacion;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CotizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cotizaciones.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proveedores = Proveedor::all();
        return view('cotizaciones.create', compact('proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $cotizacion = $request->validate([
            'nombre' => 'required|string|max:255',
            'expediente' => 'required|string|max:255',
            'precio_estimado' => 'required',
            'fecha_autorizacion' => 'nullable|date',
            'fecha_reso_llamado' => 'nullable|date',
            'numero' => 'nullable',
            'fecha_llamado' => 'nullable|date',
            'hora_llamado' => 'nullable',
            'fecha_reso_adjudicacion' => 'nullable|date',
            'nro_reso_adjudicacion' => 'nullable',
            'descripcion' => 'nullable|string',
        ]);

        $cotizacion = Cotizacion::create($cotizacion);

        return redirect('/cotizaciones/show/'.$cotizacion->id);
    }

    /**
     * Display the specified resource.
     */
    public function show($cotizacion_id)
    {
        $cotizacion = Cotizacion::find($cotizacion_id);

        return view('cotizaciones.show')->with('cotizacion', $cotizacion);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($cotizacion_id)
    {
        $cotizacion = Cotizacion::find($cotizacion_id);
        $proveedores = Proveedor::all();
        return view('cotizaciones.create', compact(['proveedores' , 'cotizacion']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $cotizacion_id)
    {
        $cotizacion = Cotizacion::find($cotizacion_id);
        $request['proveedor_ganador_id'] = $request->input('proveedor_ganador_id') == 0 ? null : $request->input('proveedor_ganador_id');
        
        $cotizacionValidate = $request->validate([
            'nombre' => 'required|string|max:255',
            'expediente' => 'required|string|max:255',
            'precio_estimado' => 'required',
            'fecha_autorizacion' => 'nullable|date',
            'fecha_reso_llamado' => 'nullable|date',
            'numero' => 'nullable',
            'fecha_llamado' => 'nullable|date',
            'hora_llamado' => 'nullable',
            'fecha_reso_adjudicacion' => 'nullable|date',
            'nro_reso_adjudicacion' => 'nullable',
            'descripcion' => 'nullable|string',
        ]);
        $cotizacion->update($cotizacionValidate);

        return redirect()->route('cotizaciones.index')->with('success', 'Cotización actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cotizacion $cotizacion)
    {
        //
    }

    public function getOfertas($cotizacion_id){
        
        $cotizacion = Cotizacion::find($cotizacion_id);
        return view('cotizaciones.ofertas', compact('cotizacion'));
    }
}
