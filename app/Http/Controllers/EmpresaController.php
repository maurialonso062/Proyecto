<?php

namespace App\Http\Controllers;
use App\Models\Empresa;
use DB;

use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function index(){
        return Empresa::all();
    }

    public function store(Request $r){
        //Validación de datos del formulario
        $datosvalidados = $r->validate([
            'empresa_descri'=> 'required',
            'empresa_ruc'=> 'required',
            'empresa_direccion'=> 'required',
            'empresa_telef'=> 'required',
            'empresa_email'=> 'required'
        ]);
        //Crear una nueva instancia de empresa con los datos validados
        $empresa = Empresa::create($datosvalidados);

        //Guardar el nuevo empresa en la base de datos
        $empresa->save();

        //Respuesta JSON para indicar el éxito de la operación
        return response()->json([
            'mensaje' => 'Registro creado con exito', 
            'tipo' =>'success',
            'registro' => $empresa
        ],200);
    }

    public function buscar(Request $r) {
        return DB::select("
            SELECT 
                e.id, 
                e.empresa_descri,
                e.empresa_ruc,
                e.empresa_direccion,
                e.empresa_telef,
                e.empresa_email,
                e.created_at,
                e.updated_at,
                'EMPRESA: ' || e.empresa_descri || ' (RUC: ' || e.empresa_ruc || ')' as descripcion_completa
            FROM 
                empresa e
            WHERE 
                e.empresa_descri ILIKE '%{$r->empresa_descri}%' 
                OR e.empresa_ruc ILIKE '%{$r->empresa_descri}%' 
                OR e.empresa_direccion ILIKE '%{$r->empresa_descri}%' 
                OR e.empresa_telef ILIKE '%{$r->empresa_descri}%' 
                OR e.empresa_email ILIKE '%{$r->empresa_descri}%'
        ");
    }

}
