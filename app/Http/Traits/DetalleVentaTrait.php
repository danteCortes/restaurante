<?php

namespace App\Http\Traits;

use App\DetalleVenta;

class DetalleVentaTrait{

  static function guardar(array $datos){
    $detalleVenta = new DetalleVenta;
    $detalleVenta->venta_id = $datos['venta_id'];
    $detalleVenta->local_producto_id = $datos['local_producto_id'];
    $detalleVenta->cantidad = $datos['cantidad'];
    $detalleVenta->precio_unitario = $datos['precio_unitario'];
    $detalleVenta->precio_venta = $datos['cantidad'] * $datos['precio_unitario'];
    $detalleVenta->save();

    return $detalleVenta;
  }




    
}
