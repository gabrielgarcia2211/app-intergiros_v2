<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administracion\AdministracionController;


Route::group(['prefix' => 'administracion', 'middleware' => ['auth']], function() {
    Route::get('/formularios/{principal}', [AdministracionController::class, 'getForms'])->name('administracion.formularios');
    Route::get('/monedas', [AdministracionController::class, 'getMonedas'])->name('administracion.monedas');
});

