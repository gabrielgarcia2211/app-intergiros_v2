<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administracion\AdministracionController;

Route::group(['prefix' => 'gestion', 'middleware' => ['auth']], function () {
    Route::get('/formularios/{principal}', [AdministracionController::class, 'getForms'])->name('administracion.formularios');
    Route::get('/monedas', [AdministracionController::class, 'getMonedas'])->name('administracion.monedas');
    Route::get('/monedas/{codigo}', [AdministracionController::class, 'getMonedaByCodigo'])->name('administracion.monedas');
});
