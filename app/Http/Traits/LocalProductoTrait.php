<?php

namespace App\Http\Traits;

use App\LocalProducto;

class LocalProductoTrait{

  static function disminuirProducto(LocalProducto $localProducto, $cantidad){
    
    if($stock = $localProducto->stock){
      if ($stock >= $cantidad) {
        $localProducto -= $cantidad;
        $localProducto->update;
      }else{
        $localProducto = 0;
        $localProducto->update;
      }
    }
  }
  




}
