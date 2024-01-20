<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Noticias\NoticiaController;

Route::group(['prefix' => 'noticias', 'middleware' => ['auth']], function() {
    Route::get('/list', [NoticiaController::class, 'getNoticias'])->name('noticia.list');
    Route::get('/status', [NoticiaController::class, 'statusNoticias'])->name('noticia.status');
    Route::post('/update/{UserNoticia}', [NoticiaController::class, 'update'])->name('noticia.update');
});

