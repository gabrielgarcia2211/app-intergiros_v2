<?php

namespace App\Http\Controllers\Solicitudes;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Depositante\Depositante;
use App\Models\Configuration\MasterCombos;
use App\Http\Controllers\ResponseController as Response;
use App\Http\Requests\Solicitudes\StoreSolicitudRequest;

class SolicitudesController extends Controller
{

    public function index()
    {
        return view('envio.index');
    }

    public function initSolicitud(StoreSolicitudRequest $request)
    {
        try {
            $depositante_id = $request->input('depositante_id');
            $beneficiario_id = $request->input('beneficiario_id');

            $estado = MasterCombos::whereRaw("parent_id = (SELECT id FROM master_combos WHERE code = 'estados_solicitud')")
                ->whereRaw("LOWER(name) = LOWER('pendiente')")
                ->get()
                ->first()->id;

            Log::debug($request->all());
            Log::debug($depositante_id);
            Log::debug($beneficiario_id);
            return Response::sendResponse(true, 'Registro obtenido con exito.');
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }
}
