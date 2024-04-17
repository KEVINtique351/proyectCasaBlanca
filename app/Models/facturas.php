<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class facturas extends Model
{
    use HasFactory;
    protected $table = 'facturas';
    protected $fillable = [
        'facturaVenta',
        'fechaFactura',
        'idCliente',
        'idUsuario',
        'idOrdenServicio',
        'subTotal',
        'deposito',
        'iva',
        'impuestoConsumo',
        'total',
        'estado',
        'medioPago',
        'valorPagado',
        'valorCambio'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Reservacion()
    {
        return $this->belongsTo(reservaciones::class);
    }


}
