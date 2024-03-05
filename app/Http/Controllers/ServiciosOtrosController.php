<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiciosOtrosController extends Controller
{
    public function OtrosVer()
    {
        return view('otros.OtroServicios');
    }
}