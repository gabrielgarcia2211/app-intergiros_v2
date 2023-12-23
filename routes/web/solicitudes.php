<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Solicitudes\SolicitudesController;

Route::group(['prefix' => 'solicitudes', 'middleware' => ['auth' ]], function() {
    Route::get('/', [SolicitudesController::class, 'index'])->name('pago.index');
    Route::post('/pago', [SolicitudesController::class, 'initSolicitud'])->name('solicitudes.pago');
});

