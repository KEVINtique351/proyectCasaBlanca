<?php
namespace App\Services\Factura;

use App\Services\Factura\IFacturaAppService;
use App\Repositories\FacturaRepo\IFacturaRepo;

class FacturaAppService implements IFacturaAppService{

    protected $repository;
    protected $serviceSalon;
    protected $serviceServicio;
    protected $serviceOtro;
    
    public function __construct(IFacturaRepo $repo)
    {
        $this->repository = $repo;
    }

    public function get(){
        return $this->repository->all();
    }
    public function getById($id){
        return $this->repository->find($id);
    }

    public function findByFactura($factura){
        return $this->repository->findByFactura($factura);
    }



    public function guardar($data){
        try {
            
            $factura= $this->repository->create($data);
            
            return $factura;
            
        } catch (\Throwable $th) {
            throw $th;
        }
       
    }
    public function actualizar($id,$data){
        try {
            
            $factura= $this->repository->update($id,$data);
           
            return $factura;
            
        } catch (\Throwable $th) {
            throw $th;
        }
       
    }

   
}