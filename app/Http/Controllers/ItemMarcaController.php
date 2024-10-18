<?php

namespace App\Http\Controllers;

use App\Models\ItemMarca;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ItemMarcaController extends Controller
{
    public function index(){
        return DB::table('item_marca')
            ->join('marca', 'item_marca.marca_id', '=', 'marca.id')
            ->join('items', 'item_marca.item_id', '=', 'item_id')
            ->select('item_marca.*', 'marca.marca_nombre', 'items.item_descripcion')
            ->get();
    }   

    public function store(Request $request){
        $datosValidados = $request->validate([
            'marca_id' => 'required',
            'item_id' => 'required',
            'item_marca_descri' => 'required'
        ]);

        $itemmarca = ItemMarca::create($datosValidados);
        $itemmarca->save();
        return response()->json([
            'mensaje' => 'Registro creado con exito',
            'tipo' => 'success',
            'registro' => $itemmarca
        ], 200);
    }
        public function update(Request $request, $marca_id, $items_id){
            $itemmarca  = DB::table('item_marca')->
            where('marca_id', $marca_id)->
            where('item_id', $items_id)->
            update(['item_marca_descri' => $request->item_marca_descri
            ]);

            $itemmarca = DB::select("select * from item_marca where marca_id = $marca_id and items_id = $items_id");
            return response()->json([
                'mensaje' => 'Registro Modificado con exito',
                'tipo' => 'success',
                'registro' => $itemmarca
            ], 200);
        }

        public function destroy($marca_id, $item_id){
            $itemmarca=DB::table('item_marca')->
            where('marca_id', $marca_id)->
            where('item_id', $item_id)->
            delete();
            return response()->json([
               'mensaje' => 'Registro Eliminado con exito',
                'tipo' =>'success',
                'registro' => $itemmarca
            ], 200);
        }
    }


