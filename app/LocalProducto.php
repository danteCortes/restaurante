<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocalProducto extends Model{

  protected $table = 'local_producto';

  Public $timestamps = false;

  public function producto(){
    return $this->belongsTo('App\Producto');
  }
  




}
