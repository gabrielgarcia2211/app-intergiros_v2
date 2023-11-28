<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/* Home */
Route::get('/', [HomeController::class, 'home'])->name('home');

/* Perfil */
Route::get('/perfil', [HomeController::class, 'perfil'])->name('perfil');
