<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaLocalProducto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_producto', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('local_id')->unsigned();
            $table->foreign('local_id')->on('locales')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('producto_id')->unsigned();
            $table->foreign('producto_id')->on('productos')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('stock')->nullable();
            $table->float('precio')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('local_producto');
    }
}
