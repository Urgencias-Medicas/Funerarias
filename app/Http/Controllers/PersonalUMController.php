<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\DetallesFuneraria;
use App\Casos;
use App\HistorialPagos;
use App\Configuracion;
use App\Documentos;
use App\DocumentosFuneraria;
use App\DetallesDeFuneraria;
use App\Notificaciones;
use App\InfoFunerariasRegistradas;
use App\ReportesCHN;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Support\Facades\Storage;
use PDF;
use DB;

class PersonalUMController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Personal||Contabilidad');
    }
    public function verFunerarias(){
        $users = User::where('activo', '=', null)->get();

        return view('Personal.Funerarias.ver', ['Funerarias' => $users]);
    }
    public function verFunerariasPendientes(){
        $users = User::where('activo', 'No')->orderByDesc('id')->get();

        return view('Personal.Funerarias.ver', ['Funerarias' => $users]);
    }
    public function verFuneraria($id){
        $funeraria = User::find($id);
        $detalle = DetallesFuneraria::find($funeraria->detalle);
        $documentos = Documentos::get();

        $documentos_funeraria = DocumentosFuneraria::where('Funeraria', $id)->get();

        $detalles_funeraria = DetallesDeFuneraria::where('Funeraria', $id)->get();
        
        return view('Personal.Funerarias.verFuneraria', ['Funeraria' => $funeraria, 'Detalle' => $detalle, 'Documentos' => $documentos, 'DoctosFuneraria' => $documentos_funeraria, 'Detalles_Funeraria' => $detalles_funeraria]);
    }
    public function accionDocto($id, $docto, $accion, Request $request){
        if(isset($request->comentario)){
            $comentario = $request->comentario;
        }else{
            $comentario = '-';
        }
        
        DocumentosFuneraria::where('Id', $docto)->update(['Estatus' => $accion, 'Comentarios' => $comentario]);
        $documento = DocumentosFuneraria::where('Id', $docto)->value('Documento');

        if($documento == 'licenciaAmbiental'){
            $test = DetallesDeFuneraria::where('Funeraria', $id)->where('Campo', 'LicenciaAmbiental')->update(['Estado' => $accion]);
        }
        
        $documentacion = DetallesDeFuneraria::where('Funeraria', $id)->where('Campo', 'Documentacion')->first();

        if($documentacion){
            DetallesDeFuneraria::where('Funeraria', $id)->where('Campo', 'Documentacion')->update(['Estado' => 'Denegado']);
        }else{
            DetallesDeFuneraria::create(['Funeraria' => $id, 'Campo' => 'Documentacion', 'Estado' => 'Denegado']);
        }

        activity()->log('El documento '.$documento.' fue '.$accion. ' para la funeraria No. '.$id);
        return back();
        //return $docto;
    }
    public function accionPaso($funeraria, $accion, $paso){

        if($paso == 1){
            DetallesDeFuneraria::where('Funeraria', $funeraria)->where('Campo', 'LicenciaAmbiental')->update(['Estado' => $accion]);
        }elseif($paso == 2){
            DetallesDeFuneraria::where('Funeraria', $funeraria)->where('Campo', 'InfoGeneral')->update(['Estado' => $accion]);
        }elseif($paso == 3){
            DetallesDeFuneraria::where('Funeraria', $funeraria)->where('Campo', 'Documentacion')->update(['Estado' => $accion]);
            if($accion == 'Aprobado'){
                DetallesDeFuneraria::updateOrCreate(['Funeraria' => $funeraria, 'Campo' => 'Convenio', 'Estado' => 'Denegado']);
            }
        }elseif($paso == 4){
            if($accion == 'Denegado'){
                DetallesDeFuneraria::where('Funeraria', $funeraria)->where('Campo', 'Convenio')->update(['Estado' => $accion]);
            }
        }

        $respuesta = '';
        if($accion == 'Aprobar'){
            $respuesta = 'Verifique su procedimiento de aplicación, un paso ha sido aprobado';
        }elseif($accion === 'Denegar'){
            $respuesta = 'Verifique su procedimiento de aplicación, un paso ha sido denegado';
        }
        Notificaciones::create(['funeraria' => $funeraria, 'contenido' => $respuesta, 'estatus' => 'Activa']);

        return back();
    }
    public function actualizarFuneraria($id, $detalle, Request $request){
        $user = User::find($id)->update(['activo' => $request->activo]);

        $pasos = array();
        if($request->paso_uno == ''){
            array_push($pasos, 'No');
        }else{
            array_push($pasos, 'Si');
        }

        if($request->paso_dos == ''){
            array_push($pasos, 'No');
        }else{
            array_push($pasos, 'Si');
        }

        if($request->paso_tres == ''){
            array_push($pasos, 'No');
        }else{
            array_push($pasos, 'Si');
        }

        $detalle = DetallesFuneraria::find($detalle)->update(['paso_uno' => $pasos[0], 'paso_dos' => $pasos[1], 'paso_tres' => $pasos[2]]);
        activity()->log('La funeraria '.$id.' fue actualizada');
        if($user->isDirty('activo')){
            activity()->log('El estatus de la funeraria '.$id.' fue actualizado a '.$request->activo);
        }
        return redirect('/Personal/Funerarias/ver');
    }
    public function verReportes(){
        return view('Personal.Reportes.Principal');
    }
    public function reporteEdades($fechaInicio, $fechaFin, $aseguradora){
        
        $fechaInicio = date($fechaInicio);
        $fechaFin = date($fechaFin);

        if($aseguradora == 'Todas'){
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $casos = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->orderBy('Codigo', 'DESC')->select('Nombre', 'Edad')->get();
            }else{
                //Seleccionar entre días, meses o años
                $casos = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Codigo', 'DESC')->select('Nombre', 'Edad')->get();
            }    
        }else{
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $casos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereDate('Fecha', '=', $fechaInicio)->orderBy('Codigo', 'DESC')->select('Nombre', 'Edad')->get();
            }else{
                //Seleccionar entre días, meses o años
                $casos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Codigo', 'DESC')->select('Nombre', 'Edad')->get();
            }
        }

        $pdf = PDF::loadView('Personal.Reportes.Plantillas.Edades', ['Casos' => $casos, 'FechaInicio' => $fechaInicio, 'FechaFin' => $fechaFin]);
        return $pdf->download('Reporte__SFUM_Reporte-Edades.pdf');
        
    }
    public function reporteEdadesCSV($fechaInicio, $fechaFin, $aseguradora){
        
        $fechaInicio = date($fechaInicio);
        $fechaFin = date($fechaFin);
        
        if($aseguradora == 'Todas'){
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $casos = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->orderBy('Codigo', 'DESC')->select('Nombre', 'Edad')->get();
            }else{
                //Seleccionar entre días, meses o años
                $casos = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Codigo', 'DESC')->select('Nombre', 'Edad')->get();
            }
        }else{
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $casos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereDate('Fecha', '=', $fechaInicio)->orderBy('Codigo', 'DESC')->select('Nombre', 'Edad')->get();
            }else{
                //Seleccionar entre días, meses o años
                $casos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Codigo', 'DESC')->select('Nombre', 'Edad')->get();
            }   
        }

        $fileName = 'Reporte__SFUM_Edades-'.$fechaInicio.'-'.$fechaFin.'.csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Nombre', 'Edad');

        $callback = function() use($casos, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($casos as $caso) {
                $row['Nombre']  = $caso->Nombre;
                $row['Edad']    = $caso->Edad;

                fputcsv($file, array($row['Nombre'], $row['Edad']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
        
    }

    public function reporteEdadesExcel($fechaInicio, $fechaFin, $aseguradora){
        $fechaInicio = date($fechaInicio);
        $fechaFin = date($fechaFin);

        if($aseguradora == 'Todas'){
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $casos = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->orderBy('Codigo', 'DESC')->select('Nombre', 'Edad')->get();
            }else{
                //Seleccionar entre días, meses o años
                $casos = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Codigo', 'DESC')->select('Nombre', 'Edad')->get();
            }
        }else{
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $casos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereDate('Fecha', '=', $fechaInicio)->orderBy('Codigo', 'DESC')->select('Nombre', 'Edad')->get();
            }else{
                //Seleccionar entre días, meses o años
                $casos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Codigo', 'DESC')->select('Nombre', 'Edad')->get();
            }
        }

        $fileName = 'Reporte__SFUM_Edades-'.$fechaInicio.'-'.$fechaFin.'.xls';

        $headers = array(
            "Content-type"        => "application/vnd.ms-excel",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $callback = function() use($casos) {

            $flag = false;

            foreach($casos as $caso){
                $row['Nombre']  = utf8_decode($caso->Nombre);
                $row['Edad']    = $caso->Edad;

                if(!$flag){
                    echo implode("\t", array_keys($row)) . "\r\n";
                    $flag = true;
                }
                echo implode("\t", array_values($row)) . "\r\n";
            }

        };

        return response()->stream($callback, 200, $headers);
    }

    public function reporteCausas($fechaInicio, $fechaFin, $aseguradora){

        if($aseguradora == 'Todas'){
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $casos = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->orderBy('Causa', 'DESC')->select('Nombre', 'Causa')->get();
            }else{
                //Seleccionar entre días, meses o años
                $casos = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Causa', 'DESC')->select('Nombre', 'Causa')->get();
            }
        }else{
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $casos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereDate('Fecha', '=', $fechaInicio)->orderBy('Causa', 'DESC')->select('Nombre', 'Causa')->get();
            }else{
                //Seleccionar entre días, meses o años
                $casos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Causa', 'DESC')->select('Nombre', 'Causa')->get();
            }
        }


        $pdf = PDF::loadView('Personal.Reportes.Plantillas.Causas', ['Casos' => $casos, 'FechaInicio' => $fechaInicio, 'FechaFin' => $fechaFin]);
        return $pdf->download('Reporte__SFUM_Reporte-Causas.pdf');
    }
    public function reporteCausasCSV($fechaInicio, $fechaFin, $aseguradora){

        if($aseguradora == 'Todas'){
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $casos = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->orderBy('Causa', 'DESC')->select('Nombre', 'Causa')->get();
            }else{
                //Seleccionar entre días, meses o años
                $casos = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Causa', 'DESC')->select('Nombre', 'Causa')->get();
            }
        }else{
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $casos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereDate('Fecha', '=', $fechaInicio)->orderBy('Causa', 'DESC')->select('Nombre', 'Causa')->get();
            }else{
                //Seleccionar entre días, meses o años
                $casos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Causa', 'DESC')->select('Nombre', 'Causa')->get();
            }
        }

        //$pdf = PDF::loadView('Personal.Reportes.Plantillas.Causas', ['Casos' => $casos, 'FechaInicio' => $fechaInicio, 'FechaFin' => $fechaFin]);

        $fileName = 'Reporte__SFUM_Causas-'.$fechaInicio.'-'.$fechaFin.'.csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Nombre', 'Causa');

        $callback = function() use($casos, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($casos as $caso) {
                $row['Nombre']  = $caso->Nombre;
                $row['Causa']    = $caso->Causa;

                fputcsv($file, array($row['Nombre'], $row['Causa']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function reporteCausasExcel($fechaInicio, $fechaFin, $aseguradora){

        if($aseguradora == 'Todas'){
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $casos = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->orderBy('Causa', 'DESC')->select('Nombre', 'Causa')->get();
            }else{
                //Seleccionar entre días, meses o años
                $casos = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Causa', 'DESC')->select('Nombre', 'Causa')->get();
            }
        }else{
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $casos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereDate('Fecha', '=', $fechaInicio)->orderBy('Causa', 'DESC')->select('Nombre', 'Causa')->get();
            }else{
                //Seleccionar entre días, meses o años
                $casos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Causa', 'DESC')->select('Nombre', 'Causa')->get();
            }
        }

        $fileName = 'Reporte__SFUM_Causas-'.$fechaInicio.'-'.$fechaFin.'.xls';

        $headers = array(
            "Content-type"        => "application/vnd.ms-excel",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $callback = function() use($casos) {

            $flag = false;

            foreach($casos as $caso){
                $row['Nombre']  = utf8_decode($caso->Nombre);
                $row['Causa']    = $caso->Causa;

                if(!$flag){
                    echo implode("\t", array_keys($row)) . "\r\n";
                    $flag = true;
                }
                echo implode("\t", array_values($row)) . "\r\n";
            }

        };

        return response()->stream($callback, 200, $headers);
    }

    public function reporteLugares($fechaInicio, $fechaFin, $aseguradora){

        if($aseguradora == 'Todas'){
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $casos = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->orderBy('Lugar', 'DESC')->select('Nombre', 'Lugar', 'Municipio', 'Departamento')->get();
            }else{
                //Seleccionar entre días, meses o años
                $casos = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Lugar', 'DESC')->select('Nombre', 'Lugar', 'Municipio', 'Departamento')->get();
            }
        }else{
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $casos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereDate('Fecha', '=', $fechaInicio)->orderBy('Lugar', 'DESC')->select('Nombre', 'Lugar', 'Municipio', 'Departamento')->get();
            }else{
                //Seleccionar entre días, meses o años
                $casos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Lugar', 'DESC')->select('Nombre', 'Lugar', 'Municipio', 'Departamento')->get();
            }
        }

        $pdf = PDF::loadView('Personal.Reportes.Plantillas.Lugares', ['Casos' => $casos, 'FechaInicio' => $fechaInicio, 'FechaFin' => $fechaFin]);
        return $pdf->download('Reporte__SFUM_Reporte-Lugares.pdf');
    }
    public function reporteLugaresCSV($fechaInicio, $fechaFin, $aseguradora){

        if($aseguradora == 'Todas'){
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $casos = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->orderBy('Lugar', 'DESC')->select('Nombre', 'Lugar', 'Municipio', 'Departamento')->get();
            }else{
                //Seleccionar entre días, meses o años
                $casos = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Lugar', 'DESC')->select('Nombre', 'Lugar', 'Municipio', 'Departamento')->get();
            }
        }else{
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $casos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereDate('Fecha', '=', $fechaInicio)->orderBy('Lugar', 'DESC')->select('Nombre', 'Lugar', 'Municipio', 'Departamento')->get();
            }else{
                //Seleccionar entre días, meses o años
                $casos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Lugar', 'DESC')->select('Nombre', 'Lugar', 'Municipio', 'Departamento')->get();
            }
        }

        $fileName = 'Reporte__SFUM_Lugares-'.$fechaInicio.'-'.$fechaFin.'.csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Nombre', 'Lugar', 'Municipio', 'Departamento');

        $callback = function() use($casos, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($casos as $caso) {
                $row['Nombre']  = $caso->Nombre;
                $row['Lugar']    = $caso->Lugar;
                $row['Municipio']    = strtoupper($caso->Municipio);
                $row['Departamento']    = strtoupper($caso->Departamento);

                fputcsv($file, array($row['Nombre'], $row['Lugar'], $row['Municipio'], $row['Departamento']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function reporteLugaresExcel($fechaInicio, $fechaFin, $aseguradora){

        if($aseguradora == 'Todas'){
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $casos = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->orderBy('Lugar', 'DESC')->select('Nombre', 'Lugar', 'Municipio', 'Departamento')->get();
            }else{
                //Seleccionar entre días, meses o años
                $casos = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Lugar', 'DESC')->select('Nombre', 'Lugar', 'Municipio', 'Departamento')->get();
            }
        }else{
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $casos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereDate('Fecha', '=', $fechaInicio)->orderBy('Lugar', 'DESC')->select('Nombre', 'Lugar', 'Municipio', 'Departamento')->get();
            }else{
                //Seleccionar entre días, meses o años
                $casos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Lugar', 'DESC')->select('Nombre', 'Lugar', 'Municipio', 'Departamento')->get();
            }
        }

        $fileName = 'Reporte__SFUM_Lugares-'.$fechaInicio.'-'.$fechaFin.'.xls';

        $headers = array(
            "Content-type"        => "application/vnd.ms-excel",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $callback = function() use($casos) {

            $flag = false;

            foreach($casos as $caso){
                $row['Nombre']  = utf8_decode($caso->Nombre);
                $row['Lugar']    = $caso->Lugar;
                $row['Municipio']    = strtoupper($caso->Municipio);
                $row['Departamento']    = strtoupper($caso->Departamento);

                if(!$flag){
                    echo implode("\t", array_keys($row)) . "\r\n";
                    $flag = true;
                }
                echo implode("\t", array_values($row)) . "\r\n";
            }

        };

        return response()->stream($callback, 200, $headers);
    }

    public function reporteGeneral($fechaInicio, $fechaFin, $aseguradora){

        $fechaInicio = date($fechaInicio);
        $fechaFin = date($fechaFin);

        if($aseguradora == 'Todas'){
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $casos = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->orderBy('id', 'DESC')->get();
    
                $conteo = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->select('Causa', DB::raw('count(*) as total'))->groupBy('Causa')->get();
    
                $conteo_funerarias = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->select('Funeraria_Nombre', DB::raw('count(*) as total'))->groupBy('Funeraria_Nombre')->get();
    
                $departamentos = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->distinct('Departamento')->select('Departamento')->get();
    
                foreach($departamentos as $departamento){
                    $causas_deptos = Casos::where('Reportar', 'Si')->where('Departamento', $departamento->Departamento)->whereDate('Fecha', '=', $fechaInicio)->select('Causa', DB::raw('count(*) as total'))->groupBy('Causa')->get();
                    $departamento->Causas_arreglo = $causas_deptos;
                }
            }else{
                //Seleccionar entre días, meses o años
                $casos = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('id', 'DESC')->get();
    
                $conteo = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->select('Causa', DB::raw('count(*) as total'))->groupBy('Causa')->get();
    
                $conteo_funerarias = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->select('Funeraria_Nombre', DB::raw('count(*) as total'))->groupBy('Funeraria_Nombre')->get();
    
                $departamentos = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->distinct('Departamento')->select('Departamento')->get();
    
                foreach($departamentos as $departamento){
                    $causas_deptos = Casos::where('Reportar', 'Si')->where('Departamento', $departamento->Departamento)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->select('Causa', DB::raw('count(*) as total'))->groupBy('Causa')->get();
                    $departamento->Causas_arreglo = $causas_deptos;
                }
            }
        }else{
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $casos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereDate('Fecha', '=', $fechaInicio)->orderBy('id', 'DESC')->get();
    
                $conteo = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereDate('Fecha', '=', $fechaInicio)->select('Causa', DB::raw('count(*) as total'))->groupBy('Causa')->get();
    
                $conteo_funerarias = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereDate('Fecha', '=', $fechaInicio)->select('Funeraria_Nombre', DB::raw('count(*) as total'))->groupBy('Funeraria_Nombre')->get();
    
                $departamentos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereDate('Fecha', '=', $fechaInicio)->distinct('Departamento')->select('Departamento')->get();
    
                foreach($departamentos as $departamento){
                    $causas_deptos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->where('Departamento', $departamento->Departamento)->whereDate('Fecha', '=', $fechaInicio)->select('Causa', DB::raw('count(*) as total'))->groupBy('Causa')->get();
                    $departamento->Causas_arreglo = $causas_deptos;
                }
            }else{
                //Seleccionar entre días, meses o años
                $casos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('id', 'DESC')->get();
    
                $conteo = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->select('Causa', DB::raw('count(*) as total'))->groupBy('Causa')->get();
    
                $conteo_funerarias = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->select('Funeraria_Nombre', DB::raw('count(*) as total'))->groupBy('Funeraria_Nombre')->get();
    
                $departamentos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->distinct('Departamento')->select('Departamento')->get();
    
                foreach($departamentos as $departamento){
                    $causas_deptos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->where('Departamento', $departamento->Departamento)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->select('Causa', DB::raw('count(*) as total'))->groupBy('Causa')->get();
                    $departamento->Causas_arreglo = $causas_deptos;
                }
            }
        }

        if($aseguradora == '7'){
            $pdf = PDF::loadView('Personal.Reportes.Plantillas.General_SeguRed', ['Casos' => $casos, 'Conteo' => $conteo, 'Conteo_funerarias' => $conteo_funerarias, 'Departamentos' => $departamentos, 'FechaInicio' => $fechaInicio, 'FechaFin' => $fechaFin])->setPaper('a2', 'landscape');    
        }else{
            $pdf = PDF::loadView('Personal.Reportes.Plantillas.General', ['Casos' => $casos, 'Conteo' => $conteo, 'Conteo_funerarias' => $conteo_funerarias, 'Departamentos' => $departamentos, 'FechaInicio' => $fechaInicio, 'FechaFin' => $fechaFin])->setPaper('a2', 'landscape');
        }
        return $pdf->download('Reporte__SFUM_Reporte-General.pdf');
    }
    public function reporteGeneralCSV($fechaInicio, $fechaFin, $aseguradora){
        setlocale(LC_TIME, "spanish");

        if($aseguradora == 'Todas'){
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $casos = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->orderBy('id', 'DESC')->get();
            }else{
                //Seleccionar entre días, meses o años
                $casos = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('id', 'DESC')->get();
            }
        }else{
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $casos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereDate('Fecha', '=', $fechaInicio)->orderBy('id', 'DESC')->get();
            }else{
                //Seleccionar entre días, meses o años
                $casos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('id', 'DESC')->get();
            }
        }

        $fileName = 'Reporte__SFUM_General-'.$fechaInicio.'-'.$fechaFin.'.csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        if($aseguradora == '7'){
            $columns = array('Caso', 'Mes', 'Estudiante', 'Nombre Estudiante', 'Tutor', 'Municipio', 'Departamento', 'Causa de muerte', 'Causa', 'Descripcion Causa', 'Funeraria', 'Fecha', 'Evaluacion', 'Precio', 'Certificado', 'Poliza', 'Tipo Asegurado');
        }else{
            $columns = array('Caso', 'Mes', 'Estudiante', 'Nombre Estudiante', 'Tutor', 'Municipio', 'Departamento', 'Causa de muerte', 'Causa', 'Descripcion Causa', 'Funeraria', 'Fecha', 'Evaluacion', 'Precio');
        }

        $callback = function() use($casos, $columns, $aseguradora) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            if($aseguradora == '7'){
                foreach ($casos as $caso) {
                    $row['Caso']  = $caso->id;
                    $row['Mes']  = date('F', strtotime($caso->Fecha));
                    $row['Estudiante']  = $caso->Codigo;
                    $row['Nombre Estudiante']  = $caso->Nombre;
                    $row['Tutor']  = $caso->Tutor;
                    $row['Municipio']  = strtoupper($caso->Municipio);
                    $row['Departamento']  = strtoupper($caso->Departamento);
                    $row['Causa de muerte']  = $caso->Causa;
                    $row['Causa']  = $caso->Causa_Desc;
                    $row['Descripcion Causa']  = $caso->Causa_Especifica;
                    $row['Funeraria']  = $caso->Funeraria_Nombre;
                    $row['Fecha']  = $caso->Fecha;
                    $row['Evaluacion']  = $caso->Evaluacion;
                    $row['Precio']  = $caso->Costo;
                    $row['Certificado']  = $caso->Certificado;
                    $row['Poliza']  = $caso->Poliza;
                    $row['TipoAsegurado']  = $caso->TipoAsegurado;
    
                    fputcsv($file, array($row['Caso'],
                    $row['Mes'],
                    $row['Estudiante'],
                    $row['Nombre Estudiante'],
                    $row['Tutor'],
                    $row['Municipio'],
                    $row['Departamento'],
                    $row['Causa de muerte'],
                    $row['Causa'],
                    $row['Descripcion Causa'],
                    $row['Funeraria'],
                    $row['Fecha'],
                    $row['Evaluacion'],
                    $row['Precio'],
                    $row['Certificado'],
                    $row['Poliza'],
                    $row['TipoAsegurado']));
                }
            }else{
                foreach ($casos as $caso) {
                    $row['Caso']  = $caso->id;
                    $row['Mes']  = date('F', strtotime($caso->Fecha));
                    $row['Estudiante']  = $caso->Codigo;
                    $row['Nombre Estudiante']  = $caso->Nombre;
                    $row['Tutor']  = $caso->Tutor;
                    $row['Municipio']  = strtoupper($caso->Municipio);
                    $row['Departamento']  = strtoupper($caso->Departamento);
                    $row['Causa de muerte']  = $caso->Causa;
                    $row['Causa']  = $caso->Causa_Desc;
                    $row['Descripcion Causa']  = $caso->Causa_Especifica;
                    $row['Funeraria']  = $caso->Funeraria_Nombre;
                    $row['Fecha']  = $caso->Fecha;
                    $row['Evaluacion']  = $caso->Evaluacion;
                    $row['Precio']  = $caso->Costo;
    
                    fputcsv($file, array($row['Caso'],
                    $row['Mes'],
                    $row['Estudiante'],
                    $row['Nombre Estudiante'],
                    $row['Tutor'],
                    $row['Municipio'],
                    $row['Departamento'],
                    $row['Causa de muerte'],
                    $row['Causa'],
                    $row['Descripcion Causa'],
                    $row['Funeraria'],
                    $row['Fecha'],
                    $row['Evaluacion'],
                    $row['Precio']));
                }
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function ExcelReporteGeneral($fechaInicio, $fechaFin, $aseguradora){
        setlocale(LC_TIME, "spanish");

        if($aseguradora == 'Todas'){
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $casos = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->orderBy('id', 'DESC')->get();
            }else{
                //Seleccionar entre días, meses o años
                $casos = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('id', 'DESC')->get();
            }
        }else{
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $casos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereDate('Fecha', '=', $fechaInicio)->orderBy('id', 'DESC')->get();
            }else{
                //Seleccionar entre días, meses o años
                $casos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('id', 'DESC')->get();
            }
        }

        $fileName = 'Reporte__SFUM_General-'.$fechaInicio.'-'.$fechaFin.'.xls';

        $headers = array(
            "Content-type"        => "application/vnd.ms-excel",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $callback = function() use($casos, $aseguradora) {

            $flag = false;

            if($aseguradora == '7'){
                foreach($casos as $caso){
                    $row['Caso']  = $caso->id;
                    $row['Mes']  = date('F', strtotime($caso->Fecha));
                    $row['Estudiante']  = $caso->Codigo;
                    $row['Nombre Estudiante']  = utf8_decode($caso->Nombre);
                    $row['Tutor']  = utf8_decode($caso->Tutor);
                    $row['Municipio']  = strtoupper($caso->Municipio);
                    $row['Departamento']  = strtoupper($caso->Departamento);
                    $row['Causa de muerte']  = utf8_decode($caso->Causa);
                    $row['Causa']  = utf8_decode($caso->Causa_Desc);
                    $row['Descripcion Causa']  = utf8_decode($caso->Causa_Especifica);
                    $row['Funeraria']  = utf8_decode($caso->Funeraria_Nombre);
                    $row['Fecha']  = $caso->Fecha;
                    $row['Evaluacion']  = $caso->Evaluacion;
                    $row['Precio']  = $caso->Costo;
                    $row['Certificado']  = $caso->Certificado;
                    $row['Poliza']  = $caso->Poliza;
                    $row['Tipo Asegurado']  = $caso->TipoAsegurado;
    
                    if(!$flag){
                        echo implode("\t", array_keys($row)) . "\r\n";
                        $flag = true;
                    }
                    echo implode("\t", array_values($row)) . "\r\n";
                }
            }else{
                foreach($casos as $caso){
                    $row['Caso']  = $caso->id;
                    $row['Mes']  = date('F', strtotime($caso->Fecha));
                    $row['Estudiante']  = $caso->Codigo;
                    $row['Nombre Estudiante']  = utf8_decode($caso->Nombre);
                    $row['Tutor']  = utf8_decode($caso->Tutor);
                    $row['Municipio']  = strtoupper($caso->Municipio);
                    $row['Departamento']  = strtoupper($caso->Departamento);
                    $row['Causa de muerte']  = utf8_decode($caso->Causa);
                    $row['Causa']  = utf8_decode($caso->Causa_Desc);
                    $row['Descripcion Causa']  = utf8_decode($caso->Causa_Especifica);
                    $row['Funeraria']  = utf8_decode($caso->Funeraria_Nombre);
                    $row['Fecha']  = $caso->Fecha;
                    $row['Evaluacion']  = $caso->Evaluacion;
                    $row['Precio']  = $caso->Costo;
    
                    if(!$flag){
                        echo implode("\t", array_keys($row)) . "\r\n";
                        $flag = true;
                    }
                    echo implode("\t", array_values($row)) . "\r\n";
                }
            }           

        };

        return response()->stream($callback, 200, $headers);
    }

    public function CSVConteoCausas($fechaInicio, $fechaFin, $aseguradora){

        if($aseguradora == 'Todas'){
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $conteo = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->select('Causa', DB::raw('count(*) as total'))->groupBy('Causa')->get();
    
            }else{
                $conteo = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->select('Causa', DB::raw('count(*) as total'))->groupBy('Causa')->get();
            }
        }else{
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $conteo = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereDate('Fecha', '=', $fechaInicio)->select('Causa', DB::raw('count(*) as total'))->groupBy('Causa')->get();
    
            }else{
                $conteo = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->select('Causa', DB::raw('count(*) as total'))->groupBy('Causa')->get();
            }
        }

        $fileName = 'Reporte__SFUM_Conteo-Causas-'.$fechaInicio.'-'.$fechaFin.'.csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Causa', 'Total');

        $callback = function() use($conteo, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($conteo as $cont) {
                $row['Causa']  = $cont->Causa;
                $row['Total']    = $cont->total;

                fputcsv($file, array($row['Causa'], $row['Total']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function ExcelConteoCausas($fechaInicio, $fechaFin, $aseguradora){

        if($aseguradora == 'Todas'){
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $conteo = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->select('Causa', DB::raw('count(*) as total'))->groupBy('Causa')->get();
    
            }else{
                $conteo = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->select('Causa', DB::raw('count(*) as total'))->groupBy('Causa')->get();
            }
        }else{
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $conteo = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereDate('Fecha', '=', $fechaInicio)->select('Causa', DB::raw('count(*) as total'))->groupBy('Causa')->get();
    
            }else{
                $conteo = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->select('Causa', DB::raw('count(*) as total'))->groupBy('Causa')->get();
            }
        }

        $fileName = 'Reporte__SFUM_Conteo-Causas-'.$fechaInicio.'-'.$fechaFin.'.xls';

        $headers = array(
            "Content-type"        => "application/vnd.ms-excel",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $callback = function() use($conteo) {

            $flag = false;

            foreach($conteo as $cont){
                $row['Causa']  = $cont->Causa;
                $row['Total']    = $cont->total;

                if(!$flag){
                    echo implode("\t", array_keys($row)) . "\r\n";
                    $flag = true;
                }
                echo implode("\t", array_values($row)) . "\r\n";
            }

        };

        return response()->stream($callback, 200, $headers);
    }

    public function CSVConteoFunerarias($fechaInicio, $fechaFin, $aseguradora){

        if($aseguradora == 'Todas'){
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $conteo = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->select('Funeraria_Nombre', DB::raw('count(*) as total'))->groupBy('Funeraria_Nombre')->get();
    
            }else{
                $conteo = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->select('Funeraria_Nombre', DB::raw('count(*) as total'))->groupBy('Funeraria_Nombre')->get();
            }
        }else{
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $conteo = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereDate('Fecha', '=', $fechaInicio)->select('Funeraria_Nombre', DB::raw('count(*) as total'))->groupBy('Funeraria_Nombre')->get();
    
            }else{
                $conteo = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->select('Funeraria_Nombre', DB::raw('count(*) as total'))->groupBy('Funeraria_Nombre')->get();
            }
        }

        $fileName = 'Reporte__SFUM_Conteo-Funerarias-'.$fechaInicio.'-'.$fechaFin.'.csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Funeraria', 'Total');

        $callback = function() use($conteo, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($conteo as $cont) {
                $row['Funeraria']  = $cont->Funeraria_Nombre;
                $row['Total']    = $cont->total;

                fputcsv($file, array($row['Funeraria'], $row['Total']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function ExcelConteoFunerarias($fechaInicio, $fechaFin, $aseguradora){

        if($aseguradora == 'Todas'){
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $conteo = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->select('Funeraria_Nombre', DB::raw('count(*) as total'))->groupBy('Funeraria_Nombre')->get();
    
            }else{
                $conteo = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->select('Funeraria_Nombre', DB::raw('count(*) as total'))->groupBy('Funeraria_Nombre')->get();
            }
        }else{
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $conteo = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereDate('Fecha', '=', $fechaInicio)->select('Funeraria_Nombre', DB::raw('count(*) as total'))->groupBy('Funeraria_Nombre')->get();
    
            }else{
                $conteo = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->select('Funeraria_Nombre', DB::raw('count(*) as total'))->groupBy('Funeraria_Nombre')->get();
            }
        }

        $fileName = 'Reporte__SFUM_Conteo-Funerarias-'.$fechaInicio.'-'.$fechaFin.'.xls';

        $headers = array(
            "Content-type"        => "application/vnd.ms-excel",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $callback = function() use($conteo) {

            $flag = false;

            foreach($conteo as $cont){
                $row['Funeraria']  = $cont->Funeraria_Nombre;
                $row['Total']    = $cont->total;

                if(!$flag){
                    echo implode("\t", array_keys($row)) . "\r\n";
                    $flag = true;
                }
                echo implode("\t", array_values($row)) . "\r\n";
            }

        };

        return response()->stream($callback, 200, $headers);
    }

    public function CSVCausasDeptos($fechaInicio, $fechaFin, $aseguradora){

        if($aseguradora == 'Todas'){
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $departamentos = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->distinct('Departamento')->select('Departamento')->get();
                foreach($departamentos as $departamento){
                    $causas_deptos = Casos::where('Reportar', 'Si')->where('Departamento', $departamento->Departamento)->whereDate('Fecha', '=', $fechaInicio)->select('Causa', DB::raw('count(*) as total'))->groupBy('Causa')->get();
                    $departamento->Causas_arreglo = $causas_deptos;
                }
            }else{
                $departamentos = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->distinct('Departamento')->select('Departamento')->get();
                foreach($departamentos as $departamento){
                    $causas_deptos = Casos::where('Reportar', 'Si')->where('Departamento', $departamento->Departamento)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->select('Causa', DB::raw('count(*) as total'))->groupBy('Causa')->get();
                    $departamento->Causas_arreglo = $causas_deptos;
                }
            }
        }else{
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $departamentos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereDate('Fecha', '=', $fechaInicio)->distinct('Departamento')->select('Departamento')->get();
                foreach($departamentos as $departamento){
                    $causas_deptos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->where('Departamento', $departamento->Departamento)->whereDate('Fecha', '=', $fechaInicio)->select('Causa', DB::raw('count(*) as total'))->groupBy('Causa')->get();
                    $departamento->Causas_arreglo = $causas_deptos;
                }
            }else{
                $departamentos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->distinct('Departamento')->select('Departamento')->get();
                foreach($departamentos as $departamento){
                    $causas_deptos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->where('Departamento', $departamento->Departamento)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->select('Causa', DB::raw('count(*) as total'))->groupBy('Causa')->get();
                    $departamento->Causas_arreglo = $causas_deptos;
                }
            }
        }
        
        $fileName = 'Reporte__SFUM_Causas-Deptos-'.$fechaInicio.'-'.$fechaFin.'.csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Departamento', 'Causa', 'Total');

        
        $callback = function() use($departamentos, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($departamentos as $conteo) {
                foreach($conteo->Causas_arreglo as $causa){
                    $row['Departamento']  = $conteo->Departamento;
                    $row['Causa']  = $causa->Causa;
                    $row['Total']    = $causa->total;

                    fputcsv($file, array($row['Departamento'], $row['Causa'], $row['Total']));
                }
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function ExcelCausasDeptos($fechaInicio, $fechaFin, $aseguradora){

        if($aseguradora == 'Todas'){
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $departamentos = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->distinct('Departamento')->select('Departamento')->get();
                foreach($departamentos as $departamento){
                    $causas_deptos = Casos::where('Reportar', 'Si')->where('Departamento', $departamento->Departamento)->whereDate('Fecha', '=', $fechaInicio)->select('Causa', DB::raw('count(*) as total'))->groupBy('Causa')->get();
                    $departamento->Causas_arreglo = $causas_deptos;
                }
            }else{
                $departamentos = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->distinct('Departamento')->select('Departamento')->get();
                foreach($departamentos as $departamento){
                    $causas_deptos = Casos::where('Reportar', 'Si')->where('Departamento', $departamento->Departamento)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->select('Causa', DB::raw('count(*) as total'))->groupBy('Causa')->get();
                    $departamento->Causas_arreglo = $causas_deptos;
                }
            }
        }else{
            if($fechaInicio != '' && $fechaFin == '0'){
                //Seleccionar de un sólo día
                $departamentos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereDate('Fecha', '=', $fechaInicio)->distinct('Departamento')->select('Departamento')->get();
                foreach($departamentos as $departamento){
                    $causas_deptos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->where('Departamento', $departamento->Departamento)->whereDate('Fecha', '=', $fechaInicio)->select('Causa', DB::raw('count(*) as total'))->groupBy('Causa')->get();
                    $departamento->Causas_arreglo = $causas_deptos;
                }
            }else{
                $departamentos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->distinct('Departamento')->select('Departamento')->get();
                foreach($departamentos as $departamento){
                    $causas_deptos = Casos::where('Reportar', 'Si')->where('Aseguradora', $aseguradora)->where('Departamento', $departamento->Departamento)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->select('Causa', DB::raw('count(*) as total'))->groupBy('Causa')->get();
                    $departamento->Causas_arreglo = $causas_deptos;
                }
            }
        }

        $fileName = 'Reporte__SFUM_Causas-Deptos-'.$fechaInicio.'-'.$fechaFin.'.xls';

        $headers = array(
            "Content-type"        => "application/vnd.ms-excel",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $callback = function() use($departamentos) {

            $flag = false;

            foreach($departamentos as $conteo){
                foreach($conteo->Causas_arreglo as $causa){
                    $row['Departamento']  = $conteo->Departamento;
                    $row['Causa']  = $causa->Causa;
                    $row['Total']    = $causa->total;

                    if(!$flag){
                        echo implode("\t", array_keys($row)) . "\r\n";
                        $flag = true;
                    }
                    echo implode("\t", array_values($row)) . "\r\n";
                }
            }

        };

        return response()->stream($callback, 200, $headers);
    }

    public function reporteCaso($id, Request $request){
        $imagenes = $request->descargar;
        $caso = Casos::find($id);
        //$files = File::files(public_path('images'));
        //$allowed='png,jpg,jpeg,gif,tiff';  //which file types are allowed seperated by comma
        //$extension_allowed=  explode(',', $allowed);
        //$archivos = array();
        //$descargables = array();
        //foreach ($files as $file) {
        //    $nombre = basename($file);
        //    $posicion_indicador = strpos($nombre, '-');
        //    $nuevonombre = substr($nombre, $posicion_indicador+1);
        //    $nombrecaso = substr($nombre, 0, $posicion_indicador-1);
        //    $posicion_caso = strpos($nombrecaso, 'Caso');
        //    $no_caso = substr($nombre, $posicion_caso+4, $posicion_indicador-4);
        //    if($no_caso == $id && array_search(pathinfo($file, PATHINFO_EXTENSION), $extension_allowed)){
        //        array_push($archivos, $nombre);
        //    }elseif($no_caso == $id && !array_search(pathinfo($file, PATHINFO_EXTENSION), $extension_allowed)){
        //        array_push($descargables, $nombre);
        //    }
        //}
        $pagos = HistorialPagos::where('caso', $id)->get();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('Personal.Reportes.Plantillas.Caso', ['Caso' => $caso, 'Archivos' => $imagenes, 'Pagos' => $pagos])->setPaper('a4', 'portrait');
        $save_pdf = $pdf->download('Reporte__SFUM_Caso-'.$id.'.pdf');

        $pdf_name = 'Reporte__SFUM_Caso-'.$id.'.pdf';

        Storage::disk('public_uploads')->put('reportes/'.$pdf_name,$save_pdf);

        ReportesCHN::updateOrCreate([
            'caso' => $id,
            'ruta' => '/images/reportes/'.$pdf_name,
        ]);
        
        return $save_pdf;
        //return view('Personal.Reportes.Plantillas.Caso', ['Caso' => $caso, 'Archivos' => $archivos, 'Pagos' => $pagos]);
    }

    public function Graficas(){


        $keys_funerarias = Casos::groupBy('Funeraria_Nombre')->whereNotNull('Funeraria')->where('Estatus', 'Cerrado')->orderBy('Funeraria_Nombre', 'asc')->pluck('Funeraria_Nombre');

        $servicios_funerarias = Casos::groupBy('Funeraria_Nombre')->whereNotNull('Funeraria')->where('Estatus', 'Cerrado')->orderBy('Funeraria_Nombre', 'asc')->select('Funeraria_Nombre', DB::raw('count(*) as total'))->get();
        $array_servicios = array();
        foreach($servicios_funerarias as $servicios){
            array_push($array_servicios, $servicios->total);
        }

        $servicios_conteo = collect($array_servicios);

        $array_promedio = array();
        $promedio_funerarias = Casos::groupBy('Funeraria_Nombre')->whereNotNull('Funeraria')->where('Estatus', 'Cerrado')->orderBy('Funeraria_Nombre', 'asc')->select('Funeraria_Nombre', DB::raw('avg(Evaluacion) as total'))->get();
        foreach($promedio_funerarias as $promedio){
            array_push($array_promedio, $promedio->total);
        }

        $promedio_conteo = collect($array_promedio);

        //$promedio_funerarias = Casos::selectRaw('AVG(Eval)')

        $keys_tipos_muerte = Casos::groupBy('Causa')->whereNotNull('Funeraria')->where('Estatus', 'Cerrado')->orderBy('Causa', 'asc')->pluck('Causa');

        $conteo_tipos_muerte = Casos::groupBy('Causa')->whereNotNull('Funeraria')->where('Estatus', 'Cerrado')->orderBy('Causa', 'asc')->select('Causa', DB::raw('count(*) as total'))->get();
        $array_conteo_muerte = array();
        foreach($conteo_tipos_muerte as $conteo){
            array_push($array_conteo_muerte, $conteo->total);
        }

        $muertes_conteo = collect($array_conteo_muerte);

        $conteo_funerarias = User::with('roles')->get();

        $conteo_funerarias = $conteo_funerarias->reject(function ($user, $key) {
            return $user->hasRole(['Super Admin', 'Personal', 'Agente']);
        });

        $conteo_funerarias = $conteo_funerarias->count();

        $conteo_casos = Casos::count();

        $promedio_edades = Casos::avg('Edad');

        $costos = Casos::sum('Costo');

        $pendiente = Casos::sum('Pendiente');

        $pagado = Casos::sum('Pagado');

        $evaluacion = Casos::avg('Evaluacion');

        $departamentoObject = Casos::select('Departamento', DB::raw('count(id) as total'))
                 ->groupBy('Departamento')
                 ->get();

        $deptosJson = array();

        foreach($departamentoObject as $departamento){
            $indvDeptoJson = array('nombreDepto' => $departamento->Departamento, 'total' => $departamento->total);

            $deptosJson[strtolower($departamento->Departamento)] = [$indvDeptoJson];

            //array_push($deptosJson, array($departamento->Departamento => $indvDeptoJson ));
        }

        $funerariasCasos = Casos::whereNotNull('Funeraria')->select('Funeraria_Nombre')->groupBy('Funeraria_Nombre')->get();

        $deptosCasos = Casos::select('Departamento')->groupBy('Departamento')->get();

        $categoriasFunerariasKeys = InfoFunerariasRegistradas::whereNotNull('tipo')->groupBy('tipo')->pluck('tipo');

        $categoriasFunerarias = InfoFunerariasRegistradas::whereNotNull('tipo')->select(['tipo', DB::raw('count(*) as total')])->groupBy('tipo')->get();
        $array_Funerarias_Categoria = array();
        foreach($categoriasFunerarias as $funeraria){
            array_push($array_Funerarias_Categoria, $funeraria->total);
        }

        $categoriasFunerarias = collect($array_Funerarias_Categoria);


        $conteos = [
            'Conteo_Funerarias' => $conteo_funerarias,
            'Conteo_Casos' => $conteo_casos,
            'Promedio_Edad' => round($promedio_edades),
            'Costos' => $costos, 
            'Pendiente' => $pendiente,
            'Pagado' => $pagado,
            'Evaluacion' => round($evaluacion),
            'Satisfaccion' => isset($evaluacion) && isset($conteo_casos) ? round(round($evaluacion) * 100 / $conteo_casos) : 0,
            'Aseguradoras' => '2',
        ];

        //return $muertes_conteo;

        //return $deptosJson;

        return view('Personal.Reportes.Graficas', ['Funerarias' => $keys_funerarias, 'Conteo_Servicios' => $servicios_conteo, 'Funerarias_Categorias_Keys' => $categoriasFunerariasKeys, 'Funerarias_Categorias' => $categoriasFunerarias, 'Promedio_Funerarias' => $promedio_conteo, 'Muertes' => $keys_tipos_muerte, 'Conteo_Muertes' => $muertes_conteo, 'Conteos' => $conteos ,'departamento' =>$deptosJson, 'select_funerarias' => $funerariasCasos, 'select_deptos' => $deptosCasos]);
    }

    public function GraficasPorFecha($fechaInicio, $fechaFin, $funeraria, $departamento){

        $funerariasCasos = Casos::whereNotNull('Funeraria')->select('Funeraria_Nombre')->groupBy('Funeraria_Nombre')->get();

        $deptosCasos = Casos::select('Departamento')->groupBy('Departamento')->get();

        $todas = false;

        $deptoVal = $departamento;

        if($funeraria == 'Todas' && $departamento == 'Todos'){
            $todas = true;
        }else{
            $todas = false;
        }

        if($todas){
            $keys_funerarias = Casos::groupBy('Funeraria_Nombre')->whereNotNull('Funeraria')->where('Estatus', 'Cerrado')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Funeraria_Nombre', 'asc')->pluck('Funeraria_Nombre');

            $servicios_funerarias = Casos::groupBy('Funeraria_Nombre')->whereNotNull('Funeraria')->where('Estatus', 'Cerrado')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Funeraria_Nombre', 'asc')->select('Funeraria_Nombre', DB::raw('count(*) as total'))->get();
            $array_servicios = array();
            foreach($servicios_funerarias as $servicios){
                array_push($array_servicios, $servicios->total);
            }

            $servicios_conteo = collect($array_servicios);

            $array_promedio = array();
            $promedio_funerarias = Casos::groupBy('Funeraria_Nombre')->whereNotNull('Funeraria')->where('Estatus', 'Cerrado')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Funeraria_Nombre', 'asc')->select('Funeraria_Nombre', DB::raw('avg(Evaluacion) as total'))->get();
            foreach($promedio_funerarias as $promedio){
                array_push($array_promedio, $promedio->total);
            }

            $promedio_conteo = collect($array_promedio);

            //$promedio_funerarias = Casos::selectRaw('AVG(Eval)')

            $keys_tipos_muerte = Casos::groupBy('Causa')->whereNotNull('Funeraria')->where('Estatus', 'Cerrado')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Causa', 'asc')->pluck('Causa');

            $conteo_tipos_muerte = Casos::groupBy('Causa')->whereNotNull('Funeraria')->where('Estatus', 'Cerrado')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Causa', 'asc')->select('Causa', DB::raw('count(*) as total'))->get();
            $array_conteo_muerte = array();
            foreach($conteo_tipos_muerte as $conteo){
                array_push($array_conteo_muerte, $conteo->total);
            }

            $muertes_conteo = collect($array_conteo_muerte);

            $conteo_funerarias = User::with('roles')->get();

            $conteo_funerarias = $conteo_funerarias->reject(function ($user, $key) {
                return $user->hasRole(['Super Admin', 'Personal', 'Agente']);
            });

            $conteo_funerarias = $conteo_funerarias->count();

            $conteo_casos = Casos::whereBetween('Fecha', [$fechaInicio, $fechaFin])->count();

            $promedio_edades = Casos::whereBetween('Fecha', [$fechaInicio, $fechaFin])->avg('Edad');

            $costos = Casos::whereBetween('Fecha', [$fechaInicio, $fechaFin])->sum('Costo');

            $pendiente = Casos::whereBetween('Fecha', [$fechaInicio, $fechaFin])->sum('Pendiente');

            $pagado = Casos::whereBetween('Fecha', [$fechaInicio, $fechaFin])->sum('Pagado');

            $evaluacion = Casos::whereBetween('Fecha', [$fechaInicio, $fechaFin])->avg('Evaluacion');
            $departamentoObject = Casos::select('Departamento', DB::raw('count(id) as total'))->whereBetween('Fecha', [$fechaInicio, $fechaFin])->groupBy('Departamento')->get();

            $deptosJson = array();

            foreach($departamentoObject as $departamento){
                $indvDeptoJson = array('nombreDepto' => $departamento->Departamento, 'total' => $departamento->total);

                $deptosJson[strtolower($departamento->Departamento)] = [$indvDeptoJson];

                //array_push($deptosJson, array($departamento->Departamento => $indvDeptoJson ));
            }

        }else{
            $keys_funerarias = Casos::groupBy('Funeraria_Nombre')->whereNotNull('Funeraria')->where('Departamento', $departamento)->where('Funeraria_Nombre', $funeraria)->where('Estatus', 'Cerrado')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Funeraria_Nombre', 'asc')->pluck('Funeraria_Nombre');

            $servicios_funerarias = Casos::groupBy('Funeraria_Nombre')->whereNotNull('Funeraria')->where('Departamento', $departamento)->where('Funeraria_Nombre', $funeraria)->where('Estatus', 'Cerrado')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Funeraria_Nombre', 'asc')->select('Funeraria_Nombre', DB::raw('count(*) as total'))->get();
            $array_servicios = array();
            foreach($servicios_funerarias as $servicios){
                array_push($array_servicios, $servicios->total);
            }

            $servicios_conteo = collect($array_servicios);

            $array_promedio = array();
            $promedio_funerarias = Casos::groupBy('Funeraria_Nombre')->whereNotNull('Funeraria')->where('Departamento', $departamento)->where('Funeraria_Nombre', $funeraria)->where('Estatus', 'Cerrado')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Funeraria_Nombre', 'asc')->select('Funeraria_Nombre', DB::raw('avg(Evaluacion) as total'))->get();
            foreach($promedio_funerarias as $promedio){
                array_push($array_promedio, $promedio->total);
            }

            $promedio_conteo = collect($array_promedio);

            //$promedio_funerarias = Casos::selectRaw('AVG(Eval)')

            $keys_tipos_muerte = Casos::groupBy('Causa')->whereNotNull('Funeraria')->where('Departamento', $departamento)->where('Funeraria_Nombre', $funeraria)->where('Estatus', 'Cerrado')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Causa', 'asc')->pluck('Causa');

            $conteo_tipos_muerte = Casos::groupBy('Causa')->whereNotNull('Funeraria')->where('Departamento', $departamento)->where('Funeraria_Nombre', $funeraria)->where('Estatus', 'Cerrado')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Causa', 'asc')->select('Causa', DB::raw('count(*) as total'))->get();
            $array_conteo_muerte = array();
            foreach($conteo_tipos_muerte as $conteo){
                array_push($array_conteo_muerte, $conteo->total);
            }

            $muertes_conteo = collect($array_conteo_muerte);

            $conteo_funerarias = User::with('roles')->get();

            $conteo_funerarias = $conteo_funerarias->reject(function ($user, $key) {
                return $user->hasRole(['Super Admin', 'Personal', 'Agente']);
            });

            $conteo_funerarias = $conteo_funerarias->count();

            $conteo_casos = Casos::whereBetween('Fecha', [$fechaInicio, $fechaFin])->where('Departamento', $departamento)->where('Funeraria_Nombre', $funeraria)->count();

            $promedio_edades = Casos::whereBetween('Fecha', [$fechaInicio, $fechaFin])->where('Departamento', $departamento)->where('Funeraria_Nombre', $funeraria)->avg('Edad');

            $costos = Casos::whereBetween('Fecha', [$fechaInicio, $fechaFin])->where('Departamento', $departamento)->where('Funeraria_Nombre', $funeraria)->sum('Costo');

            $pendiente = Casos::whereBetween('Fecha', [$fechaInicio, $fechaFin])->where('Departamento', $departamento)->where('Funeraria_Nombre', $funeraria)->sum('Pendiente');

            $pagado = Casos::whereBetween('Fecha', [$fechaInicio, $fechaFin])->where('Departamento', $departamento)->where('Funeraria_Nombre', $funeraria)->sum('Pagado');

            $evaluacion = Casos::whereBetween('Fecha', [$fechaInicio, $fechaFin])->where('Departamento', $departamento)->where('Funeraria_Nombre', $funeraria)->avg('Evaluacion');

            if($funeraria == 'Todas'){
                $departamentoObject = Casos::select('Departamento', DB::raw('count(id) as total'))->where('Departamento', $departamento)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->groupBy('Departamento')->get();
            }else if($funeraria != 'Todas'){
                $departamentoObject = Casos::select('Departamento', DB::raw('count(id) as total'))->where('Departamento', $departamento)->where('Funeraria_Nombre', $funeraria)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->groupBy('Departamento')->get();
            }

            $deptosJson = array();

            foreach($departamentoObject as $departamento){
                $indvDeptoJson = array('nombreDepto' => $departamento->Departamento, 'total' => $departamento->total);

                $deptosJson[strtolower($departamento->Departamento)] = [$indvDeptoJson];

                //array_push($deptosJson, array($departamento->Departamento => $indvDeptoJson ));
            }
        }

        if($funeraria == 'Todas' && $deptoVal != 'Todos'){
            $keys_funerarias = Casos::groupBy('Funeraria_Nombre')->whereNotNull('Funeraria')->where('Departamento', $deptoVal)->where('Estatus', 'Cerrado')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Funeraria_Nombre', 'asc')->pluck('Funeraria_Nombre');

            $servicios_funerarias = Casos::groupBy('Funeraria_Nombre')->whereNotNull('Funeraria')->where('Departamento', $deptoVal)->where('Estatus', 'Cerrado')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Funeraria_Nombre', 'asc')->select('Funeraria_Nombre', DB::raw('count(*) as total'))->get();
            $array_servicios = array();
            foreach($servicios_funerarias as $servicios){
                array_push($array_servicios, $servicios->total);
            }

            $servicios_conteo = collect($array_servicios);

            $array_promedio = array();
            $promedio_funerarias = Casos::groupBy('Funeraria_Nombre')->whereNotNull('Funeraria')->where('Departamento', $deptoVal)->where('Estatus', 'Cerrado')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Funeraria_Nombre', 'asc')->select('Funeraria_Nombre', DB::raw('avg(Evaluacion) as total'))->get();
            foreach($promedio_funerarias as $promedio){
                array_push($array_promedio, $promedio->total);
            }

            $promedio_conteo = collect($array_promedio);

            //$promedio_funerarias = Casos::selectRaw('AVG(Eval)')

            $keys_tipos_muerte = Casos::groupBy('Causa')->whereNotNull('Funeraria')->where('Departamento', $deptoVal)->where('Estatus', 'Cerrado')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Causa', 'asc')->pluck('Causa');

            $conteo_tipos_muerte = Casos::groupBy('Causa')->whereNotNull('Funeraria')->where('Departamento', $deptoVal)->where('Estatus', 'Cerrado')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Causa', 'asc')->select('Causa', DB::raw('count(*) as total'))->get();
            $array_conteo_muerte = array();
            foreach($conteo_tipos_muerte as $conteo){
                array_push($array_conteo_muerte, $conteo->total);
            }

            $muertes_conteo = collect($array_conteo_muerte);

            $conteo_funerarias = User::with('roles')->get();

            $conteo_funerarias = $conteo_funerarias->reject(function ($user, $key) {
                return $user->hasRole(['Super Admin', 'Personal', 'Agente']);
            });

            $conteo_funerarias = $conteo_funerarias->count();

            $conteo_casos = Casos::whereBetween('Fecha', [$fechaInicio, $fechaFin])->where('Departamento', $deptoVal)->count();

            $promedio_edades = Casos::whereBetween('Fecha', [$fechaInicio, $fechaFin])->where('Departamento', $deptoVal)->avg('Edad');

            $costos = Casos::whereBetween('Fecha', [$fechaInicio, $fechaFin])->where('Departamento', $deptoVal)->sum('Costo');

            $pendiente = Casos::whereBetween('Fecha', [$fechaInicio, $fechaFin])->where('Departamento', $deptoVal)->sum('Pendiente');

            $pagado = Casos::whereBetween('Fecha', [$fechaInicio, $fechaFin])->where('Departamento', $deptoVal)->sum('Pagado');

            $evaluacion = Casos::whereBetween('Fecha', [$fechaInicio, $fechaFin])->where('Departamento', $deptoVal)->avg('Evaluacion');

            if($funeraria == 'Todas'){
                $departamentoObject = Casos::select('Departamento', DB::raw('count(id) as total'))->where('Departamento', $deptoVal)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->groupBy('Departamento')->get();
            }else if($funeraria != 'Todas'){
                $departamentoObject = Casos::select('Departamento', DB::raw('count(id) as total'))->where('Departamento', $deptoVal)->where('Funeraria_Nombre', $funeraria)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->groupBy('Departamento')->get();
            }

            $deptosJson = array();

            foreach($departamentoObject as $departamento){
                $departamento->Departamento = preg_replace("/\s+/", "", $departamento->Departamento);
                $indvDeptoJson = array('nombreDepto' => preg_replace("/\s+/", "", $departamento->Departamento), 'total' => $departamento->total);

                $deptosJson[strtolower($departamento->Departamento)] = [$indvDeptoJson];
                //array_push($deptosJson, array($departamento->Departamento => $indvDeptoJson ));
            }
        }elseif($funeraria != 'Todas' && $deptoVal == 'Todos'){
            $keys_funerarias = Casos::groupBy('Funeraria_Nombre')->whereNotNull('Funeraria')->where('Funeraria_Nombre', $funeraria)->where('Estatus', 'Cerrado')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Funeraria_Nombre', 'asc')->pluck('Funeraria_Nombre');

            $servicios_funerarias = Casos::groupBy('Funeraria_Nombre')->whereNotNull('Funeraria')->where('Funeraria_Nombre', $funeraria)->where('Estatus', 'Cerrado')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Funeraria_Nombre', 'asc')->select('Funeraria_Nombre', DB::raw('count(*) as total'))->get();
            $array_servicios = array();
            foreach($servicios_funerarias as $servicios){
                array_push($array_servicios, $servicios->total);
            }

            $servicios_conteo = collect($array_servicios);

            $array_promedio = array();
            $promedio_funerarias = Casos::groupBy('Funeraria_Nombre')->whereNotNull('Funeraria')->where('Funeraria_Nombre', $funeraria)->where('Estatus', 'Cerrado')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Funeraria_Nombre', 'asc')->select('Funeraria_Nombre', DB::raw('avg(Evaluacion) as total'))->get();
            foreach($promedio_funerarias as $promedio){
                array_push($array_promedio, $promedio->total);
            }

            $promedio_conteo = collect($array_promedio);

            //$promedio_funerarias = Casos::selectRaw('AVG(Eval)')

            $keys_tipos_muerte = Casos::groupBy('Causa')->whereNotNull('Funeraria')->where('Funeraria_Nombre', $funeraria)->where('Estatus', 'Cerrado')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Causa', 'asc')->pluck('Causa');

            $conteo_tipos_muerte = Casos::groupBy('Causa')->whereNotNull('Funeraria')->where('Funeraria_Nombre', $funeraria)->where('Estatus', 'Cerrado')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Causa', 'asc')->select('Causa', DB::raw('count(*) as total'))->get();
            $array_conteo_muerte = array();
            foreach($conteo_tipos_muerte as $conteo){
                array_push($array_conteo_muerte, $conteo->total);
            }

            $muertes_conteo = collect($array_conteo_muerte);

            $conteo_funerarias = User::with('roles')->get();

            $conteo_funerarias = $conteo_funerarias->reject(function ($user, $key) {
                return $user->hasRole(['Super Admin', 'Personal', 'Agente']);
            });

            $conteo_funerarias = $conteo_funerarias->count();

            $conteo_casos = Casos::whereBetween('Fecha', [$fechaInicio, $fechaFin])->where('Funeraria_Nombre', $funeraria)->count();

            $promedio_edades = Casos::whereBetween('Fecha', [$fechaInicio, $fechaFin])->where('Funeraria_Nombre', $funeraria)->avg('Edad');

            $costos = Casos::whereBetween('Fecha', [$fechaInicio, $fechaFin])->where('Funeraria_Nombre', $funeraria)->sum('Costo');

            $pendiente = Casos::whereBetween('Fecha', [$fechaInicio, $fechaFin])->where('Funeraria_Nombre', $funeraria)->sum('Pendiente');

            $pagado = Casos::whereBetween('Fecha', [$fechaInicio, $fechaFin])->where('Funeraria_Nombre', $funeraria)->sum('Pagado');

            $evaluacion = Casos::whereBetween('Fecha', [$fechaInicio, $fechaFin])->where('Funeraria_Nombre', $funeraria)->avg('Evaluacion');

            if($funeraria == 'Todas'){
                $departamentoObject = Casos::select('Departamento', DB::raw('count(id) as total'))->whereBetween('Fecha', [$fechaInicio, $fechaFin])->groupBy('Departamento')->get();
            }else if($funeraria != 'Todas'){
                $departamentoObject = Casos::select('Departamento', DB::raw('count(id) as total'))->where('Funeraria_Nombre', $funeraria)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->groupBy('Departamento')->get();
            }

            $deptosJson = array();

            foreach($departamentoObject as $departamento){
                $departamento->Departamento = preg_replace("/\s+/", "", $departamento->Departamento);
                $indvDeptoJson = array('nombreDepto' => preg_replace("/\s+/", "", $departamento->Departamento), 'total' => $departamento->total);

                $deptosJson[strtolower($departamento->Departamento)] = [$indvDeptoJson];
                //array_push($deptosJson, array($departamento->Departamento => $indvDeptoJson ));
            }
        }

        $categoriasFunerariasKeys = InfoFunerariasRegistradas::whereNotNull('tipo')->groupBy('tipo')->pluck('tipo');

        $categoriasFunerarias = InfoFunerariasRegistradas::whereNotNull('tipo')->select(['tipo', DB::raw('count(*) as total')])->groupBy('tipo')->get();
        $array_Funerarias_Categoria = array();
        foreach($categoriasFunerarias as $funeraria){
            array_push($array_Funerarias_Categoria, $funeraria->total);
        }

        $categoriasFunerarias = collect($array_Funerarias_Categoria);

        $conteos = [
            'Conteo_Funerarias' => $conteo_funerarias,
            'Conteo_Casos' => $conteo_casos,
            'Promedio_Edad' => round($promedio_edades),
            'Costos' => $costos, 
            'Pendiente' => $pendiente,
            'Pagado' => $pagado,
            'Evaluacion' => round($evaluacion),
            'Satisfaccion' => ($conteo_casos > 0)?round(round($evaluacion) * 100 / $conteo_casos):0,
            'Aseguradoras' => '2',
        ];

        //return $muertes_conteo;
        //return $deptosJson;

        return view('Personal.Reportes.Graficas', ['Funerarias' => $keys_funerarias, 'Funerarias_Categorias_Keys' => $categoriasFunerariasKeys, 'Funerarias_Categorias' => $categoriasFunerarias, 'Conteo_Servicios' => $servicios_conteo, 'Promedio_Funerarias' => $promedio_conteo, 'Muertes' => $keys_tipos_muerte, 'Conteo_Muertes' => $muertes_conteo, 'Fecha_Inicio' => $fechaInicio, 'Fecha_Fin' => $fechaFin, 'Conteos' => $conteos,
                'departamento' => $deptosJson, 'select_funerarias' => $funerariasCasos, 'select_deptos' => $deptosCasos
            ]);
    }

    public function configuraciones(){
        $tasa_cambio = Configuracion::where('opcion', 'Tasa_Cambio')->value('valor');
        $checks = Configuracion::where('opcion', 'Campos_Check')->value('valor');
        return view('Personal.Configuraciones', ['Tasa_Cambio' => $tasa_cambio, 'Checks' => $checks]);
    }
    public function configuracionesGuardar(Request $request){
        Configuracion::where('opcion', 'Tasa_Cambio')->update(['valor' => $request->tasa_cambio]);

        $cantidad_checks = $request->contadorCampos;

        $arrayChecks = array();

        for($i = 1; $i <= $cantidad_checks; $i++){
            $campo = (string)$i;
            $nombre = $request->input('campo_'.$i);
            array_push($arrayChecks, array("campo" => $campo, "nombre" => $nombre));
        }

        $jsonChecks = json_encode($arrayChecks);
        Configuracion::where('opcion', 'Campos_Check')->update(['valor' => $jsonChecks]);
        activity()->log('Las configuraciones del sitio fueron cambiadas');
        return back();
    }

    public function verlogs(){
        $log = Activity::all();
        foreach($log as $log_activitie){
            $user_name = User::where('id', $log_activitie->causer_id)->value('name');
            $log_activitie->user_name = $user_name;
        }
        return view('Personal.log', ['Logs' => $log]);
    }

    public function sendMail($mail, $caso){

        $seguro = Casos::where('id', $caso)->value('Aseguradora_Nombre');

        $update_mail_sent = Casos::where('id', $caso)->update(['Mail_Enviado' => 1]);

        $documento = '';

        if(strcasecmp($seguro, 'Seguro Escolar') == 0){
            $documento = 'SE.pdf';
        }elseif(strcasecmp($seguro, 'CHN') == 0){
            $documento = 'CHN.pdf';
        }elseif(strcasecmp($seguro, 'Segured') == 0){
            $documento = 'SEGURED.pdf';
        }

        $data = ['docto' => $documento];

        Mail::send('mailslayouts.pdfseguro', $data, function($message) use($mail)
        {
            $message->to($mail, 'Guía seguro')->subject('Guía seguro');
        });

        return 'done';
    }

    public function generarToken($id_caso){
        $token = substr(md5(mt_rand()), 0, 25);
        
        $caso = Casos::find($id_caso);
        $mes_actual = Carbon::now()->format('m');
        $anio_actual = Carbon::now()->format('Y');

        if(empty($caso->token)){
            $caso->Campania = 'Externa';
            $caso->token = $token;
            $caso->Estatus = 'Asignado';
            $caso->Funeraria_Nombre = 'Externa';
            $caso->Mes = $mes_actual;
            $caso->Anio = $anio_actual;
            $caso->save();
            activity()->log('El caso #'.$id_caso.' fue asignado a una funeraria externa.');
            Notificaciones::create(['funeraria' => NULL, 'contenido' => 'El caso #'.$id_caso.' fue asignado a una funeraria externa.', 'estatus' => 'Activa', 'caso' => $id_caso]);
        }else{
            $token = $caso->token;
        }
        
        return url('Casos/Externo/'.$token);
    }

    public function estadoCuentaFunerarias($fechaInicio = null, $fechaFin = null){
        //$funerarias = Funerarias::get();
        
        $data = InfoFunerariasRegistradas::get();

        /*$api_uri = url('/getFuneraria');
        $client = new \GuzzleHttp\Client([
            'headers' => [ 'Content-Type' => 'application/json' ]
        ]);
        $res = $client->request('GET', $api_uri, [
            
        ]);
        $data = json_decode($res->getBody());

        return $data;*/

        $tasa_cambio = Configuracion::where('opcion', 'Tasa_Cambio')->value('valor');

        if($fechaInicio != null && $fechaFin != null){

            $fechaInicio = date($fechaInicio);
            $fechaFin = date($fechaFin);

            foreach($data as $funeraria){
                $costo_gtq = Casos::where('Funeraria', $funeraria->id)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->where('Moneda', 'GTQ')->whereNotNull('Costo')->sum('Costo');
                $pagado_gtq = Casos::where('Funeraria', $funeraria->id)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->where('Moneda', 'GTQ')->whereNotNull('Pagado')->sum('Pagado');
                $pendiente_gtq = Casos::where('Funeraria', $funeraria->id)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->where('Moneda', 'GTQ')->whereNotNull('Pendiente')->sum('Pendiente');
    
                $costo_usd = Casos::where('Funeraria', $funeraria->id)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->where('Moneda', 'USD')->whereNotNull('Costo')->sum('Costo');
                $pagado_usd = Casos::where('Funeraria', $funeraria->id)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->where('Moneda', 'USD')->whereNotNull('Pagado')->sum('Pagado');
                $pendiente_usd = Casos::where('Funeraria', $funeraria->id)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->where('Moneda', 'USD')->whereNotNull('Pendiente')->sum('Pendiente');
    
                $costo_usd = $costo_usd * $tasa_cambio;
                $pagado_usd = $pagado_usd * $tasa_cambio;
                $pendiente_usd = $pendiente_usd * $tasa_cambio;
    
                $funeraria->costo = $costo_gtq + $costo_usd;
                $funeraria->pagado = $pagado_gtq + $pagado_usd;
                $funeraria->pendiente = $funeraria->costo - $funeraria->pagado;
            }
            
        }else{

            foreach($data as $funeraria){
                $costo_gtq = Casos::where('Funeraria', $funeraria->id)->where('Moneda', 'GTQ')->whereNotNull('Costo')->sum('Costo');
                $pagado_gtq = Casos::where('Funeraria', $funeraria->id)->where('Moneda', 'GTQ')->whereNotNull('Pagado')->sum('Pagado');
                $pendiente_gtq = Casos::where('Funeraria', $funeraria->id)->where('Moneda', 'GTQ')->whereNotNull('Pendiente')->sum('Pendiente');
    
                $costo_usd = Casos::where('Funeraria', $funeraria->id)->where('Moneda', 'USD')->whereNotNull('Costo')->sum('Costo');
                $pagado_usd = Casos::where('Funeraria', $funeraria->id)->where('Moneda', 'USD')->whereNotNull('Pagado')->sum('Pagado');
                $pendiente_usd = Casos::where('Funeraria', $funeraria->id)->where('Moneda', 'USD')->whereNotNull('Pendiente')->sum('Pendiente');
    
                $costo_usd = $costo_usd * $tasa_cambio;
                $pagado_usd = $pagado_usd * $tasa_cambio;
                $pendiente_usd = $pendiente_usd * $tasa_cambio;
    
                $funeraria->costo = $costo_gtq + $costo_usd;
                $funeraria->pagado = $pagado_gtq + $pagado_usd;
                $funeraria->pendiente = $funeraria->costo - $funeraria->pagado;
            }

        }
            
        return view('Personal.Funerarias.estadoCuenta', ['Funerarias' => $data, 'FechaInicio' => $fechaInicio, 'FechaFin' => $fechaFin]);
    }

    public function detalleCuentaFuneraria($id, $fechaInicio = null, $fechaFin = null){

        if($fechaInicio != null && $fechaFin != null){
            $casos = Casos::where('Funeraria', $id)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->whereNotNull('Costo')->select(['id', 'Costo', 'Pagado', 'Pendiente', 'Moneda'])->get();   
        }else{
            $casos = Casos::where('Funeraria', $id)->whereNotNull('Costo')->select(['id', 'Costo', 'Pagado', 'Pendiente', 'Moneda'])->get();
        }

        foreach($casos as $caso){
            empty($caso->Costo) ? $caso->Costo = 0 : $caso->Costo;
            empty($caso->Pagado) ? $caso->Pagado = 0 : $caso->Pagado;
            $caso->Pendiente = $caso->Costo - $caso->Pagado;
            //empty($caso->Pendiente) ? $caso->Pendiente = 0 : $caso->Pendiente;
        }

        return $casos;
    }
}
