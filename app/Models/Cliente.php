<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'Clientes';
    protected $fillable = [
        'nombres',
        'apellidos',
        'tipoIdentificacion',
        'identificacion',
        'direccion',
        'email',
        'contacto'];
}
