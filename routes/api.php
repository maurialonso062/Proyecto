<?php

use App\Http\Controllers\TipoController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PedidosDetalleController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\PresupuestoController;
use App\Http\Controllers\PresupuestosDetalleController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ItemMarcaController;
use App\Http\Controllers\TipoImpuestoController;
use App\Http\Controllers\NacionalidadController;
use App\Http\Controllers\ClienteController;

use App\Http\Controllers\AuthController;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get("tipos/read",[TipoController::class,"index"]);
Route::post("tipos/create",[TipoController::class,"store"]);
Route::put("tipos/update/{id}",[TipoController::class,"update"]);
Route::delete("tipos/delete/{id}",[TipoController::class,"destroy"]);

Route::get("items/read",[ItemController::class,"index"]);
Route::post("items/create",[ItemController::class,"store"]);
Route::put("items/update/{id}",[ItemController::class,"update"]);
Route::delete("items/delete/{id}",[ItemController::class,"destroy"]);
Route::post("items/buscar",[ItemController::class,"buscar"]);

Route::get("pedidos/read",[PedidoController::class,"index"]);
Route::post("pedidos/create",[PedidoController::class,"store"]);
Route::put("pedidos/update/{id}",[PedidoController::class,"update"]);
Route::delete("pedidos/delete/{id}",[PedidoController::class,"destroy"]);
Route::put("pedidos/anular/{id}",[PedidoController::class,"anular"]);
Route::put("pedidos/confirmar/{id}",[PedidoController::class,"confirmar"]);
Route::post("pedidos/buscar",[PedidoController::class,"buscar"]);

Route::get("pedidos-detalles/read/{id}",[PedidosDetalleController::class,"index"]);
Route::post("pedidos-detalles/create",[PedidosDetalleController::class,"store"]);
Route::put("pedidos-detalles/update/{pedido_id}/{item_id}",[PedidosDetalleController::class,"update"]);
Route::delete("pedidos-detalles/delete/{pedido_id}/{item_id}",[PedidosDetalleController::class,"destroy"]);

Route::get("paises/read",[PaisController::class,"index"]);
Route::post("paises/create",[PaisController::class,"store"]);
Route::put("paises/update/{id}",[PaisController::class,"update"]);
Route::delete("paises/delete/{id}",[PaisController::class,"destroy"]);
Route::post("paises/buscar",[PaisController::class,"buscar"]);

Route::get("ciudades/read",[CiudadController::class,"index"]);
Route::post("ciudades/create",[CiudadController::class,"store"]);
Route::put("ciudades/update/{id}",[CiudadController::class,"update"]);
Route::delete("ciudades/delete/{id}",[CiudadController::class,"destroy"]);
Route::post("ciudades/buscar",[CiudadController::class,"buscar"]);

Route::get("proveedores/read",[ProveedorController::class,"index"]);
Route::post("proveedores/create",[ProveedorController::class,"store"]);
Route::put("proveedores/update/{id}",[ProveedorController::class,"update"]);
Route::delete("proveedores/delete/{id}",[ProveedorController::class,"destroy"]);
Route::post("proveedores/buscar",[ProveedorController::class,"buscar"]);

Route::post("presupuestos/create",[PresupuestoController::class,"store"]);
Route::get("presupuestos/read",[PresupuestoController::class,"index"]);
Route::put("presupuestos/update/{id}",[PresupuestoController::class,"update"]);
Route::put("presupuestos/anular/{id}",[PresupuestoController::class,"anular"]);
Route::put("presupuestos/confirmar/{id}",[PresupuestoController::class,"confirmar"]);
Route::put("presupuestos/rechazar/{id}",[PresupuestoController::class,"rechazar"]);
Route::put("presupuestos/aprobar/{id}",[PresupuestoController::class,"aprobar"]);


Route::get("presupuestos-detalles/read/{id}",[PresupuestosDetalleController::class,"index"]);
Route::post("presupuestos-detalles/create/{id}",[PresupuestosDetalleController::class,"store"]);
Route::put("presupuestos-detalles/update/{presupuesto_id}/{item_id}",[PresupuestosDetalleController::class,"update"]);
Route::delete("presupuestos-detalles/delete/{presupuesto_id}/{item_id}",[PresupuestosDetalleController::class,"destroy"]);

Route::get("perfiles/read",[PerfilController::class,"index"]);
Route::post("perfiles/create",[PerfilController::class,"store"]);
Route::delete("perfiles/delete/{id}",[PerfilController::class,"destroy"]);

Route::get("marca/read",[MarcaController::class,"index"]);
Route::post("marca/create",[MarcaController::class,"store"]);
Route::put("marca/update/{id}",[MarcaController::class,"update"]);
Route::delete("marca/delete/{id}",[MarcaController::class,"destroy"]);

Route::get("item_marca/read",[ItemMarcaController::class,"index"]);
Route::post("item_marca/create",[ItemMarcaController::class,"store"]);
Route::put("item_marca/update/{id}",[ItemMarcaController::class,"update"]);
Route::delete("item_marca/delete/{id}",[ItemMarcaController::class,"destroy"]);

Route::get("tipo_impuesto/read",[TipoImpuestoController::class,"index"]);
Route::post("tipo_impuesto/create",[TipoImpuestoController::class,"store"]);
Route::put("tipo_impuesto/update/{id}",[TipoImpuestoController::class,"update"]);
Route::delete("tipo_impuesto/delete/{id}",[TipoImpuestoController::class,"destroy"]);

Route::get("nacionalidad/read",[NacionalidadController::class,"index"]);
Route::post("nacionalidad/create",[NacionalidadController::class,"store"]);
Route::put("nacionalidad/update/{id}",[NacionalidadController::class,"update"]);
Route::delete("nacionalidad/delete/{id}",[NacionalidadController::class,"destroy"]);

Route::get("cliente/read",[ClienteController::class,"index"]);
Route::post("cliente/create",[ClienteController::class,"store"]);
Route::put("cliente/update/{id}",[ClienteController::class,"update"]);
Route::delete("cliente/delete/{id}",[ClienteController::class,"destroy"]);
Route::post("cliente/buscar",[ClienteController::class,"buscar"]);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('registrarse',[AuthController::class, 'register']);
Route::post('login',[AuthController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('logout',[AuthController::class, 'logout']);
    
});