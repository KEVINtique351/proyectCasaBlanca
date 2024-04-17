<?php

namespace App\Services\Factura;

interface IFacturaAppService
{

    public function get();
    public function getById($id);
    public function findByFactura($factura);
    public function guardar(array $data);
    public function actualizar($id, array $data);
}
