<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Tienda;

class TiendaController extends Controller{
  
  public function inicio(){
    return view('administrador.tienda.inicio');
  }

  public function guardar(Request $request){
    Validator::make($request->all(), [
      'ruc'=>'required|max:11',
      'nombre'=>'required|max:45',
      'direccion'=>'required|max:45',
      'telefono'=>'nullable|max:45',
      'serie'=>'required|max:4',
      'ticketera'=>'nullable|max:255',
      'autorizacion'=>'nullable|max:255'
    ])->validate();

    $tienda = new Tienda;
    $tienda->ruc = $request->ruc;
    $tienda->nombre = mb_strtoupper($request->nombre);
    $tienda->direccion = mb_strtoupper($request->direccion);
    $tienda->telefono = mb_strtoupper($request->telefono);
    $tienda->serie = mb_strtoupper($request->serie);
    $tienda->ticketera = mb_strtoupper($request->ticketera);
    $tienda->autorizacion = mb_strtoupper($request->autorizacion);
    $tienda->save();

    return redirect('administrador/tienda')->with('correcto', 'LA TIENDA '.$tienda->nombre.' FUE CREADA CON ÉXITO.');
  }

  public function buscar($id){
    return Tienda::find($id);
  }

  public function modificar(Request $request, $id){
    Validator::make($request->all(), [
      'ruc'=>'required|max:11',
      'nombre'=>'required|max:45',
      'direccion'=>'required|max:45',
      'telefono'=>'nullable|max:45',
      'serie'=>'required|max:4',
      'ticketera'=>'nullable|max:255',
      'autorizacion'=>'nullable|max:255'
    ])->validate();

    $tienda = Tienda::find($id);
    if($request->serie != $tienda->serie){
      if(Tienda::where('serie', $request->serie)->first()){
        return redirect('administrador/tienda')->with('error', 'EL NRO DE SERIE YA ESTÁ EN USO.');
      }
    }

    $tienda->ruc = $request->ruc;
    $tienda->nombre = mb_strtoupper($request->nombre);
    $tienda->direccion = mb_strtoupper($request->direccion);
    $tienda->telefono = mb_strtoupper($request->telefono);
    $tienda->serie = mb_strtoupper($request->serie);
    $tienda->ticketera = mb_strtoupper($request->ticketera);
    $tienda->autorizacion = mb_strtoupper($request->autorizacion);
    $tienda->save();

    return redirect('administrador/tienda')->with('correcto', 'LA TIENDA '.$tienda->nombre.
    ' FUE MODIFICADA CON ÉXITO.');
    
  }

  public function eliminar($id){
    $tienda = Tienda::find($id);
    $tienda->delete();

    return redirect('administrador/tienda')->with('info', 'LA TIENDA '.$tienda->nombre.
      ' FUE ELIMINADA SIN PROBLEMAS.');
  }

  public function todos(){
    return Tienda::get();
  }






}
