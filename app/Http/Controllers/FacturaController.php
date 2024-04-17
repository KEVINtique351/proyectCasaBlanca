<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Factura\IFacturaAppService;
use App\Services\Orden\IOrdenAppService;

class FacturaController extends Controller
{
    protected $service;
    protected $reserva;
    
    public function __construct(IFacturaAppService $facturaService,IOrdenAppService $Ireserva)
    {
        $this->service = $facturaService;
        $this->reserva = $Ireserva;
    }

    public function index()
    {
        if (!auth()->check()) {
            return view('login');
        }
	
	    // Si no está logado le mostramos la vista con el formulario de login
        return view('factura.factura');
    }

    public function getCliente(){
        if (!auth()->check()) {
            $respuesta= array([
                "data"=> null,
                "message"=>"no se puede ejecutar el proceso, debe iniciar sesión",
                "error"=>true
            ]);
            return response()->json($respuesta,500); 
        }
        try {
            $data=$this->service->get();
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


    public function guardarFactura(Request $request){
        try {
            $datos = $request->only([
                'deposito',
                'estado',
                'facturaVenta',
                'idCliente',
                'impuestoConsumo',
                'iva',
                'medioPago',
                'subTotal',
                'total',
                'valorCambio',
                'valorPagado',
                'idOrdenServicio'
            ]);
            $datos['idUsuario'] = auth()->user()->id;
            $datos['fechaFactura']=date("Y-m-d H:i:s");
            $data=$this->service->guardar($datos);
            if($data->id>0){
               $this->actualizarReserva($data['idOrdenServicio']);
            }
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

    private function actualizarReserva($numeroOrden){
        $data=$this->reserva->getById($numeroOrden);
        $data->estado=2;
        $id=$data->id;
        $this->reserva->actualizar($id,$data);
    }
}
