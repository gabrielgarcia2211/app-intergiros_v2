<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\FileService;
use App\Models\Registro\UserRedes;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Login\loginRequest;
use App\Http\Requests\Login\RegistroRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\ResponseController as Response;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->middleware('guest')->except('logout');
        $this->fileService = $fileService;
    }

    public function index_login()
    {
        return view('auth.login');
    }

    public function index_registro()
    {
        return view('auth.register');
    }

    public function login(loginRequest $request)
    {
        $user = User::where('email', $request['email'])
            ->get();

        if (count($user) > 0) {
            if (!is_null($user) && Hash::check($request['password'], $user->first()->password)) {
                $this->guard()->login($user[0]);
                return Response::sendResponse($user, 'Inicio exitoso.');
            }
        }

        return Response::sendError("Algunos datos ingresados son incorrectos. Si olvidaste tu contraseña, haz clic en 'Recuperar'.", 422);
    }

    public function registro(RegistroRequest $request)
    {

        try {
            $form_info_general = $request->all()['formInfoGeneral'];
            $form_password = $request->all()['formPassword'];
            $form_info_redes = $request->all()['formRedes'];
            $form_verificacion = $request->all()['formVerificacion'];

            if ($form_password['inputPassword1'] !== $form_password['inputPassword2']) {
                return Response::sendError('Las contraseñas no coinciden', 500);
            }

            $user = new User();
            $user_redes_fk = new UserRedes();
            $user_redes_ig = new UserRedes();

            $user->name = $form_info_general['nombre'];
            $user->email = $form_info_general['email'];
            $user->apellidos = $form_info_general['apellidos'];
            $user->fecha_nacimiento = $form_info_general['fehaNacimiento'];
            $user->fecha_nacimiento = $form_info_general['fehaNacimiento'];
            $user->password = Hash::make($form_password['inputPassword1']);

            // campos relacionados
            $user->pais_id = $form_info_general['pais'];
            $user->telefono = $form_info_general['telefono'];
            $user->pais_telefono_id = $form_info_general['paisTelefono'];
            $user->documento = $form_verificacion['documento'];
            $user->tipo_documento_id = $form_verificacion['tipoDocumento'];

            // campos de redes
            $user->save();

            if (isset($form_info_redes['nombreUsuario1']) && isset($form_info_redes['redes1'])) {
                $user_redes_fk->user_id = $user->id;
                $user_redes_fk->redes_id = $form_info_redes['redes1'];
                $user_redes_fk->nombre = $form_info_redes['nombreUsuario1'];
                $user_redes_fk->save();
            }

            if (isset($form_info_redes['nombreUsuario2']) && isset($form_info_redes['redes2'])) {
                $user_redes_ig->user_id = $user->id;
                $user_redes_ig->redes_id = $form_info_redes['redes2'];
                $user_redes_ig->nombre = $form_info_redes['nombreUsuario2'];
                $user_redes_ig->save();
            }

            if ((isset($form_verificacion['inputGroupFile01']) && !empty($form_verificacion['inputGroupFile01']))
                && (isset($form_verificacion['inputGroupFile02']) && !empty($form_verificacion['inputGroupFile02']))
            ) {
                $path_selfie = $this->fileService->saveFile($form_verificacion['inputGroupFile01'], $user->id, 'verificacion');
                $path_documento = $this->fileService->saveFile($form_verificacion['inputGroupFile02'], $user->id, 'verificacion');
                User::where('id', $user->id)->update([
                    'path_selfie' => $path_selfie,
                    'path_documento' => $path_documento,
                ]);
            }
            $this->guard()->login($user);
            return Response::sendResponse([], 'Registro guardado con exito.');
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }

    public function sendLoginResponse($request)
    {

        try {
            $ingreso_error = [];
            $user = User::where('email', $request['email'])->first();

            if ($user && Hash::check($request['password'], $user->password)) {
                $this->guard()->login($user);

                if ($user->hasRole('admin')) {
                    return redirect('/admin');
                }
                return redirect('');
            } else {
                array_push($ingreso_error, '¡Los datos ingresados son incorrectos!');
                return view('home.inicioSesion')->with(compact('ingreso_error'));;
            }
        } catch (\Exception $ex) {
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        return $this->loggedOut($request) ?: redirect('/');
    }
}
