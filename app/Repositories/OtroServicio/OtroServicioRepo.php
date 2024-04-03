<?php

namespace App\Repositories\OtroServicio;
use Illuminate\Support\Facades\Log;

use App\Models\otroServicio;

class OtroServicioRepo implements IOtroServicioRepo{
    
    public function all()
    {
        return otroServicio::all();
    }

    public function find($id)
    {
        return otroServicio::find($id);
    }

    public function findByNombre($nombre)
    {
        return otroServicio::where('nombre', 'like', '%' . $nombre . '%')->get();
    }

    public function create(array $data)
    {
        return otroServicio::create($data);
    }

    public function update($id, array $data)
    {
        try {
            Log::error('act.'.$id);
            $servicio = otroServicio::find($id);
            $servicio->update($data);
            return $servicio;
        } catch (\Throwable $th) {
            Log::error('error act.'.$th);
            throw $th;
        }
    }

    public function delete($id)
    {
        return otroServicio::destroy($id);
    }
}