<?php

namespace App\Repositories\Salon;
use Illuminate\Support\Facades\Log;

use App\Models\Salon;

class SalonRepo implements ISalonRepo{
    
    public function all()
    {
        return Salon::all();
    }

    public function find($id)
    {
        return Salon::find($id);
    }

    public function findByNombre($nombre)
    {
        return Salon::where('nombre', 'like', '%' . $nombre . '%')->get();
    }

    public function create(array $data)
    {
        return Salon::create($data);
    }

    public function update($id, array $data)
    {
        try {
            Log::error('act.'.$id);
            $salon = Salon::find($id);
            $salon->update($data);
            return $salon;
        } catch (\Throwable $th) {
            Log::error('error act.'.$th);
            throw $th;
        }
    }

    public function delete($id)
    {
        return Salon::destroy($id);
    }
}