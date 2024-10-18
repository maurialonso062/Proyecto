<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidosDetalle extends Model
{
    use HasFactory;
    protected $fillable=[
        'pedido_id',
        'item_id',
        'det_cantidad'
    ];

    protected $primaryKey = [
        'pedido_id',
        'item_id'
    ];

    public $incrementing = false;
}
