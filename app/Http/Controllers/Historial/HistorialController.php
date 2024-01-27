<?php

namespace App\Http\Controllers\Historial;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController as Response;
use App\Models\Solicitudes\Solicitudes;
use Illuminate\Support\Facades\Auth;

class HistorialController extends Controller
{
    public function index()
    {
        return view('envio.historial');
    }

    public function getSolicitudes($estado)
    {
        try {
            return Solicitudes::join('master_combos as mc_estado', 'mc_estado.id', '=', 'solicitudes.estado_id')
                ->where([
                    'user_id' => Auth()->user()->id,
                    'mc_estado.code' => $estado
                ])->with(Solicitudes::RELATIONS)
                ->get();
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }
}
