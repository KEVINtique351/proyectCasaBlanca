<?php
namespace App\Services\Orden\Detalle\DetalleServicio;

use App\Services\Orden\Detalle\DetalleServicio\IDetalleServicioAppService;
use App\Repositories\OrdenServicio\DetalleServicio\Servicio\IDetalleServicioRepo;

class DetalleServicioAppService implements IDetalleServicioAppService{

    protected $repository;
    
    public function __construct(IDetalleServicioRepo $repo)
    {
        $this->repository = $repo;
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

    public function findByIdOrden($idOrden){
        return $this->repository->findByIdOrden($idOrden);
    }

    public function guardar($data){
        try {
            return $this->repository->create($data);
            
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }
    public function actualizar($id,$data){
        try {
            return $this->repository->update($id,$data);
        } catch (\Throwable $th) {
            throw $th;
        }
       
    }
   
}