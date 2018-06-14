<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaVentas extends Migration{
 
  public function up(){
    Schema::create('ventas', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('usuario_id')->unsigned();
      $table->foreign('usuario_id')->on('usuarios')->references('id')
        ->onUpdate('cascade')->onDelete('cascade');
      $table->integer('local_id')->unsigned();
      $table->foreign('local_id')->on('locales')->references('id')
        ->onUpdate('cascade')->onDelete('cascade');
      $table->string('mesa')->nullable();
      $table->string('cliente')->nullable();
      $table->float('subtotal')->default(0);
      $table->float('igv')->default(0);
      $table->float('total')->default(0);
      $table->tinyInteger('llevar')->default(0);
      $table->datetime('fecha');
      $table->tinyInteger('estado')->default(0)->comment('0: Pedido; 1: Servido; 2: Cobrado.');
    });
  }

  public function down(){
    Schema::dropIfExists('ventas');
  }
}
