<?php
namespace App\Services;

use App\Services\IServicioAppService;
use App\Repositories\ServicioRepo\IServicioRepo;

class ServicioAppService implements IServicioAppService{

    protected $servicioRepository;
    
    public function __construct(IServicioRepo $servicioRepository)
    {
        $this->servicioRepository = $servicioRepository;
    }


    public function getServicio(){
        return $this->servicioRepository->all();
    }
    public function getServicioById($id){
        return $this->servicioRepository->find($id);
    }

    public function getServicioByNombre($nombre){
        return $this->servicioRepository->findByNombre($nombre);
    }

    public function guardarServicio($data){
        return $this->servicioRepository->create($data);
    }
    public function actualizarServicio($id,$data){
        try {
            return $this->servicioRepository->update($id,$data);
        } catch (\Throwable $th) {
            throw $th;
        }
       
    }
    public function eliminarServicio($id){
        return $this->servicioRepository->delete($id);
    }
}