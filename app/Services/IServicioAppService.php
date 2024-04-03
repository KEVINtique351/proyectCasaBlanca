<?php

namespace App\Services;

interface IServicioAppService
{

    public function getServicio();
    public function getServicioById($id);
    public function getServicioByNombre($nombre);
    public function guardarServicio(array $data);
    public function actualizarServicio($id, array $data);
    public function eliminarServicio($id);
}
