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

Route::get('/dashboard', 'PersonalUMController@dashboard');

Route::get('/verFunerarias', 'HomeController@devolverFunerarias');

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

//Route::get('CHN/Casos/ver', 'CasosController@verCasosCHN')->middleware('role:CHN');
//Route::get('CHN/Casos/ver/{causa}', 'CasosController@verCasosCHN')->middleware('role:CHN');

Route::group(['prefix' => 'Casos'], function () {
    Route::get('vistaCrear', 'CasosController@viewCrear');
    Route::post('guardarNuevo', 'CasosController@guardarNuevo');
    Route::get('ver', 'CasosController@verCasos')->middleware('role:Personal||Contabilidad||CHN');
    Route::get('ver/{causa}', 'CasosController@verCasos')->middleware('role:Personal||Contabilidad||CHN');
    Route::get('{id}/ver', 'CasosController@detallesCaso')->middleware('role:Personal||Contabilidad||CHN');
    Route::get('/{caso}/asignarFuneraria/{id}/{campania}/{moneda}/{correo}/{wp}', 'CasosController@asignarFuneraria');
    Route::any('/{caso}/actualizarPago', 'CasosController@actualizarPago');
    Route::get('/cerrarCaso/{caso}', 'CasosController@cerrarCaso');
    Route::post('/cancelarCaso/{caso}', 'CasosController@cancelarCaso');
    Route::get('Reportar/{caso}/{instruccion}', 'CasosController@reportarCaso');
    Route::get('Solicitudes/{caso}/{solicitud}/{opcion}', 'CasosController@actualizarSolicitud');
    Route::post('{id}/evaluar', 'CasosController@evaluarFuneraria');
    Route::get('Causas/nueva/{causa}', 'CasosController@nuevaCausa');
    Route::post('{id}/Causas/actualizar', 'CasosController@actualizarCausa');
    Route::post('{id}/modificar', 'CasosController@modificarCaso');
    Route::get('getInfoFuneraria/{id}', 'CasosController@getInfoFuneraria');
    Route::get('reportes', 'CasosController@verReportesCHN');
    Route::get('reportes/{fechaInicio}/{fechaFin}', 'CasosController@verReportesCHNFiltrada');
    Route::get('{caso}/reportes/generar', 'CasosController@generarReporteCHN');

    Route::get('Externo/{token}', 'CasosController@casoExterno');

});

