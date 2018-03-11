<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;

class ProductoController extends Controller{

  public function inicio(){
    return view('administrador.producto.inicio');
  }

  public function guardar(Request $request){
    $producto = new Producto;
    $producto->nombre = mb_strtoupper($request->nombre);
    $producto->precio = number_format($request->precio, 2, '.', '');
    $producto->categoria_id = $request->categoria_id;
    $producto->save();

    return redirect('administrador/producto')->with('correcto', 'EL PRODUCTO '.$producto->nombre.
      ' FUE REGISTRADO CON ÉXITO.');
  }

  public function buscar($id){
    return Producto::with('categoria')->where('id', $id)->first();
  }

  public function modificar(Request $request, $id){
    $producto = Producto::find($id);
    $producto->nombre = mb_strtoupper($request->nombre);
    $producto->precio = number_format($request->precio, 2, '.', '');
    $producto->categoria_id = $request->categoria_id;
    $producto->update();

    return redirect('administrador/producto')->with('correcto', 'EL PRODUCTO '.$producto->nombre.
      ' FUE MODIFICADO CON ÉXITO.');
  }

  public function eliminar($id){
    $producto = Producto::find($id);
    $producto->delete();

    return redirect('administrador/producto')->with('info', 'EL PRODUCTO '.$producto->nombre.
      ' FUE ELIMINADO CON ÉXITO.');
  }






  



}
