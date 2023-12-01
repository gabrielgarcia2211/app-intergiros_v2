<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\TokenGenerated;
use App\Models\Perfil\Token;
use Illuminate\Http\Request;
use App\Models\Registro\UserRedes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Token\StoreTokenRequest;
use App\Http\Requests\Perfil\UpdateUserRequest;
use App\Http\Controllers\ResponseController as Response;

class HomeController extends Controller
{

    public function home()
    {
        return view('home');
    }

    public function perfil()
    {
        return view('perfil.index');
    }

    public function getUser()
    {
        $user = User::where('id', Auth()->user()->id)->with(['user_redes'])->get()[0];
        return Response::sendResponse($user, 'Registro obtenido con exito.');
    }

    public function setToken(StoreTokenRequest $request)
    {
        try {
            $token = Token::create([
                'user_id' => Auth()->user()->id,
                'token' => $request->all()['token'],
                'expires_at' => now()->addMinutes(5),
            ]);
            // Enviar el correo electrónico - Auth()->user()->email
            Mail::to("garciaquinteroga@gmail.com")->send(new TokenGenerated($token));

            return Response::sendResponse($token, 'Token generado con exito.');
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }

    public function updateUser(UpdateUserRequest $request)
    {

        DB::beginTransaction();

        try {

            $formActualizarInfo = $request->input()["formActualizarInfo"];

            $user = User::find(Auth()->user()->id);

            $user->pais_id = $formActualizarInfo["pais"];
            $user->telefono = $formActualizarInfo["telefono"];
            $user->pais_telefono_id = $formActualizarInfo["paisTelefono"];
            $user->fecha_nacimiento = $formActualizarInfo["fehaNacimiento"];

            if (isset($formActualizarInfo["inputPassword2"]) && !empty($formActualizarInfo["inputPassword2"])) {
                $user->password = Hash::make($formActualizarInfo["inputPassword2"]);
            }

            UserRedes::where("user_id",  Auth()->user()->id)->delete();

            if (isset($formActualizarInfo["nombreUsuario1"]) && isset($formActualizarInfo["redes1"])) {
                UserRedes::create([
                    "user_id" => Auth()->user()->id,
                    "redes_id" => $formActualizarInfo["redes1"],
                    "nombre" => $formActualizarInfo["nombreUsuario1"],
                ]);
            }

            if (isset($formActualizarInfo["nombreUsuario2"]) && isset($formActualizarInfo["redes2"])) {
                UserRedes::create([
                    "user_id" => Auth()->user()->id,
                    "redes_id" => $formActualizarInfo["redes2"],
                    "nombre" => $formActualizarInfo["nombreUsuario2"],
                ]);
            }

            Log::Debug($request->all());

            $user->save();

            DB::commit();
            return Response::sendResponse($user, 'Perfil actualizado con exito.');
        } catch (\Exception $ex) {
            DB::rollback();
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }
}
