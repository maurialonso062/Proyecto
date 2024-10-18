<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PresupuestosDetalleController extends Controller
{
    public function index($id){
        return DB::select("select
        pd.*, 
        i.item_descripcion
        from  presupuestos_detalles pd
        join items i on i.id = pd.item_id
        where pd.presupuesto_id = $id;");
    }

    public function store(Request $request){
        $datosvalidados = $request->validate([
            'presupuesto_id'=> 'required',
            'item_id'=> 'required',
            'det_cantidad'=> 'required',
            'det_costo'=> 'required'
        ]);
        $detalle = PresupuestosDetalle::create($datosvalidados);
        return response()->json([
            'mensaje' => 'Registro creado con exito', 
            'tipo' =>'success',
            'registro' => $detalle
        ],200);
    } 

    public function update(Request $request, $presupuesto_id, $item_id){
        $detalle = DB::table('presupuestos_detalles')->
        where('presupuesto_id', $presupuesto_id)->
        where('item_id', $item_id)->
        update(['det_costo'=>$request->det_costo]);

        $detalle = DB::select("select * from presupuestos_detalles where presupuesto_id=$presupuesto_id and item_id=$item_id");

        return response()->json([
            'mensaje' => 'Registro modificado con exito', 
            'tipo' =>'success',
            'registro' => $detalle
        ],200);
    }

    public function destroy($presupuestos_id, $item_id){
        $detalle = DB::table('presupuestos_detalles')->
        where('presupuesto_id', $presupuesto_id)->
        where('item_id', $item_id)->
        delete();

        return response()->json([
            'mensaje' => 'Registro eliminado con exito', 
            'tipo' =>'success',
            'registro' => $detalle
        ],200);
    }

}
