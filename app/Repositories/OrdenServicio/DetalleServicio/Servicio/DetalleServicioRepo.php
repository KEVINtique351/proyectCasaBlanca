<?php

namespace App\Repositories\OrdenServicio\DetalleServicio\Servicio;
use Illuminate\Support\Facades\Log;

use App\Models\reservacionesDetalleServicio;

class DetalleServicioRepo implements IDetalleServicioRepo{
    
    public function all()
    {
        return reservacionesDetalleServicio::all();
    }

    public function find($id)
    {
        return reservacionesDetalleServicio::find($id);
    }

    public function findByNumeroOrden($orden)
    {
        return reservacionesDetalleServicio::where('numeroOrden', '=', $orden)->get();
    }

    public function findByIdOrden($idOrden)
    {
        return reservacionesDetalleServicio::where('idOrden', '=', $idOrden)->get();
    }

    
    public function create(array $data)
    {
        return reservacionesDetalleServicio::create($data);
    }

    public function update($id, array $data)
    {
        try {
            Log::error('act.'.$id);
            $servicio = reservacionesDetalleServicio::find($id);
            $servicio->update($data);
            return $servicio;
        } catch (\Throwable $th) {
            Log::error('error act.'.$th);
            throw $th;
        }
    }

    
}