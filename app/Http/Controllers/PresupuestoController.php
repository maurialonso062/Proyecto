<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presupuesto;
use App\Models\Pedido;
use App\Models\PresupuestosDetalle;
use DB;

class PresupuestoController extends Controller
{
    public function index(){
        return DB::select("select 
        p.*,
        to_char(p.pre_vence, 'dd/mm/yyyy HH24:mi:ss') as pre_vence,
        p2. prov_razonsocial,
        p2.prov_ruc,
        p2.prov_telefono,
        p2.prov_correo,
        'PEDIDO NRO:'||to_char(p.pedido_id, '0000000')||'VENCE EL: '||to_char(p3.pedido_vence, 'dd/mm/yyyy HH24:mi:ss')||' ('||p3.pedido_observaciones||')' as pedido,
        to_char(p.pedido_id, '0000000') as nro_pedido,
        u.name, 
        u.login 
       from presupuestos p
       join proveedores p2 on p2.id = p.proveedor_id 
       join pedidos p3 on p3.id = p.pedido_id 
       join users u on u.id = p.user_id");
    }

    public function store(Request $request){
    $datosValidados = $request->validate([
        'pre_vence'=>'required',
        'pre_observaciones'=>'required',
        'pre_estado'=>'required',
        'proveedor_id'=>'required',
        'pedido_id'=>'required',
        'user_id'=>'required'
    ]);
    $presupuesto = Presupuesto::create($datosValidados);
    $presupuesto->save();

    $pedido = Pedido::find($request->pedido_id);
    $pedido->pedido_estado = "PROCESADO";
    $pedido->save();

    $detalles = DB::select("select 
    pd.*,
    i.item_costo
    from pedidos_detalles pd
    join items i on i.id = pd.item_id
    where pedido_id = $request->pedido_id;");

    foreach ($detalles as $dp){
        $presupuestosDetalle = new PresupuestosDetalle();
        $presupuestosDetalle-> presupuesto_id = $presupuesto->id;
        $presupuestosDetalle-> item_id = $dp->item_id;
        $presupuestosDetalle-> det_costo = $dp->item_costo;
        $presupuestosDetalle-> det_cantidad = $dp->det_cantidad;
        $presupuestosDetalle->save();
    }

    return response()->json([
        "mensaje"=>"Registro creado con exito",
        "tipo"=>"success",
        "registro"=> $presupuesto
    ], 200);
    }

    public function update(Request $request, $id){
        $presupuesto=Presupuesto::find($id);
        if (!$presupuesto){
            return response()->json([
            'mensaje' => 'Registro no encontrado', 
            'tipo' =>'error',
            ],404);
        }
        $datosvalidados = $request->validate([
            'pre_vence'=>'required',
            'pre_observaciones'=>'required',
            'pre_estado'=>'required',
            'proveedor_id'=>'required',
            'user_id'=>'required'
        ]);
        $presupuesto -> update($datosvalidados);

        return response()->json([
            'mensaje' => 'Registro modificado con exito', 
            'tipo' =>'success',
            'registro' => $presupuesto
        ],200);
    }
    public function destroy($id){
        $presupuesto=Presupuesto::find($id);
        if (!$presupuesto){
            return response()->json([
            'mensaje' => 'Registro no encontrado', 
            'tipo' =>'error',
            ],404);
        }
        $presupuesto->delete();
        return response()->json([
            'mensaje' => 'Registro eliminado con exito', 
            'tipo' =>'success'
        ],200);
    }
    public function anular(Request $request, $id){
        $presupuesto=Presupuesto::find($id);
        if (!$presupuesto){
            return response()->json([
            'mensaje' => 'Registro no encontrado', 
            'tipo' =>'error',
            ],404);
        }
        $datosvalidados = $request->validate([
            'pre_vence'=>'required',
            'pre_observaciones'=>'required',
            'pre_estado'=>'required',
            'proveedor_id'=>'required',
            'user_id'=>'required'
        ]);
        $presupuesto -> update($datosvalidados);

        $pedido = Pedido::find($request->pedido_id);
        $pedido->pedido_estado = "CONFIRMADO";
        $pedido->save();
        return response()->json([
            'mensaje' => 'Registro anulado con exito', 
            'tipo' =>'success',
            'registro' => $presupuesto
        ],200);
    }
    public function confirmar(Request $request, $id){
        $presupuesto=Presupuesto::find($id);
        if (!$presupuesto){
            return response()->json([
            'mensaje' => 'Registro no encontrado', 
            'tipo' =>'error',
            ],404);
        }
        $datosvalidados = $request->validate([
            'pre_vence'=>'required',
            'pre_observaciones'=>'required',
            'pre_estado'=>'required',
            'proveedor_id'=>'required',
            'user_id'=>'required'
        ]);
        $presupuesto -> update($datosvalidados);
        return response()->json([
            'mensaje' => 'Registro confirmado con exito', 
            'tipo' =>'success',
            'registro' => $presupuesto
        ],200);
    }

    public function rechazar(Request $request, $id){
        $presupuesto=Presupuesto::find($id);
        if (!$presupuesto){
            return response()->json([
            'mensaje' => 'Registro no encontrado', 
            'tipo' =>'error',
            ],404);
        }
        $datosvalidados = $request->validate([
            'pre_vence'=>'required',
            'pre_observaciones'=>'required',
            'pre_estado'=>'required',
            'proveedor_id'=>'required',
            'user_id'=>'required'
        ]);
        $presupuesto -> update($datosvalidados);
        return response()->json([
            'mensaje' => 'Registro rechazado con exito', 
            'tipo' =>'success',
            'registro' => $presupuesto
        ],200);
    }

    public function aprobar(Request $request, $id){
        $presupuesto=Presupuesto::find($id);
        if (!$presupuesto){
            return response()->json([
            'mensaje' => 'Registro no encontrado', 
            'tipo' =>'error',
            ],404);
        }
        $datosvalidados = $request->validate([
            'pre_vence'=>'required',
            'pre_observaciones'=>'required',
            'pre_estado'=>'required',
            'proveedor_id'=>'required',
            'user_id'=>'required'
        ]);
        $presupuesto -> update($datosvalidados);
        return response()->json([
            'mensaje' => 'Registro aprobado con exito', 
            'tipo' =>'success',
            'registro' => $presupuesto
        ],200);
    }
}