<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Beneficiario\BeneficiarioController;


Route::group(['prefix' => 'beneficiario', 'middleware' => ['auth']], function() {
    Route::get('/list', [BeneficiarioController::class, 'getBeneficiarios'])->name('beneficiario.list');
    Route::get('/show/{id}', [BeneficiarioController::class, 'show'])->name('beneficiario.show');
    Route::post('/store', [BeneficiarioController::class, 'store'])->name('beneficiario.store');
    Route::post('/update/{beneficiario}', [BeneficiarioController::class, 'update'])->name('beneficiario.update');
    Route::post('/destroy/{beneficiario}', [BeneficiarioController::class, 'destroy'])->name('beneficiario.destroy');
});

