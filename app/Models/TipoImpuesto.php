<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoImpuesto extends Model
{
    use HasFactory;
    protected $fillable = [
        'tipo_imp_descrip', 
        'tipo_imp_tasa'];
    
    protected $table = 'tipo_impuesto';
}
