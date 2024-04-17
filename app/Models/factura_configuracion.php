<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class factura_configuracion extends Model
{
    use HasFactory;
    protected $table = 'factura_configuracions';
    protected $fillable = [
        'resolucion',
        'facturaInicia',
        'facturaFinal',
        'numero',
        'estado'];
}
