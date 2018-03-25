<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model{

  public $timestamps = false;

  public function detallesVenta(){
    return $this->hasMany('App\DetalleVenta');
  }
  



}
