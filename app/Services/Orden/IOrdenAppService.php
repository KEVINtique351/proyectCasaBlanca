<?php

namespace App\Services\Orden;

interface IOrdenAppService
{

    public function get();
    public function getById($id);
    public function findByNumeroOrden($orden);
    public function guardar(array $data);
    public function actualizar($id, array $data);
}
