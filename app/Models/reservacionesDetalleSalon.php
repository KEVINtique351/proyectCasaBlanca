<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservacionesDetalleSalon extends Model
{
    use HasFactory;
    protected $table = 'reservaciones_detalle_salones';
    protected $fillable = [
        'numeroOrden',
        'idOrden',
        'idSalon',
        'dia',
        'cantidad',
        'valorUnitario',
        'valorTotal'
    ];

    public function reservaciones()
    {
        return $this->belongsTo(reservaciones::class);
    }

    public function Salon()
    {
        return $this->belongsTo(Salon::class);
    }
}
