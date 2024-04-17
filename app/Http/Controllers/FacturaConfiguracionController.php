<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Factura\Configuracion\IFacturaConfiguracionAppService;
use Illuminate\Http\Request;

class FacturaConfiguracionController extends Controller
{
    protected $service;
    
    public function __construct(IFacturaConfiguracionAppService $facturaConfiguracionService)
    {
        $this->service = $facturaConfiguracionService;
    }

    public function index()
    {
        if (!auth()->check()) {
            return view('login');
        }
	
	    // Si no está logado le mostramos la vista con el formulario de login
        return view('factura.configuracion');
    }

    public function buscarResoluciones(){
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

    public function getResolucion(Request $request){
        if (!auth()->check()) {
            $respuesta= array([
                "data"=> null,
                "message"=>"no se puede ejecutar el proceso, debe iniciar sesión",
                "error"=>true
            ]);
            return response()->json($respuesta,500); 
        }
        try {
            $estado = $request->route('estado');
            $data=$this->service->findByEstado($estado);
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


    public function guardarFacturaConfiguracion(Request $request){
        if (!auth()->check()) {
            $respuesta= array([
                "data"=> null,
                "message"=>"no se puede ejecutar el proceso, debe iniciar sesión",
                "error"=>true
            ]);
            return response()->json($respuesta,500); 
        }
        try {
            $datos = $request->only([
                'estado',
                'resolucion',
                'facturaInicia',
                'facturaFinal',
                'numero'
            ]);
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

    public function actualizarFacturaConfiguracion(Request $request){
        if (!auth()->check()) {
            $respuesta= array([
                "data"=> null,
                "message"=>"no se puede ejecutar el proceso, debe iniciar sesión",
                "error"=>true
            ]);
            return response()->json($respuesta,500); 
        }
        try {
            $id=$request->input('id');
            
            $datos = $request->only([
                'estado',
                'resolucion',
                'facturaInicia',
                'facturaFinal',
                'numero'
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
