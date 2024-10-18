<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipos;

class TipoController extends Controller
{
    // Método para obtener todos los tipos
    public function index(){
        return Tipos::all();
    }

    // Método para almacenar un nuevo registro de tipo
    public function store(Request $request){
        // Validación de datos del formulario
        $datosvalidados = $request->validate([
            'tipo_descripcion'=> 'required',
            'tipo_objeto'=> 'required'
        ]);

        // Crear una nueva instancia de Tipo con los datos validados
        $tipo = Tipos::create($datosvalidados);

        // Guardar el nuevo tipo en la base de datos
        $tipo->save();

        // Respuesta JSON para indicar el éxito de la operación
        return response()->json([
            'mensaje' => 'Registro creado con éxito', 
            'tipo' =>'success',
            'registro' => $tipo
        ],200);
    }

    // Método para actualizar un registro de tipo existente
    public function update(Request $request, $id){
        // Buscar el tipo por su ID
        $tipo = Tipos::find($id);

        // Si el tipo no se encuentra, devolver un mensaje de error
        if (!$tipo){
            return response()->json([
                'mensaje' => 'Registro no encontrado', 
                'tipo' =>'error',
            ],404);
        }

        // Validar los datos del formulario
        $datosvalidados = $request->validate([
            'tipo_descripcion'=> 'required',
            'tipo_objeto'=> 'required'
        ]);

        // Actualizar los datos del tipo con los datos validados
        $tipo -> update($datosvalidados);

        // Respuesta JSON para indicar el éxito de la operación
        return response()->json([
            'mensaje' => 'Registro modificado con éxito', 
            'tipo' =>'success',
            'registro' => $tipo
        ],200);
    }

    // Método para eliminar un registro de tipo
    public function destroy($id){
        // Buscar el tipo por su ID
        $tipo = Tipos::find($id);

        // Si el tipo no se encuentra, devolver un mensaje de error
        if (!$tipo){
            return response()->json([
                'mensaje' => 'Registro no encontrado', 
                'tipo' =>'error',
            ],404);
        }

        // Eliminar el tipo de la base de datos
        $tipo->delete();

        // Respuesta JSON para indicar el éxito de la operación
        return response()->json([
            'mensaje' => 'Registro eliminado con éxito', 
            'tipo' =>'success'
        ],200);
    }
}
