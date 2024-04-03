<?php

namespace App\Repositories\OtroServicio;

interface IOtroServicioRepo{

    public function all();

    public function find($id);

    public function findByNombre($nombre);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);
}