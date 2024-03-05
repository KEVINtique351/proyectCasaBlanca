<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function reservaSalon()
    {
        return view('topbar.Reserva');
    }
}