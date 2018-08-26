@extends('plantillas.plantilla')

@section('menu')
  <li class="">
    <a href="{{url('administrador/tienda')}}">
      <i class="menu-icon fa fa-home"></i>
      <span class="menu-text"> Tiendas </span>
    </a>
    <b class="arrow"></b>
  </li>
  <li class="">
    <a href="{{url('administrador/usuario')}}">
      <i class="menu-icon fa fa-users"></i>
      <span class="menu-text"> Personal </span>
    </a>
    <b class="arrow"></b>
  </li>
  <li class="">
    <a href="{{url('administrador/categoria')}}">
      <i class="menu-icon fa fa-briefcase"></i>
      <span class="menu-text"> Categorias </span>
    </a>
    <b class="arrow"></b>
  </li>
  <li class="">
    <a href="{{url('administrador/producto')}}">
      <i class="menu-icon fa fa-lemon-o"></i>
      <span class="menu-text"> Productos </span>
    </a>
    <b class="arrow"></b>
  </li>
  <li class="">
    <a href="#">
      <i class="menu-icon fa fa-dollar"></i>
      <span class="menu-text"> Compras </span>
    </a>
    <b class="arrow"></b>
  </li>
  <li class="">
    <a href="{{url('administrador/reporte')}}">
      <i class="menu-icon fa fa-file"></i>
      <span class="menu-text"> Reportes </span>
    </a>
    <b class="arrow"></b>
  </li>
@stop