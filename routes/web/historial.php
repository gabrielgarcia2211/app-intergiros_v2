<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Historial\HistorialController;

Route::group(['prefix' => 'historial', 'middleware' => ['auth']], function() {
    Route::get('/', [HistorialController::class, 'index'])->name('historial');
    Route::post('/store', [HistorialController::class, 'store'])->name('historial.store');
    Route::post('/solicitudes', [HistorialController::class, 'getSolicitudes'])->name('historial.solicitudes');
});

