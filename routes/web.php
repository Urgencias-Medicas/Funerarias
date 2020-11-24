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
    $user = auth()->user();
    if($user){
        return redirect('/home');
    }
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'password'], function () {
    Route::get('cambio', 'HomeController@cambioPassword');
    Route::get('verificar/{password}', 'HomeController@verificarPassword');
    Route::post('guardarCambio', 'HomeController@guardarPassword');
});
Route::group(['prefix' => 'mail'], function () {
    Route::get('cambio', 'HomeController@cambioMail');
    Route::get('verificar/{mail}', 'HomeController@verificarMail');
    Route::post('guardarCambio', 'HomeController@guardarMail');
});

Route::get('/Notificaciones', 'HomeController@notificaciones');

Route::group(['prefix' => 'Casos'], function () {
    Route::get('vistaCrear', 'CasosController@viewCrear');
    Route::post('guardarNuevo', 'CasosController@guardarNuevo');
    Route::get('ver', 'CasosController@verCasos')->middleware('role:Personal');
    Route::get('{id}/ver', 'CasosController@detallesCaso')->middleware('role:Personal');
    Route::get('/{caso}/asignarFuneraria/{id}/{funeraria}/{correo}/{wp}', 'CasosController@asignarFuneraria');
    Route::any('/{caso}/actualizarPago', 'CasosController@actualizarPago');
    Route::get('/cerrarCaso/{caso}', 'CasosController@cerrarCaso');
    Route::get('Reportar/{caso}/{instruccion}', 'CasosController@reportarCaso');
    Route::get('Solicitudes/{caso}/{solicitud}/{opcion}', 'CasosController@actualizarSolicitud');
    Route::post('{id}/evaluar', 'CasosController@evaluarFuneraria');
    Route::get('Causas/nueva/{causa}', 'CasosController@nuevaCausa');
    Route::post('{id}/Causas/actualizar', 'CasosController@actualizarCausa');
    Route::post('{id}/modificar', 'CasosController@modificarCaso');
    Route::get('getInfoFuneraria/{id}', 'CasosController@getInfoFuneraria');
});

Route::group(['prefix' => 'Personal'], function (){
    Route::get('Funerarias/ver', 'PersonalUMController@verFunerarias');
    Route::get('Funeraria/{id}/ver', 'PersonalUMController@verFuneraria');
    Route::post('Funeraria/{id}/{detalle}/guardar', 'AdminController@guardarCambiosFuneraria');

    Route::group(['prefix' => 'Reportes'], function () {
        Route::get('ver', 'PersonalUMController@verReportes');
        Route::get('Edades/{fechaInicio}/{fechaFin}', 'PersonalUMController@reporteEdades');
        Route::get('EdadesCSV/{fechaInicio}/{fechaFin}', 'PersonalUMController@reporteEdadesCSV');
        Route::get('Causas/{fechaInicio}/{fechaFin}', 'PersonalUMController@reporteCausas');
        Route::get('CausasCSV/{fechaInicio}/{fechaFin}', 'PersonalUMController@reporteCausasCSV');
        Route::get('Lugares/{fechaInicio}/{fechaFin}', 'PersonalUMController@reporteLugares');
        Route::get('LugaresCSV/{fechaInicio}/{fechaFin}', 'PersonalUMController@reporteLugaresCSV');
        Route::get('General/{fechaInicio}/{fechaFin}', 'PersonalUMController@reporteGeneral');
        Route::get('GeneralCSV/{fechaInicio}/{fechaFin}', 'PersonalUMController@reporteGeneralCSV');
        Route::get('CSVConteoCausas/{fechaInicio}/{fechaFin}', 'PersonalUMController@CSVConteoCausas');
        Route::get('CSVConteoFunerarias/{fechaInicio}/{fechaFin}', 'PersonalUMController@CSVConteoFunerarias');
        Route::get('CSVCausasDeptos/{fechaInicio}/{fechaFin}', 'PersonalUMController@CSVCausasDeptos');
        Route::get('Caso/{id}', 'PersonalUMController@reporteCaso');
    });
    
    Route::get('CrearUsuario', 'AdminController@nuevoUsuario');
    Route::get('CrearUsuarioFuneraria', 'AdminController@nuevoUsuarioFuneraria');
    Route::get('CrearFuneraria', 'AdminController@nuevaFuneraria');
    Route::post('nuevoUsuario', 'AdminController@guardarUsuario');
    Route::post('nuevoUsuarioFuneraria', 'AdminController@guardarUsuarioFuneraria');
    Route::post('nuevaFuneraria', 'AdminController@guardarFuneraria');
    Route::get('verUsuarios', 'AdminController@verUsuarios');
    Route::get('verUsuariosFunerarias', 'AdminController@verUsuariosFunerarias');
    Route::get('verFunerarias', 'AdminController@verFunerarias');
    Route::get('eliminarUsuario/{id}', 'AdminController@eliminarUsuario');
    Route::get('eliminarFuneraria/{id}', 'AdminController@eliminarFuneraria');
    Route::get('editarFuneraria/{id}/{nombre}', 'AdminController@editarFuneraria');
    Route::get('editarUsuario/{id}', 'AdminController@editarUsuario');
    Route::post('guardarUsuario/{id}', 'AdminController@guardarCambiosUsuario');
    Route::post('guardarFuneraria/{id}', 'AdminController@guardarCambiosFuneraria');

});

Route::post('Caso/{id}/guardarMedia', 'CasosController@guardarMedia');
Route::post('Funeraria/Caso/{id}/guardarMedia', 'FunerariasController@guardarMedia');
Route::get('Notificacion/{id}/quitar', 'HomeController@quitarNotificacion');

Route::group(['prefix' => 'Funerarias'], function () {
    Route::get('Casos/ver', 'FunerariasController@verCasos');
    Route::get('Casos/{id}/ver', 'FunerariasController@detallesCaso');
    Route::get('Inactiva', 'HomeController@funerariaInactiva');
    Route::get('Descargas', 'FunerariasController@descargas');
    Route::post('Casos/{caso}/actualizarCosto', 'FunerariasController@actualizarCosto');
    Route::post('Casos/{id}/modificar', 'FunerariasController@modificarCaso');
});

/*Route::group(['prefix' => 'Admin'], function () {
    Route::get('CrearUsuario', 'AdminController@nuevoUsuario');
    Route::get('CrearFuneraria', 'AdminController@nuevaFuneraria');
    Route::post('nuevoUsuario', 'AdminController@guardarUsuario');
    Route::post('nuevaFuneraria', 'AdminController@guardarFuneraria');
});*/
