<?php
namespace App\Services\Cliente;

use App\Services\Cliente\IClienteAppService;
use App\Repositories\ClienteRepo\IClienteRepo;

class ClienteAppService implements IClienteAppService{

    protected $repository;
    
    public function __construct(IClienteRepo $repo)
    {
        $this->repository = $repo;
    }

    public function get(){
        return $this->repository->all();
    }
    public function getById($id){
        return $this->repository->find($id);
    }

    public function getByNombre($nombre){
        return $this->repository->findByNombre($nombre);
    }

    public function getByDocumento($tipo, $documento)
    {
        return $this->repository->findByDocumento($tipo,$documento);
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