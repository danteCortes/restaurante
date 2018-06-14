<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venta;
use Carbon\Carbon;
use Auth;
use DB;

class CierreController extends Controller{

  public function obtenerCierre(){
    $ventas = Venta::whereDate('fecha', Carbon::now()->format('Y-m-d'))
      ->where('usuario_id', Auth::user()->id)
      ->with(['detallesVenta.localProducto.producto'])->get();
    
    $total_ventas = DB::table('ventas')->whereDate('fecha', Carbon::now()->format('Y-m-d'))
      ->where('usuario_id', Auth::user()->id)
      ->select(
        DB::raw("sum(total) as total")
      )->first();

    $productos = DB::table('detalles_venta as dv')
      ->join('local_producto as lp', 'lp.id', '=', 'dv.local_producto_id')
      ->join('productos as p', 'p.id', '=', 'lp.producto_id')
      ->join('ventas as v', 'v.id', '=', 'dv.venta_id')
      ->select(
        'p.nombre as producto',
        DB::raw("sum(dv.precio_venta) as total"),
        DB::raw("sum(dv.cantidad) as cantidad")
      )
      ->whereDate('v.fecha', Carbon::now()->format('Y-m-d'))
      ->where('v.usuario_id', Auth::user()->id)
      ->groupBy('p.nombre')
      ->get();

    return ['ventas'=>$ventas, 'total_ventas'=>$total_ventas->total, 'productos'=>$productos];
  }
  
  public function inicio(){
    return view('cajero.cierre.inicio');
  }
}
