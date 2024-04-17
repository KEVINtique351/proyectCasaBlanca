<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Orden\IOrdenAppService;

class ReservaController extends Controller
{

    protected $service;
    
    public function __construct(IOrdenAppService $ordenService)
    {
        $this->service = $ordenService;
    }

    public function reservaSalon()
    {
        return view('topbar.Reserva');
    }

    public function guardarOrden(Request $request){
        if (!auth()->check()) {
            $respuesta= array([
                "data"=> null,
                "message"=>"no se puede ejecutar el proceso, debe iniciar sesión",
                "error"=>true
            ]);
            return response()->json($respuesta,500); 
        }
        try {
            $fechaHoraActual = now()->format('YmdHisv');
            $numeroOrden = 'ORD-' . $fechaHoraActual;
            $datos = $request->only([                
                'fechaEvento',
                'idCliente',
                'subTotal',
                'deposito',
                'iva',
                'impuestoConsumo',
                'total',
                'detalleSalon',
                'detalleServicio',
                'detalleOtro',
                'estado'
            ]);

            $datos['numeroOrden'] = $numeroOrden;
            $datos['idUsuario'] = auth()->user()->id;
            $data=$this->service->guardar($datos);
            $respuesta= array([
                "data"=> $data,
                "message"=>"succes",
                "error"=>false
            ]);
            return response()->json($respuesta,200);
        } catch (\Throwable $th) {
            $respuesta= array([
                "data"=> null,
                "message"=>$th->getMessage(),
                "error"=>true
            ]);
            return response()->json($respuesta,500);
        }
    }

    public function buscarOrden(Request $request){
        if (!auth()->check()) {
            $respuesta= array([
                "data"=> null,
                "message"=>"no se puede ejecutar el proceso, debe iniciar sesión",
                "error"=>true
            ]);
            return response()->json($respuesta,500); 
        }
        try {
            $nombre = $request->route('numeroOrden');
            $data=$this->service->findByNumeroOrden($nombre);
            $respuesta= array([
                "data"=> $data,
                "message"=>"succes",
                "error"=>false
            ]);
            return response()->json($respuesta,200); 
        } catch (\Throwable $th) {
            return response()->json($th,500);
        }
    }

    public function actualizarReserva(Request $request){
        try {
            $id=$request->input('id');
            
            $datos = $request->only([
                
                'numeroOrden',
                'fechaEvento',
                'idCliente',
                'idUsuario',
                'subTotal',
                'deposito',
                'iva',
                'impuestoConsumo',
                'total',
                'estado'
            ]);
            $data=$this->service->actualizar($id,$datos);
            $respuesta= array([
                "data"=> $data,
                "message"=>"success act",
                "error"=>false
            ]);
            return response()->json($respuesta,200);
        } catch (\Throwable $th) {
            $respuesta= array([
                "data"=> null,
                "message"=>$th->getMessage(),
                "error"=>true
            ]);
            return response()->json($respuesta,500);
           
        }
    }

}