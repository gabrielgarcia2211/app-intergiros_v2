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
use Carbon\Carbon;

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
            if ($request->input('password') !== $request->input('confirmPassword')) {
                return Response::sendError('Las contraseñas no coinciden', 500);
            }

            $user = new User();
            $user_redes_fk = new UserRedes();
            $user_redes_ig = new UserRedes();

            $user->name = $request->input('nombre');
            $user->apellidos =  $request->input('apellido');
            $user->email = $request->input('correo');
            $user->fecha_nacimiento = Carbon::parse($request->input('fehaNacimiento'))->format('Y-m-d');
            $user->password = Hash::make($request->input('password'));
            $user->verificado = 0;

            // campos relacionados
            $user->pais_id =  $request->input('pais');
            $user->telefono = $request->input('celular');
            $user->pais_telefono_id = $request->input('tipoCelular');
            $user->documento = $request->input('documento');
            $user->tipo_documento_id = $request->input('tipoDocumento');
            if (
                !empty($request->file('inputGroupFile01'))
                && !empty($request->file('inputGroupFile02'))
            ) {
                $path_selfie = $this->fileService->saveFile($request->file('inputGroupFile01'), $user->id, 'verificacion');
                $path_documento = $this->fileService->saveFile($request->file('inputGroupFile02'), $user->id, 'verificacion');
                $user->path_selfie = $path_selfie;
                $user->path_documento = $path_documento;
                $user->verificado = 3;
            }

            $user->save();
            // campos de redes
            if (!empty($request->input('red1')) && !empty($request->input('nombreRed1'))) {
                $user_redes_fk->user_id = $user->id;
                $user_redes_fk->redes_id = $request->input('red1');
                $user_redes_fk->nombre = $request->input('nombreRed1');
                $user_redes_fk->save();
            }

            if (!empty($request->input('red2')) &&  !empty($request->input('nombreRed2'))) {
                $user_redes_ig->user_id = $user->id;
                $user_redes_ig->redes_id = $request->input('red2');
                $user_redes_ig->nombre = $request->input('nombreRed2');
                $user_redes_ig->save();
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
