<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Notificaciones\NotificacionesController;

Route::group(['prefix' => 'notificaciones', 'middleware' => ['auth']], function() {
    Route::get('/', [NotificacionesController::class, 'index'])->name('notificaciones.index');
    Route::get('/list', [NotificacionesController::class, 'getNotificaciones'])->name('administracion.list');
    Route::get('/status', [NotificacionesController::class, 'statusNotificaciones'])->name('administracion.status');
    Route::post('/update/{solicitudes}', [NotificacionesController::class, 'update'])->name('administracion.update');
});

