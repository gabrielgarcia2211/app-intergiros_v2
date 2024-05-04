<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Notificaciones\NotificacionesController;

Route::group(['prefix' => 'notificaciones', 'middleware' => ['auth']], function() {
    Route::get('/', [NotificacionesController::class, 'index'])->name('notificaciones.index');
    Route::get('/list', [NotificacionesController::class, 'getNotificaciones'])->name('notificaciones.list');
    Route::get('/status', [NotificacionesController::class, 'statusNotificaciones'])->name('notificaciones.status');
    Route::post('/update', [NotificacionesController::class, 'update'])->name('notificaciones.update');
});

