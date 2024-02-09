<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Administracion\TipoMoneda;
use App\Models\Administracion\TipoFormulario;
use App\Http\Controllers\ResponseController as Response;
use App\Models\Solicitudes\Solicitudes;

class AdministracionController extends Controller
{

    public function index()
    {
        return view('admin.index');
    }

    public function tasas()
    {
        return view('admin.tasas');
    }

    public function verificar()
    {
        return view('admin.verificacion');
    }

    public function envios()
    {
        return view('admin.envios');
    }

    public function noticias()
    {
        return view('admin.noticias');
    }

    public function getSolicitudes(Request $request)
    {
        try {
            $query = $this->setQuery();
            return renderDataTable(
                $query,
                $request,
                [],
                [
                    'solicitudes.*'
                ]
            );
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return Response::sendError("Ocurrio un error inesperado al intentar procesar la solicitud", 500);
        }
    }

    public function getForms($principal)
    {
        return TipoFormulario::where([
            'principal' => $principal
        ])->get();
    }

    public function getMonedas()
    {
        return TipoMoneda::all();
    }

    private function setQuery()
    {
        return Solicitudes::query();
    }
}
