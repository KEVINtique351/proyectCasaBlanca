<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservacionesDetalleOtro extends Model
{
    use HasFactory;
    protected $table = 'reservaciones_detalle_otros';
    protected $fillable = [
        'numeroOrden',
        'idOrden',
        'idOtros',
        'dia',
        'cantidad',
        'valorUnitario',
        'valorTotal'
    ];

    public function reservaciones()
    {
        return $this->belongsTo(reservaciones::class);
    }

    public function otroServico()
    {
        return $this->belongsTo(otroServicio::class);
    }
}
