<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaDetallesVenta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_venta', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('venta_id')->unsigned();
            $table->foreign('venta_id')->on('ventas')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('local_producto_id')->unsigned();
            $table->foreign('local_producto_id')->on('local_producto')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('cantidad');
            $table->float('precio_unitario');
            $table->float('precio_venta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalles_venta');
    }
}
