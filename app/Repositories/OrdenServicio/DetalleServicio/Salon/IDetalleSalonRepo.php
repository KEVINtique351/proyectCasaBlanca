<?php

namespace App\Repositories\OrdenServicio\DetalleServicio\Salon;

interface IDetalleSalonRepo{

    public function all();

    public function find($id);

    public function findByNumeroOrden($orden);

    public function findByIdOrden($idOrden);

    public function create(array $data);

    public function update($id, array $data);

    
}