<?php

namespace App\Http\Controllers;

use App\Imports\PartidaImport;
use App\Models\Partida;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PartidaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('partidas.index');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Partida $partida)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partida $partida)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partida $partida)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partida $partida)
    {
        //
    }

    function importar_partida(Request $request)
    {
        partida::truncate();

        $excel = $request->file('partida_importar');

        $import = new PartidaImport();

        Excel::import($import, $excel);

        return redirect('/partidas')->with('success', 'Proceso Completo');
    }
}
