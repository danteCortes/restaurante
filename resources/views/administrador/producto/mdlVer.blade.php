<div class="modal fade" id="mdlVerProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Datos del Producto</h4>
      </div>
      <div class="modal-body">
        <table class="table">
          <tr>
            <th>ID</th>
            <td>@{{ productoCompleto.id }}</td>
          </tr>
          <tr>
            <th>NOMBRE</th>
            <td>@{{ productoCompleto.nombre }}</td>
          </tr>
          <tr>
            <th>CATEGORIA</th>
            <td>@{{ productoCompleto.categoria_nombre }}</td>
          </tr>
          <tr>
            <th>PRECIOS</th>
            <td>
              <p v-for="precio in productoCompleto.precios">
                @{{ precio.nombre }}: S/ @{{ parseFloat(precio.pivot.precio).toFixed(2) }}</p>  
            </td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-ban"></span> Cerrar</button>
      </div>
    </div>
  </div>
</div>