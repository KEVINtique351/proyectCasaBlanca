<?php

namespace App\Repositories\OrdenServicio\DetalleServicio\Otro;
use Illuminate\Support\Facades\Log;

use App\Models\reservacionesDetalleOtro;

class DetalleOtroRepo implements IDetalleOtroRepo{
    
    public function all()
    {
        return reservacionesDetalleOtro::all();
    }

    public function find($id)
    {
        return reservacionesDetalleOtro::find($id);
    }

    public function findByNumeroOrden($orden)
    {
        return reservacionesDetalleOtro::where('numeroOrden', '=', $orden)->get();
    }

    public function findByIdOrden($idOrden)
    {
        return reservacionesDetalleOtro::where('idOrden', '=', $idOrden)->get();
    }

    
    public function create(array $data)
    {
        return reservacionesDetalleOtro::create($data);
    }

    public function update($id, array $data)
    {
        try {
            Log::error('act.'.$id);
            $servicio = reservacionesDetalleOtro::find($id);
            $servicio->update($data);
            return $servicio;
        } catch (\Throwable $th) {
            Log::error('error act.'.$th);
            throw $th;
        }
    }

    
}