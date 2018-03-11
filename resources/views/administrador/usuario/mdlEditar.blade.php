<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar Local</h4>
      </div>
      {{Form::open(['id'=>'frmEditarUsuario', 'class'=>'form-horizontal', 'method'=>'put'])}}
        {{ csrf_field() }}
        <div class="modal-body">
          <div class="form-group">
            <label for="dni" class="control-label col-sm-4">DNI*:</label>
            <div class="col-sm-8">
              <input type="text" name="dni" class="form-control input-sm dni" placeholder="DNI" required>
            </div>
          </div>
          <div class="form-group">
            <label for="nombres" class="control-label col-sm-4">NOMBRES*:</label>
            <div class="col-sm-8">
              <input type="text" name="nombres" class="form-control input-sm mayuscula nombres"
                placeholder="NOMBRES" required>
            </div>
          </div>
          <div class="form-group">
            <label for="apellidos" class="control-label col-sm-4">APELLIDOS*:</label>
            <div class="col-sm-8">
              <input type="text" name="apellidos" class="form-control input-sm mayuscula apellidos"
                placeholder="APELLIDOS" required>
            </div>
          </div>
          <div class="form-group">
            <label for="direccion" class="control-label col-sm-4">DIRECCIÓN:</label>
            <div class="col-sm-8">
              <input type="text" name="direccion" class="form-control input-sm mayuscula direccion"
                placeholder="DIRECCIÓN">
            </div>
          </div>
          <div class="form-group">
            <label for="telefono" class="control-label col-sm-4">TELEFONO:</label>
            <div class="col-sm-8">
              <input type="text" name="telefono" class="form-control input-sm mayuscula telefono"
                placeholder="TELEFONO">
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="control-label col-sm-4">EMAIL:</label>
            <div class="col-sm-8">
              <input type="email" name="email" class="form-control input-sm email" placeholder="EMAIL">
            </div>
          </div>
          <div class="form-group">
            <label for="tipo_usuario" class="control-label col-sm-4">CARGO*:</label>
            <div class="col-sm-8">
              <select name="tipo_usuario" required class="form-control input-sm tipo_usuario">
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="tienda_id" class="control-label col-sm-4">TIENDA:</label>
            <div class="col-sm-8">
              <select name="tienda_id" class="form-control input-sm tienda_id">
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-ban"></span> Cancelar</button>
          <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Modificar</button>
        </div>
      {{Form::close()}}
    </div>
  </div>
</div>