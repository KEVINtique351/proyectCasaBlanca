<?php

namespace App\Repositories\FacturaRepo;

interface IFacturaRepo{

    public function all();

    public function find($id);

    public function findByFactura($factura);

    public function create(array $data);

    public function update($id, array $data);

    
}