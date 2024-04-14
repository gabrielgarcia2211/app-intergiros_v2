<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Terceros\TercerosController;

Route::group(['prefix' => 'terceros', 'middleware' => ['auth']], function() {
    Route::get('/list/{code}/{service}', [TercerosController::class, 'getTerceros'])->name('terceros.list');
    Route::get('/show/{id}/{code}/{service}', [TercerosController::class, 'showTercero'])->name('terceros.show');
    Route::post('/store', [TercerosController::class, 'storeTercero'])->name('terceros.store');
    Route::post('/update/{tercero}', [TercerosController::class, 'updateTercero'])->name('terceros.update');
    Route::post('/destroy/{tercero}/{code}', [TercerosController::class, 'destroyTercero'])->name('terceros.destroy');
    Route::post('/destroy/path_document', [TercerosController::class, 'destroyPathDocument'])->name('terceros.destroy');
});

