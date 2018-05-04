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
use Auth;

class PedidoController extends Controller{

  public function inicio(){
    if(Auth::user()->tipo_usuario == 2){
      return view('mozo.pedido.inicio.inicio');
    }elseif(Auth::user()->tipo_usuario == 1){
      return view('cajero.pedido.nuevo.inicio');
    }
  }

  public function nuevo(){
    return view('mozo.pedido.nuevo.inicio');
  }

  private function validarDatos(Request $request){
    $this->validate($request, [
      'dni'       =>  'required|digits:8|exists:usuarios,persona_dni',
      'password'  =>  'required',
      'mesa'      =>  'nullable|numeric|min:1|required_without:llevar',
      'cliente'   =>  'nullable|required_with:llevar'
    ]);
    $estado = 200;
    $respuesta = [];
    $usuario = Usuario::where('persona_dni', $request->dni)->first();
    if (!Hash::check($request->password, $usuario->password)) {
      $estado = 422;
      $mensaje = "EL PASSWORD ES INCORRECTO, PRUEBE NUEVAMENTE";
      $respuesta = ['errors'=>['password'=>$mensaje], 'message'=>'The given data was invalid.'];
      goto terminar;
    }
    if(empty($usuario->local_id)){
      $estado = 422;
      $mensaje = "ESTE USUARIO NO ESTÁ REGISTRADO A UNA TIENDA, COMUNIQUE AL ADMINISTRADOR";
      $respuesta = ['errors'=>['dni'=>$mensaje], 'message'=>'The given data was invalid.'];
      goto terminar;
    }
    terminar:
    return response($respuesta, $estado);
  }

  public function validar(Request $request){
    return $this->validarDatos($request);
  }

  public function guardar(Request $request){

    $this->validate($request, [
      'dni' => 'required|digits:8',
      'detalles'=>'required',
      'mesa'=>'nullable|required_without:cliente,llevar',
      'cliente'=>'nullable|required_without:mesa'
    ]);
    $respuesta = [];
    $usuario = Usuario::where('persona_dni', $request->dni)->first();
    if($request->password){
      if (!Hash::check($request->password, $usuario->password)) {
        $mensaje = "EL PASSWORD ES INCORRECTO, PRUEBE NUEVAMENTE";
        $respuesta = ['errors'=>['password'=>$mensaje], 'message'=>'The given data was invalid.'];
        return response($respuesta, 422);
      }
    }
    if(empty($usuario->local_id)){
      $mensaje = "ESTE USUARIO NO ESTÁ REGISTRADO A UNA TIENDA, COMUNIQUE AL ADMINISTRADOR";
      $respuesta = ['errors'=>['dni'=>$mensaje], 'message'=>'The given data was invalid.'];
      return response($respuesta, 422);
    }    

    $datosVenta = ['usuario_id'=>$usuario->id, 'local_id'=>$usuario->tienda->id, 'mesa'=>$request->mesa,
      'cliente'=>$request->cliente, 'llevar'=>$request->llevar];
    $venta = VentaTrait::guardar($datosVenta);

    foreach ($request->detalles as $detalle) {
      $localProducto = LocalProducto::where('local_id', $usuario->local_id)->where('producto_id', $detalle['id'])
        ->first();
      $datosDetalleVenta = ['venta_id'=>$venta->id, 'local_producto_id'=>$localProducto->id, 
        'cantidad'=>$detalle['cantidad'], 'precio_unitario'=>$localProducto->precio];
      $detalleVenta = DetalleVentaTrait::guardar($datosDetalleVenta);
      LocalProductoTrait::disminuirProducto($localProducto, $detalle['cantidad']);
      $venta = VentaTrait::actualizarTotal($venta, $detalleVenta);
    }
    
    return response('EL PEDIDO FUÉ REGISTRADO CON ÉXITO', 200);
  }

  public function buscarPedidos($dni){
    $usuario = Usuario::where('persona_dni', $dni)->first();
    return Venta::with('detallesVenta.localProducto.producto')->where('usuario_id', $usuario->id)
      ->whereDate('fecha', Carbon::now()->format('Y-m-d'))->get();
  }

  public function buscar($id){
    return Venta::with('detallesVenta.localProducto.producto')->with('tienda')->with('usuario.persona')
      ->where('id', $id)->first();
  }
  
  public function todos(){
    $pedidos = Venta::whereDate('fecha', Carbon::now()->format('Y-m-d'))->where('local_id', Auth::user()->local_id)
    ->where('estado', '!=', 2)->with('usuario.persona')->with('tienda')->get();
    return $pedidos;
  }

  public function servir(Request $request){
    $pedido = Venta::find($request->id);
    $pedido->estado = 1;
    $pedido->update();
  }

  public function cobrar(Request $request){
    $pedido = Venta::find($request->id);
    $pedido->estado = 2;
    $pedido->save();
  }

  public function ingresar(Request $request){
    $this->validate($request, [
      'dni'=>'required|digits:8|exists:usuarios,persona_dni',
      'password'=>'required|string'
    ]);
    $usuario = Usuario::where('persona_dni', $request->dni)->first();
    if(Hash::check($request->password, $usuario->password)){
      if($usuario->local_id){
        return response(['tienda'=>$usuario->local_id, "mensaje"=>"PUEDE HACER EL PEDIDO."], 200);
      }
      return response(["errors"=>["dni"=>"El usuario no tiene asignado un local."]], 422);
    }
    return response(["errors"=>["dni"=>"Las credenciales son incorrectas."]], 422);
  }





}
