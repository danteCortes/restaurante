<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar Categoria</h4>
      </div>
      {{Form::open(['id'=>'frmEditarCategoria', 'class'=>'form-horizontal', 'method'=>'put', 'autocomplete'=>'off'])}}
        {{ csrf_field() }}
        <div class="modal-body">
          <div class="form-group">
            {{Form::label('nombre', 'NOMBRE*', ['class'=>'control-label col-sm-4'])}}
            <div class="col-sm-8">
              {{Form::text('nombre', null, ['class'=>'form-control input-sm mayuscula nombre', 'placeholder'=>'NOMBRE',
                'required'=>''])}}
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