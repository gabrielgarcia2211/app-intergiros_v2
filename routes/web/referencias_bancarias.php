<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReferenciaBancaria\ReferenciaBancariaController;


Route::group(['prefix' => 'referencias', 'middleware' => ['auth' ]], function() {
    Route::post('/list', [ReferenciaBancariaController::class, 'getReferencias'])->name('solicitudes.pago');
});

