<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

Route::group(['prefix' => 'perfil', 'middleware' => ['auth']], function () {
    Route::get('/', [UserController::class, 'perfil'])->name('perfil');
    Route::get('/user', [UserController::class, 'getUser'])->name('perfil.user');
    Route::post('/token', [UserController::class, 'setToken'])->name('perfil.token');
    Route::post('/user/update', [UserController::class, 'updateUser'])->name('perfil.user.update');
    Route::post('/verification/update', [UserController::class, 'updateVerification'])->name('perfil.verification');
    Route::post('/foto', [UserController::class, 'updateFoto'])->name('perfil.user.foto');
    Route::post('/foto/delete', [UserController::class, 'deleteFoto'])->name('perfil.user.foto.delete');
});
