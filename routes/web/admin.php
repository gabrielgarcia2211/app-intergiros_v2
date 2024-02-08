<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administracion\AdministracionController;

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/', [AdministracionController::class, 'index'])->name('administracion.index')->middleware('role:admin');
    Route::group(['prefix' => 'solicitudes'], function () {
        Route::get('/list', [AdministracionController::class, 'getSolicitudes'])->name('solicitudes.list');
    });
});
