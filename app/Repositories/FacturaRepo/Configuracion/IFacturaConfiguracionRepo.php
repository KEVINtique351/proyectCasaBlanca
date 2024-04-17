<?php

namespace App\Repositories\FacturaRepo\Configuracion;

interface IFacturaConfiguracionRepo{

    public function all();

    public function find($id);

    public function findByEstado($estado);

    public function create(array $data);

    public function update($id, array $data);

    
}