<?php

namespace App\Http\Controllers\Historial;

use App\Services\FileService;
use App\Models\Historial\Historial;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Solicitudes\Solicitudes;
use App\Http\Requests\Historial\StoreHistorialRequest;
use App\Http\Controllers\ResponseController as Response;

class HistorialController extends Controller
{

    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function index()
    {
        return view('envio.historial');
    }

    public function getSolicitudes($estado)
    {
        try {
            $data = Solicitudes::select('solicitudes.*')
                ->join('master_combos as mc_estado', 'mc_estado.id', '=', 'solicitudes.estado_id')
                ->where([
                    'user_id' => Auth()->user()->id,
                    'mc_estado.code' => $estado
                ])->with(Solicitudes::RELATIONS)
                ->get();
            return Response::sendResponse($data, "Informacion Obtenida");
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }

    public function store(StoreHistorialRequest $request)
    {
        try {
            $historial = new Historial;
            $historial->comentarios = $request->comentario;
            $historial->solicitud_id = $request->solicitud_id;
            $historial->beneficiario_id = $request->beneficiario_id;
            $historial->opciones = json_encode($request->opciones);
            if (isset($request->estadoCuenta) && !empty($request->estadoCuenta)) {
                $path_selfie = $this->fileService->saveFile($request->estadoCuenta, Auth()->user()->id, 'verificacion_cuenta');
                $historial->path_estado_cuenta = $path_selfie;
            }
            $historial->save();
            return Response::sendResponse($historial, "Registro guardado con exito.");
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return Response::sendError("Ocurrio un error inesperado al intentar procesar la solicitud", 500);
        }
    }
}
