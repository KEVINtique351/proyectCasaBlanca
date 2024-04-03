<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservacionesDetalleServicio extends Model
{
    use HasFactory;
    protected $table = 'reservaciones_detalle_servicios';
    protected $fillable = [
        'numeroOrden',
        'idOrden',
        'idServicio',
        'dia',
        'cantidad',
        'valorUnitario',
        'valorTotal'
    ];

    public function reservaciones()
    {
        return $this->belongsTo(reservaciones::class);
    }

    public function Servcicio()
    {
        return $this->belongsTo(servicio::class);
    }
}
