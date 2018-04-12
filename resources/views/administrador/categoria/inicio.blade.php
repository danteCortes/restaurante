@extends('administrador.inicio')

@section('contenido')
  <div class="page-header">
    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#nuevo">Nuevo</button>
    @include('administrador.categoria.mdlNuevo')
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
          @foreach(App\Categoria::get() as $categoria)
            <tr>
              <td>{{$categoria->id}}</td>
              <td>{{$categoria->nombre}}</td>
              <td>
                <a class="btn btn-warning btn-white btn-minier editar" data-toogle="tooltip" title="Editar" data-id="{{$categoria->id}}">
                  <span class="fa fa-edit"> </span> </a>
                <a class="btn btn-danger btn-white btn-minier eliminar" data-toogle="tooltip" title="Eliminar" data-id="{{$categoria->id}}">
                  <span class="fa fa-trash"> </span> </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  @include('administrador.categoria.mdlEditar')
  @include('administrador.categoria.mdlEliminar')
@stop

@section('scripts')
  <script>
    $(document).ready(function(){

      $("a.editar").click(function(){
        $("form#frmEditarCategoria").prop('action', "{{url('administrador/categoria')}}/"+$(this).data('id'));
        $.get(
          "{{url('administrador/categoria')}}/"+$(this).data('id'),
          function(categoria, estado, xhr){
            $("input.nombre").val(categoria["nombre"]);
            $("#editar").modal("show");
          }
        );
      });

      $("a.eliminar").click(function(){
        $("form#frmEliminarCategoria").prop('action', "{{url('administrador/categoria')}}/"+$(this).data('id'))
        $.get(
          "{{url('administrador/categoria')}}/"+$(this).data('id'),
          function(categoria, estado, xhr){
            $("strong.nombre").html(categoria["nombre"]);
            $("#eliminar").modal("show");
          }
        )
      });
      
      
    });
  </script>
@stop