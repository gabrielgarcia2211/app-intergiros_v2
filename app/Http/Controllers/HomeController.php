<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{

    public function home()
    {
        return view('home');
    }

    public function pago()
    {
        return view('envio.pagopaypal');
    }
}
