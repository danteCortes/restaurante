@extends('mozo.pedido.inicio')

@section('estilos')
  <style>
    .caja{
      background-color: cornflowerblue;
    }
  
  </style>
@endsection

@section('contenido')
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
      <div class="panel panel-default" v-if="!pedidos">
        {{Form::open(['id'=>'frmBuscarPedidos', 'autocomplete'=>'off', 
          '@submit.prevent'=>'autenticarMozo()'])}}
          <div class="panel-heading">
            <h4 class="panel-title">Datos del Usuario</h4>
          </div>
          <div class="panel-body form-horizontal">
            <div class="form-group">
              {{Form::label(null, 'DNI*: ', ['class'=>'control-label col-sm-3'])}}
              <div class="col-sm-9">
                {{Form::text('dni', null, ['class'=>'form-control input-sm dni', 'placeholder'=>'DNI',
                  'required'=>'', 'v-model'=>'datosMozo.dni'])}}
                <span class="text-danger" v-for="error in errores.dni">@{{ error }}</span>
              </div>
            </div>
            <div class="form-group">
              {{Form::label(null, 'PASSWORD*: ', ['class'=>'control-label col-sm-3'])}}
              <div class="col-sm-9">
                {{Form::password('password', ['class'=>'form-control input-sm', 'placeholder'=>'PASSWORD',
                  'required'=>'', 'v-model'=>'datosMozo.password'])}}
                <span class="text-danger" v-for="error in errores.password">@{{ error }}</span>
              </div>
            </div>
          </div>
          <div class="panel-footer">
            {{Form::button('<span class="fa fa-key"> </span> Buscar', ['class'=>'btn btn-primary btn-sm', 'type'=>'submit'])}}
          </div>
        {{Form::close()}}
      </div>
    </div>
  </div>
  <div class="row">
      <div class="col-xs-6 col-sm-4 col-md-4 col-lg-3" v-for="pedido in pedidos">
        <div class="panel panel-default">
          <button class="btn btn-block mostrar-pedido" style="height: 152px;"
            :class="[ pedido.estado ? 'btn-success' : 'btn-warning' ]" 
            @click.prevent="mostrarPedido(pedido)">
            <div class="panel-body" style="padding: 0px;">
              <p></p>
              <p v-if="pedido.cliente"> Cliente @{{ pedido.cliente }}</p>
              <p v-if="pedido.mesa"> Mesa @{{ pedido.mesa }}</p>
              <p><strong> Total S/ @{{ pedido.total }}</strong></p>
              <p><strong> Estado @{{ estado(pedido.estado) }}</strong></p>
            </div>
          </button> 
        </div>
      </div>
  </div>
  <pre>
    @{{ $data }}
  </pre>
  @include('plantillas.mdlError')
  @include('mozo.pedido.inicio.mdlPedido')
@endsection

@section('scripts')
  {{Html::script('assets/js/vue.js')}}
  {{Html::script('assets/js/axios.js')}}
  {{Html::script('assets/js/v-mask.min.js')}}
  <script>

    Vue.component('mesa', {
      template: '<strong>Mesa @{{ numero }}</strong>',
      props: ['numero']
    });

    Vue.component('cliente', {
      template: '<strong>Cliente @{{ nombre }}</strong>',
      props: ['nombre']
    });

    new Vue({
      el: '#main-container > div.main-content > div > div.page-content',
      data: {
        pedidos: null,
        datosMozo: {
          dni: '',
          password: '',
          mesa: 1
        },
        pedido: {},
        errores: []
      },
      computed: {
        
      },
      methods: {
        autenticarMozo: function(){
          url = "../mozo/pedido/validar";
          axios.post(url, this.datosMozo).then(response => {
            this.errores = [];
            this.buscarPedidos(this.datosMozo.dni)
          }).catch(errores => {
            if (response = errores.response) {
              this.errores = response.data.errors;
            }
          });
        },
        buscarPedidos: function(){
          url = "../mozo/pedido/buscar-pedidos/" + this.datosMozo.dni;
          axios.get(url).then(response => {
            this.pedidos = response.data;
          });
        },
        estado: function(estado){
          switch (estado) {
            case 0:
              return "Pedido";
              break;
            case 1:
              return "Servido";
              break;
            case 2:
              return "Cobrado";
              break;
          
            default:
              break;
          }
        },
        mostrarPedido: function(pedido){
          this.pedido = pedido;
          $("#pedido").modal("show");
        }
      }
    });


  </script>
@endsection