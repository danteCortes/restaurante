<div class="modal fade" id="mdlEliminarProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Eliminar Producto</h4>
      </div>
      {{Form::open(['class'=>'form-horizontal', '@submit.prevent'=>'eliminarProducto(productoCompleto.id)'])}}
        {{ csrf_field() }}
        <div class="modal-body">
          <p>ESTA A PUNTO DE ELIMINAR EL PRODUCTO <producto :nombre="productoCompleto.nombre"></producto>, 
            TAMBIÉN SE VAN A ELIMINAR LAS VENTAS REALIZADAS CON ESTE PRODUCTO.</p>
          <p>PARA CONTINUAR CON ESTA ACCIÓN DE CLIC EN EL BOTÓN ELIMINAR, DE LO CONTRARIO PUEDE CANCELAR
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