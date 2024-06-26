<?php

namespace App\Http\Controllers\Terceros;

use Illuminate\Http\Request;
use App\Services\FileService;
use App\Models\Terceros\Tercero;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Solicitudes\Solicitudes;
use App\Models\Beneficiario\Beneficiario;
use App\Models\Configuration\MasterCombos;
use App\Models\Administracion\TipoFormulario;
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

    public function getTerceros($code, $servicio, $filter = null)
    {
        try {
            $query = Tercero::select('terceros.id', 'terceros.nombre', 'terceros.alias')
                ->join('master_combos', 'master_combos.id', 'terceros.tipo_tercero_id')
                ->join('tipo_formulario', 'tipo_formulario.id', 'terceros.tipo_formulario_id')
                ->where([
                    'terceros.user_id' => Auth()->user()->id,
                    'master_combos.code' => $code,
                    'tipo_formulario.codigo' => $servicio
                ]);
            if (!empty($filter)) {
                $query->whereNotIn('terceros.id', [$filter]);
            }
            return $query->get();
        } catch (\Exception $ex) {
            Log::debug($ex->getLine());
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }

    public function showTercero($id, $code, $servicio)
    {
        $response = Tercero::select('terceros.*', 'mc_banco.id as banco_id')
            ->join('master_combos', 'master_combos.id', 'terceros.tipo_tercero_id')
            ->join('tipo_formulario', 'tipo_formulario.id', 'terceros.tipo_formulario_id')
            ->leftJoin('master_combos as mc_banco', 'mc_banco.id', 'terceros.banco_id')
            ->where([
                'terceros.id' => $id,
                'master_combos.code' => $code,
                'tipo_formulario.codigo' => $servicio
            ])
            ->first();
        $response['path_documento'] = !empty($response['path_documento']) ? $this->fileService->getFileUrl($response['path_documento']) : null;
        return Response::sendResponse($response, 'Registro obtenido con exito.');
    }

    public function storeTercero(StoreTerceroRequest $request)
    {
        try {
            $data = mapTipoTercero($request->all());
            $servicio = $request->input('servicio');
            $code = $request->input('code');

            $data['user_id'] = Auth()->user()->id;
            $data['tipo_tercero_id'] = MasterCombos::whereRaw("parent_id = (SELECT id FROM master_combos WHERE code = 'terceros')")
                ->whereRaw("LOWER(code) = LOWER('$code')")
                ->get()
                ->first()
                ->id;

            $data['tipo_formulario_id'] = TipoFormulario::where('codigo', $servicio)->first()->id;
            if (in_array($code, ['TD'])) {
                $data['path_documento'] = $this->fileService->saveFile($data['adjuntar_documento'], Auth()->user()->id, 'documento_tercero');
            }
            $tercero = Tercero::create($data);
            return Response::sendResponse($tercero, 'Registro guardado con exito.');
        } catch (\Exception $ex) {
            Log::debug($ex->getLine());
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }

    public function updateTercero(UpdateTerceroRequest $request, Tercero $Tercero)
    {
        try {
            $data = mapTipoTercero($request->all());
            $pattern = '/\bhttps?:\/\/\S+\b/';
            $code = $request->input('code');

            if (in_array($code, ['TD']) && !preg_match($pattern, $data['adjuntar_documento'])) {
                $this->fileService->deleteFile($Tercero->path_documento);
                $data['path_documento'] = $this->fileService->saveFile($data['adjuntar_documento'], Auth()->user()->id, 'documento_tercero');
                $data['adjuntar_documento'] = !empty($data['path_documento']) ? $this->fileService->getFileUrl($data['path_documento']) : null;
            }
            $Tercero->update($data);
            return Response::sendResponse($data, 'Registro actualizado con exito.');
        } catch (\Exception $ex) {
            Log::debug($ex->getLine());
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }

    public function destroyTercero(Tercero $Tercero, $code)
    {
        $solicitudes = Solicitudes::where('beneficiario_id', $Tercero->id)
            ->orWhere('depositante_id', $Tercero->id)
            ->exists();

        if ($solicitudes) {
            return Response::sendError('El depositante/beneficiario cuenta con una solicitud en el sistema', 400);
        }
        if ($Tercero->delete()) {
            if (in_array($code, ['TD'])) {
                $this->fileService->deleteFile($Tercero->path_documento);
            }
        }
        return Response::sendResponse(true, "Recurso eliminado con exito");
    }

    public function destroyPathDocument(Request $request)
    {
        $id = $request->input('id');
        $path_document = ltrim(parse_url($request->input('path_document'))['path'], '/comprobantes/');
        if ($this->fileService->deleteFile($path_document)) {
            Tercero::where('id', $id)->update([
                'path_documento' => null,
            ]);
        }
        return true;
    }

    public function getTercerosFiltered(Request $request)
    {
        try {
            $ids = $request->input('ids');
            $code = $request->input('code');
            $servicio = $request->input('servicio');
            return $this->getTerceros($code, $servicio, $ids);
        } catch (\Exception $ex) {
            Log::debug($ex->getLine());
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }
}
