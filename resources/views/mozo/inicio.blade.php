@extends('plantillas.plantilla')

@section('menu')
  <li class="">
    <a href="{{url('mozo/pedido')}}">
      <i class="menu-icon fa fa-list"></i>
      <span class="menu-text"> Pedidos </span>
    </a>
    <b class="arrow"></b>
  </li>
  <li class="">
    <a href="{{url('mozo/pedido/nuevo')}}">
      <i class="menu-icon fa fa-money"></i>
      <span class="menu-text"> Nuevo Pedido </span>
    </a>
    <b class="arrow"></b>
  </li>
  <li class="">
    <a href="#">
      <i class="menu-icon fa fa-ban"></i>
      <span class="menu-text"> Terminar </span>
    </a>
    <b class="arrow"></b>
  </li>
@stop