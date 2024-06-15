<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Solicitudes\SolicitudesController;

Route::group(['prefix' => 'solicitudes', 'middleware' => ['auth' ]], function() {
    Route::post('/pago', [SolicitudesController::class, 'create'])->name('solicitudes.pago');
    Route::get('/proceso', [SolicitudesController::class, 'indexPago'])->name('solicitudes.proceso');
    Route::get('/paypal/{id}', [SolicitudesController::class, 'getSolicitudPaypal'])->name('solicitudes.get');
    Route::post('/update/estado/{id}', [SolicitudesController::class, 'getUpdateEstado'])->name('solicitudes.get');
});

