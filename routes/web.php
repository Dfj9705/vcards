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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/productos', 'ProductoController@index')->name('productos.index')->middleware('role');
Route::get('/productos/create', 'ProductoController@create')->name('productos.create')->middleware('role');
Route::post('/productos/store', 'ProductoController@store')->name('productos.store')->middleware('role');
Route::get('/productos/list', 'ProductoController@getProductos')->name('productos.list')->middleware('role');
Route::get('/productos/{producto}', 'ProductoController@show')->name('productos.show')->middleware('verified');
Route::get('/productos/{producto}/edit', 'ProductoController@edit')->name('productos.edit')->middleware('role');
Route::put('/productos/{producto}', 'ProductoController@update')->name('productos.update')->middleware('role');
Route::delete('/productos/{producto}', 'ProductoController@destroy')->name('productos.destroy')->middleware('role');

Route::delete('/fotografia/{fotografia}', 'ProductoDetalleController@destroy')->name('fotografias.destroy');

Route::get('/store', 'StoreController@index')->name('store.index');


Route::get('/cotizaciones', 'CotizacionController@index')->name('cotizacion.index')->middleware('role');
Route::get('/calendario', 'CotizacionController@calendario')->name('calendario')->middleware('role');
Route::post('/cotizacion', 'CotizacionController@store')->name('cotizacion.store');
Route::get('/cotizacion/{cotizacion}/edit', 'CotizacionController@edit')->name('cotizacion.edit')->middleware('role');
Route::put('/cotizacion/{cotizacion}', 'CotizacionController@update')->name('cotizacion.update')->middleware('role');
Route::get('/cotizaciones/all', 'CotizacionController@cotizaciones')->name('cotizacion.all');
Route::post('/cotizaciones/mensaje', 'CotizacionController@mensaje')->name('cotizacion.mensaje')->middleware('role');
Route::put('/cotizaciones/status/{cotizacion}', 'CotizacionController@updateStatus')->name('cotizacion.autorizar')->middleware('role');
Route::put('/cotizaciones/finalizar/{cotizacion}', 'CotizacionController@finalizar')->name('cotizacion.finalizar')->middleware('role');
Route::delete('/cotizacion/{cotizacion}', 'CotizacionController@destroy')->name('cotizacion.destroy');


Route::get('/perfil', 'PerfilController@index')->name('perfil.index')->middleware('verified');
Route::get('/perfil/create', 'PerfilController@create')->name('perfil.create')->middleware('verified');
Route::post('/perfil/store', 'PerfilController@store')->name('perfil.store')->middleware('verified');
Route::get('/perfil/{perfil}/edit', 'PerfilController@edit')->name('perfil.edit')->middleware('verified');
Route::put('/perfil/{perfil}', 'PerfilController@update')->name('perfil.update')->middleware('verified');

Route::get('/mensaje/{id}', 'TwilioController@message')->name('mensaje');

Auth::routes(['verify' => true]);



// Route::get('/home', 'HomeController@index')->name('home');
