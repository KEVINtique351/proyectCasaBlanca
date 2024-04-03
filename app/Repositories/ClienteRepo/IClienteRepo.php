<?php

namespace App\Repositories\ClienteRepo;

interface IClienteRepo{

    public function all();

    public function find($id);

    public function findByNombre($nombre);

    public function findByDocumento($tipo,$documento);

    public function create(array $data);

    public function update($id, array $data);

    
}