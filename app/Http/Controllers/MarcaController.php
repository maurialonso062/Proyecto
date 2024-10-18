<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;


class MarcaController extends Controller
{
    // Método para obtener todos las marcas
    public function index(){
        return Marca::all();
    }

    public function store(Request $request){
        $datosValidados = $request->validate([
            'marca_nombre'=>'required'
        ]);
        $marca = Marca::create($datosValidados);
    $marca->save();
    return response()->json([
        "mensaje"=>"Registro creado con exito",
        "tipo"=>"success",
        "registro"=> $marca
    ], 200);
    }
}
