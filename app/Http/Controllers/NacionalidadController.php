<?php

namespace App\Http\Controllers;
use App\Models\Nacionalidad;

use Illuminate\Http\Request;

class NacionalidadController extends Controller
{
    public function index(){
        return Nacionalidad::all();
    }
    public function store(Request $r){
        $datosValidados = $r->validate([
            'nacion_descri'=>'required'
        ]);
        $nacionalidad = Nacionalidad::create($datosValidados);
        $nacionalidad->save();
        return response()->json([
            'mensaje'=>'Registro creado con exito',
            'tipo'=>'success',
            'registro'=> $nacionalidad
        ],200);
    }
    public function update(Request $r, $id){
        $nacionalidad = Nacionalidad::find($id);
        if(!$nacionalidad){
            return response()->json([
                'mensaje'=>'Registro no encontrado',
                'tipo'=>'error'
            ],404);
        }
        $datosValidados = $r->validate([
            'nacion_descri'=>'required'
        ]);
        $nacionalidad->update($datosValidados);
        return response()->json([
            'mensaje'=>'Registro modificado con exito',
            'tipo'=>'success',
            'registro'=> $nacionalidad
        ],200);
    }
    public function destroy($id){
        $nacionalidad = Nacionalidad::find($id);
        if(!$nacionalidad){
            return response()->json([
                'mensaje'=>'Registro no encontrado',
                'tipo'=>'error'
            ],404);
        }
        $nacionalidad->delete();
        return response()->json([
            'mensaje'=>'Registro Eliminado con exito',
            'tipo'=>'success',
        ],200);
    }
}