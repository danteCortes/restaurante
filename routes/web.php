<?php

Route::get('/', 'LoginController@inicio');
Route::get('login', 'LoginController@frmLogin');
Route::post('login', 'LoginController@ingresar');
Route::get('tipo-usuario', 'LoginController@tipoUsuario');
Route::get('salir', 'LoginController@salir');

Route::post('primer-usuario', 'UsuarioController@primerUsuario');

Route::prefix('administrador')->group(function(){
  Route::get('/', 'AdministradorController@inicio');
  Route::prefix('usuario')->group(function(){
    Route::get('/', 'UsuarioController@inicio');
    Route::get('/{id}', 'UsuarioController@buscar');
    Route::post('/', 'UsuarioController@guardar')->name('usuario');
    Route::put('/{id}', 'UsuarioController@modificar');
    Route::delete('/{id}', 'UsuarioController@eliminar');
  });
  Route::prefix('tienda')->group(function(){
    Route::get('/', 'TiendaController@inicio');
    Route::get('/todos', 'TiendaController@todos');
    Route::get('/{id}', 'TiendaController@buscar')->where('id', '[0-9]+');
    Route::post('/', 'TiendaController@guardar')->name('local');
    Route::put('/{id}', 'TiendaController@modificar')->where('id', '[0-9]+');
    Route::delete('/{id}', 'TiendaController@eliminar')->where('id', '[0-9]+');
  });
  Route::prefix('categoria')->group(function(){
    Route::get('/', 'CategoriaController@inicio');
    Route::get('/todos', 'CategoriaController@todos');
    Route::get('/{id}', 'CategoriaController@buscar')->where('id', '[0-9]+');
    Route::post('/', 'CategoriaController@guardar')->name('categoria');
    Route::put('/{id}', 'CategoriaController@modificar')->where('id', '[0-9]+');
    Route::delete('/{id}', 'CategoriaController@eliminar')->where('id', '[0-9]+');
  });
  Route::prefix('producto')->group(function(){
    Route::get('/', 'ProductoController@inicio');
    Route::get('/todos', 'ProductoController@todos');
    Route::get('/{id}', 'ProductoController@buscar')->where('id', '[0-9]+');
    Route::post('/', 'ProductoController@guardar')->name('producto');
    Route::post('/{id}/precio', 'ProductoController@precio')->where('id', '[0-9]+');
    Route::put('/{id}', 'ProductoController@modificar')->where('id', '[0-9]+');
    Route::delete('/{id}', 'ProductoController@eliminar')->where('id', '[0-9]+');
  });
});

Route::prefix('mozo')->group(function(){
  Route::get('/', 'MozoController@inicio');
  Route::prefix('producto')->group(function(){
    Route::get('todos', 'ProductoController@todos');
  });
  Route::prefix('pedido')->group(function(){
    Route::get('/', 'PedidoController@inicio');
    Route::get('/{id}', 'PedidoController@buscar')->where('id', '[0-9]+');
    Route::get('/nuevo', 'PedidoController@nuevo');
    Route::get('/buscar-pedidos/{dni}', 'PedidoController@buscarPedidos')->where('id', '[0-9]+');
    Route::post('/validar', 'PedidoController@validar');
    Route::post('/servir', 'PedidoController@servir');
    Route::post('/ingresar', 'PedidoController@ingresar');
    Route::post('/', 'PedidoController@guardar')->name('pedido');
  });
});

Route::prefix('cajero')->group(function(){
  Route::get('/', 'CajeroController@inicio');
  Route::prefix('pedido')->group(function(){
    Route::get('/', 'PedidoController@inicio');
    Route::post('/', 'PedidoController@guardar');
    Route::get('/{id}', 'PedidoController@buscar')->where('id', '[0-9]+');
  });
  Route::get('pedidos', 'PedidoController@todos');
  Route::post('pedido/cobrar', 'PedidoController@cobrar');
  Route::get('producto/todos', 'ProductoController@todos');
  Route::get('producto/{id}', 'ProductoController@buscar')->where('id', '[0-9]+');
});

Route::get('llenar-bd', function(){
  $locales = App\Tienda::get();
  foreach ($locales as $local) {
    foreach(App\Producto::get() as $producto){
      $local_producto = new App\LocalProducto;
      $local_producto->local_id = $local->id;
      $local_producto->producto_id = $producto->id;
      $local_producto->precio = $producto->precio;
      $local_producto->save();
    }
  }
  return "listo";
});
