<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar Local</h4>
      </div>
      {{Form::open(['id'=>'frmEditarTienda', 'class'=>'form-horizontal', 'method'=>'put'])}}
        {{ csrf_field() }}
        <div class="modal-body">
          <div class="form-group">
            {{Form::label('ruc', 'RUC', ['class'=>'control-label col-sm-4'])}}
            <div class="col-sm-8">
              {{Form::text('ruc', null, ['class'=>'form-control input-sm ruc', 'placeholder'=>'RUC',
                'required'=>''])}}
            </div>
          </div>
          <div class="form-group">
            {{Form::label('nombre', 'NOMBRE', ['class'=>'control-label col-sm-4'])}}
            <div class="col-sm-8">
              {{Form::text('nombre', null, ['class'=>'form-control input-sm mayuscula nombre', 'placeholder'=>'NOMBRE',
                'required'=>''])}}
            </div>
          </div>
          <div class="form-group">
            {{Form::label('direccion', 'DIRECCIÓN', ['class'=>'control-label col-sm-4'])}}
            <div class="col-sm-8">
              {{Form::text('direccion', null, ['class'=>'form-control input-sm mayuscula direccion', 'placeholder'=>'DIRECCIÓN',
                'required'=>''])}}
            </div>
          </div>
          <div class="form-group">
            {{Form::label('telefono', 'TELÉFONO', ['class'=>'control-label col-sm-4'])}}
            <div class="col-sm-8">
              {{Form::text('telefono', null, ['class'=>'form-control input-sm mayuscula telefono', 
                'placeholder'=>'TELÉFONO'])}}
            </div>
          </div>
          <div class="form-group">
            {{Form::label('serie', 'SERIE TICKETS', ['class'=>'control-label col-sm-4'])}}
            <div class="col-sm-8">
              {{Form::text('serie', null, ['class'=>'form-control input-sm mayuscula serie', 'placeholder'=>'SERIE TICKETS',
                'required'=>''])}}
            </div>
          </div>
          <div class="form-group">
            {{Form::label('numeracion', 'NUMERACIÓN TICKETS', ['class'=>'control-label col-sm-4'])}}
            <div class="col-sm-8">
              {{Form::text('numeracion', null, ['class'=>'form-control input-sm numero numeracion', 
                'placeholder'=>'NUMERACIÓN TICKETS'])}}
            </div>
          </div>
          <div class="form-group">
            {{Form::label('ticketera', 'SERIE TICKETERA', ['class'=>'control-label col-sm-4'])}}
            <div class="col-sm-8">
              {{Form::text('ticketera', null, ['class'=>'form-control input-sm mayuscula ticketera', 
                'placeholder'=>'SERIE TICKETERA'])}}
            </div>
          </div>
          <div class="form-group">
            {{Form::label('autorizacion', 'AUTORIZACIÓN SUNAT', ['class'=>'control-label col-sm-4'])}}
            <div class="col-sm-8">
              {{Form::text('autorizacion', null, ['class'=>'form-control input-sm mayuscula autorizacion',
                'placeholder'=>'AUTORIZACIÓN SUNAT'])}}
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