<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use DB;

class PedidoController extends Controller
{
    public function index(){
        return DB::select("SELECT
            p.id,
            to_char(p.pedido_vence, 'dd/mm/yyyy HH24:mi:ss') AS pedido_vence, 
            p.pedido_observaciones,
            p.pedido_estado, 
            p.user_id,
            p.created_at,
            p.updated_at,
            p.pedido_fecha_aprob,
            p.empresa_id,
            p.sucursal_id,
            u.name,
            u.login,
            e.empresa_descri,  -- Añadir la descripción de la empresa
            s.suc_descri      -- Añadir la descripción de la sucursal
        FROM
            pedidos p 
        JOIN
            users u ON u.id = p.user_id
        JOIN
            empresa e ON e.id = p.empresa_id  -- Unir con la tabla de empresas
        JOIN
            sucursal s ON s.id = p.sucursal_id;  -- Unir con la tabla de sucursales
        ");
    }
    public function store(Request $request){
        $datosvalidados = $request->validate([
            'pedido_vence'=> 'required',
            'pedido_observaciones'=> 'required',
            'pedido_estado'=> 'required',
            'user_id'=> 'required',
            'pedido_fecha_aprob'=> 'required',
            'empresa_id'=> 'required',
            'sucursal_id'=> 'required'
        ]);
        $pedido = Pedido::create($datosvalidados);

        $pedido->save();

        return response()->json([
            'mensaje' => 'Registro creado con exito', 
            'tipo' =>'success',
            'registro' => $pedido
        ],200);
    }
    public function update(Request $request, $id){
        $pedido=Pedido::find($id);
        if (!$pedido){
            return response()->json([
            'mensaje' => 'Registro no encontrado', 
            'tipo' =>'error',
            ],404);
        }
        $datosvalidados = $request->validate([
            'pedido_vence'=> 'required',
            'pedido_observaciones'=> 'required',
            'pedido_estado'=> 'required',
            'user_id'=> 'required',
            'pedido_fecha_aprob'=> 'required',
            'empresa_id'=> 'required',
            'sucursal_id'=> 'required'
        ]);
        $pedido -> update($datosvalidados);
        return response()->json([
            'mensaje' => 'Registro modificado con exito', 
            'tipo' =>'success',
            'registro' => $pedido
        ],200);
    } 
    public function destroy($id){
        $pedido=Pedido::find($id);
        if (!$pedido){
            return response()->json([
            'mensaje' => 'Registro no encontrado', 
            'tipo' =>'error',
            ],404);
        }

        $pedido->delete();
        return response()->json([
            'mensaje' => 'Registro eliminado con exito', 
            'tipo' =>'success'
        ],200);
    }
    public function anular(Request $request, $id){
        $pedido=Pedido::find($id);

        if (!$pedido){
            return response()->json([
            'mensaje' => 'Registro no encontrado', 
            'tipo' =>'error',
            ],404);
        }
        
        $datosvalidados = $request->validate([
            'pedido_vence'=> 'required',
            'pedido_observaciones'=> 'required',
            'pedido_estado'=> 'required',
            'user_id'=> 'required',
            'pedido_fecha_aprob'=> 'required',
            'empresa_id'=> 'required',
            'sucursal_id'=> 'required'
        ]);
        
        $pedido -> update($datosvalidados);

        return response()->json([
            'mensaje' => 'Registro anulado con exito', 
            'tipo' =>'success',
            'registro' => $pedido
        ],200);
    }
    public function confirmar(Request $request, $id){
        
        $pedido=Pedido::find($id);

        if (!$pedido){
            return response()->json([
            'mensaje' => 'Registro no encontrado', 
            'tipo' =>'error',
            ],404);
        }

        $datosvalidados = $request->validate([
            'pedido_vence'=> 'required',
            'pedido_observaciones'=> 'required',
            'pedido_estado'=> 'required',
            'user_id'=> 'required',
            'pedido_fecha_aprob'=> 'required',
            'empresa_id'=> 'required',
            'sucursal_id'=> 'required'
        ]);

        $pedido -> update($datosvalidados);

        return response()->json([
            'mensaje' => 'Registro confirmado con exito', 
            'tipo' =>'success',
            'registro' => $pedido
        ],200);
    }

    public function buscar(Request $r){
        return DB::select("select
        p.id,
        to_char(p.pedido_vence, 'dd/mm/yyyy HH24:mi:ss') as pedido_vence, 
        p.pedido_observaciones,
        p.pedido_estado, 
        p.user_id,
        p.created_at,
        p.updated_at,
        u.name,
        u.login,
        p.id as pedido_id,
        'PEDIDO NRO:'||to_char(p.id, '0000000')||'VENCE EL: '||to_char(p.pedido_vence, 'dd/mm/yyyy HH24:mi:ss')||' ('||pedido_observaciones||')' as pedido
        from pedidos p join users u on u.id = p.user_id
        where pedido_estado = 'CONFIRMADO' and p.user_id = {$r->user_id} and u.name ilike '%{$r->name}%'");
    }
}
