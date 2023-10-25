<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
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
        dd($request->all());
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
