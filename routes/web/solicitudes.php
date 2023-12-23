<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Solicitudes\SolicitudesController;

Route::group(['prefix' => 'solicitudes', 'middleware' => ['auth' ]], function() {
    Route::post('/pago', [SolicitudesController::class, 'initSolicitud'])->name('solicitudes.pago');
    Route::get('/proceso', [SolicitudesController::class, 'indexPago'])->name('solicitudes.proceso');
    Route::get('/{id}', [SolicitudesController::class, 'getSolicitud'])->name('solicitudes.get');
});

