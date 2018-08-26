<script>
    new Vue({
        el: "#main-container > div.main-content > div > div.page-content",
        data: {
            fechas: {
                inicio: '',
                fin: '',
                local: ''
            },
            locales: [],
            ventas: [],
            local: '',
            errores: []
        },
        computed:{
            mostrar(){
                if(this.ventas.length > 0){
                    return true;
                }
            }
        },
        mounted() {
            this.buscarLocales();
        },
        methods: {
            buscarLocales(){
                axios.get('/administrador/tienda/todos')
                    .then((response) => {
                        this.locales = response.data;
                    });
            },
            mdlReporteVentas(){
                $("#mdlReporteVentas").modal("show");
            },
            buscarReporteVentas(){
                axios.get('reporte/buscar-ventas?inicio=' + this.fechas.inicio + '&fin=' +
                    this.fechas.fin + '&local=' + this.fechas.local)
                    .then((response) => {
                        this.ventas = response.data.ventas;
                        this.local = response.data.local;
                        $("#mdlReporteVentas").modal("hide");
                    });
            },
            formatoFecha(fecha){
                return moment(fecha).format("DD/MM/YYYY");
            },
            formatoNumeracion(numero){
                salida = numero.toString();
                while(salida.length < 6){
                    salida = '0'.concat(salida.toString());
                }
                return salida;
            },
            imprimir(){
                $("#reporte").printArea();
            }
        }
    })
</script>