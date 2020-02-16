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

Route::group(['middleware' => 'auth'], function() {
	Route::get('/', 'HomeController@index');

	Route::get('/index', 'HomeController@index')->name('index');

	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/balance','BalanceController@index')->name('balance');

	Route::get('/pago-de-servicios', 'ServicesController@index')->name('pago-de-servicios');

	Route::post('/pago-de-servicios/pago', 'ServicesController@pagoDeServicios')->name('pago-de-servicios/pago');

	Route::get('/inversiones', 'InvestmentController@index')->name('inversiones');

	Route::post('/inversiones/comprar', 'InvestmentController@comprarAcciones')->name('inversiones/comprar');
	
	Route::post('/inversiones/vender', 'InvestmentController@venderAcciones')->name('inversiones/vender');
	
	Route::get('/user', 'UserController@index')->name('user');

	Route::post('/actualizarUsuario', 'UserController@actualizarUsuarioAPI');

	Route::post('/eliminarUsuario/{id}', 'UserController@eliminarUsuarioAPI');
});

Auth::routes();

Route::get('/obtenerSaldo/{id}','BalanceController@obtenerSaldoAPI');

Route::get('/obtenerBalance/{id}','BalanceController@obtenerBalanceAPI');

Route::get('/obtenerServicios', 'ServicesController@obtenerServiciosAPI');

Route::post('/pagoDeServicios', 'ServicesController@pagoDeServiciosAPI');

Route::post('/comprarAcciones', 'InvestmentController@comprarAccionesAPI');

Route::post('/venderAcciones', 'InvestmentController@venderAccionesAPI');

Route::post('/crearUsuario', 'UserController@crearUsuarioAPI');

Route::get('/obtenerUsuario/{id}', 'UserController@obtenerUsuarioAPI');

Route::put('/actualizarUsuario', 'UserController@actualizarUsuarioAPI');

Route::delete('/eliminarUsuario/{id}', 'UserController@eliminarUsuarioAPI');