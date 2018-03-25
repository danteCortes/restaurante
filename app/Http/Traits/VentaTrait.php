<?php

namespace App\Http\Traits;

use App\Venta;
use App\DetalleVenta;
use Carbon\Carbon;

class VentaTrait{

  static function guardar(array $datos){
    $venta = new Venta;
    $venta->usuario_id = $datos['usuario_id'];
    $venta->local_id = $datos['local_id'];
    $venta->mesa = $datos['mesa'];
    $venta->cliente = mb_strtoupper($datos['cliente']);
    if ($datos['llevar']) {
      $venta->llevar = $datos['llevar'];
    }
    $venta->fecha = Carbon::now()->format('Y-m-d H:i:s');
    $venta->save();

    return $venta;
  }

  static function actualizarTotal(Venta $venta, DetalleVenta $detalleVenta){
    $venta->subtotal += $detalleVenta->precio_venta;
    $venta->total += $detalleVenta->precio_venta;
    $venta->update();

    return $venta;
  }
    
}
