<?php

namespace App\Http\Traits;

use App\Persona;

class PersonaTrait{
  
  static function guardar(array $datos){
    $persona = new Persona;
    $persona->dni = $datos['dni'];
    $persona->nombres = mb_strtoupper($datos['nombres']);
    $persona->apellidos = mb_strtoupper($datos['apellidos']);
    $persona->direccion = mb_strtoupper($datos['direccion']);
    $persona->telefono = mb_strtoupper($datos['telefono']);
    $persona->email = mb_strtoupper($datos['email']);
    $persona->save();

    return Persona::find($datos['dni']);
  }







}






?>