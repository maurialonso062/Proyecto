<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perfil;

class PerfilController extends Controller
{
    public function index(){
        return Perfil::all();
    }

    public function store(Request $request){
        $perfil = Perfil::create($request->all());
        return response()->json([
            'mensaje'=>'Registro creado con exito',
            'tipo'=>'success',
            'registro'=> $perfil
        ]);
    }

    public function destroy($id){
        // Buscar el item por su ID
        $perfil=Perfil::find($id);
        // Si el item no se encuentra, devolver un mensaje de error
        if (!$perfil){
            return response()->json([
            'mensaje' => 'Registro no encontrado', 
            'tipo' =>'error',
            ],404);
        }

        //Eliminar el item de la base de datos
        $perfil->delete();

        //Respuesta JSON para indicar el éxito de la operación
        return response()->json([
            'mensaje' => 'Registro eliminado con exito', 
            'tipo' =>'success'
        ],200);
    }
}

