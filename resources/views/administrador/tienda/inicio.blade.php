@extends('administrador.inicio')

@section('contenido')
  <div class="page-header">
    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#nuevo">Nuevo</button>
    @include('administrador.tienda.mdlNuevo')
  </div>
  @include('plantillas.mensajes')
  @include('plantillas.validaciones')
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
      <table class="table table-condensed table-striped" id="tblTiendas">
        <thead>
          <tr class="info">
            <th>RUC</th>
            <th>NOMBRE</th>
            <th>OPCIONES</th>
          </tr>
        </thead>
        <tbody>
          @foreach(App\Tienda::get() as $tienda)
            <tr>
              <td>{{$tienda->ruc}}</td>
              <td>{{$tienda->nombre}}</td>
              <td>
                <a class="btn btn-info btn-white btn-minier ver" data-toogle="tooltip" title="Ver" data-id="{{$tienda->id}}">
                  <span class="fa fa-eye"> </span> </a>
                <a class="btn btn-warning btn-white btn-minier editar" data-toogle="tooltip" title="Editar" data-id="{{$tienda->id}}">
                  <span class="fa fa-edit"> </span> </a>
                <a class="btn btn-danger btn-white btn-minier eliminar" data-toogle="tooltip" title="Eliminar" data-id="{{$tienda->id}}">
                  <span class="fa fa-trash"> </span> </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  @include('administrador.tienda.mdlVer')
  @include('administrador.tienda.mdlEditar')
  @include('administrador.tienda.mdlEliminar')
@stop

@section('scripts')
  <script>
    $(document).ready(function(){

      $("a.ver").click(function(){
        $.get(
          "{{url('administrador/tienda')}}/"+$(this).data('id'),
          function(tienda, estado, xhr){
            $("td.ruc").html(tienda["ruc"]);
            $("td.nombre").html(tienda["nombre"]);
            $("td.direccion").html(tienda["direccion"]);
            $("td.telefono").html(tienda["telefono"]);
            $("td.serie").html(tienda["serie"]);
            $("td.ticketera").html(tienda["ticketera"]);
            $("td.autorizacion").html(tienda["autorizacion"]);
            $("#ver").modal("show");
          }
        )
      });

      $("a.editar").click(function(){
        $("form#frmEditarTienda").prop('action', "{{url('administrador/tienda')}}/"+$(this).data('id'))
        $.get(
          "{{url('administrador/tienda')}}/"+$(this).data('id'),
          function(tienda, estado, xhr){
            $("input.ruc").val(tienda["ruc"]);
            $("input.nombre").val(tienda["nombre"]);
            $("input.direccion").val(tienda["direccion"]);
            $("input.telefono").val(tienda["telefono"]);
            $("input.serie").val(tienda["serie"]);
            $("input.ticketera").val(tienda["ticketera"]);
            $("input.autorizacion").val(tienda["autorizacion"]);
            $("#editar").modal("show");
          }
        )
      });

      $("a.eliminar").click(function(){
        $("form#frmEliminarTienda").prop('action', "{{url('administrador/tienda')}}/"+$(this).data('id'))
        $.get(
          "{{url('administrador/tienda')}}/"+$(this).data('id'),
          function(tienda, estado, xhr){
            $("strong.nombre").html(tienda["nombre"]);
            $("#eliminar").modal("show");
          }
        )
      });
      
      
    });
  </script>
@stop