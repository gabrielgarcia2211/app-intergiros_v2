<?php

namespace App\Http\Controllers\ReferenciaBancaria;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController as Response;
use App\Models\Administracion\ReferenciaBancaria;
use App\Models\Administracion\TipoFormulario;

class ReferenciaBancariaController extends Controller
{

    public function getReferencias(Request $request)
    {
        try {
            $tipo_moneda_id = $request->input('tipo_moneda_id');
            $tipo_formulario_id = $request->input('tipo_formulario_id');
            $formulario = TipoFormulario::where('id', $tipo_formulario_id)->get(['descripcion'])->toArray() ?? [];
            $data = ReferenciaBancaria::where('tipo_moneda_id', $tipo_moneda_id)
                ->orWhereIn('banco', $formulario)
                ->get();
            return Response::sendResponse($data, 'Registros obtenidos con exito.');
        } catch (\Exception $ex) {
            Log::debug($ex->getLine());
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }
}
