<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\DetallesFuneraria;
use App\Casos;
use App\HistorialPagos;
use Illuminate\Support\Facades\File;
use PDF;
use DB;

class PersonalUMController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Personal');
    }
    public function verFunerarias(){
        $users = User::where('activo', '!=', null)->get();

        return view('Personal.Funerarias.ver', ['Funerarias' => $users]);
    }
    public function verFuneraria($id){
        $funeraria = User::find($id);
        $detalle = DetallesFuneraria::find($funeraria->detalle);
        
        return view('Personal.Funerarias.verFuneraria', ['Funeraria' => $funeraria, 'Detalle' => $detalle]);
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

        return redirect('/Personal/Funerarias/ver');
    }
    public function verReportes(){
        return view('Personal.Reportes.Principal');
    }
    public function reporteEdades($fechaInicio, $fechaFin){
        
        $fechaInicio = date($fechaInicio);
        $fechaFin = date($fechaFin);

        if($fechaInicio != '' && $fechaFin == '0'){
            //Seleccionar de un sólo día
            $casos = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->orderBy('Codigo', 'DESC')->select('Nombre', 'Codigo')->get();
        }else{
            //Seleccionar entre días, meses o años
            $casos = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Codigo', 'DESC')->select('Nombre', 'Codigo')->get();
        }

        $pdf = PDF::loadView('Personal.Reportes.Plantillas.Edades', ['Casos' => $casos, 'FechaInicio' => $fechaInicio, 'FechaFin' => $fechaFin]);
        return $pdf->download('Reporte-Edades.pdf');
        
    }
    public function reporteEdadesCSV($fechaInicio, $fechaFin){
        
        $fechaInicio = date($fechaInicio);
        $fechaFin = date($fechaFin);

        if($fechaInicio != '' && $fechaFin == '0'){
            //Seleccionar de un sólo día
            $casos = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->orderBy('Codigo', 'DESC')->select('Nombre', 'Codigo')->get();
        }else{
            //Seleccionar entre días, meses o años
            $casos = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Codigo', 'DESC')->select('Nombre', 'Codigo')->get();
        }

        $fileName = 'Edades-'.$fechaInicio.'-'.$fechaFin.'.csv';

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
    public function reporteCausas($fechaInicio, $fechaFin){

        if($fechaInicio != '' && $fechaFin == '0'){
            //Seleccionar de un sólo día
            $casos = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->orderBy('Causa', 'DESC')->select('Nombre', 'Causa')->get();
        }else{
            //Seleccionar entre días, meses o años
            $casos = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Causa', 'DESC')->select('Nombre', 'Causa')->get();
        }

        $pdf = PDF::loadView('Personal.Reportes.Plantillas.Causas', ['Casos' => $casos, 'FechaInicio' => $fechaInicio, 'FechaFin' => $fechaFin]);
        return $pdf->download('Reporte-Causas.pdf');
    }
    public function reporteCausasCSV($fechaInicio, $fechaFin){

        if($fechaInicio != '' && $fechaFin == '0'){
            //Seleccionar de un sólo día
            $casos = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->orderBy('Causa', 'DESC')->select('Nombre', 'Causa')->get();
        }else{
            //Seleccionar entre días, meses o años
            $casos = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Causa', 'DESC')->select('Nombre', 'Causa')->get();
        }

        //$pdf = PDF::loadView('Personal.Reportes.Plantillas.Causas', ['Casos' => $casos, 'FechaInicio' => $fechaInicio, 'FechaFin' => $fechaFin]);

        $fileName = 'Causas-'.$fechaInicio.'-'.$fechaFin.'.csv';

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
    public function reporteLugares($fechaInicio, $fechaFin){

        if($fechaInicio != '' && $fechaFin == '0'){
            //Seleccionar de un sólo día
            $casos = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->orderBy('Lugar', 'DESC')->select('Nombre', 'Lugar', 'Municipio', 'Departamento')->get();
        }else{
            //Seleccionar entre días, meses o años
            $casos = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Lugar', 'DESC')->select('Nombre', 'Lugar', 'Municipio', 'Departamento')->get();
        }

        $pdf = PDF::loadView('Personal.Reportes.Plantillas.Lugares', ['Casos' => $casos, 'FechaInicio' => $fechaInicio, 'FechaFin' => $fechaFin]);
        return $pdf->download('Reporte-Lugares.pdf');
    }
    public function reporteLugaresCSV($fechaInicio, $fechaFin){

        if($fechaInicio != '' && $fechaFin == '0'){
            //Seleccionar de un sólo día
            $casos = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->orderBy('Lugar', 'DESC')->select('Nombre', 'Lugar', 'Municipio', 'Departamento')->get();
        }else{
            //Seleccionar entre días, meses o años
            $casos = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Lugar', 'DESC')->select('Nombre', 'Lugar', 'Municipio', 'Departamento')->get();
        }

        $fileName = 'Lugares-'.$fechaInicio.'-'.$fechaFin.'.csv';

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
    public function reporteGeneral($fechaInicio, $fechaFin){

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

        $pdf = PDF::loadView('Personal.Reportes.Plantillas.General', ['Casos' => $casos, 'Conteo' => $conteo, 'Conteo_funerarias' => $conteo_funerarias, 'Departamentos' => $departamentos, 'FechaInicio' => $fechaInicio, 'FechaFin' => $fechaFin])->setPaper('a2', 'landscape');
        return $pdf->download('Reporte-General.pdf');
    }
    public function reporteGeneralCSV($fechaInicio, $fechaFin){
        setlocale(LC_TIME, "spanish");
        if($fechaInicio != '' && $fechaFin == '0'){
            //Seleccionar de un sólo día
            $casos = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->orderBy('id', 'DESC')->get();
        }else{
            //Seleccionar entre días, meses o años
            $casos = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('id', 'DESC')->get();
        }

        $fileName = 'General-'.$fechaInicio.'-'.$fechaFin.'.csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Caso', 'Mes', 'Estudiante', 'Nombre Estudiante', 'Tutor', 'Municipio', 'Departamento', 'Causa de muerte', 'Causa', 'Descripcion Causa', 'Funeraria', 'Fecha', 'Evaluacion', 'Precio');

        $callback = function() use($casos, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

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

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function CSVConteoCausas($fechaInicio, $fechaFin){
        if($fechaInicio != '' && $fechaFin == '0'){
            //Seleccionar de un sólo día
            $conteo = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->select('Causa', DB::raw('count(*) as total'))->groupBy('Causa')->get();

        }else{
            $conteo = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->select('Causa', DB::raw('count(*) as total'))->groupBy('Causa')->get();
        }

        $fileName = 'Conteo-Causas-'.$fechaInicio.'-'.$fechaFin.'.csv';

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

    public function CSVConteoFunerarias($fechaInicio, $fechaFin){
        if($fechaInicio != '' && $fechaFin == '0'){
            //Seleccionar de un sólo día
            $conteo = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->select('Funeraria_Nombre', DB::raw('count(*) as total'))->groupBy('Funeraria_Nombre')->get();

        }else{
            $conteo = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->select('Funeraria_Nombre', DB::raw('count(*) as total'))->groupBy('Funeraria_Nombre')->get();
        }

        $fileName = 'Conteo-Funerarias-'.$fechaInicio.'-'.$fechaFin.'.csv';

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

    public function CSVCausasDeptos($fechaInicio, $fechaFin){
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
        
        $fileName = 'Causas-Deptos-'.$fechaInicio.'-'.$fechaFin.'.csv';

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

    public function reporteCaso($id){
        $caso = Casos::find($id);
        $files = File::files(public_path('images'));
        $allowed='png,jpg,jpeg,gif,tiff';  //which file types are allowed seperated by comma
        $extension_allowed=  explode(',', $allowed);
        $archivos = array();
        $descargables = array();
        foreach ($files as $file) {
            $nombre = basename($file);
            $posicion_indicador = strpos($nombre, '-');
            $nuevonombre = substr($nombre, $posicion_indicador+1);
            $nombrecaso = substr($nombre, 0, $posicion_indicador-1);
            $posicion_caso = strpos($nombrecaso, 'Caso');
            $no_caso = substr($nombre, $posicion_caso+4, $posicion_indicador-4);
            if($no_caso == $id && array_search(pathinfo($file, PATHINFO_EXTENSION), $extension_allowed)){
                array_push($archivos, $nombre);
            }elseif($no_caso == $id && !array_search(pathinfo($file, PATHINFO_EXTENSION), $extension_allowed)){
                array_push($descargables, $nombre);
            }
        }
        $pagos = HistorialPagos::where('caso', $id)->get();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('Personal.Reportes.Plantillas.Caso', ['Caso' => $caso, 'Archivos' => $archivos, 'Pagos' => $pagos])->setPaper('a4', 'portrait');
        return $pdf->download('Caso-'.$id.'.pdf');
        //return view('Personal.Reportes.Plantillas.Caso', ['Caso' => $caso, 'Archivos' => $archivos, 'Pagos' => $pagos]);
    }
}
