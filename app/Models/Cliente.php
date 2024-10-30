<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_nombre',
        'cliente_apellido',
        'cliente_ruc',
        'cliente_direc',
        'cliente_telefono',
        'cliente_email'

    ];

    protected $table = 'cliente';
}
