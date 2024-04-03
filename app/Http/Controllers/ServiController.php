<?php

namespace App\Http\Controllers;

use App\Services\IServicioAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ServiController extends Controller
{
    protected $servicioAppService;
    
    public function __construct(IServicioAppService $servicioAppService)
    {
        $this->servicioAppService = $servicioAppService;
    }

    public function serviciosVer()
    {
        return view('servicio.servicio');
    }

    public function buscar(){
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

    public function getServicio(Request $request){
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

    public function guardar(Request $request){
        try {
            $datos = $request->only([
                'nombre',
                'valor'
            ]);
            $data=$this->servicioAppService->guardarServicio($datos);
            $respuesta= array([
                "data"=> $data,
                "message"=>"succes",
                "error"=>false
            ]);
            return response()->json($respuesta,200);
        } catch (\Throwable $th) {
            return response()->json($th,200);
        }
    }

    public function actualizar(Request $request){
        try {
            $id=$request->input('id');
            Log::error('act.'.$id);
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

    public function deleteServicio(Request $request){
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