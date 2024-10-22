<?php

namespace App\Http\Controllers;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use DB;

class ProveedorController extends Controller
{
    public function index(){
        return DB::table('proveedores')
        ->join('ciudades', 'proveedores.ciudad_id', '=', 'ciudades.id')
        ->join('nacionalidad', 'proveedores.nacionalidad_id', '=', 'nacionalidad.id')
        ->select('proveedores.*', 'ciudades.ciudades_descripcion as ciudades_descripcion', 'nacionalidad.nacion_descri as nacion_descri')
        ->get();
    }
    public function store(Request $r){
        $datosValidados = $r->validate([
            'prov_razonsocial'=> 'required',
            'prov_ruc'=> 'required',
            'prov_direccion'=> 'required',
            'prov_telefono'=> 'required',
            'prov_correo'=> 'required',
            'ciudad_id'=> 'required',
            'nacionalidad_id'=> 'required'
        ]);
        $proveedor = Proveedor::create($datosValidados);
        $proveedor->save();
        return response()->json([
            "mensaje"=>"registro creado con exito",
            "tipo"=>"success",
            "registro"=> $proveedor
        ],200);
     }
     public function update(Request $r, $id){
        $proveedor = Proveedor::find($id);
        if(!$proveedor){
            return response()->json([
                'mensaje'=>'Registro no encontrado',
                'tipo'=>'error'
            ],404);
        }
        $datosValidados = $r->validate([
            'prov_razonsocial'=>'required',
            'prov_ruc'=>'required',
            'prov_direccion'=>'required',
            'prov_telefono'=>'required',
            'prov_correo'=>'required',
            'ciudad_id'=>'required',
            'nacionalidad_id'=>'required'
        ]);
        $proveedor->update($datosValidados);
        return response()->json([
            'mensaje'=>'Registro modificado con exito',
            'tipo'=>'success',
            'registro'=> $proveedor
        ],200);
    }

    public function destroy($id){
        $proveedor = Proveedor::find($id);
        if(!$proveedor){
            return response()->json([
                'mensaje'=>'Registro no encontrado',
                'tipo'=>'error'
            ],404);
        }
        $proveedor->delete();
        return response()->json([
            'mensaje'=>'Registro Eliminado con exito',
            'tipo'=>'success',
        ],200);
    }

    public function buscar(Request $r){
        return DB::select("select p.*,p.id  as proveedor_id from proveedores p 
        where prov_razonsocial ilike '%{$r->prov_razonsocial}%' 
        or prov_ruc ilike '%{$r->prov_razonsocial}%'");
    }
     
}