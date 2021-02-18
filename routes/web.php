<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**RUTAS PARA VEHICULOS */
Route::get('/vehiculos', 'VehiculosController@index')->name('vehiculos');
Route::get('/listar_vehiculos', 'VehiculosController@getVehiculos')->name('listar_vehiculos');
Route::get('/vehiculos/create', 'VehiculosController@create')->name('vehiculos.create');
Route::post('/vehiculos/guardar', 'VehiculosController@postGuardarVehiculo')->name('vehiculos.create');
Route::get('/vehiculos/edit/{id}', 'VehiculosController@edit')->name('vehiculos.edit');
Route::post('/vehiculos/actualizar/{id}', 'VehiculosController@postActualizarVehiculo')->name('vehiculos.update');
Route::delete('/vehiculos/{id}', 'VehiculosController@eliminarVehiculo')->name('vehiculos.delete');


/**RUTAS PARA CLIENTES */
Route::get('/clientes', 'AsesoresController@index')->name('clientes');

