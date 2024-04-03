<?php

namespace App\Services\Orden\Detalle\DetalleServicio;

interface IDetalleServicioAppService
{
    public function get();
    public function getById($id);
    public function findByNumeroOrden($orden);
    public function findByIdOrden($idOrden);
    public function guardar(array $data);
    public function actualizar($id, array $data);
}
