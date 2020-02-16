<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Balance;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $saldo = Balance::obtenerSaldo();

        return view('index', ['jumboTitle' => 'Bienvenido a Cloud Banking!', 'jumboDesc' => 'En este sitio poder operar con tu cuenta mirando el balance, haciendo transferencias, pagando servicios y armando inversiones!', 'saldo' => $saldo]);
    }
}