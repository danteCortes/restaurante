<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model{

  public $timestamps = false;

  public function categoria(){
    return $this->belongsTo('App\Categoria');
  }
  
  




}
