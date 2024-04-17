<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SalonesController;
use App\Http\Controllers\ServiController;
use App\Http\Controllers\ServiciosOtrosController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\FacturaConfiguracionController;

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
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/salones', [SalonesController::class, 'mostrarSalones'])->name('salones.index');
Route::post('/guardarSalon', [SalonesController::class, 'guardarSalon'])->name('guardarSalon');
Route::put('/actualizarSalon', [SalonesController::class, 'actualizarSalon'])->name('actualizarSalon');
Route::get('/getSalones', [SalonesController::class, 'getSalones'])->name('getSalones');
Route::get('/getSalonesByNombre/{nombre}', [SalonesController::class, 'getSalonesByNombre'])->name('getSalonesByNombre');
Route::delete('/deleteSalon/{id}', [SalonesController::class, 'deleteSalon'])->name('deleteSalon');


Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes');
Route::post('/guardarCliente', [ClienteController::class, 'guardarCliente'])->name('guardarCliente');
Route::put('/actualizarCliente', [ClienteController::class, 'actualizarCliente'])->name('actualizarCliente');
Route::get('/getCliente', [ClienteController::class, 'getCliente'])->name('getCliente');
Route::get('/getClienteByNombre/{nombre}', [ClienteController::class, 'getClienteByNombre'])->name('getClienteByNombre');
Route::get('/getClienteById/{id}', [ClienteController::class, 'getClienteById'])->name('getClienteById');
Route::get('/getClienteByDocumento/{tipo}/{documento}', [ClienteController::class, 'getClienteByDocumento'])->name('getClienteByDocumento');


Route::get('/servicios', [ServiController::class, 'serviciosVer'])->name('ser.servicio');
Route::post('/servicios', [ServiController::class, 'guardar'])->name('guardar');
Route::put('/servicios', [ServiController::class, 'actualizar'])->name('actualizar');
Route::get('/buscarServicios', [ServiController::class, 'buscar'])->name('buscar');
Route::get('/getServicio', [ServiController::class, 'getServicio'])->name('getServicio');
Route::delete('/deleteServicio/{id}', [ServiController::class, 'deleteServicio'])->name('deleteServicio');

Route::get('/otroServicio', [ServiciosOtrosController::class, 'OtrosVer'])->name('otros.OtroServicios');
Route::post('/guardarOtroServicio', [ServiciosOtrosController::class, 'guardarOtroServicio'])->name('guardarOtroServicio');
Route::put('/actualizarOtroServicio', [ServiciosOtrosController::class, 'actualizarOtroServicio'])->name('actualizar');
Route::get('/buscarOtroServicios', [ServiciosOtrosController::class, 'buscarOtroServicios'])->name('buscar');
Route::get('/getOtroServicio/{nombre}', [ServiciosOtrosController::class, 'getOtroServicio'])->name('getServicio');
Route::delete('/deleteOtrServicio/{id}', [ServiciosOtrosController::class, 'deleteOtrServicio'])->name('deleteServicio');

Route::get('/reserva', [ReservaController::class, 'reservaSalon'])->name('topbar.Reserva');
Route::post('/guardarOrden', [ReservaController::class, 'guardarOrden'])->name('guardarOrden');
Route::get('/buscarOrden/{numeroOrden}', [ReservaController::class, 'buscarOrden'])->name('buscarOrden');

Route::get('/factura', [FacturaController::class, 'index'])->name('factura');
Route::post('/guardarFactura', [FacturaController::class, 'guardarFactura'])->name('guardarFactura');
/*Route::put('/actualizarOtroServicio', [ServiciosOtrosController::class, 'actualizarOtroServicio'])->name('actualizar');
Route::get('/buscarOtroServicios', [ServiciosOtrosController::class, 'buscarOtroServicios'])->name('buscar');
Route::get('/getOtroServicio/{nombre}', [ServiciosOtrosController::class, 'getOtroServicio'])->name('getServicio');
Route::delete('/deleteOtrServicio/{id}', [ServiciosOtrosController::class, 'deleteOtrServicio'])->name('deleteServicio');*/

Route::get('/factura-configuracion', [FacturaConfiguracionController::class, 'index'])->name('factura.configuracion');
Route::post('/guardarFacturaConfiguracion', [FacturaConfiguracionController::class, 'guardarFacturaConfiguracion'])->name('guardarFacturaConfiguracion');
Route::put('/actualizarFacturaConfiguracion', [FacturaConfiguracionController::class, 'actualizarFacturaConfiguracion'])->name('actualizarFacturaConfiguracion');
Route::get('/buscarResoluciones', [FacturaConfiguracionController::class, 'buscarResoluciones'])->name('buscarResoluciones');
Route::get('/getResolucion/{estado}', [FacturaConfiguracionController::class, 'getResolucion'])->name('getResolucion');
