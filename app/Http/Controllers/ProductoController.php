<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\LocalProducto;

class ProductoController extends Controller{

  public function todos(){
    return Producto::with(['categoria', 'locales'])->get();
  }

  public function inicio(){
    return view('administrador.producto.inicio');
  }

  public function guardar(Request $request){
    $this->validate($request, [
      'nombre'=>'required',
      'categoria_id'=>'required|exists:categorias,id'
    ]);
    $producto = new Producto;
    $producto->nombre = mb_strtoupper($request->nombre);
    $producto->categoria_id = $request->categoria_id;
    $producto->save();

    return response('EL PRODUCTO '.$producto->nombre.' FUE REGISTRADO CON ÉXITO.');
  }

  public function buscar($id){
    return Producto::with(['categoria', 'localProducto'])->where('id', $id)->first();
  }

  public function modificar(Request $request, $id){
    $this->validate($request, [
      'nombre'=>'required',
      'categoria_id'=>'required|exists:categorias,id'
    ]);
    $producto = Producto::find($id);
    $producto->nombre = mb_strtoupper($request->nombre);
    $producto->categoria_id = $request->categoria_id;
    $producto->update();

    return response('EL PRODUCTO '.$producto->nombre.' FUE MODIFICADO CON ÉXITO.', 200);
  }

  public function eliminar($id){
    $producto = Producto::find($id);
    $producto->delete();

    return response('EL PRODUCTO '.$producto->nombre.' FUE ELIMINADO CON ÉXITO.', 200);
  }

  public function precio(Request $request, $id){
    $this->validate($request, [
      'precio'=>'required|numeric',
      'tienda'=>'required|exists:locales,id',
      'producto'=>'required|exists:productos,id'
    ]);
    $producto = Producto::find($id);
    if($localProducto = LocalProducto::where('local_id', $request->tienda)->where('producto_id', $id)->first()){
      $localProducto->precio = $request->precio;
      $localProducto->update();
    }else{
      $localProducto = new LocalProducto;
      $localProducto->local_id = $request->tienda;
      $localProducto->producto_id = $id;
      $localProducto->precio = $request->precio;
      $localProducto->save();
    }
    return response('SE AGREGÓ UN PRECIO AL PRODUCTO '.$producto->nombre.' CON ÉXITO', 200);
  }






  



}
