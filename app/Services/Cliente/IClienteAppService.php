<?php

namespace App\Services\Cliente;

interface IClienteAppService
{

    public function get();
    public function getById($id);
    public function getByNombre($nombre);
    public function getByDocumento($tipo,$documento);
    public function guardar(array $data);
    public function actualizar($id, array $data);
}