Route::group(['prefix' => 'Personal'], function (){
    Route::get('/sendMail/{mail}/{caso}', 'PersonalUMController@sendMail');
    Route::get('Funerarias/ver', 'PersonalUMController@verFunerarias');
    Route::get('Funeraria/{id}/ver', 'PersonalUMController@verFuneraria');
    Route::get('Funeraria/{id}/{docto}/{accion}', 'PersonalUMController@accionDocto');
    //Route::get('Funeraria/pasos/{funeraria}/{accion}', 'PersonalUMController@accionPaso');
    Route::post('Funeraria/{id}/guardar', 'AdminController@guardarCambiosFuneraria');
    Route::post('Funeraria/{id}/guardarNueva', 'AdminController@guardarCambiosFunerariaNueva');
    Route::get('configuraciones', 'PersonalUMController@configuraciones');
    Route::post('configuraciones/guardar', 'PersonalUMController@configuracionesGuardar');
    Route::get('log', 'PersonalUMController@verlogs');
    Route::get('generarToken/{caso}', 'PersonalUMController@generarToken');

    Route::group(['prefix' => 'Reportes'], function () {
        Route::get('ver', 'PersonalUMController@verReportes');
        Route::get('Edades/{fechaInicio}/{fechaFin}/{aseguradora}', 'PersonalUMController@reporteEdades');
        Route::get('EdadesCSV/{fechaInicio}/{fechaFin}/{aseguradora}', 'PersonalUMController@reporteEdadesCSV');
        Route::get('EdadesExcel/{fechaInicio}/{fechaFin}/{aseguradora}', 'PersonalUMController@reporteEdadesExcel');
        Route::get('Causas/{fechaInicio}/{fechaFin}/{aseguradora}', 'PersonalUMController@reporteCausas');
        Route::get('CausasCSV/{fechaInicio}/{fechaFin}/{aseguradora}', 'PersonalUMController@reporteCausasCSV');
        Route::get('CausasExcel/{fechaInicio}/{fechaFin}/{aseguradora}', 'PersonalUMController@reporteCausasExcel');
        Route::get('Lugares/{fechaInicio}/{fechaFin}/{aseguradora}', 'PersonalUMController@reporteLugares');
        Route::get('LugaresCSV/{fechaInicio}/{fechaFin}/{aseguradora}', 'PersonalUMController@reporteLugaresCSV');
        Route::get('LugaresExcel/{fechaInicio}/{fechaFin}/{aseguradora}', 'PersonalUMController@reporteLugaresExcel');
        Route::get('General/{fechaInicio}/{fechaFin}/{aseguradora}', 'PersonalUMController@reporteGeneral');
        Route::get('GeneralCSV/{fechaInicio}/{fechaFin}/{aseguradora}', 'PersonalUMController@reporteGeneralCSV');
        Route::get('CSVConteoCausas/{fechaInicio}/{fechaFin}/{aseguradora}', 'PersonalUMController@CSVConteoCausas');
        Route::get('CSVConteoFunerarias/{fechaInicio}/{fechaFin}/{aseguradora}', 'PersonalUMController@CSVConteoFunerarias');
        Route::get('CSVCausasDeptos/{fechaInicio}/{fechaFin}/{aseguradora}', 'PersonalUMController@CSVCausasDeptos');
        Route::get('ExcelGeneral/{fechaInicio}/{fechaFin}/{aseguradora}', 'PersonalUMController@ExcelReporteGeneral');
        Route::get('ExcelConteoCausas/{fechaInicio}/{fechaFin}/{aseguradora}', 'PersonalUMController@ExcelConteoCausas');
        Route::get('ExcelConteoFunerarias/{fechaInicio}/{fechaFin}/{aseguradora}', 'PersonalUMController@ExcelConteoFunerarias');
        Route::get('ExcelCausasDeptos/{fechaInicio}/{fechaFin}/{aseguradora}', 'PersonalUMController@ExcelCausasDeptos');
        Route::get('Caso/{id}', 'PersonalUMController@reporteCaso');
        Route::get('Graficas', 'PersonalUMController@Graficas');
        Route::get('Graficas/{fechaInicio}/{fechaFin}/{funeraria}/{departamento}', 'PersonalUMController@GraficasPorFecha');
        Route::get('CanceladosCSV/{fechaInicio}/{fechaFin}/{aseguradora}', 'PersonalUMController@CSVCancelados');
        Route::get('ExcelCancelados/{fechaInicio}/{fechaFin}/{aseguradora}', 'PersonalUMController@ExcelCancelados');
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
    
    Route::get('estadoCuentaFunerarias', 'PersonalUMController@estadoCuentaFunerarias');
    Route::get('estadoCuentaFunerarias/{fechaInicio}/{fechaFin}', 'PersonalUMController@estadoCuentaFunerarias');
    Route::get('detalleCuentaFuneraria/{id}', 'PersonalUMController@detalleCuentaFuneraria');
    Route::get('detalleCuentaFuneraria/{id}/{fechaInicio}/{fechaFin}', 'PersonalUMController@detalleCuentaFuneraria');

    Route::get('verFunerariasPendientes', 'PersonalUMController@verFunerariasPendientes');
    Route::get('eliminarUsuario/{id}', 'AdminController@eliminarUsuario');
    Route::get('eliminarFuneraria/{id}', 'AdminController@eliminarFuneraria');
    Route::get('editarFuneraria/{id}/{nombre}', 'AdminController@editarFuneraria');
    Route::get('editarUsuario/{id}', 'AdminController@editarUsuario');
    Route::post('guardarUsuario/{id}', 'AdminController@guardarCambiosUsuario');
    Route::post('guardarFuneraria/{id}', 'AdminController@guardarCambiosFuneraria');

    Route::group(['prefix' => 'Campanias'], function () {
        Route::get('', 'AdminController@verCampanias');
        Route::get('ver/{id}', 'AdminController@detallesCampanias');
        Route::get('crear', 'AdminController@crearCampania');
        Route::post('guardar', 'AdminController@guardarCampania');
        Route::post('{id}/actualizar', 'AdminController@actualizarCampania');
        Route::get('eliminar/{id}', 'AdminController@eliminarCampania');
    });

    Route::get('Tabla_CHN', 'AdminController@tablaCHN');
    Route::post('Tabla_CHN', 'AdminController@guardarTablaCHN');

});

Route::get('/pasos/{funeraria}/{accion}/{paso}', 'PersonalUMController@accionPaso');
Route::post('Caso/{id}/guardarMedia', 'CasosController@guardarMedia');
Route::post('Caso/{id}/guardarFacturaUM', 'CasosController@guardarFacturaUM');
Route::post('Caso/{id}/guardarComprobanteUM', 'CasosController@guardarComprobanteUM');
Route::get('Caso/factura/{id}/{accion}', 'CasosController@estatusFacturaUM');
Route::get('Caso/{id}/documento/{docto}/{estatus}', 'CasosController@documentosCHN');
Route::post('Caso/{id}/guardarFactura', 'CasosController@guardarFactura');
Route::post('Funeraria/Caso/{id}/guardarMedia', 'FunerariasController@guardarMedia');
Route::get('Notificacion/{id}/quitar', 'HomeController@quitarNotificacion');
Route::post('Caso/{id}/CHNEstatus', 'CasosController@chnEstatus');
Route::post('Caso/{id}/ISR', 'CasosController@isrCaso');


Route::post('Funeraria/info/guardarMedia/{media}', 'HomeController@guardarMedia');
Route::post('Funeraria/info/actualizarInfo', 'HomeController@guardarInfo');
Route::post('Funeraria/info/actualizarInfo/{id}', 'HomeController@guardarInfoFuneraria');

Route::get('/convenio', 'HomeController@generarConvenio');
Route::get('/convenio/{id}', 'HomeController@generarConvenioFuneraria');

Route::group(['prefix' => 'Funerarias'], function () {
    Route::get('Casos/ver', 'FunerariasController@verCasos');
    Route::get('Casos/{id}/ver', 'FunerariasController@detallesCaso');
    Route::get('Inactiva', 'HomeController@funerariaInactiva');
    Route::get('Descargas', 'FunerariasController@descargas');
    Route::post('Casos/{caso}/actualizarCosto', 'FunerariasController@actualizarCosto');
    Route::post('Casos/{id}/modificar', 'FunerariasController@modificarCaso');
    Route::get('datosBancarios', 'FunerariasController@datosBancarios');
    Route::post('datosBancarios/guardar', 'FunerariasController@datosBancariosGuardar');
});

Route::group(['prefix' => 'Externa'], function () {
    Route::post('Casos/{caso}/actualizarCosto', 'CasosController@actualizarCostoExterno');
    Route::post('Casos/{id}/modificar', 'CasosController@modificarCasoExterno');
    Route::post('Casos/{id}/modificarFuneraria', 'CasosController@modificarFunerariaCasoExterno');
    Route::post('Casos/{id}/guardarMedia', 'CasosController@guardarMediaExterno');
});

/*Route::group(['prefix' => 'Admin'], function () {
    Route::get('CrearUsuario', 'AdminController@nuevoUsuario');
    Route::get('CrearFuneraria', 'AdminController@nuevaFuneraria');
    Route::post('nuevoUsuario', 'AdminController@guardarUsuario');
    Route::post('nuevaFuneraria', 'AdminController@guardarFuneraria');
});*/
