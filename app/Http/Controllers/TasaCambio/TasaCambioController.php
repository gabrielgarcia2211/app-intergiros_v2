<?php

namespace App\Http\Controllers\TasaCambio;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Administracion\TasaCambio;
use App\Http\Controllers\ResponseController as Response;

class TasaCambioController extends Controller
{

    public function getTasaCambio()
    {
        try {
            $data = TasaCambio::leftJoin('tipo_formulario', 'tipo_formulario.id', '=', 'tasa_cambio.tipo_formulario_id')
                ->whereIn('tipo_formulario.codigo', ['TP-01', 'TP-02', 'TP-03', 'TP-04', 'TP-05', 'TP-06', 'TP-07', 'TP-08'])
                ->get();
            return Response::sendResponse($data, 'Registros obtenidos con exito.');
        } catch (\Exception $ex) {
            Log::debug($ex->getLine());
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }
}
