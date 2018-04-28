@extends('cajero.pedido.inicio')

@section('estilos')
  {{Html::style('componentes/bootstrap-select/bootstrap-select.min.css')}}
  {{Html::style('assets/css/toastr.css')}}
  {{Html::style('assets/css/bootstrap-vue.css')}}
@stop

@section('contenido')
@include('plantillas.validaciones')
@include('plantillas.mensajes')
<div class="row">
  {{Form::open(['id'=>'frmNuevaVenta', '@submit.prevent'=>'guardarPedido', 'autocomplete'=>'off'])}}
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-7">
      <div class="row">
        <div class="col-xs-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">Agregar Productos</h4>
            </div>
            <div class="panel-body">
              <div class="form-horizontal">
                <div class="form-group">
                  {{Form::label(null, 'CATEGORÍA: ', ['class'=>'control-label col-xs-3'])}}
                  <div class="col-xs-9">
                    <select name="categoria" class="form-control input-sm" @change="buscarProductos"
                      v-model="categoria">
                      <option value>--CATEGORIA*--</option>
                      @foreach (App\Categoria::all() as $categoria)
                        <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  {{Form::label(null, 'PRODUCTO*:', ['class'=>'control-label col-xs-3'])}}
                  <div class="col-xs-9">
                    <select name="producto" class="form-control input-sm" @change="buscarPrecio">
                      <option value v-if="productos.length != 0">--PRODUCTO*--</option>
                      <option value v-else>--ESCOJA UNA CATEGORÍA--</option>
                      <option v-for="producto in productos" :value="producto.id">@{{ producto.nombre }}</option>
                    </select>
                    <span class="text-danger" v-for="error in errores.detalles">@{{ error }}</span>
                    <span class="text-danger" v-for="error in errores.password">@{{ error }}</span>
                    <span class="text-danger" v-for="error in errores.dni">@{{ error }}</span>
                  </div>
                </div>
                <div class="form-group" v-if="precios">
                  {{Form::label(null, 'PRECIO:', ['class'=>'control-label col-xs-3'])}}
                  <div class="col-xs-9">
                    <label class="control-label">@{{ obtenerPrecio(tienda) }}</label>
                  </div>
                </div>
                <div class="form-group" v-if="precios">
                  <div class="col-xs-9 col-xs-offset-3">
                    {{Form::button('Agregar', ['class'=>'btn btn-primary btn-sm', '@click'=>'agregarDetalle'])}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">Detalles del Pedido</h4>
            </div>
            <div class="panel-body">
              <table class="table" id="tblDetalles">
                <thead>
                  <tr class="info">
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Unit.</th>
                    <th>Total</th>
                    <th>Eliminar</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="detalle in detalles">
                    <td>@{{ detalle.nombre }}</td>
                    <td>
                      <input type="number" class="form-control" style="width: 100px;" 
                        v-model="detalle.cantidad">
                    </td>
                    <td class="text-right">@{{ detalle.precio }}</td>
                    <td class="text-right">@{{ parseFloat(detalle.cantidad * detalle.precio).toFixed(2) }}</td>
                    <td>
                      <button type="button" class="btn btn-danger btn-white btn-minier" @click="eliminarDetalle(detalle)">
                        <span class="fa fa-trash"></span>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">Nuevo Pedido</h4>
        </div>
        <div class="form-horizontal">
          <div class="panel-body">
            <div class="form-group">
              {{Form::label(null, 'MESA*:', ['class'=>'control-label col-xs-4'])}}
              <div class="col-xs-8">
                {{Form::text('mesa', null, ['class'=>'form-control input-sm mayuscula', 'placeholder'=>'MESA',
                  'v-model'=>'mesa'])}}
                <span class="text-danger" v-for="error in errores.mesa">@{{ error }}</span>
              </div>
            </div>
            <div class="form-group">
              {{Form::label(null, 'CLIENTE:', ['class'=>'control-label col-xs-4'])}}
              <div class="col-xs-8">
                {{Form::text('cliente', null, ['class'=>'form-control input-sm mayuscula', 'placeholder'=>'CLIENTE',
                  'v-model'=>'cliente'])}}
                <span class="text-danger" v-for="error in errores.cliente">@{{ error }}</span>
              </div>
            </div>
            <div class="form-group">
              {{Form::label(null, 'TOTAL:', ['class'=>'control-label col-xs-4'])}}
              <div class="col-xs-8">
                <label for="" class="control-label total">@{{ calcularTotal() }}</label>
              </div>
            </div>
            <div class="form-group">
              {{Form::label('llevar', 'LLEVAR:', ['class'=>'control-label col-xs-4'])}}
              <div class="col-xs-8">
                <label>
                  <input name="llevar" class="ace ace-switch ace-switch-4 btn-rotate" type="checkbox" value="1"
                    v-model="llevar"/>
                  <span class="lbl" data-lbl="SI.............NO">&nbsp;</span>
                </label>
                <span class="text-danger" v-for="error in errores.llevar">@{{ error }}</span>
              </div>
            </div>
            <div class="form-group">
              <div class="col-xs-8 col-xs-offset-4">
                {{Form::button('Terminar', ['class'=>'btn btn-primary btn-sm', 'type'=>'submit',
                  'id'=>'btnNuevaVenta'])}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  {{Form::close()}}
  @include('plantillas.mdlError')
</div>
@stop

@section('scripts')
  {{Html::script('componentes/bootstrap-select/bootstrap-select.min.js')}}
  {{Html::script('assets/js/vue.js')}}
  {{Html::script('assets/js/polyfill.min.js')}}
  {{Html::script('assets/js/bootstrap-vue.js')}}
  {{Html::script('assets/js/axios.js')}}
  {{Html::script('assets/js/v-mask.min.js')}}
  {{Html::script('assets/js/toastr.js')}}
  @include('cajero.pedido.nuevo.scripts')
@stop