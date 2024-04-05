<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Mail\TokenGenerated;
use App\Models\Perfil\Token;
use App\Services\FileService;
use App\Models\Registro\UserRedes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Token\StoreTokenRequest;
use App\Http\Requests\Perfil\UpdateUserRequest;
use App\Http\Requests\Perfil\UpdateVerificationRequest;
use App\Http\Controllers\ResponseController as Response;

class UserController extends Controller
{
    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function perfil()
    {
        return view('perfil.index');
    }

    public function getUser()
    {
        $user = User::where('id', Auth()->user()->id)->with(['user_redes'])->get()[0];
        $user['path_documento'] = !empty($user['path_documento']) ? $this->fileService->getFileUrl($user['path_documento']) : null;
        $user['path_selfie'] = !empty($user['path_selfie']) ? $this->fileService->getFileUrl($user['path_selfie']) : null;

        return Response::sendResponse($user, 'Registro obtenido con exito.');
    }

    public function setToken(StoreTokenRequest $request)
    {
        try {

            $user = User::find(Auth()->user()->id);
            if (!$user->verificado) {
                return Response::sendError('El usuario no ha sido verificado', 422);
            }
            $token = Token::create([
                'user_id' => $user->id,
                'token' => $request->all()['token'],
                'expires_at' => now()->addMinutes(5),
            ]);
            Mail::to($user->email)->send(new TokenGenerated($token));
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
            $form_actualizar_info = $request->input()['formActualizarInfo'];

            $user = User::find(Auth()->user()->id);

            if (!$user->verificado) {
                return Response::sendError('El usuario no ha sido verificado', 403);
            }

            $user->pais_id = $form_actualizar_info['pais'];
            $user->telefono = $form_actualizar_info['telefono'];
            $user->pais_telefono_id = $form_actualizar_info['paisTelefono'];
            $user->fecha_nacimiento = $form_actualizar_info['fehaNacimiento'];

            if (isset($form_actualizar_info['inputPassword2']) && !empty($form_actualizar_info['inputPassword2'])) {
                $user->password = Hash::make($form_actualizar_info['inputPassword2']);
            }

            UserRedes::where('user_id',  Auth()->user()->id)->delete();
            if (isset($form_actualizar_info['nombreUsuario1']) && isset($form_actualizar_info['redes1'])) {
                UserRedes::create([
                    'user_id' => Auth()->user()->id,
                    'redes_id' => $form_actualizar_info['redes1'],
                    'nombre' => $form_actualizar_info['nombreUsuario1'],
                ]);
            }
            if (isset($form_actualizar_info['nombreUsuario2']) && isset($form_actualizar_info['redes2'])) {
                UserRedes::create([
                    'user_id' => Auth()->user()->id,
                    'redes_id' => $form_actualizar_info['redes2'],
                    'nombre' => $form_actualizar_info['nombreUsuario2'],
                ]);
            }

            $user->save();
            DB::commit();
            return Response::sendResponse($user, 'Perfil actualizado con exito.');
        } catch (\Exception $ex) {
            DB::rollback();
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }

    public function updateVerification(UpdateVerificationRequest $request)
    {
        DB::beginTransaction();
        try {
            $form_verificacion = $request->all()['formVerificacion'];
            $user = User::find(Auth()->user()->id);
            $user->documento = $form_verificacion['documento'];
            $user->tipo_documento_id = $form_verificacion['tipoDocumento'];
            $this->fileService->deleteFile($user->path_selfie);
            $this->fileService->deleteFile($user->path_documento);
            $user->path_selfie = $this->fileService->saveFile($form_verificacion['inputGroupFile01'], Auth()->user()->id, 'verificacion');
            $user->path_documento = $this->fileService->saveFile($form_verificacion['inputGroupFile02'], Auth()->user()->id, 'verificacion');

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
