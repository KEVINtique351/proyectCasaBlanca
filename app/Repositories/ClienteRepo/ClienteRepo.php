<?php

namespace App\Repositories\ClienteRepo;
use Illuminate\Support\Facades\Log;

use App\Models\Cliente;

class ClienteRepo implements IClienteRepo{
    
    public function all()
    {
        return Cliente::all();
    }

    public function find($id)
    {
        return Cliente::find($id);
    }

    public function findByNombre($nombre)
    {
        return Cliente::where('nombres', 'like', '%' . $nombre . '%')->get();
    }

    public function findByDocumento($tipo, $documento)
    {
        return Cliente::where('tipoIdentificacion', $tipo)->where('identificacion', $documento)->get();
    }

    public function create(array $data)
    {
        return Cliente::create($data);
    }

    public function update($id, array $data)
    {
        try {
            Log::error('act.'.$id);
            $servicio = Cliente::find($id);
            $servicio->update($data);
            return $servicio;
        } catch (\Throwable $th) {
            Log::error('error act.'.$th);
            throw $th;
        }
    }

    
}