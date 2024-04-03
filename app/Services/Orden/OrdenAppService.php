<?php
namespace App\Services\Orden;

use App\Services\Orden\IOrdenAppService;
use App\Services\Orden\Detalle\DetalleOtro\IDetalleOtroAppService;
use App\Services\Orden\Detalle\DetalleSalon\IDetalleSalonAppService;
use App\Services\Orden\Detalle\DetalleServicio\IDetalleServicioAppService;
use App\Repositories\OrdenServicio\IOrdenServicioRepo;

class OrdenAppService implements IOrdenAppService{

    protected $repository;
    protected $serviceSalon;
    protected $serviceServicio;
    protected $serviceOtro;
    
    public function __construct(IOrdenServicioRepo $repo,
        IDetalleOtroAppService $otroService, IDetalleSalonAppService $salonService, IDetalleServicioAppService $servicioService)
    {
        $this->repository = $repo;
        $this->serviceSalon= $salonService;
        $this->serviceServicio= $servicioService;
        $this->serviceOtro= $otroService;
    }

    public function get(){
        return $this->repository->all();
    }
    public function getById($id){
        return $this->repository->find($id);
    }

    public function findByNumeroOrden($nombre){
        return $this->repository->findByNumeroOrden($nombre);
    }



    public function guardar($data){
        try {
            $datos= [
                "numeroOrden"=> $data['numeroOrden'],
                "fechaEvento"=>$data['fechaEvento'],
                "idCliente"=>$data['idCliente'],
                "idUsuario"=>$data['idUsuario'],
                "subTotal"=>$data['subTotal'],
                "deposito"=>$data['deposito'],
                "iva"=>$data['iva'],
                "impuestoConsumo"=>$data['impuestoConsumo'],
                "total"=>$data['total'],
                "estado"=>"1",
            ];
            $orden= $this->repository->create($datos);
            if($orden->id>0){
                $this->guardarDetalleSalon($orden, $data['detalleSalon'], $data['numeroOrden']);
                $this->guardarDetalleServicio($orden, $data['detalleServicio'], $data['numeroOrden']);
                $this->guardarDetalleOtro($orden, $data['detalleOtro'], $data['numeroOrden']);
            }
            return $orden;
            
        } catch (\Throwable $th) {
            throw $th;
        }
       
    }
    public function actualizar($id,$data){
        try {
            $datos= array([
                "numeroOrden"=> $data['numeroOrden'],
                "fechaEvento"=>$data['fechaEvento'],
                "idCliente"=>$data['idCliente'],
                "idUsuario"=>$data['idUsuario'],
                "subTotal"=>$data['subTotal'],
                "deposito"=>$data['deposito'],
                "iva"=>$data['iva'],
                "impuestoConsumo"=>$data['impuestoConsumo'],
                "total"=>$data['total'],
                "estado"=>"A",
            ]);
            $orden= $this->repository->update($id,$datos);
            /*if($orden->id>0){
                $this->guardarDetalleSalon($orden, $data->detalleSalon, $data->numeroOrden);
                $this->guardarDetalleServicio($orden, $data->detalleServicio, $data->numeroOrden);
                $this->guardarDetalleOtro($orden, $data->detalleOtro, $data->numeroOrden);
            }*/
            return $orden;
            
        } catch (\Throwable $th) {
            throw $th;
        }
       
    }

    private function guardarDetalleSalon($orden, $data, $numeroOrden){
        try {
           if(count($data)==0){
            return;
           }
           foreach ($data as $item) {
                $salon=$item['nombre'];
                $sl = explode('-', $salon);
                $idSalon = $sl[0];
                $datos= [
                    "numeroOrden"=> $numeroOrden,
                    "idOrden"=>$orden['id'],
                    "idSalon"=>$idSalon,
                    "dia"=>$item['dia'],
                    "cantidad"=>$item['cantidad'],
                    "valorUnitario"=>$item['valor'],
                    "valorTotal"=>$item['total'],
                   
                ];
                $this->serviceSalon->guardar($datos);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function guardarDetalleServicio($orden, $data, $numeroOrden){
        try {
            if(count($data)==0){
                return;
               }
            foreach ($data as $item) {
                $servicio=$item['nombre'];
                $sv = explode('-', $servicio);
                $idServicio = $sv[0];
                $datos= [
                    "numeroOrden"=> $numeroOrden,
                    "idOrden"=>$orden['id'],
                    "idServicio"=>$idServicio,
                    "dia"=>$item['dia'],
                    "cantidad"=>$item['cantidad'],
                    "valorUnitario"=>$item['valor'],
                    "valorTotal"=>$item['total'],
                   
                ];
                $this->serviceServicio->guardar($datos);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function guardarDetalleOtro($orden, $data, $numeroOrden){
        try {
            if(count($data)==0){
                return;
               }
            foreach ($data as $item) {
                $otros=$item['nombre'];
                $ot = explode('-', $otros);
                $idOtro = $ot[0];
                $datos= [
                    "numeroOrden"=> $numeroOrden,
                    "idOrden"=>$orden['id'],
                    "idOtros"=>$idOtro,
                    "dia"=>$item['dia'],
                    "cantidad"=>$item['cantidad'],
                    "valorUnitario"=>$item['valor'],
                    "valorTotal"=>$item['total'],
                   
                ];
                $this->serviceOtro->guardar($datos);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
   
}