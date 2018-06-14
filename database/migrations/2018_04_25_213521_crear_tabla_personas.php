<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPersonas extends Migration{
  
  public function up(){
    Schema::create('personas', function (Blueprint $table) {
      $table->string('dni', 8);
      $table->primary('dni');
      $table->string('nombres');
      $table->string('apellidos');
      $table->string('direccion')->nullable();
      $table->string('telefono')->nullable();
      $table->string('email')->nullable();
    });
  }

  public function down(){
    Schema::dropIfExists('personas');
  }
}
