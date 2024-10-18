<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipos extends Model
{
    use HasFactory;

    protected $fillable =[
    'tipo_descripcion',
    'tipo_objeto'];

    protected $table = 'tipos';
}
