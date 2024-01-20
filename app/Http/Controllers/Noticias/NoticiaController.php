<?php

namespace App\Http\Controllers\Noticias;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Noticias\Noticia;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Noticias\UserNoticia;
use Illuminate\Support\Facades\Auth;
use App\Models\Solicitudes\Solicitudes;
use App\Http\Controllers\ResponseController as Response;

class NoticiaController extends Controller
{
    public function getNoticias()
    {
        try {
            $user_id = Auth::user()->id;

            $nuevas = Noticia::join('users_noticias', 'users_noticias.noticia_id', '=', 'noticias.id')
                ->where([
                    'users_noticias.user_id' => $user_id,
                    'visible' => true
                ])->get([
                    'noticias.id',
                    'users_noticias.id as user_noticia_id',
                    'noticias.titulo',
                    'noticias.referencia',
                    'noticias.descripcion',
                    'noticias.created_at',
                ]);

            $anteriores = Noticia::join('users_noticias', 'users_noticias.noticia_id', '=', 'noticias.id')
                ->whereNotIn('noticias.id', $nuevas->pluck('id')->toArray())
                ->where([
                    'users_noticias.user_id' => $user_id,
                    'visible' => false
                ])->get([
                    'noticias.id',
                    'users_noticias.id as user_noticia_id',
                    'noticias.titulo',
                    'noticias.referencia',
                    'noticias.descripcion',
                    'noticias.created_at',
                ]);


            return Response::sendResponse([
                'nuevas' => $nuevas,
                'anteriores' => $anteriores,
            ], 'Registros obtenidos con exito.');
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }

    public function update(Request $request, UserNoticia $UserNoticia)
    {
        return $UserNoticia->update([
            'visible' => 0
        ]);
    }
}
