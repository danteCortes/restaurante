<?php

namespace App\Http\Traits;

use App\Venta;
use App\Tienda;
use App\DetalleVenta;
use Carbon\Carbon;

class VentaTrait{

  static function guardar(array $datos){

    $tienda = Tienda::find($datos['local_id']);
    $venta = new Venta;
    $venta->usuario_id = $datos['usuario_id'];
    $venta->local_id = $datos['local_id'];
    if($tienda->serie){
      $venta->serie = $tienda->serie;
    }
    if($tienda->numeracion){
      $venta->numeracion = $tienda->numeracion;
    }
    $venta->mesa = $datos['mesa'];
    $venta->cliente = mb_strtoupper($datos['cliente']);
    if ($datos['llevar']) {
      $venta->llevar = $datos['llevar'];
    }
    $venta->fecha = Carbon::now()->format('Y-m-d H:i:s');
    $venta->save();

    $tienda->numeracion++;
    $tienda->update();

    return $venta;
  }

  static function actualizarTotal(Venta $venta, DetalleVenta $detalleVenta){
    $venta->subtotal += $detalleVenta->precio_venta;
    $venta->total += $detalleVenta->precio_venta;
    $venta->update();

    return $venta;
  }
    
}
