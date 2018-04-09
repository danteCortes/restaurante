<div class="modal fade" id="pedido" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">
          <mesa v-if="pedido.mesa" :numero="pedido.mesa"></mesa>
          <cliente v-if="!pedido.mesa" :nombre="pedido.cliente"></cliente>
        </h4>
      </div>
      <div class="modal-body">
        <table class="table table-condensed table-bordered">
          <thead>
            <tr class="info">
              <th>Cant.</th>
              <th>Producto</th>
              <th>Prec. Uni.</th>
              <th>Prec. Venta</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="detalle in pedido.detalles_venta">
              <td class="text-center">@{{ detalle.cantidad }}</td>
              <td class="text-left">@{{ detalle.local_producto.producto.nombre }}</td>
              <td class="text-right">@{{ detalle.precio_unitario }}</td>
              <td class="text-right">@{{ detalle.precio_venta }}</td>
            </tr>
            <tr>
              <th colspan="3" class="text-right">TOTAL</th>
              <th class="text-right">@{{ pedido.total }}</th>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        {{Form::button('<span class="fa fa-cutlery"> </span> Servido', ['class'=>'btn btn-warning btn-sm pull-left',
          'type'=>'button', 'id'=>'btnServirPedido'])}}
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><span class="fa fa-ban">
          </span> Cancelar</button>
      </div>
    </div>
  </div>
</div>