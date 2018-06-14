<script>

  Vue.use(VueMask.VueMaskPlugin);

  new Vue({
    el: "#main-container > div.main-content > div > div.page-content",
    data: {
      tienda: {{Auth::user()->local_id}},
      dni: {{Auth::user()->persona_dni}},
      categoria: '',
      productos: [],
      producto: null,
      productoCompleto: {
        id: '',
        nombre: '',
        precio: '',
        cantidad: 1,
        total: 0
      },
      detalles: [],
      precios: '',
      mesa: '',
      cliente: '',
      llevar: '',
      errores: []
    },
    created: function(){
    },
    methods: {
      guardarPedido: function(){
        url = "pedido";
        axios.post(url, {
          detalles: this.detalles,
          mesa: this.mesa,
          cliente: this.cliente,
          llevar: this.llevar,
          dni: this.dni
        }).then(response => {
          this.cliente = '';
          this.mesa = '';
          this.llevar = '';
          this.detalles = [];
          this.errores = [];
          this.productos = [];
          this.categoria = '';
          toastr.success(response.data);
        }).catch(errores => {
          if(response = errores.response){
            this.errores = response.data.errors;
          }
        });
      },
      calcularTotal: function(){
        var total = 0;
        $.each(this.detalles, function (clave, detalle) { 
          total += parseFloat(detalle.cantidad * detalle.precio);console.log(this.total);
        });
        return parseFloat(total).toFixed(2);
      },
      eliminarDetalle: function(detalle){
        var indice = this.detalles.indexOf(detalle);
        this.detalles.splice(indice, 1);
        this.calcularTotal();
      },
      agregarDetalle: function(){
        this.detalles.push(this.productoCompleto);
        this.productoCompleto = {
          id: '',
          nombre: '',
          precio: '',
          cantidad: 1,
          total: 0
        };
        this.producto = null;
        this.precios = '';
        this.productos = [];
        this.categoria = '';
        this.calcularTotal();
      },
      obtenerPrecio: function(tienda){
        resp = '';
        $.each(this.precios, function (clave, precio) {
          if(precio.local_id == tienda){
            resp = parseFloat(precio.precio).toFixed(2);
            return false;
          }
        });
        this.productoCompleto.precio = resp;
        this.productoCompleto.total = 0;
        return resp;
      },
      buscarPrecio: function(event){
        id = event.target.value;
        url = "producto/" + id;
        axios.get(url).then(response => {
          this.productoCompleto.id = response.data.id;
          this.productoCompleto.nombre = response.data.nombre;
          this.productoCompleto.precio = 0.00;
          this.productoCompleto.cantidad = 1;
          this.productoCompleto.total = 0;
          this.precios = response.data.local_producto;
        });
      },
      buscarProductos: function(event){
        id = event.target.value;
        if(id){
          url = "categoria/" + id + "/productos";
          axios.get(url).then(response => {
            this.productos = response.data;
          }).catch(errores => {
            this.obtenerProductos();
          });
        }else{
          this.productos = [];
        }
      }
    }
  });
  
</script>