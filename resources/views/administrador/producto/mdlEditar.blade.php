<div class="modal fade" id="mdlEditarProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar Producto</h4>
      </div>
      {{Form::open(['class'=>'form-horizontal', '@submit.prevent'=>'modificarProducto(productoCompleto.id)'])}}
        {{ csrf_field() }}
        <div class="modal-body">
          <div class="form-group">
            {{Form::label('nombre', 'NOMBRE*', ['class'=>'control-label col-sm-4'])}}
            <div class="col-sm-8">
              {{Form::text('nombre', null, ['class'=>'form-control input-sm mayuscula', 'placeholder'=>'NOMBRE',
                'required'=>'', 'v-model'=>'productoCompleto.nombre'])}}
              <span class="text-danger" v-for="error in errores.nombre">@{{ error }}</span>
            </div>
          </div>
          <div class="form-group">
            {{Form::label('categoria_id', 'CATEGORIA', ['class'=>'control-label col-sm-4'])}}
            <div class="col-sm-8">
              <select name="categoria_id" class="form-control input-sm" v-model="productoCompleto.categoria_id">
                <option value>--CATEGORIA--</option>
                <option v-for="categoria in categorias" :value="categoria.id">@{{ categoria.nombre }}</option>
              </select>
              <span class="text-danger" v-for="error in errores.categoria_id">@{{ error }}</span>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-ban">
            </span> Cancelar</button>
          <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Modificar</button>
        </div>
      {{Form::close()}}
    </div>
  </div>
</div>