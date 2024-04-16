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
        if (!empty($request->input('tasa'))  && (!empty($request->input('monto')) && $request->input('monto') != 'null')) {
            $codigo = $request->input('tasa');
            $monto = $request->input('monto');
            $response = TipoFormulario::with('tasa_cambios')->where('codigo', $codigo)->first();
            if (empty($response)) {
                return false;
            } else if (in_array($codigo, [
                'TP-01',
                'TP-01-paypal-venezuela',
                'TP-01-paypal-peru',
                'TP-01-paypal-peru-dolar',
                'TP-01-paypal-colombia'
            ])) {
                $comision_fija = 0.3;
                $comision = (($monto + $comision_fija) * 100) / 94.6;
                $monto_a_recibir = $monto * $response->tasa_cambios->valor;
                return Response::sendResponse(['monto_a_pagar' => round($comision, 2), 'monto_a_recibir' => $monto_a_recibir]);
            } else {
                $total = $monto * $response->tasa_cambios->valor;
                return Response::sendResponse(['monto_a_pagar' => number_format($total, 2, '.'), 'monto_a_recibir' => number_format($total, 2, '.')]);
            }
        }
        return Response::sendResponse(false, 'No hay informacion');
    }
}
