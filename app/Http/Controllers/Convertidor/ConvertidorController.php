<?php

namespace App\Http\Controllers\Convertidor;

use Illuminate\Http\Request;
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
            $response = TipoFormulario::with('tasa_cambios')->where('codigo', $codigo)->first();
            if (in_array($codigo, ['TP-01'])) {
                $total = $monto * $response->tasa_cambios->valor;
                return Response::sendResponse(['monto_a_pagar' => number_format($total, 2, '.'), 'monto_a_recibir' => number_format($total, 2, '.')]);
            }
        }
        return Response::sendResponse(false, 'No hay informacion');
    }
}
