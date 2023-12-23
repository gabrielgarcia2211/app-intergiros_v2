<?php

namespace App\Http\Controllers\Terceros;

use App\Services\FileService;
use App\Models\Terceros\Tercero;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Beneficiario\Beneficiario;
use App\Models\Configuration\MasterCombos;
use App\Http\Requests\Terceros\StoreTerceroRequest;
use App\Http\Requests\Terceros\UpdateTerceroRequest;
use App\Http\Controllers\ResponseController as Response;

class TercerosController extends Controller
{

    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function getTerceros($code)
    {
        return Tercero::select('terceros.*')
            ->join('master_combos', 'master_combos.id', 'terceros.tipo_tercero_id')
            ->where(['terceros.user_id' => Auth()->user()->id, 'master_combos.code' => $code])
            ->get();
    }

    public function showTercero($id, $code)
    {
        $response = Tercero::select('terceros.*')
            ->join('master_combos', 'master_combos.id', 'terceros.tipo_tercero_id')
            ->where(['terceros.id' => $id, 'master_combos.code' => $code])
            ->first();
        $response['path_documento'] = !empty($response['path_documento']) ? $this->fileService->getFileUrl($response['path_documento']) : null;
        return Response::sendResponse($response, 'Registro obtenido con exito.');
    }

    public function storeTercero(StoreTerceroRequest $request)
    {
        try {
            $data = mapTipoTercero($request->all());
            $code = $request->input('code');

            $data['user_id'] = Auth()->user()->id;
            $data['tipo_tercero_id'] = MasterCombos::whereRaw("parent_id = (SELECT id FROM master_combos WHERE code = 'terceros')")
                ->whereRaw("LOWER(code) = LOWER('$code')")
                ->get()
                ->first()->id;

            if (in_array($code, ['TD'])) {
                $data['path_documento'] = $this->fileService->saveFile($request->file('adjuntarDocumento'), Auth()->user()->id, 'documento_tercero');
            }

            $tercero = Tercero::create($data);
            return Response::sendResponse($tercero, 'Registro guardado con exito.');
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }

    public function updateTercero(UpdateTerceroRequest $request, Tercero $Tercero)
    {
        try {
            $data = mapTipoTercero($request->all());
            $code = $request->input('code');

            if (in_array($code, ['TD'])) {
                $this->fileService->deleteFile($Tercero->path_documento);
                $data['path_documento'] = $this->fileService->saveFile($request->file('adjuntarDocumento'), Auth()->user()->id, 'documento_tercero');
            }

            $tercero = $Tercero->update($data);
            return Response::sendResponse($tercero, 'Registro actualizado con exito.');
        } catch (\Exception $ex) {
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }

    public function destroyTercero(Tercero $Tercero, $code)
    {
        if (in_array($code, ['TD'])) {
            $this->fileService->deleteFile($Tercero->path_documento);
        }
        return Response::sendResponse($Tercero->delete(), "Recurso eliminado con exito");
    }
}
