<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [AuthController::class, 'index'])->name('home');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logados', [AuthController::class, 'logados'])->name('logados');

Route::get('/salones', [SalonesController::class, 'logados'])->name('salones');
Route::get('/servicios', [ServiciosController::class, 'logados'])->name('servicio');
Route::get('/otroServicio', [OtroServicioController::class, 'logados'])->name('otroservicio');