<?php
namespace App\Services\Factura\Configuracion;

use App\Services\Factura\Configuracion\IFacturaConfiguracionAppService;
use App\Repositories\FacturaRepo\Configuracion\IFacturaConfiguracionRepo;

class FacturaConfiguracionAppService implements IFacturaConfiguracionAppService{

    protected $repository;
    
    public function __construct(IFacturaConfiguracionRepo $repo)
    {
        $this->repository = $repo;
    }

    public function get(){
        return $this->repository->all();
    }
    public function getById($id){
        return $this->repository->find($id);
    }

    public function findByEstado($estado){
        return $this->repository->findByEstado($estado);
    }

    public function guardar($data){
        return $this->repository->create($data);
    }
    public function actualizar($id,$data){
        try {
            return $this->repository->update($id,$data);
        } catch (\Throwable $th) {
            throw $th;
        }
       
    }
   
}