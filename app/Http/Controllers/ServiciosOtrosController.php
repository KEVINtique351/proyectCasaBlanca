<?php

namespace App\Http\Controllers;

use App\Services\Servicio\IOtroServicioAppService;
use Illuminate\Http\Request;

class ServiciosOtrosController extends Controller
{
    protected $servicioAppService;
    
    public function __construct(IOtroServicioAppService $servicioAppService)
    {
        $this->servicioAppService = $servicioAppService;
    }

    public function OtrosVer()
    {
        return view('otros.OtroServicios');
    } 

    public function buscarOtroServicios(){
        try {
            $data=$this->servicioAppService->getServicio();
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

    public function getOtroServicio(Request $request){
        try {
            $nombre = $request->query('nombre');
            $data=$this->servicioAppService->getServicioByNombre($nombre);
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

    public function guardarOtroServicio(Request $request){
        try {
            $datos = $request->only([
                'nombre',
                'valor'
            ]);
            $data=$this->servicioAppService->guardarServicio($datos);
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

    public function actualizarOtroServicio(Request $request){
        try {
            $id=$request->input('id');
            
            $datos = $request->only([
                'nombre',
                'valor'
            ]);
            $data=$this->servicioAppService->actualizarServicio($id,$datos);
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

    public function deleteOtrServicio(Request $request){
        try {
            $id = $request->route('id');
            $data=$this->servicioAppService->eliminarServicio($id);
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