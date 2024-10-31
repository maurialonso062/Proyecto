<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'empresa_id',
        'suc_descri',
        'suc_direccion',
        'suc_telef',
        'suc_email',
        'ciudades_id',
        'paises_id'

    ];

    protected $table = 'sucursal';
}
