<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'empresa_descri',
        'empresa_ruc',
        'empresa_direccion',
        'empresa_telef',
        'empresa_email'

    ];

    protected $table = 'empresa';
}
