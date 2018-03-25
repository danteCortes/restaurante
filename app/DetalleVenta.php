<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model{

  protected $table = 'detalles_venta';

  public $timestamps = false;

  public function localProducto(){
    return $this->belongsTo('App\LocalProducto', 'local_producto_id');
  }
  



}
