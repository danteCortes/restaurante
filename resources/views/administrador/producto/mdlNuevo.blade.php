<div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nuevo Producto</h4>
      </div>
      {{Form::open(['route'=>'producto', 'class'=>'form-horizontal'])}}
        {{ csrf_field() }}
        <div class="modal-body">
          <div class="form-group">
            {{Form::label('nombre', 'NOMBRE*', ['class'=>'control-label col-sm-4'])}}
            <div class="col-sm-8">
              {{Form::text('nombre', null, ['class'=>'form-control input-sm mayuscula', 'placeholder'=>'NOMBRE',
                'id'=>'ruc', 'required'=>''])}}
            </div>
          </div>
          <div class="form-group">
            {{Form::label('precio', 'PRECIO*', ['class'=>'control-label col-sm-4'])}}
            <div class="col-sm-8">
              {{Form::text('precio', null, ['class'=>'form-control input-sm moneda', 'placeholder'=>'PRECIO',
                'id'=>'ruc', 'required'=>''])}}
            </div>
          </div>
          <div class="form-group">
            {{Form::label('categoria_id', 'CATEGORIA', ['class'=>'control-label col-sm-4'])}}
            <div class="col-sm-8">
              <select name="categoria_id" id="categoria_id" class="form-control input-sm">
                <option value>--CATEGORIA--</option>
                @foreach(App\Categoria::get() as $categoria)
                  <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
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