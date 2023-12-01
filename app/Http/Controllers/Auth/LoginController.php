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
            $formInfoGeneral = $request->all()["formInfoGeneral"];
            $formPassword = $request->all()["formPassword"];
            $formInfoRedes = $request->all()["formRedes"];
            $formVerificacion = $request->all()["formVerificacion"];

            if ($formPassword["inputPassword1"] !== $formPassword["inputPassword2"]) {
                return Response::sendError('Las contraseñas no coinciden', 500);
            }

            $user = new User();
            $user_redes_fk = new UserRedes();
            $user_redes_ig = new UserRedes();

            $user->name = $formInfoGeneral["nombre"];
            $user->email = $formInfoGeneral["email"];
            $user->apellidos = $formInfoGeneral["apellidos"];
            $user->fecha_nacimiento = $formInfoGeneral["fehaNacimiento"];
            $user->fecha_nacimiento = $formInfoGeneral["fehaNacimiento"];
            $user->password = Hash::make($formPassword["inputPassword1"]);

            // campos relacionados
            $user->pais_id = $formInfoGeneral["pais"];
            $user->telefono = $formInfoGeneral["telefono"];
            $user->pais_telefono_id = $formInfoGeneral["paisTelefono"];
            $user->documento = $formVerificacion["documento"];
            $user->tipo_documento_id = $formVerificacion["tipoDocumento"];

            // campos de redes
            $user->save();

            if (isset($formInfoRedes["nombreUsuario1"]) && isset($formInfoRedes["redes1"])) {
                $user_redes_fk->user_id = $user->id;
                $user_redes_fk->redes_id = $formInfoRedes["redes1"];
                $user_redes_fk->nombre = $formInfoRedes["nombreUsuario1"];
                $user_redes_fk->save();
            }

            if (isset($formInfoRedes["nombreUsuario2"]) && isset($formInfoRedes["redes2"])) {
                $user_redes_ig->user_id = $user->id;
                $user_redes_ig->redes_id = $formInfoRedes["redes2"];
                $user_redes_ig->nombre = $formInfoRedes["nombreUsuario2"];
                $user_redes_ig->save();
            }

            if ((isset($formVerificacion['inputGroupFile01']) && !empty($formVerificacion['inputGroupFile01']))
                && (isset($formVerificacion['inputGroupFile02']) && !empty($formVerificacion['inputGroupFile02']))
            ) {
                $path_selfie = $this->fileService->saveFile($formVerificacion['inputGroupFile01']);
                $path_documento = $this->fileService->saveFile($formVerificacion['inputGroupFile02']);
                User::where('id', $user->id)->update([
                    'path_selfie' => $path_selfie,
                    'path_documento' => $path_documento,
                ]);
            }

            return Response::sendResponse([], 'Registro guardado con exito.');
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }

    public function sendLoginResponse($request)
    {

        try {
            $ingresoError = [];
            $user = User::where('email', $request['email'])->first();

            if ($user && Hash::check($request['password'], $user->password)) {
                $this->guard()->login($user);

                if ($user->hasRole('admin')) {
                    return redirect('/admin');
                }
                return redirect('');
            } else {
                array_push($ingresoError, "¡Los datos ingresados son incorrectos!");
                return view('home.inicioSesion')->with(compact('ingresoError'));;
            }
        } catch (\Exception $ex) {
            return Response::sendError("Ocurrio un error inesperado al intentar procesar la solicitud", 500);
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        return $this->loggedOut($request) ?: redirect('/');
    }
}
