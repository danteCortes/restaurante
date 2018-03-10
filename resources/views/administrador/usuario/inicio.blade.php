@extends('administrador.inicio')

@section('contenido')
  <div class="row">
    <div class="col-sm-12">
      <button class="btn btn-primary" data-toggle="modal" data-target="#nuevo">Nuevo</button>
      @include('administrador.usuario.mdlNuevo')
    </div>
  </div>
@stop