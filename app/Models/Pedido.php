<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable=[
        'pedido_vence',
        'pedido_observaciones',
        'pedido_estado',
        'user_id',
        'pedido_fecha_aprob',
        'empresa_id',
        'sucursal_id'
    ];
}
