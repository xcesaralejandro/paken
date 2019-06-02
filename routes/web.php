<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['middleware' => 'auth'],function(){

	//Vistas estaticas inicio loguin y nologuin
	Route::get('/inicio', 'staticViewController@inicioPrivate')->name('inicioPrivate');

	Route::get('/', 'staticViewController@inicioPrivate')->name('inicioPrivate');

	//Rutas del sistema
	
	//agregar pedido
	Route::resource('orders','ordersController');
	Route::get('orders/{id}/destroy','ordersController@destroy')->name('orders.destroy');

	//pedidos
	Route::get('pedidos',function(){
		return view('pedidos');
	})->name('pedidos');

	//productos
	Route::get('products/{id}/destroy','productsController@destroy')->name('products.destroy');

});

Route::group(['prefix' => 'consultas', 'middleware' => 'auth'], function(){
	//RUTAS PARA VISTA
	Route::get('fechas','consultasController@indexfecha')->name('consultas.fecha');
	Route::get('estados','consultasController@indexestado')->name('consultas.estado');
	Route::get('nombreproducto','consultasController@indexproducto')->name('consultas.producto');
	Route::get('nombretienda','consultasController@indextienda')->name('consultas.tienda');
	Route::get('nombrevendedor','consultasController@indexvendedor')->name('consultas.vendedor');
	
	//GESTIONADORAS DE DATOS
	Route::get('fechas/enviar','consultasController@searchfecha')->name('consultas.fecha.search');
	Route::get('estados/enviar','consultasController@searchestado')->name('consultas.estado.search');
	Route::get('nombreproducto/enviar','consultasController@searchproducto')->name('consultas.producto.search');
	Route::get('nombretienda/enviar','consultasController@searchtienda')->name('consultas.tienda.search');
	Route::get('nombrevendedor/enviar','consultasController@searchvendedor')->name('consultas.vendedor.search');
	Route::get('pedidosExpirados','consultasController@searchexpirado')->name('consultas.expirado.search');

});
//RUTAS PUBLICAS :'V
Route::get('support','staticViewController@soporte')->name('support');
Route::post('support/send','staticViewController@supportSend')->name('support.send');
