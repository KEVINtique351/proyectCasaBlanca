<?php

namespace App\Services\Servicio;

interface IOtroServicioAppService
{

    public function getServicio();
    public function getServicioById($id);
    public function getServicioByNombre($nombre);
    public function guardarServicio(array $data);
    public function actualizarServicio($id, array $data);
    public function eliminarServicio($id);
}
