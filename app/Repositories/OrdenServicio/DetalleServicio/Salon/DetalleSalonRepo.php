<?php

namespace App\Repositories\OrdenServicio\DetalleServicio\Salon;
use Illuminate\Support\Facades\Log;

use App\Models\reservacionesDetalleSalon;

class DetalleSalonRepo implements IDetalleSalonRepo{
    
    public function all()
    {
        return reservacionesDetalleSalon::all();
    }

    public function find($id)
    {
        return reservacionesDetalleSalon::find($id);
    }

    public function findByNumeroOrden($orden)
    {
        return reservacionesDetalleSalon::where('numeroOrden', '=', $orden)->get();
    }

    public function findByIdOrden($idOrden)
    {
        return reservacionesDetalleSalon::where('idOrden', '=', $idOrden)->get();
    }

    
    public function create(array $data)
    {
        return reservacionesDetalleSalon::create($data);
    }

    public function update($id, array $data)
    {
        try {
            Log::error('act.'.$id);
            $servicio = reservacionesDetalleSalon::find($id);
            $servicio->update($data);
            return $servicio;
        } catch (\Throwable $th) {
            Log::error('error act.'.$th);
            throw $th;
        }
    }

    
}