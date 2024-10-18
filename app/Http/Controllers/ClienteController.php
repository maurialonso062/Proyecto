<?php
namespace App\Http\Controllers;
use App\Models\Cliente;


use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(){
        return Cliente::all();
    }
    public function store(Request $r){
        $datosValidados = $r->validate([
            'cliente_nombre'=>'required',
            'cliente_apellido'=>'required',
            'cliente_ruc'=>'required',
            'cliente_direc'=>'required',
            'cliente_telefono'=>'required',
            'cliente_email'=>'required'
        ]);
        $cliente = Cliente::create($datosValidados);
        $cliente->save();
        return response()->json([
            "mensaje"=>"Registro creado con exito",
            "tipo"=>"success",
            "registro"=>$cliente
        ],200);
    }
    public function update(Request $r, $id){
        $cliente = Cliente::find($id);
        if(!$cliente){
            return response()->json([
                'mensaje'=>'Registro no encontrado',
                'tipo'=>'error'
            ],404);
        }
        $datosValidados = $r->validate([
            'cliente_nombre'=>'required',
            'cliente_apellido'=>'required',
            'cliente_ruc'=>'required',
            'cliente_direc'=>'required',
            'cliente_telefono'=>'required',
            'cliente_email'=>'required'
        ]);
        $cliente->update($datosValidados);
        return response()->json([
            'mensaje'=>'Registro modificado con exito',
            'tipo'=>'success',
            'registro'=> $cliente
        ],200);
    }   

    public function destroy($id){
        $cliente = Cliente::find($id);
        if(!$cliente){
            return response()->json([
                'mensaje'=>'Registro no encontrado',
                'tipo'=>'error'
            ],404);
        }
        $cliente->delete();
        return response()->json([
            'mensaje'=>'Registro Eliminado con exito',
            'tipo'=>'success',
        ],200);
    }
    public function buscar(Request $r){
        return DB::select(
        "select c.*,c.*,
        c.id as cliente_id from clientes c where cliente_nombre ilike '%{$r->cliente_nombre}%' or cliente_ruc ilike '%{$r->cliente_nombre}%'");
    }
}
