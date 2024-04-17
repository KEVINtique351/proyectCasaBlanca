<?php

namespace App\Repositories\FacturaRepo\Configuracion;
use Illuminate\Support\Facades\Log;

use App\Models\factura_configuracion;

class FacturaConfiguracionRepo implements IFacturaConfiguracionRepo{
    
    public function all()
    {
        return factura_configuracion::all();
    }

    public function find($id)
    {
        return factura_configuracion::find($id);
    }

    public function findByEstado($estado)
    {
        return factura_configuracion::where('estado', '=',  $estado)->get();
    }

    public function create(array $data)
    {
        return factura_configuracion::create($data);
    }

    public function update($id, array $data)
    {
        try {
            Log::error('act.'.$id);
            $servicio = factura_configuracion::find($id);
            $servicio->update($data);
            return $servicio;
        } catch (\Throwable $th) {
            Log::error('error act.'.$th);
            throw $th;
        }
    }

    
}