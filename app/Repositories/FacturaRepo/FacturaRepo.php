<?php

namespace App\Repositories\FacturaRepo;
use Illuminate\Support\Facades\Log;

use App\Models\facturas;

class FacturaRepo implements IFacturaRepo{
    
    public function all()
    {
        return facturas::all();
    }

    public function find($id)
    {
        return facturas::find($id);
    }

    public function findByFactura($factura)
    {
       // return reservaciones::where('nombres', 'like', '%' . $nombre . '%')->get();
    }

    
    public function create(array $data)
    {
        return facturas::create($data);
    }

    public function update($id, array $data)
    {
        try {
            Log::error('act.'.$id);
            $servicio = facturas::find($id);
            $servicio->update($data);
            return $servicio;
        } catch (\Throwable $th) {
            Log::error('error act.'.$th);
            throw $th;
        }
    }

    
}