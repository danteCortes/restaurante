<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model{

  public $timestamps = false;

  public function detallesVenta(){
    return $this->hasMany('App\DetalleVenta');
  }

  public function usuario(){
    return $this->belongsTo('App\Usuario');
  }

  public function tienda(){
    return $this->belongsTo('App\Tienda', 'local_id');
  }

  public function getTotalAttribute($value){
    return number_format($value, 2, '.', '');
  }
  



}
