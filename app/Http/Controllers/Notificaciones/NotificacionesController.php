<?php

namespace App\Http\Controllers\Notificaciones;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Solicitudes\Solicitudes;
use App\Models\Solicitudes\SolicitudNotificacionLog;
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
            $nuevas = self::getNotificacionNueva($user_id);
            $anteriores = self::getNotificacionAnterior($user_id);
            return Response::sendResponse([
                'nuevas' => $nuevas,
                'anteriores' => $anteriores,
            ], 'Registros obtenidos con exito.');
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }

    private static function getNotificacionNueva($user_id)
    {
        return SolicitudNotificacionLog::select([
            'solicitud_notificacion_logs.id',
            'solicitudes.uuid',
            'master_combos.name',
            'master_combos.valor1',
            'master_combos.valor2',
            DB::raw("DATE_FORMAT(solicitud_notificacion_logs.created_at, '%Y-%m-%d %H:%i:%s') as formatted_created_at")
        ])
            ->join('solicitudes', 'solicitudes.id', '=', 'solicitud_notificacion_logs.solicitud_id')
            ->leftJoin('master_combos', 'master_combos.id', '=', 'solicitud_notificacion_logs.estado_id')
            ->where([
                'solicitud_notificacion_logs.read' => 1,
                'solicitud_notificacion_logs.delete' => 0,
                'solicitudes.user_id' => $user_id,
            ])
            ->get();
    }

    private static function getNotificacionAnterior($user_id)
    {
        return SolicitudNotificacionLog::select([
            'solicitud_notificacion_logs.id',
            'solicitudes.uuid',
            'master_combos.name',
            'master_combos.valor1',
            'master_combos.valor2',
            DB::raw("DATE_FORMAT(solicitud_notificacion_logs.created_at, '%Y-%m-%d %H:%i:%s') as formatted_created_at")
        ])
            ->join('solicitudes', 'solicitudes.id', '=', 'solicitud_notificacion_logs.solicitud_id')
            ->leftJoin('master_combos', 'master_combos.id', '=', 'solicitud_notificacion_logs.estado_id')
            ->where([
                'solicitud_notificacion_logs.read' => 0,
                'solicitud_notificacion_logs.delete' => 1,
                'solicitudes.user_id' => $user_id,
            ])
            ->get();
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        SolicitudNotificacionLog::where('id', $id)->update([
            'solicitud_notificacion_logs.read' => 0,
            'solicitud_notificacion_logs.delete' => 1,
        ]);
    }

    public function statusNotificaciones()
    {
        try {
            $user_id = Auth::user()->id;
            $nuevas = self::getNotificacionNueva($user_id);
            return Response::sendResponse([
                'nuevas' => count($nuevas) > 0,
            ], 'Registros obtenidos con exito.');
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }
}
