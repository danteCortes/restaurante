<?php

Route::get('/', 'LoginController@inicio');
Route::get('login', 'LoginController@frmLogin');
Route::post('login', 'LoginController@ingresar');
Route::get('tipo-usuario', 'LoginController@tipoUsuario');
Route::get('salir', 'LoginController@salir');

Route::post('primer-usuario', 'UsuarioController@guardar');

Route::prefix('administrador')->group(function(){
  Route::get('/', 'AdministradorController@inicio');
  Route::prefix('usuario')->group(function(){
    Route::get('/', 'UsuarioController@inicio');
    Route::post('/', 'UsuarioController@inicio')->name('usuario');
  });
  Route::prefix('tienda')->group(function(){
    Route::get('/', 'TiendaController@inicio');
    Route::get('/{id}', 'TiendaController@buscar')->where('id', '[0-9]+');
    Route::post('/', 'TiendaController@guardar')->name('local');
    Route::put('/{id}', 'TiendaController@modificar')->where('id', '[0-9]+');
    Route::delete('/{id}', 'TiendaController@eliminar')->where('id', '[0-9]+');
  });
});
