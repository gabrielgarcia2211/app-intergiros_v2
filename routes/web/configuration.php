<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Configuration\ConfigurationController;

Route::group(['prefix' => 'configuration', 'middleware' => [/* 'auth' */]], function() {
    Route::get('/gestor/{name}', [ConfigurationController::class, 'listChildrens'])->name('configuration.gestor');
    Route::get('/ids/{key}', [ConfigurationController::class, 'listValues'])->name('configuration.gestor');
    Route::get('/moneda/{tipo_moneda}', [ConfigurationController::class, 'getMoneda'])->name('configuration.gestor');
});

