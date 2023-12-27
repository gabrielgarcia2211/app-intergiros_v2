<?php

namespace App\Http\Controllers\Notificaciones;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Solicitudes\Solicitudes;
use App\Http\Controllers\ResponseController as Response;

class NotificacionesController extends Controller
{
    public function index()
    {
        return view('notificaciones.index');
    }

    public function getNotificaciones()
    {
        try {
            $user_id = Auth::user()->id;
            $hoy = Carbon::today();

            $nuevas = Solicitudes::where('user_id', $user_id)
                ->whereDate('created_at', $hoy)
                ->where([
                    'notificacion' => 1
                ])
                ->with('estado')
                ->get();

            $anteriores = Solicitudes::where('user_id', $user_id)
                ->whereNotIn('id', $nuevas->pluck('id')->toArray())
                ->with('estado')
                ->get();

            return Response::sendResponse([
                'nuevas' => $nuevas,
                'anteriores' => $anteriores,
            ], 'Registros obtenidos con exito.');
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }

    public function update(Request $request, Solicitudes $Solicitudes)
    {
        return $Solicitudes->update([
            'notificacion' => 0
        ]);
    }

    public function statusNotificaciones()
    {
        try {
            $user_id = Auth::user()->id;
            $hoy = Carbon::today();

            $nuevas = Solicitudes::where('user_id', $user_id)
                ->whereDate('created_at', $hoy)
                ->where([
                    'notificacion' => 1
                ])
                ->with('estado')
                ->get();

            return Response::sendResponse([
                'nuevas' => count($nuevas) > 0,
            ], 'Registros obtenidos con exito.');
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }
}
