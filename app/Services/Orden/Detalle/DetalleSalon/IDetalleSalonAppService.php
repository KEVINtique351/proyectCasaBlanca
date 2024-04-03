<?php

namespace App\Services\Orden\Detalle\DetalleSalon;

interface IDetalleSalonAppService
{

    public function get();
    public function getById($id);
    public function findByNumeroOrden($orden);
    public function findByIdOrden($idOrden);
    public function guardar(array $data);
    public function actualizar($id, array $data);
}
