@extends('cajero.pedido.inicio')

@section('estilos')
  <style>

    .caja{
      background-color: cornflowerblue;
    }

    .mesa{
      border: 1px solid;
      position:absolute;
      z-index: 1000;
      background-color: white;
      border-radius: 5px;
      width:  100px;
      height: 30px;
      vertical-align:  middle;
      top: -5px;
      right:  -5px;
      padding-left: 5px;
      padding-top: 5px;
    }

    table.ticket > tr > th {
      border-top-width: 0px;
    }
  
  </style>
@endsection

@section('contenido')
  <div class="row" id="pedidos">
    <pedido-component v-for="pedido in pedidos" :key="pedido.id" :pedido="pedido"
      v-on:ver-pedido="cobrarPedido"></pedido-component>
    @include('cajero.pedido.inicio.mdlTicket')
  </div>
  @include('plantillas.mdlError')
  @include('cajero.pedido.inicio.mdlPedido')
@endsection

@section('scripts')
  {{Html::script('componentes/printarea/jquery.printarea.js')}}
  {{Html::script('assets/js/moment.min.js')}}
  {{Html::script('assets/js/vue.js')}}
  {{Html::script('assets/js/axios.js')}}
  <script>

    Vue.component('pedido-component', {
      props: ['pedido'],
      methods: {
        numero: function(){
          return "0000987";
        },
        estado: function(estado){
          if(estado == 0){
            return "Pedido";
          }else{
            return "Servido";
          }
        },
        llevar: function(llevar, mesa){
          if(llevar == 1){
            return "para llevar";
          }else{
            return "Mesa: " + mesa;
          }
        }
      },
      template: `<div class="col-xs-6 col-sm-4 col-md-4 col-lg-3">
        <div class="panel panel-default">
            <span class="mesa" v-text="llevar(pedido.llevar, pedido.mesa)"></span>
          <button class="btn btn-block btn-warning"type="button"
            @click="$emit('ver-pedido', pedido.id)">
            <div class="panel-body">
              <p> Cliente: @{{pedido.cliente}}</p>
              <p><strong> Total: S/ @{{parseFloat(pedido.total).toFixed(2)}} </strong></p>
              <p><strong> Estado: @{{estado(pedido.estado)}} </strong></p>
              <p> Mozo: @{{ pedido.usuario.persona.nombres }} </p>  
            </div>
          </button> 
        </div>
      </div>`
    });

    const app = new Vue({
      el: "#pedidos",
      data: {
        pedidos: [],
        pedidoCompleto: {
          id: '',
          tienda_ruc: '',
          tienda_nombre: '',
          tienda_direccion: '',
          tienda_ticketera: '',
          tienda_autorizacion: '',
          numeracion: '',
          fecha: '',
          cliente: '',
          total: '',
          usuario: '',
          detalles: []
        }
      },
      created() {
        this.buscarPedidos();
      },
      methods: {
        imprimirTicket: function(pedido_id){
          $("#papel-ticket").printArea();
          $("#ticket").modal("hide");
          axios.post('cajero/pedido/cobrar', {id: pedido_id})
            .then((response) => {
              this.pedidoCompleto = {
                id: '',
                tienda_ruc: '',
                tienda_nombre: '',
                tienda_direccion: '',
                tienda_ticketera: '',
                tienda_autorizacion: '',
                numeracion: '',
                fecha: '',
                cliente: '',
                total: '',
                usuario: '',
                detalles: []
              };
              this.buscarPedidos();
            });
        },
        cobrarPedido: function(id){
          axios.get('cajero/pedido/' + id).then((response) => {
            pedido = response.data;
            this.pedidoCompleto.id = pedido.id;
            this.pedidoCompleto.tienda_ruc = pedido.tienda.ruc;
            this.pedidoCompleto.tienda_nombre = pedido.tienda.nombre;
            this.pedidoCompleto.tienda_direccion = pedido.tienda.direccion;
            this.pedidoCompleto.tienda_ticketera = pedido.tienda.ticketera;
            this.pedidoCompleto.tienda_autorizacion = pedido.tienda.autorizacion;
            num = pedido.numeracion + "";
            while (num.length < 8) {
              num = "0"+num;
            }
            console.log(pedido.numeracion.length);
            this.pedidoCompleto.numeracion = pedido.serie + '-' + num;
            this.pedidoCompleto.fecha = moment(pedido.fecha).format('DD/MM/YYYY HH:mm A');
            this.pedidoCompleto.cliente = pedido.cliente;
            this.pedidoCompleto.total = pedido.total;
            this.pedidoCompleto.usuario = pedido.usuario.persona.nombres + ' ' +
              pedido.usuario.persona.apellidos;
            this.pedidoCompleto.detalles = pedido.detalles_venta;
            $("#ticket").modal("show");
          });
        },
        formatoFecha(fecha){
          return moment(fecha).format('DD/MM/YYYY HH:mm A');
        },
        numero: function(){
          return "09845";
        },
        buscarPedidos: function(){
          axios.get('cajero/pedidos').then( (response) => {
            this.pedidos = response.data;
          });
        }
      }
    });
  </script>
@endsection