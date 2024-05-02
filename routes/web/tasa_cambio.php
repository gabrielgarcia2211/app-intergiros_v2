<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasaCambio\TasaCambioController;


Route::group(['prefix' => 'tasa-cambio', 'middleware' => ['auth' ]], function() {
    Route::get('/list', [TasaCambioController::class, 'getTasaCambio'])->name('solicitudes.pago');
});

