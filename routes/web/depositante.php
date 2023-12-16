<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Depositante\DepositanteController;


Route::group(['prefix' => 'depositante', 'middleware' => ['auth']], function () {
    Route::get('/list', [DepositanteController::class, 'getDepositantes'])->name('depositante.list');
    Route::get('/show/{id}', [DepositanteController::class, 'show'])->name('depositante.show');
    Route::post('/store', [DepositanteController::class, 'store'])->name('depositante.store');
    Route::post('/update/{depositante}', [DepositanteController::class, 'update'])->name('depositante.update');
    Route::post('/destroy/{depositante}', [DepositanteController::class, 'destroy'])->name('depositante.destroy');
});
