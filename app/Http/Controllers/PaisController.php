<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pais;
use DB;

class PaisController extends Controller
{
    public function index(){
        return Pais::all();
    }

    public function store(Request $request){
    $datosValidados = $request->validate([
        'pais_descripcion'=>'required',
        'pais_gentilicio'=>'required',
        'pais_siglas'=>'required'
    ]);
    $pais = Pais::create($datosValidados);
    $pais->save();
    return response()->json([
        "mensaje"=>"Registro creado con exito",
        "tipo"=>"success",
        "registro"=> $pais
    ], 200);
    }

    public function buscar(Request $request) {
        // Obtener el término de búsqueda
        $searchTerm = $request->input('descripcion'); // Asegúrate de que 'descripcion' esté en la solicitud
    
        // Realizar la consulta
        $resultados = DB::table('paises')
            ->select('pais_descripcion') // Solo selecciona la columna de descripción
            ->where('pais_descripcion', 'ILIKE', "%$searchTerm%")
            ->orWhere('pais_gentilicio', 'ILIKE', "%$searchTerm%")
            ->orWhere('pais_siglas', 'ILIKE', "%$searchTerm%")
            ->get();
    
        // Retornar los resultados en formato JSON
        return response()->json($resultados);
    }
}