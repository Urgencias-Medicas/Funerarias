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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'Casos'], function () {
    Route::get('vistaCrear', 'CasosController@viewCrear');
    Route::post('guardarNuevo', 'CasosController@guardarNuevo');
    Route::get('ver', 'CasosController@verCasos')->middleware('role:Personal');
    Route::get('{id}/ver', 'CasosController@detallesCaso')->middleware('role:Personal');
    Route::get('/{caso}/asignarFuneraria/{id}/{correo}/{wp}', 'CasosController@asignarFuneraria');
    Route::get('/cerrarCaso/{caso}', 'CasosController@cerrarCaso');
});

Route::post('Caso/{id}/guardarMedia', 'CasosController@guardarMedia');
Route::post('Funeraria/Caso/{id}/guardarMedia', 'FunerariasController@guardarMedia');

Route::group(['prefix' => 'Funerarias'], function () {
    Route::get('Casos/ver', 'FunerariasController@verCasos');
    Route::get('Casos/{id}/ver', 'FunerariasController@detallesCaso');
});
