<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Cliente\IClienteAppService;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    protected $service;
    
    public function __construct(IClienteAppService $clienteService)
    {
        $this->service = $clienteService;
    }

    public function index()
    {
        if (!auth()->check()) {
            return view('login');
        }
	
	    // Si no está logado le mostramos la vista con el formulario de login
        return view('cliente.cliente');
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

    public function getClienteByNombre(Request $request){
        if (!auth()->check()) {
            $respuesta= array([
                "data"=> null,
                "message"=>"no se puede ejecutar el proceso, debe iniciar sesión",
                "error"=>true
            ]);
            return response()->json($respuesta,500); 
        }
        try {
            $nombre = $request->route('nombre');
            $data=$this->service->getByNombre($nombre);
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

    public function getClienteByDocumento(Request $request){
        if (!auth()->check()) {
            $respuesta= array([
                "data"=> null,
                "message"=>"no se puede ejecutar el proceso, debe iniciar sesión",
                "error"=>true
            ]);
            return response()->json($respuesta,500); 
        }
        try {
            
            $tipo = $request->route('tipo');
            $documento = $request->route('documento');
            $data=$this->service->getByDocumento($tipo,$documento);
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

    public function guardarCliente(Request $request){
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
                'nombres',
                'apellidos',
                'tipoIdentificacion',
                'identificacion',
                'direccion',
                'email',
                'contacto'
            ]);
            $data=$this->service->guardar($datos);
            $respuesta= array([
                "data"=> $datos,
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

    public function actualizarCliente(Request $request){
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
                'nombres',
                'apellidos',
                'tipoIdentificacion',
                'identificacion',
                'direccion',
                'email',
                'contacto'
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
