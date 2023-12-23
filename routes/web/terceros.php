<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Terceros\TercerosController;

Route::group(['prefix' => 'terceros', 'middleware' => ['auth']], function() {
    Route::get('/list/{code}', [TercerosController::class, 'getTerceros'])->name('terceros.list');
    Route::get('/show/{id}/{code}', [TercerosController::class, 'showTercero'])->name('terceros.show');
    Route::post('/store', [TercerosController::class, 'storeTercero'])->name('terceros.store');
    Route::post('/update/{tercero}', [TercerosController::class, 'updateTercero'])->name('terceros.update');
    Route::post('/destroy/{tercero}/{code}', [TercerosController::class, 'destroyTercero'])->name('terceros.destroy');
});

