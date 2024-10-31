<?php

namespace App\Http\Controllers;
use App\Models\Sucursal;
use App\Models\Empresa;
use DB;

use Illuminate\Http\Request;

class SucursalController extends Controller
{
    public function index(){
        return Sucursal::all();
    }

    public function store(Request $r){
        //Validación de datos del formulario
        $datosvalidados = $r->validate([
            'empresa_id'=> 'required',
            'suc_descri'=> 'required',
            'suc_direccion'=> 'required',
            'suc_telef'=> 'required',
            'suc_email'=> 'required',
            'ciudades_id'=> 'required',
            'paises_id'=> 'required'
        ]);
        //Crear una nueva instancia de empresa con los datos validados
        $sucursal = Sucursal::create($datosvalidados);

        //Guardar el nuevo empresa en la base de datos
        $sucursal->save();

        //Respuesta JSON para indicar el éxito de la operación
        return response()->json([
            'mensaje' => 'Registro creado con exito', 
            'tipo' =>'success',
            'registro' => $sucursal
        ],200);
    }

    public function buscar(Request $r) {
        return DB::select("
            SELECT 
                s.id, 
                s.suc_descri,
                s.suc_direccion,
                s.suc_telef,
                s.suc_email,
                s.created_at,
                s.updated_at,
                'SUCURSAL: ' || s.suc_descri || ' (DIRECCION: ' || s.suc_direccion || ')' as descripcion_completa
            FROM 
                sucursal s
            WHERE 
                s.suc_descri ILIKE '%{$r->suc_descri}%'
                OR s.suc_direccion ILIKE '%{$r->suc_descri}%' 
                OR s.suc_telef ILIKE '%{$r->suc_descri}%' 
                OR s.suc_email ILIKE '%{$r->suc_descri}%'
        ");
    }
}


