<div class="modal fade" id="ticket" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><strong>Ticket de venta</strong></h4>
      </div>
      <div class="modal-body" id="papel-ticket">
        <h1 class="text-center">Pollería Chicken's Mafer</h1>
        <table class="table table-responsive ticket" style="margin: 0px;">
          <tr>
            <th class="text-center" colspan="3" style="border-top-width: 0px; padding: 0px;">
              LOCAL @{{pedidoCompleto.tienda_nombre}}</th>
          </tr>
          <tr>
            <th class="text-center" colspan="3" style="border-top-width: 0px; padding: 0px;">
              RUC @{{pedidoCompleto.tienda_ruc}}</th>
          </tr>
          <tr>
            <th class="text-center" colspan="3" style="border-top-width: 0px; padding: 0px;">
              DIRECCIÓN @{{pedidoCompleto.tienda_direccion}}</th>
          </tr>
          <tr>
            <th class="text-center" colspan="3" style="border-top-width: 0px; padding: 0px;">
              SERIE TICKETERA @{{pedidoCompleto.tienda_ticketera}}</th>
          </tr>
        </table>
        <hr style="margin: 0px; border: 1px dashed">
        <table class="table table-responsive ticket" style="margin: 0px;">
          <tr>
            <th class="text-left" colspan="3" style="border-top-width: 0px; padding: 0px;">
              Ticket: @{{pedidoCompleto.numeracion}}</th>
          </tr>
          <tr>
            <th class="text-left" colspan="3" style="border-top-width: 0px; padding: 0px;">
              Fecha y Hora: @{{pedidoCompleto.fecha}}</th>
          </tr>
          <tr>
            <th class="text-left" colspan="3" style="border-top-width: 0px; padding: 0px;">
              Cliente: @{{pedidoCompleto.cliente}}</th>
          </tr>
        </table>
        <hr style="margin: 0px; border: 1px dashed">
        <table class="table table-responsive table-condensed" style="margin: 0px;">
          <tr>
            <th class="text-center" style="border-top-width: 0px;">Cant.</th>
            <th class="text-center" style="border-top-width: 0px;">Descripción</th>
            <th class="text-center" style="border-top-width: 0px;">Precio</th>
          </tr>
          <tr v-for="detalle in pedidoCompleto.detalles">
            <td class="text-center" style="border-top-width: 0px; padding: 0px;">
              @{{detalle.cantidad}}</td>
            <td class="text-left" style="border-top-width: 0px; padding: 0px;">
              @{{detalle.local_producto.producto.nombre}}</td>
            <td class="text-right" style="border-top-width: 0px; padding: 0px;">
              @{{parseFloat(detalle.precio_venta).toFixed(2)}}</td>
          </tr>
          <tr>
            <th colspan="2" class="text-right" style="border-top-width: 1px; solid">TOTAL</th>
            <th class="text-right" style="border-top-width: 1px; solid">
              @{{parseFloat(pedidoCompleto.total).toFixed(2)}}</th>
          </tr>
        </table>
        <p style="margin-bottom: 0px;">Atendido por @{{pedidoCompleto.usuario}}, 
          Gracias por su preferencia.</p>
        <p style="margin-bottom: 0px;">Bienes y/o servicios consumidos en la amazonía libre de impuestos.</p>
        <p style="margin-bottom: 0px;">Autorización SUNAT: @{{pedidoCompleto.tienda_autorizacion}}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info btn-xs pull-left" @click="imprimirTicket(pedidoCompleto.id)">
          <span class="fa fa-print"></span> Imprimir</button>
        <button type="button" class="btn btn-info btn-xs pull-left" id="btnModificaVenta">
          <span class="fa fa-edit"></span> Modificar</button>
        <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">
          <span class="fa fa-ban"></span> Cerrar</button>
      </div>
    </div>
  </div>
</div>