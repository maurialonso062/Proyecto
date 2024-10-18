<?php

namespace App\Http\Controllers;
use App\Models\TipoImpuesto;

use Illuminate\Http\Request;

class TipoImpuestoController extends Controller
{
    public function index(){
        return TipoImpuesto::all();
    }   

    public function store(Request $request){
       $datosValidados = $request->validate([
        'tipo_imp_descrip' => 'required',
        'tipo_imp_tasa' => 'required',
       ]);

       $tipoimpuesto = TipoImpuesto::create($datosValidados);
       $tipoimpuesto->save();
       return response()->json([
        'mensaje' => 'Registro creado con exito',
        'tipo' => 'success',
        'regsitro' => $tipoimpuesto
       ],200);
    }

    public function update(Request $request, $id){
        $tipoimpuesto = TipoImpuesto::find($id);
        if(!$tipoimpuesto){
        return response()->json([
        'mensaje'=> 'Registro no encontrado',
        'tipo'=>'error',
        ],404);
        
        }
        $datosValidados = $request->validate([
        'tipo_imp_descrip'=> 'required',
        'tipo_imp_tasa'=> 'required'
        ]);
        
        $tipoimpuesto->update($datosValidados);
        return response()->json([
        'mensaje'=> 'Registro modificado con exito',
        'tipo'=>'success',
        'registro'=> $tipoimpuesto
        ],200);
    }
    public function destroy($id){
        $tipoimpuesto = TipoImpuesto::find($id);
        if(!$tipoimpuesto){
        return response()->json([
        'mensaje'=> 'Registro no encontrado',
        'tipo'=>'error'
        ],404);
        
        }
        $tipoimpuesto->delete();
        return response()->json([
        'mensaje'=> 'Registro eliminado con exito',
        'tipo'=>'success', 
    
    ],200);}   
}
