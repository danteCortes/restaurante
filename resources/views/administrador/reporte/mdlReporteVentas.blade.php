<div class="modal fade" id="mdlReporteVentas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Escoja intervalo de fechas</h4>
      </div>
      {{Form::open(['@submit.prevent'=>'buscarReporteVentas', 'class'=>'form-horizontal'])}}
        {{ csrf_field() }}
        <div class="modal-body">
          <div class="form-group">
            {{Form::label('inicio', 'INICIO*', ['class'=>'control-label col-sm-4'])}}
            <div class="col-sm-8">
              {{Form::date('INICIO', null, ['class'=>'form-control input-sm mayuscula',
                'placeholder'=>'INICIO', 'required'=>'', 'v-model'=>'fechas.inicio'])}}
              <span class="text-danger" v-for="error in errores.inicio">@{{ error }}</span>
            </div>
          </div>
          <div class="form-group">
            {{Form::label('fin', 'FIN*', ['class'=>'control-label col-sm-4'])}}
            <div class="col-sm-8">
              {{Form::date('FIN', null, ['class'=>'form-control input-sm mayuscula',
                'placeholder'=>'FIN', 'required'=>'', 'v-model'=>'fechas.fin'])}}
              <span class="text-danger" v-for="error in errores.fin">@{{ error }}</span>
            </div>
          </div>
          <div class="form-group">
            {{Form::label('local', 'LOCAL', ['class'=>'control-label col-sm-4'])}}
            <div class="col-sm-8">
              <select name="local" id="local" class="form-control input-sm" 
                v-model="fechas.local">
                <option value>--LOCAL--</option>
                <option v-for="local in locales" :value="local.id">@{{local.nombre}}</option>
              </select>
              <span class="text-danger" v-for="error in errores.local">@{{ error }}</span>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">
            <span class="fa fa-ban"></span> 
            Cancelar
          </button>
          <button type="submit" class="btn btn-primary">
            <span class="fa fa-save"></span> 
            Guardar
          </button>
        </div>
      {{Form::close()}}
    </div>
  </div>
</div>