@extends('administrador.inicio')

@section('contenido')
  <div class="page-header">
    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#nuevo">Nuevo</button>
    @include('administrador.producto.mdlNuevo')
  </div>
  @include('plantillas.mensajes')
  @include('plantillas.validaciones')
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
      <table class="table table-condensed table-striped" id="tblCategorias">
        <thead>
          <tr class="info">
            <th>#</th>
            <th>NOMBRE</th>
            <th>OPCIONES</th>
          </tr>
        </thead>
        <tbody>
          @foreach(App\Producto::get() as $producto)
            <tr>
              <td>{{$producto->id}}</td>
              <td>{{$producto->nombre}}</td>
              <td>
                <a class="ver" data-toogle="tooltip" title="Ver" data-id="{{$producto->id}}">
                  <span class="fa fa-eye"> </span> </a>
                <a class="editar" data-toogle="tooltip" title="Editar" data-id="{{$producto->id}}">
                  <span class="fa fa-edit"> </span> </a>
                <a class="eliminar" data-toogle="tooltip" title="Eliminar" data-id="{{$producto->id}}">
                  <span class="fa fa-trash"> </span> </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  @include('administrador.producto.mdlVer')
  @include('administrador.producto.mdlEditar')
  @include('administrador.producto.mdlEliminar')
@stop

@section('scripts')
  <script>
    $(document).ready(function(){

      $("a.ver").click(function(){
        $("#tblVerProducto > tbody > tr > td").empty();
        $.get(
          "{{url('administrador/producto')}}/"+$(this).data('id'),
          function(producto, estado, xhr){
            $("td.id").html(producto["id"]);
            $("td.nombre").html(producto["nombre"]);
            if (producto['categoria']) {
              $("td.categoria").html(producto["categoria"]['nombre']);
            }
            $("#ver").modal("show");
          }
        )
      });

      $("a.editar").click(function(){
        $("form#frmEditarProducto").prop('action', "{{url('administrador/producto')}}/"+$(this).data('id'));
        $.get(
          "{{url('administrador/producto')}}/"+$(this).data('id'),
          function(producto, estado, xhr){
            $("input.nombre").val(producto["nombre"]);
            $("input.precio").val(producto["precio"].toFixed(2));
            $.get(
              "{{url('administrador/categoria/todos')}}",
              function(categorias, estado, xhr){
                if(producto['categoria']){
                  opciones = `<option value='`+producto['categoria_id']+`'>`+producto['categoria']['nombre']+
                  `</option>
                  <option value>--CATEGORIA--</option>`;
                }else{
                  opciones = `<option value>--CATEGORIA--</option>`;
                }
                $.each(categorias, function(clave, valor){
                  if (valor['id'] != producto['categoria_id']) {
                    opciones += "<option value='"+valor['id']+"'>"+valor['nombre']+"</option>";
                  }
                });
                $("select.categoria_id").html(opciones);
                $("#editar").modal('show');
              }
            );
          }
        );
      });

      $("a.eliminar").click(function(){
        $("form#frmEliminarProducto").prop('action', "{{url('administrador/producto')}}/"+$(this).data('id'))
        $.get(
          "{{url('administrador/producto')}}/"+$(this).data('id'),
          function(producto, estado, xhr){
            $("strong.nombre").html(producto["nombre"]);
            $("#eliminar").modal("show");
          }
        )
      });
      
      
    });
  </script>
@stop