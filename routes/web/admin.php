<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administracion\AdministracionController;

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/', [AdministracionController::class, 'envios'])->name('administracion.envios')->middleware('role:admin');
    Route::get('/tasas', [AdministracionController::class, 'tasas'])->name('administracion.tasas')->middleware('role:admin');
    Route::get('/verificacion', [AdministracionController::class, 'verificar'])->name('administracion.verificar')->middleware('role:admin');
    Route::get('/noticias', [AdministracionController::class, 'noticias'])->name('administracion.noticias')->middleware('role:admin');
    Route::group(['prefix' => 'solicitudes'], function () {
        Route::get('/list', [AdministracionController::class, 'getSolicitudes'])->name('solicitudes.list');
        Route::post('/path/img', [AdministracionController::class, 'getPathReal'])->name('solicitudes.list');
        Route::post('/up/voucher', [AdministracionController::class, 'createOrUpdateVoucher'])->name('solicitudes.list');
    });
    Route::group(['prefix' => 'tasas'], function () {
        Route::get('/list', [AdministracionController::class, 'getTasaCambio'])->name('tasas.list');
        Route::post('/update', [AdministracionController::class, 'updateTasaCambio'])->name('tasas.update');
    });
    Route::group(['prefix' => 'users'], function () {
        Route::get('/list', [AdministracionController::class, 'getUsersVerificados'])->name('tasas.list');
        Route::post('/update/{user}', [AdministracionController::class, 'updateUserVerificado'])->name('tasas.update');
    });
});
