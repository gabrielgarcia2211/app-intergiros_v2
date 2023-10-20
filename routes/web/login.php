<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/login', [LoginController::class, 'index_login'])->name('login.index');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/registro', [LoginController::class, 'index_registro'])->name('registro.index');
Route::post('/registro', [LoginController::class, 'registro'])->name('registro');
Route::get('/restablecer', [LoginController::class, 'restablecer'])->name('restablecer');