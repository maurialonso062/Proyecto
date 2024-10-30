<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use DB;

class ItemController extends Controller
{
    // Método para obtener todos los items con información adicional del tipo
    public function index(){
        return DB::select("select i.*, t.tipo_descripcion from items i join tipos t on t.id = i.tipo_id");
    }
    //Método para almacenar un nuevo registro de item
    public function store(Request $r){
        //Validación de datos del formulario
        $datosvalidados = $r->validate([
            'item_descripcion'=> 'required',
            'item_costo'=> 'required',
            'item_precio'=> 'required',
            'tipo_id'=> 'required',
            'marca_id'=> 'required',
            'tipo_impuesto_id' => 'required'
        ]);
        //Crear una nueva instancia de Item con los datos validados
        $item = Item::create($datosvalidados);

        //Guardar el nuevo item en la base de datos
        $item->save();

        //Respuesta JSON para indicar el éxito de la operación
        return response()->json([
            'mensaje' => 'Registro creado con exito', 
            'tipo' =>'success',
            'registro' => $item
        ],200);
    }
        //Método para actualizar un registro de item existente
        public function update(Request $request, $id){
            //Buscar el item por su ID
            $item=Item::find($id);

            // Si el item no se encuentra, devolver un mensaje de error
            if (!$item){
                return response()->json([
                'mensaje' => 'Registro no encontrado', 
                'tipo' =>'error',
                ],404);
            }
            //Validar los datos del formulario
            $datosvalidados = $request->validate([
                'item_descripcion'=> 'required',
                'item_costo'=> 'required',
                'item_precio'=> 'required',
                'tipo_id'=> 'required',
                'marca_id'=> 'required',
                'tipo_impuesto_id' => 'required'
            ]);
            //Actualizar los datos del item con los datos validados
            $item -> update($datosvalidados);

            //Respuesta JSON para indicar el éxito de la operación
            return response()->json([
                'mensaje' => 'Registro modificado con exito', 
                'tipo' =>'success',
                'registro' => $item
            ],200);
        }
        // Método para eliminar un registro de item    
        public function destroy($id){
            // Buscar el item por su ID
            $item=Item::find($id);
            // Si el item no se encuentra, devolver un mensaje de error
            if (!$item){
                return response()->json([
                'mensaje' => 'Registro no encontrado', 
                'tipo' =>'error',
                ],404);
            }

            //Eliminar el item de la base de datos
            $item->delete();

            //Respuesta JSON para indicar el éxito de la operación
            return response()->json([
                'mensaje' => 'Registro eliminado con exito', 
                'tipo' =>'success'
            ],200);
        }

        public function buscar(Request $request){
            return DB::select("select i.*, t.tipo_descripcion, i.id as item_id 
            from items i join tipos t on t.id = i.tipo_id
            where item_descripcion ilike '%$request->item_descripcion%'
            and tipo_descripcion = '$request->tipo_descripcion'");
        }
}
