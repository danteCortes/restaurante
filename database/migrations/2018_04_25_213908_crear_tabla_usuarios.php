<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaUsuarios extends Migration{
  
  public function up(){
    Schema::create('usuarios', function (Blueprint $table) {
      $table->increments('id');
      $table->string('persona_dni', 8);
      $table->foreign('persona_dni')->on('personas')->references('dni')
        ->onUpdate('cascade')->onDelete('cascade');
      $table->integer('local_id')->unsigned()->nullable();
      $table->foreign('local_id')->on('locales')->references('id')
        ->onUpdate('cascade')->onDelete('cascade');
      $table->string('password');
      $table->rememberToken();
      $table->tinyInteger('estado_caja')->default(0)
        ->comment('0: caja cerrada; 1: usuario autorizado; 2: caja operativa.');
      $table->tinyInteger('tipo_usuario')->default(1)
        ->comment('0: administrador; 1: cajero; 2: mozo.');
    });
  }

  public function down(){
    Schema::dropIfExists('usuarios');
  }
}
