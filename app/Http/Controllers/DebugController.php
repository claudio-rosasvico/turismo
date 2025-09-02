<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\Partidas\GetAvailableBalance;
use App\Actions\Partidas\GetAllowedPartidasForUse;
use App\Actions\Pagos\GetPaymentsByProveedor;

class DebugController extends Controller
{
    public function partidaDisponible($codigo, GetAvailableBalance $action)
    {
        return response()->json($action->handle($codigo));
    }

    public function partidasParaUso($uso, GetAllowedPartidasForUse $action)
    {
        return response()->json($action->handle($uso));
    }

    public function pagosProveedor($proveedor, GetPaymentsByProveedor $action)
    {
        return response()->json($action->handle($proveedor));
    }
}
