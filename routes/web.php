<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SalonesController;
use App\Http\Controllers\ServiController;
use App\Http\Controllers\ServiciosOtrosController;

use App\Http\Controllers\ReservaController;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [AuthController::class, 'index'])->name('home');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logados', [AuthController::class, 'logados'])->name('logados');

Route::get('/salones', [SalonesController::class, 'mostrarSalones'])->name('salones.index');
Route::get('/servicios', [ServiController::class, 'serviciosVer'])->name('ser.servicio');
Route::get('/otroServicio', [ServiciosOtrosController::class, 'OtrosVer'])->name('otros.OtroServicios');

Route::get('/reserva', [ReservaController::class, 'reservaSalon'])->name('topbar.Reserva');