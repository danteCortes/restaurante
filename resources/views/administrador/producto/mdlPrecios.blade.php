<div class="modal fade" id="mdlPrecioProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Precios de 
          <producto :nombre="productoCompleto.nombre"></producto></h4>
      </div>
      {{Form::open(['class'=>'form-horizontal', 'autocomplete'=>'off',
        '@submit.prevent'=>'guardarPrecio(productoCompleto.id)'])}}
        {{ csrf_field() }}
        <div class="modal-body">
          <div class="table-responsive">
            <table class="table table-condensed table-bordered table-striped hover">
              <tr v-for="precio in productoCompleto.precios">
                <th class="text-right">@{{ precio.nombre }}</th>
                <td class="text-right">@{{ parseFloat(precio.pivot.precio).toFixed(2) }}</td>
              </tr>
            </table>
          </div>
          <div class="form-group" >
            <label class="contro-label col-sm-4">Tienda:</label>
            <div class="col-sm-8">
              <select name="tienda" class="form-control input-sm" v-model="nuevoPrecio.tienda" required>
                <option value>--TIENDA--</option>
                <option v-for="tienda in tiendas" :value="tienda.id">@{{ tienda.nombre }}</option>
              </select>
              <span class="text-danger" v-for="error in errores.tienda">@{{ error }}</span>
            </div>
          </div>
          <div class="form-group" >
            <label class="contro-label col-sm-4">PRECIO:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control input-sm" placeholder="PRECIO" required
                v-model="nuevoPrecio.precio">
              <span class="text-danger" v-for="error in errores.precio">@{{ error }}</span>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">
            <span class="fa fa-ban"></span> Cancelar</button>
          <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Guardar</button>
        </div>
      {{Form::close()}}
    </div>
  </div>
</div>