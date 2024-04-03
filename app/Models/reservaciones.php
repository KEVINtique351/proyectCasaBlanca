<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservaciones extends Model
{
    use HasFactory;
    protected $table = 'reservaciones';
    protected $fillable = [
        'numeroOrden',
        'fechaEvento',
        'idCliente',
        'idUsuario',
        'subTotal',
        'deposito',
        'iva',
        'impuestoConsumo',
        'total',
        'estado'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
