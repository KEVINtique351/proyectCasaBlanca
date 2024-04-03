<?php

namespace App\Services\Salon;

interface ISalonAppService
{

    public function get();
    public function getByNombre($nombre);
    public function guardar(array $data);
    public function actualizar($id, array $data);
    public function eliminar($id);
}
