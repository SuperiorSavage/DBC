<?php

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

// Route::get('/', function () {
//     return view('index');
// });
Route::get('/', 'DepartamentoController@index')->name('index');
Route::post('updpto','DepartamentoController@store');
Route::get('showdpto','DepartamentoController@Showdpto');
Route::post('upsubdpto','SubdepartamentoController@store');
Route::post('updoc','DocumentoController@store');
Route::get('/subdepartamento/{subdepartamento}', 'SubdepartamentoController@showSub');
Route::get('/departamento/{departamento}', 'DepartamentoController@showdep');
Route::get('/busqueda/{busqeda}', 'DocumentoController@search');


Route::post('upus','UsuarioController@storeUser');
Route::post('login', 'UsuarioController@authenticate');

Route::post('upname/{id}','UsuarioController@updatename');
Route::post('updatepass/{id}','UsuarioController@updatepass');


// Route::group(['middleware' => ['jwt.verify']], function() {
//     Route::get('user',     'UsuarioController@getAuthenticatedUser');
//     Route::get('closed', 'DocumentoController@closed');
//     Route::get('/admin','DepartamentoController@admin');
// });
Route::group(['middleware' => 'auth'], function() {
    Route::get('/admin','DepartamentoController@admin')->name('administrador');
});