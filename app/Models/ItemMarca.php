<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemMarca extends Model
{
    use HasFactory;

    protected $table = 'item_marca';
    protected $fillable = [
        'item_marca_descri',
        'marca_id',
        'item_id'
    ];

    protected $primarykey = [
        'marca_id', 
        'item_id'];

    public $incrementing = false;       
}
