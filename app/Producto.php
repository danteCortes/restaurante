<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model{

  public $timestamps = false;

  public function categoria(){
    return $this->belongsTo('App\Categoria');
  }

  public function localProducto(){
    return $this->hasMany('App\LocalProducto');
  }

  public function locales(){
    return $this->belongsToMany('App\Tienda', 'local_producto', 'producto_id', 'local_id')
      ->withPivot('stock', 'precio');
  }
  
  




}
