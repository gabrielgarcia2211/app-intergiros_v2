<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administracion\AdministracionController;

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/', [AdministracionController::class, 'index'])->name('administracion.index')->middleware('role:admin');
    Route::get('/tasas', [AdministracionController::class, 'tasas'])->name('administracion.tasas')->middleware('role:admin');
    Route::get('/verificacion', [AdministracionController::class, 'verificar'])->name('administracion.verificar')->middleware('role:admin');
    Route::get('/envios', [AdministracionController::class, 'envios'])->name('administracion.envios')->middleware('role:admin');
    Route::get('/noticias', [AdministracionController::class, 'noticias'])->name('administracion.noticias')->middleware('role:admin');
    Route::group(['prefix' => 'solicitudes'], function () {
        Route::get('/list', [AdministracionController::class, 'getSolicitudes'])->name('solicitudes.list');
    });
});
