<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Historial\HistorialController;

Route::group(['prefix' => 'historial', 'middleware' => ['auth']], function() {
    Route::get('/', [HistorialController::class, 'index'])->name('historial');
    Route::get('/solicitudes/{estado}', [HistorialController::class, 'getSolicitudes'])->name('historial.solicitudes');
});

