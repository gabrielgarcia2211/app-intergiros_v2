<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;


// RUTAS PARA CONTROL DE LOGIN
Route::get('/login', [LoginController::class, 'index_login'])->name('login.index');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/registro', [LoginController::class, 'index_registro'])->name('registro.index');
Route::post('/registro', [LoginController::class, 'registro'])->name('registro');

//RUTAS PARA CONTRASEÑA
Route::get('routes/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('routes/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('routes/password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('routes/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
