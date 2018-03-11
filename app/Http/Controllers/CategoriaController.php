<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;

class CategoriaController extends Controller{

  public function inicio(){
    return view('administrador.categoria.inicio');
  }

  public function guardar(Request $request){
    $categoria = new Categoria;
    $categoria->nombre = mb_strtoupper($request->nombre);
    $categoria->save();

    return redirect('administrador/categoria')->with('correcto', 'LA CATEGORIA '.$categoria->nombre.
      ' FUE REGISTRADA CON ÉXITO.');
  }

  public function buscar($id){
    return Categoria::where('id', $id)->first();
  }

  public function todos(){
    return Categoria::get();
  }

  public function modificar(Request $request, $id){
    $categoria = Categoria::find($id);
    $categoria->nombre = mb_strtoupper($request->nombre);
    $categoria->update();

    return redirect('administrador/categoria')->with('correcto', 'LA CATEGORIA '.$categoria->nombre.
      ' FUE MODIFICADA CON ÉXITO.');
  }

  public function eliminar($id){
    $categoria = Categoria::find($id);
    $categoria->delete();
    return redirect('administrador/categoria')->with('info', 'LA CATEGORIA '.$categoria->nombre.
      ' FUE ELIMINADA CON ÉXITO.');
  }




  
}
