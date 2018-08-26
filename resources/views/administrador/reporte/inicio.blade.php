@extends('administrador.inicio')

@section('contenido')
    <div class="page-header">
        <button class="btn btn-primary btn-sm" @click.prevent="mdlReporteVentas">
            Ventas
        </button>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="table-responsive" id="reporte" v-if="mostrar">
                <table class="table table-bordered table-condensed table-striped table-hover"
                    v-if="ventas.length > 0">
                    <thead>
                        <tr>
                            <th colspan="2">LOCAL</th>
                            <th colspan="3">@{{ local.nombre }}</th>
                        </tr>
                    </thead>
                    <thead>
                        <tr class="info">
                            <th>FECHA</th>
                            <th>SERIE</th>
                            <th>NUMERACION</th>
                            <th>CLIENTE</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="venta in ventas" :key="venta.id">
                            <td>@{{ formatoFecha(venta.fecha) }}</td>
                            <td>@{{ venta.serie }}</td>
                            <td>@{{ formatoNumeracion(venta.numeracion) }}</td>
                            <td>@{{ venta.cliente }}</td>
                            <td>@{{ parseFloat(venta.total).toFixed(2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button class="btn btn-sm" v-if="mostrar" @click.prevent="imprimir">
                <span class="fa fa-print"> Imprimir</span>
            </button>
        </div>
    </div>
    @include('administrador.reporte.mdlReporteVentas')
@stop

@section('scripts')
    {{ Html::script('assets/js/vue.js') }}
    {{ Html::script('assets/js/axios.js') }}
    {{ Html::script('assets/js/toastr.js') }}
    {{ Html::script('assets/js/v-mask.min.js') }}
    {{ Html::script('assets/js/moment.min.js') }}
    {{ Html::script('componentes/printarea/jquery.printarea.js') }}
    @include('administrador.reporte.script')
@stop