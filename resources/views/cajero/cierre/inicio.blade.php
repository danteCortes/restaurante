@extends('cajero.inicio')

@section('contenido')
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
      <table class="table table-bordered table-condensed table-hover table-striped">
        <thead>
          <tr class="info">
            <th colspan="3">Cierre de Caja {{Carbon\Carbon::now()->format('d/m/Y')}}</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th colspan="2">TOTAL DEL DÍA</th>
            <td class="text-right">@{{ parseFloat(total_ventas).toFixed(2) }}</td>
          </tr>
          <tr class="info">
            <th colspan="3">Resumen de Tickets</th>
          </tr>
          <tr v-for="venta in ventas">
            <th colspan="2" class="text-left">N° @{{venta.serie}}-@{{venta.numeracion}}</th>
            <td class="text-right">@{{parseFloat(venta.total).toFixed(2)}}</td>
            <!-- <td v-for="detalle in detalles_venta(venta)">@{{detalles_venta(venta)}}</td> -->
            <!-- <tr v-for="detalle in detalles_venta(venta)">
              <td class="text-center">@{{detalle.cantidad}}</td>
              <td class="text-center">@{{detalle.cantidad}}</td>
              <td class="text-center">@{{detalle.cantidad}}</td>
            </tr> -->
          </tr>
          <tr>
            <th class="warning" colspan="3">Ventas por productos</th>
          </tr>
          <tr v-for="producto in productos">
            <td>@{{ producto.cantidad }}</td>
            <td>@{{ producto.producto }}</td>
            <td class="text-right">@{{ parseFloat(producto.total).toFixed(2) }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
@stop

@section('scripts')
  {{Html::script('componentes/printarea/jquery.printarea.js')}}
  {{Html::script('assets/js/moment.min.js')}}
  {{Html::script('assets/js/vue.js')}}
  {{Html::script('assets/js/axios.js')}}
  <script>
    new Vue({
      el: "#main-container > div.main-content > div > div.page-content",
      data: {
        ventas: [],
        productos: [],
        total_ventas: ''
      },
      created: function(){
        this.obtenerCierre();
      },
      methods: {
        detalles_venta: function(venta){
          return venta.detalles_venta;
        },
        obtenerCierre: function(){
          url = "{{url('cajero/cierre/obtener-cierre')}}";
          axios.get(url).then(response => {
            this.ventas = response.data.ventas;
            this.total_ventas = response.data.total_ventas;
            this.productos = response.data.productos;
          });
        }
      }
    })
  </script>
@stop