<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/productos', 'ProductoController@index')->name('productos.index');
Route::get('/productos/create', 'ProductoController@create')->name('productos.create');
Route::post('/productos/store', 'ProductoController@store')->name('productos.store');
Route::get('/productos/list', 'ProductoController@getProductos')->name('productos.list');
Route::get('/productos/{producto}', 'ProductoController@show')->name('productos.show');
Route::get('/productos/{producto}/edit', 'ProductoController@edit')->name('productos.edit');
Route::put('/productos/{producto}', 'ProductoController@update')->name('productos.update');
Route::delete('/productos/{producto}', 'ProductoController@destroy')->name('productos.destroy');

Route::delete('/fotografia/{fotografia}', 'ProductoDetalleController@destroy')->name('fotografias.destroy');

Route::get('/store', 'StoreController@index')->name('store.index');


Route::get('/cotizaciones', 'CotizacionController@index')->name('cotizacion.index');
Route::get('/calendario', 'CotizacionController@calendario')->name('calendario');
Route::post('/cotizacion', 'CotizacionController@store')->name('cotizacion.store');
Route::get('/cotizacion/{cotizacion}/edit', 'CotizacionController@edit')->name('cotizacion.edit');
Route::put('/cotizacion/{cotizacion}', 'CotizacionController@update')->name('cotizacion.update');
Route::get('/cotizaciones/all', 'CotizacionController@cotizaciones')->name('cotizacion.all');
Route::post('/cotizaciones/mensaje', 'CotizacionController@mensaje')->name('cotizacion.mensaje');
Route::put('/cotizaciones/status/{cotizacion}', 'CotizacionController@updateStatus')->name('cotizacion.autorizar');
Route::delete('/cotizacion/{cotizacion}', 'CotizacionController@destroy')->name('cotizacion.destroy');


Auth::routes(['verify' => true]);



Route::get('/home', 'HomeController@index')->name('home');
