<?php

namespace App\Http\Controllers;
use App\Models\Empresa;

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
}
