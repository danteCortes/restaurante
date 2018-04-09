<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CajeroController extends Controller{

  public function inicio(){
    return view('cajero.pedido.inicio.inicio');
  }
  



}
