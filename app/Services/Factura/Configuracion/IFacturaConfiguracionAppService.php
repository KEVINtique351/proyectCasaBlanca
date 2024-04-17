<?php

namespace App\Services\Factura\Configuracion;

interface IFacturaConfiguracionAppService
{

    public function get();
    public function getById($id);
    public function findByEstado($nombre);
    public function guardar(array $data);
    public function actualizar($id, array $data);
}
