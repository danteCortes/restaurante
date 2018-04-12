@extends('administrador.inicio')

@section('contenido')
  <div class="page-header">
    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#nuevo">Nuevo</button>
    @include('administrador.usuario.mdlNuevo')
  </div>
  @include('plantillas.mensajes')
  @include('plantillas.validaciones')
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
      <table class="table table-condensed table-striped" id="tblUsuarios">
        <thead>
          <tr class="info">
            <th>DNI</th>
            <th>USUARIO</th>
            <th>CARGO</th>
            <th>TIENDA</th>
            <th>OPCIONES</th>
          </tr>
        </thead>
        <tbody>
          @foreach(App\Usuario::with('tienda')->where('id', '!=', Auth::user()->id)->get() as $usuario)
            <tr>
              <td>{{$usuario->persona->dni}}</td>
              <td>{{$usuario->persona->nombres}} {{$usuario->persona->apellidos}}</td>
              <td>
                @if($usuario->tipo_usuario == 0)
                  ADMINISTRADOR
                @elseif($usuario->tipo_usuario == 1)
                  CAJERO
                @else
                  MOZO
                @endif
              </td>
              <td>
                @if($tienda = $usuario->tienda)
                  {{$tienda->nombre}}
                @endif
              </td>
              <td>
                <a class="btn btn-info btn-white btn-minier ver" data-toogle="tooltip" title="Ver" data-id="{{$usuario->id}}">
                  <span class="fa fa-eye"> </span> </a>
                <a class="btn btn-warning btn-white btn-minier editar" data-toogle="tooltip" title="Editar" data-id="{{$usuario->id}}">
                  <span class="fa fa-edit"> </span> </a>
                <a class="btn btn-danger btn-white btn-minier eliminar" data-toogle="tooltip" title="Eliminar" data-id="{{$usuario->id}}">
                  <span class="fa fa-trash"> </span> </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  @include('administrador.usuario.mdlVer')
  @include('administrador.usuario.mdlEditar')
  @include('administrador.usuario.mdlEliminar')
@stop

@section('scripts')
  <script>
    var cargos = "<option value>--CARGO--</option>"+
      "<option value='0'>ADMINISTRADOR</option>"+
      "<option value='1'>CAJERO</option>"+
      "<option value='2'>MOZO</option>";

    $(document).ready(function(){

      $("a.ver").click(function(){
        $("#tblVerUsuario > tr > td").empty();
        $.get(
          "{{url('administrador/usuario')}}/"+$(this).data('id'),
          function(usuario, estado, xhr){
            $("td.dni").html(usuario['persona']["dni"]);
            $("td.usuario").html(usuario['persona']["nombres"]+' '+usuario['persona']["apellidos"]);
            $("td.direccion").html(usuario['persona']["direccion"]);
            $("td.telefono").html(usuario['persona']["telefono"]);
            $("td.email").html(usuario['persona']["email"]);
            var cargo = "";
            switch (usuario['tipo_usuario']) {
              case 0: cargo = "ADMINISTRADOR";
                break;
              case 1: cargo = "CAJERO";
                break;
              case 2: cargo = "MOZO";
                break;
              default:
                break;
            }
            $("td.cargo").html(cargo);
            if (usuario['tienda']) {
              $("td.tienda").html(usuario['tienda']["nombre"]);
            }
            $("#ver").modal("show");
          }
        )
      });

      $("a.editar").click(function(){
        $("form#frmEditarUsuario").prop('action', "{{url('administrador/usuario')}}/"+$(this).data('id'))
        $.get(
          "{{url('administrador/usuario')}}/"+$(this).data('id'),
          function(usuario, estado, xhr){
            $("input.dni").val(usuario['persona']["dni"]);
            $("input.nombres").val(usuario['persona']["nombres"]);
            $("input.apellidos").val(usuario['persona']["apellidos"]);
            $("input.direccion").val(usuario['persona']["direccion"]);
            $("input.telefono").val(usuario['persona']["telefono"]);
            $("input.email").val(usuario['persona']["email"]);
            var cargo = "";
            switch (usuario['tipo_usuario']) {
              case 0: cargo = "ADMINISTRADOR";
                break;
              case 1: cargo = "CAJERO";
                break;
              case 2: cargo = "MOZO";
                break;
              default:
                break;
            }
            optCargos = `<option value="`+usuario['tipo_usuario']+`">`+cargo+
              ` (ACTUAL)</option>`+cargos;
            $("select.tipo_usuario").html(optCargos);
            $.get(
              "{{url('administrador/tienda/todos')}}",
              function(t, estado, xhr){
                if(usuario['tienda']){
                  optTiendas = "<option value='"+usuario['tienda']['id']+"'>"+usuario['tienda']['nombre']+"</option>"+
                  "<option value>--TIENDA--</option>";
                }else{
                  optTiendas = "<option value>--TIENDA--</option>";
                }
                $.each(t, function(clave, valor){
                  optTiendas += "<option value='"+valor['id']+"'>"+valor['nombre']+"</option>";
                });
                console.log(optTiendas);
                $("select.tienda_id").html(optTiendas);
                $("#editar").modal("show");
              }
            );
            
          }
        )
      });

      $("a.eliminar").click(function(){
        $("form#frmEliminarUsuario").prop('action', "{{url('administrador/usuario')}}/"+$(this).data('id'))
        $.get(
          "{{url('administrador/usuario')}}/"+$(this).data('id'),
          function(usuario, estado, xhr){
            $("strong.nombre").html(usuario['persona']["nombres"]);
            $("#eliminar").modal("show");
          }
        )
      });
      
      
    });
  </script>
@stop