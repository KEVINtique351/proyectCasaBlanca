<?php

namespace App\Repositories\OrdenServicio;
use Illuminate\Support\Facades\Log;

use App\Models\reservaciones;

class OrdenServicioRepo implements IOrdenServicioRepo{
    
    public function all()
    {
        return reservaciones::all();
    }

    public function find($id)
    {
        return reservaciones::find($id);
    }

    public function findByNumeroOrden($nombre)
    {
        return reservaciones::where('nombres', 'like', '%' . $nombre . '%')->get();
    }

    
    public function create(array $data)
    {
        return reservaciones::create($data);
    }

    public function update($id, array $data)
    {
        try {
            Log::error('act.'.$id);
            $servicio = reservaciones::find($id);
            $servicio->update($data);
            return $servicio;
        } catch (\Throwable $th) {
            Log::error('error act.'.$th);
            throw $th;
        }
    }

    
}