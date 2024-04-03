<?php

namespace App\Repositories\ServicioRepo;

interface IServicioRepo{

    public function all();

    public function find($id);

    public function findByNombre($nombre);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);
}