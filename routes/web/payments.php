<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Payments\PaypalController;

Route::group(['prefix' => 'paypal', 'middleware' => ['auth']], function () {
    Route::post('/pay', [PaypalController::class, 'pay'])->name('paypal.pay');
    Route::get('/status', [PaypalController::class, 'execute'])->name('paypal.status');
    Route::get('/success', [PaypalController::class, 'success'])->name('paypal.success');
    Route::get('/cancel', [PaypalController::class, 'cancel'])->name('paypal.cancel');
});
