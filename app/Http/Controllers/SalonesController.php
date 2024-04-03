<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Salon\ISalonAppService;


class SalonesController extends Controller
{
    protected $service;
    
    public function __construct(ISalonAppService $saloService)
    {
        $this->service = $saloService;
    }

    public function mostrarSalones()
    {
        return view('salones.index');
    }

    public function getSalones(){
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

    public function getSalonesByNombre(Request $request){
        try {
            $nombre = $request->query('nombre');
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

    public function guardarSalon(Request $request){
        try {
            $datos = $request->only([
                'nombre',
                'valor'
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

    public function actualizarSalon(Request $request){
        try {
            $id=$request->input('id');
            
            $datos = $request->only([
                'nombre',
                'valor'
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

    public function deleteSalon(Request $request){
        try {
            $id = $request->route('id');
            $data=$this->service->eliminar($id);
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
}