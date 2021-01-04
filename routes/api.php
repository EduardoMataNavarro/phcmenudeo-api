<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user/login', 'App\Http\Controllers\LoginController@Login');
Route::post('/user/signup', 'App\Http\Controllers\RegisterUserController@Create');

/* Estados  */
Route::post('/estado', 'App\Http\Controllers\EstadoController@Create');
Route::put('/estado', 'App\Http\Controllers\EstadoController@Edit');
Route::get('/estado', 'App\Http\Controllers\EstadoController@Index');
Route::get('/estado/{id}', 'App\Http\Controllers\EstadoController@GetById'); 

/* Sucursales  */
Route::post('/sucursal', 'App\Http\Controllers\SucursalController@Create');
Route::put('/sucursal', 'App\Http\Controllers\SucursalController@Edit');
Route::get('/sucursal', 'App\Http\Controllers\SucursalController@Index');
Route::get('/sucursal/{id}', 'App\Http\Controllers\SucursalController@GetById'); 

/* Categorias */
Route::post('/categoria', 'App\Http\Controllers\CategoriaArticuloController@Create');
Route::put('/categoria', 'App\Http\Controllers\CategoriaArticuloController@Edit');
Route::get('/categoria', 'App\Http\Controllers\CategoriaArticuloController@Index');
Route::get('/categoria/{id}', 'App\Http\Controllers\CategoriaArticuloController@GetById'); 

/* Marcas */
Route::post('/marca', 'App\Http\Controllers\MarcaController@Create');
Route::put('/marca', 'App\Http\Controllers\MarcaController@Edit');
Route::get('/marca', 'App\Http\Controllers\MarcaController@Index');
Route::get('/marca/{id}', 'App\Http\Controllers\MarcaController@GetById'); 

/* Articulos */
Route::post('/articulo', 'App\Http\Controllers\ArticuloController@Create');
Route::put('/articulo', 'App\Http\Controllers\ArticuloController@Edit');
Route::get('/articulo', 'App\Http\Controllers\ArticuloController@Index');
Route::get('/articulo/{id}', 'App\Http\Controllers\ArticuloController@GetById'); 
Route::get('/articulo/find/{term}', 'App\Http\Controllers\ArticuloController@Find');
/* Imagen articulo */
Route::post('/articulo/media/single', 'App\Http\Controllers\ArticuloController@UploadSingleImage'); 

/* Inventario */
Route::post('/inventario', 'App\Http\Controllers\InventarioController@Create');
Route::put('/inventario', 'App\Http\Controllers\InventarioController@Edit');
Route::get('/inventario', 'App\Http\Controllers\InventarioController@Index');
Route::get('/inventario/{id}', 'App\Http\Controllers\InventarioController@GetById'); 
Route::post('/inventario/movimiento', 'App\Http\Controllers\InventarioController@CreateMovimiento');
Route::get('/inventario/{id}/movimiento', 'App\Http\Controllers\InventarioController@GetMovimientos');

/* Venta */
Route::post('/venta', 'App\Http\Controllers\VentaController@Create');
Route::put('/venta', 'App\Http\Controllers\VentaController@Edit');
Route::get('/venta', 'App\Http\Controllers\VentaController@Index');
Route::get('/venta/{id}', 'App\Http\Controllers\VentaController@GetById'); 

