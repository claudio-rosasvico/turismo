<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Imports\PartidaImport;
use App\Models\Partida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

    /* function importar_partida_CURL()
    {
        Log::info('Importar Partida con CURL');

        // URL del login
        $loginUrl = "https://portal1.entrerios.gov.ar:10443/proxy/01f15357/https/siaf.entrerios.gov.ar/siaf/start.asp?DataSource=produrac";

        // Credenciales del usuario
        $credentials = [
            'username' => '32909720',
            'password' => 'SDEyE2022*',
        ];

        // Archivo para guardar cookies
        $cookieFile = storage_path('app/cookies.txt');

        // Inicializar cURL
        $curl = curl_init();

        // Configurar cURL
        curl_setopt_array($curl, [
            CURLOPT_URL => $loginUrl,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($credentials),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true, // Seguir redirecciones
            CURLOPT_SSL_VERIFYPEER => 0,    // Ignorar verificación SSL (opcional)
            CURLOPT_COOKIEJAR => $cookieFile, // Guardar cookies en el archivo
            CURLOPT_COOKIEFILE => $cookieFile, // Leer cookies del archivo
            CURLOPT_TIMEOUT => 30,          // Tiempo máximo de espera
            CURLOPT_HEADER => true,         // Incluir encabezados en la respuesta
        ]);

        // Ejecutar la solicitud
        $response = curl_exec($curl);

        // Verificar si hubo errores
        if (curl_errno($curl)) {
            $error = curl_error($curl);
            Log::error('Error en cURL: ' . $error);
            curl_close($curl);
            return view('partidas.CURL', ['cookies' => null, 'error' => $error]);
        }

        curl_close($curl);

        // Leer las cookies del archivo para mostrarlas en la vista
        $cookies = file_exists($cookieFile) ? file_get_contents($cookieFile) : 'No se encontraron cookies';

        return view('partidas.CURL', ['cookies' => $cookies]);
    } */
}
