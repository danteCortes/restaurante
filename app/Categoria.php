<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model{

  public $timestamps = false;

  public function productos(){
    return $this->hasMany('App\Producto');
  }

  





}
