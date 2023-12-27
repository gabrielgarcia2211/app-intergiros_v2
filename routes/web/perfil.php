<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/* Home */
Route::get('/', function(){
    return view('home');
});
Route::get('/home', [HomeController::class, 'home'])->name('home');

/* Notificaciones generales */




