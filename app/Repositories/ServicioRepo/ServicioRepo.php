<?php

namespace App\Repositories\ServicioRepo;
use Illuminate\Support\Facades\Log;

use App\Models\servicio;

class ServicioRepo implements IServicioRepo{
    
    public function all()
    {
        return Servicio::all();
    }

    public function find($id)
    {
        return Servicio::find($id);
    }

    public function findByNombre($nombre)
    {
        return Servicio::where('nombre', 'like', '%' . $nombre . '%')->get();
    }

    public function create(array $data)
    {
        return Servicio::create($data);
    }

    public function update($id, array $data)
    {
        try {
            Log::error('act.'.$id);
            $servicio = Servicio::find($id);
            $servicio->update($data);
            return $servicio;
        } catch (\Throwable $th) {
            Log::error('error act.'.$th);
            throw $th;
        }
    }

    public function delete($id)
    {
        return Servicio::destroy($id);
    }
}