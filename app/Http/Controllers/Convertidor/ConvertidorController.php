<?php

namespace App\Http\Controllers\Convertidor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Administracion\TipoFormulario;
use App\Http\Controllers\ResponseController as Response;

class ConvertidorController extends Controller
{
    public function getTasaConvert(Request $request)
    {
        if (!empty($request->input('tasa'))  && !empty($request->input('monto'))) {
            $codigo = $request->input('tasa');
            $monto = $request->input('monto');
            Log::debug($codigo);
            Log::debug($monto);
            $response = TipoFormulario::with('tasa_cambios')->where('codigo', $codigo)->first();
            if (in_array($codigo, ['TP-01'])) {
                $total = $monto * $response->tasa_cambios->valor;
                return Response::sendResponse(['monto_a_pagar' => number_format($total, 2, '.'), 'monto_a_recibir' => number_format($total, 2, '.')]);
            } else if (in_array($codigo, ['TP-01-VED'])) {
                $total = $monto * $response->tasa_cambios->valor;
                return Response::sendResponse(['monto_a_pagar' => number_format($total, 2, '.'), 'monto_a_recibir' => number_format($total, 2, '.')]);
            } else if (in_array($codigo, ['TP-01-PEN'])) {
                $total = $monto * $response->tasa_cambios->valor;
                return Response::sendResponse(['monto_a_pagar' => number_format($total, 2, '.'), 'monto_a_recibir' => number_format($total, 2, '.')]);
            } else if (in_array($codigo, ['TP-01-USD'])) {
                $total = $monto * $response->tasa_cambios->valor;
                return Response::sendResponse(['monto_a_pagar' => number_format($total, 2, '.'), 'monto_a_recibir' => number_format($total, 2, '.')]);
            } else if (in_array($codigo, ['TP-01-COP'])) {
                $total = $monto * $response->tasa_cambios->valor;
                return Response::sendResponse(['monto_a_pagar' => number_format($total, 2, '.'), 'monto_a_recibir' => number_format($total, 2, '.')]);
            } else if (in_array($codigo, ['TP-05'])) {
                $total = $monto * $response->tasa_cambios->valor;
                return Response::sendResponse(['monto_a_pagar' => number_format($total, 2, '.'), 'monto_a_recibir' => number_format($total, 2, '.')]);
            } else if (in_array($codigo, ['TP-07'])) {
                $total = $monto * $response->tasa_cambios->valor;
                return Response::sendResponse(['monto_a_pagar' => number_format($total, 2, '.'), 'monto_a_recibir' => number_format($total, 2, '.')]);
            } else if (in_array($codigo, ['TP-09'])) {
                $total = $monto * $response->tasa_cambios->valor;
                return Response::sendResponse(['monto_a_pagar' => number_format($total, 2, '.'), 'monto_a_recibir' => number_format($total, 2, '.')]);
            }
        }
        return Response::sendResponse(false, 'No hay informacion');
    }
}
