<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiController extends Controller
{
    public function serviciosVer()
    {
        return view('ser.servicio');
    }
}