<div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nuevo Usuario</h4>
      </div>
      {{Form::open(['route'=>'usuario', 'class'=>'form-horizontal', 'autocomplete'=>'off'])}}
        {{ csrf_field() }}
        <div class="modal-body">
          <div class="form-group">
            <label for="dni" class="control-label col-sm-4">DNI*:</label>
            <div class="col-sm-8">
              <input type="text" name="dni" class="form-control input-sm dni" placeholder="DNI" required 
                id="dni" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="nombres" class="control-label col-sm-4">NOMBRES*:</label>
            <div class="col-sm-8">
              <input type="text" name="nombres" class="form-control input-sm mayuscula" placeholder="NOMBRES" 
                required id="nombres">
            </div>
          </div>
          <div class="form-group">
            <label for="apellidos" class="control-label col-sm-4">APELLIDOS*:</label>
            <div class="col-sm-8">
              <input type="text" name="apellidos" class="form-control input-sm mayuscula" placeholder="APELLIDOS" 
                required id="apellidos">
            </div>
          </div>
          <div class="form-group">
            <label for="direccion" class="control-label col-sm-4">DIRECCIÓN:</label>
            <div class="col-sm-8">
              <input type="text" name="direccion" class="form-control input-sm mayuscula" placeholder="DIRECCIÓN" 
                id="direccion">
            </div>
          </div>
          <div class="form-group">
            <label for="telefono" class="control-label col-sm-4">TELEFONO:</label>
            <div class="col-sm-8">
              <input type="text" name="telefono" class="form-control input-sm mayuscula" placeholder="TELEFONO" 
                id="telefono">
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="control-label col-sm-4">EMAIL:</label>
            <div class="col-sm-8">
              <input type="email" name="email" class="form-control input-sm" placeholder="EMAIL" 
                id="email">
            </div>
          </div>
          <div class="form-group">
            <label for="tipo_usuario" class="control-label col-sm-4">CARGO*:</label>
            <div class="col-sm-8">
              <select name="tipo_usuario" id="tipo_usuario" required class="form-control input-sm">
                <option value>--CARGO--</option>
                <option value="0">ADMINISTRADOR</option>
                <option value="1">CAJERO</option>
                <option value="2">MOZO</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="tienda_id" class="control-label col-sm-4">TIENDA:</label>
            <div class="col-sm-8">
              <select name="tienda_id" id="tienda_id" class="form-control input-sm">
                <option value>--TIENDA--</option>
                @foreach(App\Tienda::get() as $tienda)
                  <option value="{{$tienda->id}}">{{$tienda->nombre}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-ban"></span> Cancelar</button>
          <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Guardar</button>
        </div>
      {{Form::close()}}
    </div>
  </div>
</div>