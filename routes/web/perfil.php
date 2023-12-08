<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/* Home */
Route::get('/home', [HomeController::class, 'home'])->name('home');

/* Envio */
Route::get('/servicios', [HomeController::class, 'envio'])->name('envio');

/* Perfil */
Route::group(['prefix' => 'perfil'], function() {
    Route::get('/', [HomeController::class, 'perfil'])->name('perfil');
    Route::get('/user', [HomeController::class, 'getUser'])->name('perfil.user');
    Route::post('/token', [HomeController::class, 'setToken'])->name('perfil.token');
    Route::post('/update', [HomeController::class, 'updateUser'])->name('perfil.update');
});

