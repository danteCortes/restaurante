<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaLocales extends Migration{

  public function up(){
    Schema::create('locales', function (Blueprint $table) {
      $table->increments('id');
      $table->string('ruc', 11);
      $table->string('nombre', 45);
      $table->string('direccion', 45);
      $table->string('telefono', 45)->nullable();
      $table->string('serie', 4);
      $table->string('numeracion')->nullable();
      $table->string('ticketera')->nullable();
      $table->string('autorizacion')->nullable();
    });
  }

  public function down(){
    Schema::dropIfExists('locales');
  }
}
