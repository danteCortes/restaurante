<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Usuario;
use App\Venta;
use App\LocalProducto;
use Validator;
use App\Http\Traits\VentaTrait;
use App\Http\Traits\DetalleVentaTrait;
use App\Http\Traits\LocalProductoTrait;
use Carbon\Carbon;

class PedidoController extends Controller{

  public function inicio(){
    return view('mozo.pedido.inicio.inicio');
  }

  public function nuevo(){
    return view('mozo.pedido.nuevo.inicio');
  }

  public function validar(Request $request){
    $estado = 1;
    $mensaje = "";
    if (empty($request->dni)) {
      $estado = 0;
      $mensaje = "EL DNI DEL MOZO ES UN CAMPO OBLIGATORIO";
      goto terminar;
    }
    if (empty($request->password)) {
      $estado = 0;
      $mensaje = "EL PASSWORD ES UN CAMPO OBLIGATORIO";
      goto terminar;
    }
    if (empty($request->mesa)) {
      $estado = 0;
      $mensaje = "EL NÚMERO DE MESA ES UN CAMPO OBLIGATORIO";
      goto terminar;
    }
    if(!$usuario = Usuario::where('persona_dni', $request->dni)->first()){
      $estado = 0;
      $mensaje = "NO EXISTE UN USUARIO CON ESE NÚMERO DE DNI.";
    }else{
      if (!Hash::check($request->password, $usuario->password)) {
        $estado = 0;
        $mensaje = "EL PASSWORD ES INCORRECTO, PRUEBE NUEVAMENTE";
        goto terminar;
      }
      if(empty($usuario->local_id)){
        $estado = 0;
        $mensaje = "ESTE USUARIO NO ESTÁ REGISTRADO A UNA TIENDA, COMUNIQUE AL ADMINISTRADOR";
        goto terminar;
      }
    }
    terminar:
    return ['estado'=>$estado, 'mensaje'=>$mensaje];
  }

  public function guardar(Request $request){

    Validator::make($request->all(), [
      'mozo'=>'required|exists:usuarios,persona_dni',
      'mesa'=>'required|integer'
    ])->validate();
    $usuario = Usuario::where('persona_dni', $request->mozo)->first();
    if(!Hash::check($request->password, $usuario->password)){
      return redirect('mozo/pedido/nuevo')->with('error', 'EL PASSWORD DEL MOZO ES INCORRECTO');
    }
    if(empty($usuario->local_id)){
      return redirect('mozo/pedido/nuevo')->with('error', 'EL USUARIO NO ESTÁ REGISTRADO EN UNA TIENDA.');
    }
    $datosVenta = ['usuario_id'=>$usuario->id, 'local_id'=>$usuario->tienda->id, 'mesa'=>$request->mesa,
      'cliente'=>$request->cliente, 'llevar'=>$request->llevar];
    $venta = VentaTrait::guardar($datosVenta);

    foreach ($request->cantidades as $producto_id => $cantidad) {
      $localProducto = LocalProducto::where('local_id', $usuario->local_id)->where('producto_id', $producto_id)
        ->first();
      $datosDetalleVenta = ['venta_id'=>$venta->id, 'local_producto_id'=>$localProducto->id, 'cantidad'=>$cantidad,
      'precio_unitario'=>$localProducto->producto->precio];
      $detalleVenta = DetalleVentaTrait::guardar($datosDetalleVenta);
      LocalProductoTrait::disminuirProducto($localProducto, $cantidad);
      $venta = VentaTrait::actualizarTotal($venta, $detalleVenta);
    }
    
    return redirect('mozo/pedido')->with('correcto', 'EL PEDIDO FUÉ REGISTRADO CON ÉXITO');
  }

  public function buscarPedidos($dni){
    $usuario = Usuario::where('persona_dni', $dni)->first();
    return Venta::with('detallesVenta')->where('usuario_id', $usuario->id)
      ->whereDate('fecha', Carbon::now()->format('Y-m-d'))->get();
  }

  public function buscar($id){
    return Venta::with('detallesVenta.localProducto.producto')->where('id', $id)->first();
  }
  





}
