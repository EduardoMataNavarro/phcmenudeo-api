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
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('/loginuser', 'App\Http\Controllers\UserLoginController@Login');
Route::post('/signupuser', 'App\Http\Controllers\UserRegisterController@Create');
Route::get('/user', 'App\Http\Controllers\UserController@Index');
Route::get('/user/{id}', 'App\Http\Controllers\UserController@GetById');
Route::put('/user', 'App\Http\Controllers\UserController@Edit');

Route::get('/home/latest/{limit}', 'App\Http\Controllers\HomeController@GetLatest');

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
Route::get('/articulo/get/{id}', 'App\Http\Controllers\ArticuloController@GetById'); 
Route::get('/articulo/find/{term}', 'App\Http\Controllers\ArticuloController@Find');
Route::get('/articulo/categoria/{id}', 'App\Http\Controllers\ArticuloController@FindByCategoria');
Route::get('/articulo/related/{id}', 'App\Http\Controllers\ArticuloController@Related');
/* Imagen articulo */
Route::post('/articulo/media/single', 'App\Http\Controllers\ArticuloController@UploadSingleImage'); 
Route::delete('/articulo/media/{imageid}', 'App\Http\Controllers\ArticuloController@DeleteImage'); 
Route::get('/articulo/{id}/media', 'App\Http\Controllers\ArticuloController@GetMediaById'); 

/* Inventario */
Route::post('/inventario', 'App\Http\Controllers\InventarioController@Create');
Route::post('/inventario/check', 'App\Http\Controllers\InventarioController@Check');
Route::put('/inventario', 'App\Http\Controllers\InventarioController@Edit');
Route::get('/inventario', 'App\Http\Controllers\InventarioController@Index');
Route::get('/inventario/{id}', 'App\Http\Controllers\InventarioController@GetById'); 
Route::post('/movimientoinventario', 'App\Http\Controllers\InventarioController@CreateMovimiento');
Route::get('/movimientoinventario/{inventarioid}', 'App\Http\Controllers\InventarioController@GetMovimientos');

/* Venta */
Route::post('/venta', 'App\Http\Controllers\VentaController@Create');
Route::post('/venta/carrito', 'App\Http\Controllers\VentaController@CreateFromCarrito');
Route::put('/venta', 'App\Http\Controllers\VentaController@Edit');
Route::get('/venta', 'App\Http\Controllers\VentaController@Index');
Route::post('/venta/check', 'App\Http\Controllers\VentaController@GetById'); 

/* Carrito */
Route::post('/carrito', 'App\Http\Controllers\CarritoController@AddToCart');
Route::get('/carrito', 'App\Http\Controllers\CarritoController@Index');
Route::get('/carrito/user/{userid}', 'App\Http\Controllers\CarritoController@GetByUser'); 
Route::get('/carrito/detalle/{userid}', 'App\Http\Controllers\CarritoController@GetDetalles');
Route::delete('/carrito/detalle/{id}', 'App\Http\Controllers\CarritoController@DeleteFromCart');

/* Rol */
Route::post('/rol', 'App\Http\Controllers\RolController@Create');
Route::put('/rol', 'App\Http\Controllers\RolController@Edit');
Route::get('/rol', 'App\Http\Controllers\RolController@Index');
Route::get('/rol/{userid}', 'App\Http\Controllers\RolController@GetByUser');  

/* Metodo envio */
Route::post('/metodoenvio', 'App\Http\Controllers\MetodoEnvioController@Create');
Route::put('/metodoenvio', 'App\Http\Controllers\MetodoEnvioController@Edit');
Route::get('/metodoenvio', 'App\Http\Controllers\MetodoEnvioController@Index');
Route::get('/metodoenvio/{id}', 'App\Http\Controllers\MetodoEnvioController@GetById');  

/* Metodo pago */
Route::post('/metodopago', 'App\Http\Controllers\MetodoPagoController@Create');
Route::put('/metodopago', 'App\Http\Controllers\MetodoPagoController@Edit');
Route::get('/metodopago', 'App\Http\Controllers\MetodoPagoController@Index');
Route::get('/metodopago/{id}', 'App\Http\Controllers\MetodoPagoController@GetById');  

