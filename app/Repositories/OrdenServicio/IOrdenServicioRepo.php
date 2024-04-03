<?php

namespace App\Repositories\OrdenServicio;

interface IOrdenServicioRepo{

    public function all();

    public function find($id);

    public function findByNumeroOrden($nombre);

    public function create(array $data);

    public function update($id, array $data);

    
}