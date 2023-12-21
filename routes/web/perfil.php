<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/* Home */

Route::get('/', function(){
    return view('home');
});

/* Pago paypal se deja aqui para trabajar mientras, esta apgina tendra su propia ur externa */
Route::get('/pago', [HomeController::class, 'pago'])->name('pago');

/* Notificaciones generales */
Route::get('/notificaciones', [HomeController::class, 'notificaciones'])->name('notificaciones');


Route::get('/home', [HomeController::class, 'home'])->name('home');

/* Envio */
Route::get('/servicios', [HomeController::class, 'envio'])->name('servicios');

/* Perfil */
Route::group(['prefix' => 'perfil', 'middleware' => ['auth']], function() {
    Route::get('/', [HomeController::class, 'perfil'])->name('perfil');
    Route::get('/user', [HomeController::class, 'getUser'])->name('perfil.user');
    Route::post('/token', [HomeController::class, 'setToken'])->name('perfil.token');
    Route::post('/user/update', [HomeController::class, 'updateUser'])->name('perfil.user.update');
    Route::post('/verification/update', [HomeController::class, 'updateVerification'])->name('perfil.verification');
});

