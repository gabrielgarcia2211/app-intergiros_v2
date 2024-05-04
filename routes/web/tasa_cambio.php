<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasaCambio\TasaCambioController;


Route::group(['prefix' => 'tasa-cambio', 'middleware' => [/* 'auth' */]], function () {
    Route::get('/list', [TasaCambioController::class, 'getTasaCambio'])->name('tasa_cambio.list');
    Route::post('/convert', [TasaCambioController::class, 'convertTasa'])->name('tasa_cambio.convert');
    Route::post('/convert/calculadora', [TasaCambioController::class, 'operationsCalc'])->name('tasa_cambio.convert.calculadora');
});
