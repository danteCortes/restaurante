<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\PersonaTrait;
use App\Usuario;
use App\Persona;
use Validator;

class UsuarioController extends Controller{

  public function primerUsuario(Request $request){
    Validator::make($request->all(), [
      'dni'=>'required|size:8',
      'nombres'=>'required|max:255',
      'apellidos'=>'required|max:255'
    ])->validate();

    $datosPersona = ['dni'=>$request->dni, 'nombres'=>$request->nombres, 'apellidos'=>$request->apellidos,
      'direccion'=>null, 'telefono'=>null, 'email'=>null];
    $persona = PersonaTrait::guardar($datosPersona);

    $usuario = new Usuario;
    $usuario->persona_dni = $persona->dni;
    $usuario->password = Hash::make($persona->dni);
    $usuario->tipo_usuario = 0;
    $usuario->save();

    return redirect('login');
  }

  public function inicio(){
    return view('administrador.usuario.inicio');
  }

  public function guardar(Request $request){
    Validator::make($request->all(), [
      'dni'=>'required|size:8',
      'nombres'=>'required|max:255',
      'apellidos'=>'required|max:255',
      'direccion'=>'nullable|max:255',
      'telefono'=>'nullable|max:255',
      'email'=>'nullable|email|max:255',
      'tipo_usuario'=>'required',
      'tienda_id'=>'nullable|exists:locales,id'
    ], [
      'tipo_usuario'=>'El Cargo es un campo obligatorio.'
    ])->validate();

    $datosPersona = ['dni'=>$request->dni, 'nombres'=>$request->nombres, 'apellidos'=>$request->apellidos,
      'direccion'=>$request->direccion, 'telefono'=>$request->telefono, 'email'=>$request->email];
    if($persona = Persona::find($request->dni)){
      $persona = PersonaTrait::modificar($persona, $datosPersona);
    }else{
      $persona = PersonaTrait::guardar($datosPersona);
    }

    $usuario = new Usuario;
    $usuario->persona_dni = $persona->dni;
    $usuario->local_id = $request->tienda_id;
    $usuario->password = Hash::make($persona->dni);
    $usuario->tipo_usuario = $request->tipo_usuario;
    $usuario->save();

    return redirect('administrador/usuario')->with('correcto', 'EL USUARIO '.$usuario->persona->nombres.
      ' FUE REGISTRADO CON ÉXITO');
  }

  public function buscar($id){
    return Usuario::with('persona')->with('tienda')->where('id', $id)->first();
  }

  public function modificar(Request $request, $id){
    Validator::make($request->all(), [
      'dni'=>'required|size:8',
      'nombres'=>'required|max:255',
      'apellidos'=>'required|max:255',
      'direccion'=>'nullable|max:255',
      'telefono'=>'nullable|max:255',
      'email'=>'nullable|email|max:255',
      'tipo_usuario'=>'required',
      'tienda_id'=>'nullable|exists:locales,id'
    ], [
      'tipo_usuario'=>'El Cargo es un campo obligatorio.'
    ])->validate();

    $usuario = Usuario::find($id);

    $datosPersona = ['dni'=>$request->dni, 'nombres'=>$request->nombres, 'apellidos'=>$request->apellidos,
      'direccion'=>$request->direccion, 'telefono'=>$request->telefono, 'email'=>$request->email];
    if($request->dni != $usuario->persona->dni){
      if(Persona::find($request->dni)){
        return redirect('administrador/usuario')->with('error', 'EL DNI INGRESADO YA ESTÁ EN USO.');
      }
    }
    $persona = PersonaTrait::modificar($usuario->persona, $datosPersona);
    
    $usuario->local_id = $request->tienda_id;
    $usuario->tipo_usuario = $request->tipo_usuario;
    $usuario->update();

    return redirect('administrador/usuario')->with('correcto', 'EL USUARIO '.$usuario->persona->nombres.
      ' FUE MODIFICADO CON ÉXITO');
  }

  public function eliminar($id){
    $usuario = Usuario::find($id);
    $usuario->delete();

    return redirect('administrador/usuario')->with('info', 'EL USUARIO '.$usuario->persona->nombres.
      ' FUE ELIMINADO CON ÉXITO.');
  }
  





}
