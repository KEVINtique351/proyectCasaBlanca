<?php
namespace App\Services\Salon;

use App\Services\Salon\ISalonAppService;
use App\Repositories\Salon\ISalonRepo;

class SalonAppService implements ISalonAppService{

    protected $repo;
    
    public function __construct(ISalonRepo $SaloRepo)
    {
        $this->repo = $SaloRepo;
    }


    public function get(){
        return $this->repo->all();
    }
  

    public function getByNombre($nombre){
        return $this->repo->findByNombre($nombre);
    }

    public function guardar($data){
        return $this->repo->create($data);
    }
    public function actualizar($id,$data){
        try {
            return $this->repo->update($id,$data);
        } catch (\Throwable $th) {
            throw $th;
        }
       
    }
    public function eliminar($id){
        return $this->repo->delete($id);
    }
}