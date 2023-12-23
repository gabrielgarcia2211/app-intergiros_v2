<?php

namespace App\Http\Controllers\Servicios;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController as Response;

class ServiciosController extends Controller
{
    public function index()
    {
        return view('envio.index');
    }
}
