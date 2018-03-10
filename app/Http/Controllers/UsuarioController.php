<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\PersonaTrait;
use App\Usuario;
use Validator;

class UsuarioController extends Controller{

  public function guardar(Request $request){
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
  





}
