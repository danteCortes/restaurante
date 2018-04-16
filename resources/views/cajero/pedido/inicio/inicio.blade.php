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
    
  </div>
  @include('plantillas.mdlError')
  @include('cajero.pedido.inicio.mdlPedido')
  @include('cajero.pedido.inicio.mdlTicket')
@endsection

@section('scripts')
  {{Html::script('componentes/printarea/jquery.printarea.js')}}
  {{Html::script('assets/js/vue.js')}}
  {{Html::script('assets/js/axios.js')}}
  <script>

    function pedidos(){
      $.get("{{url('cajero/pedidos')}}",
        function (pedidos, textStatus, jqXHR) {
          $.each(pedidos, function (clave, pedido) { 
            var estado = "";
            if (pedido['estado'] == 0) {
              estado = "Pedido";
              alerta = "btn-warning";
            }else if(pedido['estado']){
              estado = "Servido";
              alerta = "btn-success";
            }
            if (pedido['llevar'] == 1) {
              llevar = "Para Llevar";
            }else{
              llevar = "Mesa: "+pedido['mesa'];
            }
            caja = `<div class="col-xs-6 col-sm-4 col-md-4 col-lg-3">
              <div class="panel panel-default">
                  <span class="mesa">${llevar}</span>
                <button class="btn btn-block ${alerta}" type="button"
                  onclick="cobrarPedido(${pedido['id']})">
                  <div class="panel-body">
                    <p> Cliente: ${pedido['cliente']} </p>
                    <p><strong> Total: S/ ${parseFloat(pedido['total']).toFixed(2)} </strong></p>
                    <p><strong> Estado: ${estado} </strong></p>
                    <p> Mozo: ${pedido['usuario']['persona']['nombres']} </p>  
                  </div>
                </button> 
              </div>
            </div>`;
            $("#pedidos").append(caja);
          });
        }
      );
    }

    function cobrarPedido(id){
      $("#pedido").modal("hide");
      $.get("{{url('cajero/pedido')}}/"+id,
        function (pedido, textStatus, jqXHR) {
          numero = pedido['id'];
          detalles = "";
          while (numero.lenght < 8) {
            numero = "0"+numero;
          }
          $.each(pedido['detalles_venta'], function (clave, detalle) { 
            detalles += `<tr>
              <td class="text-center" style="border-top-width: 0px;">${detalle['cantidad']}</td>
              <td class="text-left" style="border-top-width: 0px;">${detalle['local_producto']['producto']['nombre']}</td>
              <td class="text-right" style="border-top-width: 0px;">${parseFloat(detalle['precio_venta']).toFixed(2)}</td>
            </tr>`;
          });
          $("#ticket").find("div.modal-body").html(`<table class="table table-responsive ticket">
            <tr>
              <th class="text-center" colspan="3" style="border-top-width: 0px;">${pedido['tienda']['nombre']}</th>
            </tr>
            <tr>
              <th class="text-center" colspan="3" style="border-top-width: 0px;">RUC ${pedido['tienda']['ruc']}</th>
            </tr>
            <tr>
              <th class="text-center" colspan="3" style="border-top-width: 0px;">${pedido['tienda']['direccion']}</th>
            </tr>
            <tr>
              <th class="text-center" colspan="3" style="border-top-width: 0px;">Nro Ticketera ${pedido['tienda']['ticketera']}</th>
            </tr>
            <tr>
              <th class="text-left" colspan="3" style="border-top-width: 0px;">Ticket: ${pedido['tienda']['serie']}-${numero}</th>
            </tr>
            <tr>
              <th class="text-left" colspan="3" style="border-top-width: 0px;">Sr(a): ${pedido['cliente']}</th>
            </tr>
            <tr>
              <th class="text-center" style="border-top-width: 0px;">Cant.</th>
              <th class="text-center" style="border-top-width: 0px;">Descripción</th>
              <th class="text-center" style="border-top-width: 0px;">Precio</th>
            </tr>
            ${detalles}
            <tr>
              <th colspan="2" class="text-right" style="border-top-width: 0px;">TOTAL</th>
              <th class="text-right" style="border-top-width: 0px;">${parseFloat(pedido['total']).toFixed(2)}</th>
            </tr>
          </table>`);
          $("#btnImprimirTicket").attr('data-id', pedido['id']);
          $("#ticket").modal("show");
        }
      );
    }

    $(document).ready(function(){
      pedidos();

      $("#btnImprimirTicket").click(function(){
        $("#papel-ticket").printArea();
        $.post("cajero/pedido/cobrar", {
            id: $(this).data("id")
          },
          function (data, textStatus, jqXHR) {
            $("#pedidos").empty();
            pedidos();
            $("#ticket").modal("hide");
          }
        );
        console.log("borrar pedido");
      })
    });
  </script>
@endsection