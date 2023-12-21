<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Configuration\ConfigurationController;

Route::group(['prefix' => 'configuration', 'middleware' => [/* 'auth' */]], function() {
    Route::get('/gestor/{name}', [ConfigurationController::class, 'listChildrens'])->name('emplazamientos.gestor');
});
