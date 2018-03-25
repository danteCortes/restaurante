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
      <div class="panel panel-default" id="frmBuscarPedidos">
        <div class="panel-heading">
          <h4 class="panel-title">Datos del Usuario</h4>
        </div>
        <div class="panel-body form-horizontal">
          <div class="form-group">
            {{Form::label(null, 'DNI*: ', ['class'=>'control-label col-sm-3'])}}
            <div class="col-sm-9">
              {{Form::text('dni', null, ['class'=>'form-control input-sm dni', 'placeholder'=>'DNI',
                'required'=>''])}}
            </div>
          </div>
          <div class="form-group">
            {{Form::label(null, 'PASSWORD*: ', ['class'=>'control-label col-sm-3'])}}
            <div class="col-sm-9">
              {{Form::password('password', ['class'=>'form-control input-sm', 'placeholder'=>'PASSWORD',
                'required'=>''])}}
            </div>
          </div>
        </div>
        <div class="panel-footer">
          {{Form::button('Buscar', ['class'=>'btn btn-primary btn-sm', 'id'=>'btnBuscarPedidos'])}}
        </div>
      </div>
    </div>
  </div>
  <div class="row" id="pedidos">
  </div>
  @include('plantillas.mdlError')
  @include('mozo.pedido.inicio.mdlPedido')
@endsection

@section('scripts')
  <script>
    function validarUsuario(datos, callback){
      $.get("{{url('mozo/pedido/validar')}}", datos,
        function (respuesta, textStatus, jqXHR) {
          callback(respuesta);
        }
      );
    }
    function buscarPedidos(dni, callback){
      $.get("{{url('mozo/pedido/buscar-pedidos')}}/"+dni,
        function (pedidos, textStatus, jqXHR) {
          callback(pedidos);
        }
      );
    }
    function mostrarPedido(id, callback){
      $.get("{{url('mozo/pedido')}}/"+id,
        function (pedido, textStatus, jqXHR) {
          $("#pedido").find(".mesa").text(pedido['mesa']);
          filas = "";
          $.each(pedido['detalles_venta'], function (clave, detalle) { 
            filas += `<tr>
              <td class="text-center">`+detalle['cantidad']+`</td>
              <td class="text-left">`+detalle['local_producto']['producto']['nombre']+`</td>
              <td class="text-right">`+parseFloat(detalle['precio_unitario']).toFixed(2)+`</td>
              <td class="text-right">`+parseFloat(detalle['precio_venta']).toFixed(2)+`</td>
            </tr>`;
          });
          filas += `<tr>
            <th colspan="3" class="text-right">TOTAL</th>
            <th class="text-right">`+parseFloat(pedido['total']).toFixed(2)+`</th>
          </tr>`;
          callback(filas);
        }
      );
    }
    $(document).ready(function(){
      $("#btnBuscarPedidos").click(function(){
        $("#pedidos").empty();
        datos = {
          dni: $("input[name='dni']").val(),
          password: $("input[name='password']").val(),
          mesa: 1
        };
        validarUsuario(datos, function(respuesta){
          if(respuesta['estado'] == 1){
            buscarPedidos($("input[name='dni']").val(), function(pedidos){
              $.each(pedidos, function (clave, pedido) { 
                if(pedido['estado'] != 2){
                  estado = "PEDIDO";
                  if (pedido['estado'] == 1) {
                    estado = "SERVIDO";
                  }
                  boton = `<div class="col-xs-6 col-sm-4 col-md-4 col-lg-3">
                    <div class="panel panel-default">
                    <button class="btn btn-block {{ (`+pedido['estado']+`== 0) ? 'btn-warning' : 'btn-success'}}
                       mostrar-pedido" data-id="`+pedido['id']+`">
                      <div class="panel-body"">
                        <p> Mesa `+pedido['mesa']+`</p>
                        <p> Cliente `+pedido['cliente']+`</p>
                        <p><strong> Total S/ `+parseFloat(pedido['total']).toFixed(2)+`</strong></p>
                        <p><strong> Estado `+estado+`</strong></p>
                      </div>
                    </button> 
                    </div>
                  </div>`;
                  $("#pedidos").append(boton);
                }
              });
              $(".mostrar-pedido").click(function(){
                mostrarPedido($(this).data("id"), function(filas){
                  $("#pedido").find("tbody").html(filas);
                  $("#pedido").modal("show");
                });
              });
              $("#frmBuscarPedidos").css('display', 'none');
            });
          }else{
            $("#error").find("p.mensaje").text(respuesta['mensaje']);
            $("#error").modal("show");
          }
        });
      });
    });
  </script>
@endsection