<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tienda extends Model{

  protected $table = 'locales';

  public $timestamps = false;

  public function ventas(){
    return $this->hasMany('App\Venta', 'local_id');
  }



}
