<?php

namespace App\Http\Controllers\Historial;

use App\Services\FileService;
use Illuminate\Support\Facades\DB;
use App\Models\Historial\Historial;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Solicitudes\Solicitudes;
use App\Models\Configuration\MasterCombos;
use App\Models\Administracion\TipoFormulario;
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
            $query = Solicitudes::select('solicitudes.*')
                ->join('master_combos as mc_estado', 'mc_estado.id', '=', 'solicitudes.estado_id')
                ->where([
                    'user_id' => Auth()->user()->id,
                ]);
            if ($estado == 'pendiente') {
                $query->whereIn('mc_estado.code', [
                    'pendiente_depositante',
                    'pendiente_beneficiario',
                    'pendiente_monto'
                ]);
            } else {
                $query->where('mc_estado.code', $estado);
            }
            $data = $query->with(Solicitudes::RELATIONS)->get();
            return Response::sendResponse($data, "Informacion Obtenida");
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }

    public function store(StoreHistorialRequest $request)
    {
        DB::beginTransaction();
        try {
            $historial = new Historial;
            $historial->comentarios = $request->comentario;
            $historial->solicitud_id = $request->solicitud_id;
            $historial->tercero_id = $request->tercero_id;
            $historial->opciones = $request->opcion ?? null;
            if (isset($request->estadoCuenta) && !empty($request->estadoCuenta)) {
                $path_selfie = $this->fileService->saveFile($request->estadoCuenta, Auth()->user()->id, 'verificacion_cuenta');
                $historial->path_estado_cuenta = $path_selfie;
            }
            $historial->save();
            $listOptions = MasterCombos::where('id', $request->opcion)->first();
            if ($listOptions && $listOptions->code == 'reintentar_beneficiario_pr') {
                Solicitudes::where('id', $request->solicitud_id)->update([
                    $request->field_update => $request->tercero_id
                ]);
            } else {
                if ($request->field_update == 'monto') {
                    $monto_a_pagar = clearText($request->input('monto')['monto_a_pagar']);
                    $monto_a_recibir = clearText($request->input('monto')['monto_a_recibir']);
                    $solicitud = Solicitudes::find($request->solicitud_id);
                    $formulario = TipoFormulario::find($solicitud->tipo_formulario_id);
                    $solicitud->monto_a_pagar = $monto_a_pagar;
                    $solicitud->monto_a_recibir = $monto_a_recibir;
                    if (in_array($formulario->codigo, ['TP-01'])) {
                        $monto_a_pagar_comision = $request->input('monto')['monto_a_pagar_comision'];
                        $solicitud->monto_a_pagar_comision = $monto_a_pagar_comision;
                    }
                    $solicitud->save();
                }
            }
            DB::commit();
            return Response::sendResponse($historial, 'Registro guardado con exito.');
        } catch (\Exception $ex) {
            DB::rollBack();
            Log::debug($ex->getLine());
            Log::debug($ex->getMessage());
            return Response::sendError("Ocurrio un error inesperado al intentar procesar la solicitud", 500);
        }
    }
}
