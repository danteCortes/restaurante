<div class="modal fade" id="eliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Eliminar Local</h4>
      </div>
      {{Form::open(['id'=>'frmEliminarTienda', 'class'=>'form-horizontal', 'method'=>'delete'])}}
        {{ csrf_field() }}
        <div class="modal-body">
          <p>ESTA A PUNTO DE ELIMINAR EL LOCAL <strong class="nombre"></strong>, TAMBIÉN SE VAN A ELIMINAR 
            EL PERSONAL, LAS VENTAS Y TODO DATO RELACIONADO CON ESTE LOCAL.</p>
          <p>PARA CONTINUAR CON ESTA ACCIÓN DDE CLIC EN EL BOTÓN ELIMINAR, DE LO CONTRARIO PUEDE CANCELAR
            ESTA ACCIÓN.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-ban"></span> Cancelar</button>
          <button type="submit" class="btn btn-primary"><span class="fa fa-trash"></span> Eliminar</button>
        </div>
      {{Form::close()}}
    </div>
  </div>
</div>