<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Configuration\ConfigurationController;

Route::group(['prefix' => 'configuration', 'middleware' => [/* 'auth' */]], function() {
    Route::get('/gestor/{name}', [ConfigurationController::class, 'listChildrens'])->name('configuration.gestor');
    Route::get('/ids/{key}', [ConfigurationController::class, 'listValues'])->name('configuration.gestor');
    Route::get('/banco_moneda/{tipo_moneda}', [ConfigurationController::class, 'getBancoByMoneda'])->name('configuration.gestor');
    Route::get('/ci_moneda/{tipo_moneda}', [ConfigurationController::class, 'getTDByMoneda'])->name('configuration.gestor');
    Route::get('/bancos/{moneda}', [ConfigurationController::class, 'getBancosByCodigo'])->name('configuration.bancos.monedas');
    Route::get('/documento/{moneda}', [ConfigurationController::class, 'getDocumentoByMoneda'])->name('configuration.documento.monedas');
});

