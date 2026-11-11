<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'nombre',
        'tipo_documento',
        'numero_documento',
        'correo',
        'telefono',
        'direccion',
        'ciudad',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];
}