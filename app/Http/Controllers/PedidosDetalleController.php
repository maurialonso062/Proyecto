<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PedidosDetalle;
use DB;

class PedidosDetalleController extends Controller
{
    //
    public function index($id){
        return DB::select("select
        pd.*, 
        i.item_descripcion
        from  pedidos_detalles pd
        join items i on i.id = pd.item_id
        where pd.pedido_id = $id;");
    }
    //Método para almacenar un nuevo registro de Detalles
    public function store(Request $request){
        //Validación de datos del formulario
        $datosvalidados = $request->validate([
            'pedido_id'=> 'required',
            'item_id'=> 'required',
            'det_cantidad'=> 'required'
        ]);
        $detalle = PedidosDetalle::create($datosvalidados);

        //Respuesta JSON para indicar el éxito de la operación
        return response()->json([
            'mensaje' => 'Registro creado con exito', 
            'tipo' =>'success',
            'registro' => $detalle
        ],200);
    }
    
    public function update(Request $request, $pedido_id, $item_id){
        $detalle = DB::table('pedidos_detalles')->
        where('pedido_id', $pedido_id)->
        where('item_id', $item_id)->
        update(['det_cantidad'=>$request->det_cantidad]);

        $detalle = DB::select("select * from pedidos_detalles where pedido_id=$pedido_id and item_id=$item_id");

        return response()->json([
            'mensaje' => 'Registro modificado con exito', 
            'tipo' =>'success',
            'registro' => $detalle
        ],200);
    }

    public function destroy($pedido_id, $item_id){
        $detalle = DB::table('pedidos_detalles')->
        where('pedido_id', $pedido_id)->
        where('item_id', $item_id)->
        delete();

        return response()->json([
            'mensaje' => 'Registro eliminado con exito', 
            'tipo' =>'success',
            'registro' => $detalle
        ],200);
    }
}
