@extends('mozo.pedido.inicio')

@section('estilos')
  {{Html::style('componentes/bootstrap-select/bootstrap-select.min.css')}}
  {{Html::style('assets/css/toastr.css')}}
@stop

@section('contenido')
@include('plantillas.validaciones')
@include('plantillas.mensajes')
<div class="row" v-if="!tienda">
  <div class="col-xs-12 col-md-4">
    <form class="form-horizontal" @submit.prevent="ingresar">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">Datos de Mozo</h4>
        </div>
        <div class="panel-body">
          <div class="form-group">
            <label class="control-label col-sm-4">DNI: </label>
            <div class="col-sm-8">
              <input type="text" class="form-control input-sm" placeholder="DNI*" v-model="credenciales.dni"
                v-mask="'########'">
              <span class="text-danger" v-for="error in errores.dni">@{{ error }}</span>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4">PASSWORD: </label>
            <div class="col-sm-8">
              <input type="password" class="form-control input-sm" placeholder="PASSWORD*" 
                v-model="credenciales.password">
              <span class="text-danger" v-for="error in errores.password">@{{ error }}</span>
            </div>
          </div>
        </div>
        <div class="panel-footer">
          <button type="submit" class="btn btn-primary btn-sm"><span class="fa fa-key"> 
            Ingresar</span></button>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="row" v-if="tienda">
  {{Form::open(['route'=>'pedido', 'id'=>'frmNuevaVenta', 'autocomplete'=>'off'])}}
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
                  {{Form::label(null, 'PRODUCTO*:', ['class'=>'control-label col-xs-3'])}}
                  <div class="col-xs-9">
                    <select class="form-control input-sm" v-model="producto">
                      <option v-for="producto in productos" :value="producto.id">@{{ producto.nombre }}</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-xs-9 col-xs-offset-3">
                    {{Form::button('Agregar', ['class'=>'btn btn-primary btn-sm', 'id'=>'btnAgregarProducto'])}}
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
              {{Form::label(null, 'MOZO*:', ['class'=>'control-label col-xs-4'])}}
              <div class="col-xs-8">
                {{Form::text('dni', null, ['class'=>'form-control input-sm dni', 'placeholder'=>'DNI'])}}
              </div>
            </div>
            <div class="form-group">
              {{Form::label(null, 'PASSWORD*:', ['class'=>'control-label col-xs-4'])}}
              <div class="col-xs-8">
                {{Form::password('password', ['class'=>'form-control input-sm', 'placeholder'=>'PASSWORD'])}}
              </div>
            </div>
            <div class="form-group">
              {{Form::label(null, 'MESA:', ['class'=>'control-label col-xs-4'])}}
              <div class="col-xs-8">
                {{Form::number('mesa', null, ['class'=>'form-control input-sm numero', 'placeholder'=>'MESA',
                  'min'=>'1'])}}
              </div>
            </div>
            <div class="form-group">
              {{Form::label(null, 'CLIENTE:', ['class'=>'control-label col-xs-4'])}}
              <div class="col-xs-8">
                {{Form::text('cliente', null, ['class'=>'form-control input-sm mayuscula', 'placeholder'=>'CLIENTE'])}}
              </div>
            </div>
            <div class="form-group">
              {{Form::label(null, 'TOTAL:', ['class'=>'control-label col-xs-4'])}}
              <div class="col-xs-8">
                {{Form::label(null, '0.00', ['class'=>'control-label total', 'id'=>'total_compra'])}}
              </div>
            </div>
            <div class="form-group">
              {{Form::label('llevar', 'LLEVAR:', ['class'=>'control-label col-xs-4'])}}
              <div class="col-xs-8">
                <label>
                  <input name="llevar" class="ace ace-switch ace-switch-4 btn-rotate" type="checkbox" value="1"/>
                  <span class="lbl" data-lbl="&nbsp;SI&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO"></span>
                </label>
              </div>
            </div>
            <div class="form-group">
              <div class="col-xs-8 col-xs-offset-4">
                {{Form::button('Terminar', ['class'=>'btn btn-primary btn-sm', 'type'=>'button',
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
  {{Html::script('assets/js/vue.js')}}
  {{Html::script('assets/js/v-mask.min.js')}}
  {{Html::script('assets/js/axios.js')}}
  {{Html::script('assets/js/toastr.js')}}
  {{Html::script('componentes/bootstrap-select/bootstrap-select.min.js')}}
  <script>

    Vue.use(VueMask.VueMaskPlugin);

    new Vue({
      el: '#main-container > div.main-content > div > div.page-content',
      data: {
        productos: [],
        producto: {
          id: '',
          nombre: '',
          precio: '',
        },
        credenciales: {
          dni: '',
          password: ''
        },
        tienda: '',
        errores: []
      },
      methods: {
        obtenerProductos: function(){
          url = "../producto/todos";
          axios.get(url).then(response => {
            this.productos = response.data;
          }).catch(errores => {
            this.obtenerProductos();
          });
        },
        ingresar: function(){
          url = "ingresar";
          axios.post(url, this.credenciales).then(response => {
            this.tienda = response.data.tienda;
            this.credenciales.password = '';
            this.errores = [];
            this.obtenerProductos();
            $("#producto_id").selectpicker('render');
            toastr.success(response.data.mensaje);console.log("si");
          }).catch(errores => {
            if(response = errores.response){
              this.errores = response.data.errors;
            }
          })
        }
      }
    });


    function eliminarFila(){
      $(".eliminar").click(function(){
        $(this).closest("tr[id]").remove();
        calcularTotal();
      });
    }
    function calcularTotal(){
      total_compra = parseFloat(0.00);
      $("#tblDetalles > tbody > tr[id]").each(function(clave, valor){
        if($(this).find("td:nth-child(2) > input").val()){
          var cantidad_detalle = parseFloat($(this).find("td:nth-child(2) > input").val());
          var precio_detalle = parseFloat($(this).find("td:nth-child(3)").html());
          var total = parseFloat(cantidad_detalle * precio_detalle).toFixed(2);
          total_compra += parseFloat(total);
          $(this).find("td:nth-child(4)").html(total);
        }else{
          $(this).find("td:nth-child(4)").html("0.00");
        }
      });
      $("label#total_compra").html(total_compra.toFixed(2));
      return total_compra.toFixed(2);
    }
    function cambiarCantidad(){
      $("tr[id] > td > input").change(function(){
        calcularTotal();
      });
    }
    function validarVenta(datos, callback){
      axios.post("{{url('mozo/pedido/validar')}}", datos).then(response => {
        callback(response);
      }).catch(errores => {
        if (errores.response) {
          $("#error").find("p.mensaje").empty();
          $.each(errores.response.data.errors, function (clave, valor) {
            $("#error").find("p.mensaje").append(valor + "<br>");
          });
          $("#error").modal("show");
        }
      });
    }
    $(document).ready(function(){
      $("#btnAgregarProducto").click(function(){
        if ($("select[name='producto_id']").val()) {
          $.get(
            "{{url('administrador/producto')}}/"+$("select[name='producto_id']").val(),
            function(producto, estado, xhr){
              fila = `
                <tr id="`+producto['id']+`">
                  <td>`+producto['nombre']+`</td>
                  <td style="width:90px;">
                    <input type="number" class="form-control input-sm" name="cantidades[`+producto['id']+`]" value="1">
                  </td>
                  <td class="text-right" style="width:90px;">`+parseFloat(producto['precio']).toFixed(2)+`</td>
                  <td class="text-right" style="width:90px;">`+parseFloat(producto['precio']).toFixed(2)+`</td>
                  <td class="text-center" style="width:90px;">
                    <a data-target="tooltip" title="Eliminar" class="eliminar"><span class="fa fa-trash"></span></a>
                  </td>
                </tr>
              `
              $("#tblDetalles > tbody").append(fila);
              eliminarFila();
              cambiarCantidad();
              calcularTotal();
            }
          );
        }
      });

      $("#btnNuevaVenta").click(function(){
        llevar = null;
        if ($("input[name='llevar']").prop('checked')) {
          llevar = $("input[name='llevar']").val();
        }
        if (calcularTotal() > 0) {
          datos = {
            dni: $("input[name='dni']").val(),
            password: $("input[name='password']").val(),
            mesa: parseInt($("input[name='mesa']").val()),
            llevar: llevar,
            cliente: $("input[name='cliente']").val()
          };
          validarVenta(datos, function(respuesta){
            $("#frmNuevaVenta").submit();
          });
        }else{
          $("#error").find("p.mensaje").text("NO INGRESÓ UN SOLO PRODUCTO A LA VENTA. VUELVA A INTENTARLO.");
          $("#error").modal("show");
        }
      });
    });
  </script>
@stop