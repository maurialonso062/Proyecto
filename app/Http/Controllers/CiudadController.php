<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ciudad;
use App\Models\Pais;
use DB;

class CiudadController extends Controller
{
    public function index()
    {
        return DB::select('select c.*, p.pais_descripcion from ciudades c inner join paises p on p.id = c.pais_id;');
    }

    public function store(Request $request)
    {
        $datosValidados = $request->validate([
            'ciudades_descripcion' => 'required',
            'pais_descripcion' => 'required'
        ]);

        
        $pais = Pais::where('pais_descripcion', $datosValidados['pais_descripcion'])->first();

        if (!$pais) {
            return response()->json([
                "mensaje" => "País no encontrado.",
                "tipo" => "error"
            ], 404);
        }

        // Crear la ciudad con el pais_id encontrado
        $ciudad = Ciudad::create([
            'ciudades_descripcion' => $datosValidados['ciudades_descripcion'],
            'pais_id' => $pais->id // Usar el ID del país encontrado
        ]);

        return response()->json([
            "mensaje" => "Registro creado con éxito",
            "tipo" => "success",
            "registro" => $ciudad
        ], 200);
    }

    public function update(Request $r, $id)
    {
        $ciudad = Ciudad::find($id);
        if (!$ciudad) {
            return response()->json([
                'mensaje' => 'Registro no encontrado',
                'tipo' => 'error'
            ], 404);
        }

        $datosValidados = $r->validate([
            'ciudades_descripcion' => 'required',
            'pais_descripcion' => 'required' // Cambiado a pais_descripcion
        ]);

        // Buscar el pais_id a partir de la descripcion
        $pais = Pais::where('pais_descripcion', $datosValidados['pais_descripcion'])->first();

        if (!$pais) {
            return response()->json([
                "mensaje" => "País no encontrado.",
                "tipo" => "error"
            ], 404);
        }

        // Actualizar la ciudad con el nuevo pais_id
        $ciudad->update([
            'ciudades_descripcion' => $datosValidados['ciudades_descripcion'],
            'pais_id' => $pais->id // Usar el ID del país encontrado
        ]);

        return response()->json([
            'mensaje' => 'Registro modificado con éxito',
            'tipo' => 'success',
            'registro' => $ciudad
        ], 200);
    }

    public function destroy($id)
    {
        $ciudad = Ciudad::find($id);
        if (!$ciudad) {
            return response()->json([
                'mensaje' => 'Registro no encontrado',
                'tipo' => 'error'
            ], 404);
        }
        $ciudad->delete();
        return response()->json([
            'mensaje' => 'Registro eliminado con éxito',
            'tipo' => 'success',
        ], 200);
    }
}