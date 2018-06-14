<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use Auth;

class LoginController extends Controller{

  public function inicio(){
    if (!Usuario::where('tipo_usuario', 0)->first()) {
      return view('configuracion.inicio');
    }
    if(Auth::check()){
      return redirect('tipo-usuario');
    }
    return redirect('login');
  }

  public function frmLogin(){
    if (!Usuario::where('tipo_usuario', 0)->first()) {
      return redirect('/');
    }
    if(Auth::check()){
      return redirect('tipo-usuario');
    }
    return view('login.login');
  }

  public function ingresar(Request $request){
    if (Auth::attempt(['persona_dni' => $request->dni, 'password' => $request->password])) {
      return redirect('tipo-usuario');
    }
    return redirect('/')->with('error', 'CREDENCIALES INCORRECTAS.');
  }

  public function tipoUsuario(){
    if(Auth::user()->tipo_usuario == 0){
      return redirect('administrador');
    }elseif(Auth::user()->tipo_usuario == 1){
      return redirect('cajero');
    }elseif(Auth::user()->tipo_usuario == 2){
      return redirect('mozo');
    }
  }

  public function salir(){
    Auth::logout();
    return redirect('/');
  }





}
