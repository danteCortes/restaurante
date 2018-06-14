@extends('administrador.inicio')

@section('estilos')
  {{Html::style('assets/css/toastr.css')}}
@endsection

@section('contenido')
  <div class="page-header">
    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#mdlNuevoProducto">Nuevo</button>
    @include('administrador.producto.mdlNuevo')
  </div>
  @include('plantillas.mensajes')
  @include('plantillas.validaciones')
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
      <table class="table table-condensed table-striped" id="tblCategorias">
        <thead>
          <tr class="info">
            <th class="text-center">#</th>
            <th>NOMBRE</th>
            <th class="text-center">OPCIONES</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="producto in productos">
            <td class="text-center">@{{ producto.id }}</td>
            <td>@{{ producto.nombre }}</td>
            <td class="text-center">
              <button class="btn btn-info btn-white btn-minier ver" data-toogle="tooltip" title="Ver"
                @click="mostrarProducto(producto)">
                <span class="fa fa-eye"> </span> </button>
              <button class="btn btn-warning btn-white btn-minier editar" data-toogle="tooltip" title="Editar"
                @click="editarProducto(producto)">
                <span class="fa fa-edit"> </span> </button>
              <button class="btn btn-danger btn-white btn-minier eliminar" data-toogle="tooltip" title="Eliminar"
                @click="advertencia(producto)">
                <span class="fa fa-trash"> </span> </button>
              <button class="btn btn-inverse btn-white btn-minier precios" data-toogle="tooltip" title="Precios"
                @click="agregarPrecios(producto)">
                <span class="fa fa-dollar"> </span> </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  @include('administrador.producto.mdlVer')
  @include('administrador.producto.mdlEditar')
  @include('administrador.producto.mdlEliminar')
  @include('administrador.producto.mdlPrecios')
@stop

@section('scripts')
  {{Html::script('assets/js/vue.js')}}
  {{Html::script('assets/js/axios.js')}}
  {{Html::script('assets/js/toastr.js')}}
  {{Html::script('assets/js/v-mask.min.js')}}
  <script>

    Vue.component('producto', {
      template: "<strong>@{{ nombre }}</strong>",
      props: ['nombre']
    });

    new Vue({
      el: "#main-container > div.main-content > div > div.page-content",
      created: function(){
        this.obtenerProductos();
        this.obtenerCategorias();
        this.obtenerTiendas();
      },
      data: {
        productoNuevo: {
          nombre: '',
          categoria_id: ''
        },
        categorias: [],
        productoCompleto : {
          id: '',
          nombre: '',
          categoria_id: '',
          categoria_nombre: '',
          precios: []
        },
        productos: [],
        errores: [],
        tiendas: [],
        nuevoPrecio: {
          precio: '',
          tienda: '',
          producto: ''
        }
      },
      methods: {
        guardarPrecio: function(id){
          $("#mdlPrecioProducto").modal("hide");
          url = "producto/" + id + "/precio";
          axios.post(url, this.nuevoPrecio).then(response => {
            this.nuevoPrecio = {
              precio: '',
              tienda: '',
              producto: ''
            };
            this.errores = [];
            this.obtenerProductos();
            toastr.success(response.data);
          }).catch(errores => {
            if(response = errores.response){
              this.errores = response.data.errors;
              $("#mdlPrecioProducto").modal("show");
            }
          });
        },
        agregarPrecios: function(producto){
          this.productoCompleto.id = producto.id;
          this.productoCompleto.nombre = producto.nombre;
          this.productoCompleto.precios = producto.locales;
          this.nuevoPrecio.producto = producto.id;
          this.nuevoPrecio.tienda = '';
          this.nuevoPrecio.precio = '';
          $("#mdlPrecioProducto").modal("show");
        },
        eliminarProducto: function(id){
          $("#mdlEliminarProducto").modal("hide");
          url = "producto/" + id;
          axios.delete(url).then(response => {
            this.productoCompleto.id = '';
            this.productoCompleto.nombre = '';
            this.obtenerProductos();
            toastr.info(response.data);
          })
        },
        advertencia: function(producto){
          this.productoCompleto.id = producto.id;
          this.productoCompleto.nombre = producto.nombre;
          $("#mdlEliminarProducto").modal("show");
        },
        modificarProducto: function(id){
          $("#mdlEditarProducto").modal("hide");
          url = "producto/" + id;
          axios.put(url, this.productoCompleto).then(response => {
            this.productoCompleto = {
              id: '',
              nombre: '',
              categoria_id: '',
              categoria_nombre: '',
              precios: []
            };
            this.erroes = [];
            this.obtenerProductos();
            toastr.success(response.data);
          }).catch(errores = {
            if(response = errores.response){
              this.errores = response.data.errors;
              $("#mdlEditarProducto").modal("show");
            }
          })
        },
        guardarProducto: function(){
          $("#mdlNuevoProducto").modal("hide");
          url = "producto";
          axios.post(url, this.productoNuevo).then(response => {
            this.productoNuevo = {
              nombre: '',
              categoria_id: ''
            };
            this.errores = [];
            this.obtenerProductos();
            toastr.success(response.data);
          }).catch(errores => {
            if(response = errores.response){
              this.errores = response.data.errors;
              $("#mdlNuevoProducto").modal("show");
            }
          });
        },
        obtenerCategorias: function(){
          url = "../administrador/categoria/todos";
          axios.get(url).then(response => {
            this.categorias = response.data;
          }).catch(errores => {
            this.obtenerCategorias();
          });
        },
        editarProducto: function(producto){
          this.productoCompleto.id = producto.id;
          this.productoCompleto.nombre = producto.nombre;
          this.productoCompleto.categoria_id = producto.categoria_id;
          $("#mdlEditarProducto").modal("show");
        },
        obtenerProductos: function(){
          url = "../administrador/producto/todos";
          axios.get(url).then(response => {
            this.productos = response.data;
          }).catch(errores => {
            this.obtenerProductos();
          });
        },
        mostrarProducto: function(producto){
          this.productoCompleto.id = producto.id;
          this.productoCompleto.nombre = producto.nombre;
          this.productoCompleto.categoria_id = producto.categoria_id;
          this.productoCompleto.categoria_nombre = producto.categoria.nombre;
          this.productoCompleto.precios = producto.locales;
          $("#mdlVerProducto").modal("show");
        },
        obtenerTiendas: function(){
          url = "tienda/todos";
          axios.get(url).then(response => {
            this.tiendas = response.data;
          }).catch(errores => {
            this.obtenerTiendas();
          });
        }
      }
    });
  </script>
@stop