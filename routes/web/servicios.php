<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Servicios\ServiciosController;

Route::group(['prefix' => 'servicios', 'middleware' => ['auth']], function() {
    Route::get('/', [ServiciosController::class, 'index'])->name('servicios.index');
});