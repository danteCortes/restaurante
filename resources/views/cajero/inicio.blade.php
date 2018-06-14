@extends('plantillas.plantilla')

@section('menu')
  <li class="">
    <a href="{{url('cajero/pedido')}}">
      <i class="menu-icon fa fa-cutlery"></i>
      <span class="menu-text"> Pedido </span>
    </a>
    <b class="arrow"></b>
  </li>
  <li class="">
    <a href="{{url('cajero')}}">
      <i class="menu-icon fa fa-cutlery"></i>
      <span class="menu-text"> Ver Pedidos </span>
    </a>
    <b class="arrow"></b>
  </li>
  <li class="">
    <a href="{{url('cajero/cierre')}}">
      <i class="menu-icon fa fa-ban"></i>
      <span class="menu-text"> Cierre de Caja </span>
    </a>
    <b class="arrow"></b>
  </li>
@stop