<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReporteController extends Controller
{
    public function inicio(){
        return view('administrador.reporte.inicio');
    }

    public function buscarVentas(Request $request){
        $ventas = DB::table('ventas as v')
            ->select(
                'v.id as id',
                'v.serie as serie',
                'v.numeracion as numeracion',
                'v.fecha as fecha',
                'v.total as total'
            )
            ->where('v.local_id', $request->local)
            ->whereDate('v.fecha', '>=', $request->inicio)
            ->whereDate('v.fecha', '<=', $request->fin)
            ->get();

        $local = DB::table('locales')->where('id', $request->local)->first();
        
        return response()->json(['ventas'=>$ventas, 'local'=>$local]);
    }
}
