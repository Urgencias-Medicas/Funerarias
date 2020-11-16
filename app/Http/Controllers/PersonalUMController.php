<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\DetallesFuneraria;
use App\Casos;
use PDF;
use DB;

class PersonalUMController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Personal');
        $this->middleware('activo');
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
    public function reporteGeneral($fechaInicio, $fechaFin){

        if($fechaInicio != '' && $fechaFin == '0'){
            //Seleccionar de un sólo día
            $casos = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->orderBy('id', 'DESC')->get();

            $conteo = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->select('Causa', DB::raw('count(*) as total'))->groupBy('Causa')->get();

            $conteo_funerarias = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->select('Funeraria_Nombre', DB::raw('count(*) as total'))->groupBy('Funeraria_Nombre')->get();
        }else{
            //Seleccionar entre días, meses o años
            $casos = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('id', 'DESC')->get();

            $conteo = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->select('Causa', DB::raw('count(*) as total'))->groupBy('Causa')->get();

            $conteo_funerarias = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->select('Funeraria_Nombre', DB::raw('count(*) as total'))->groupBy('Funeraria_Nombre')->get();
        }

        $departamentos = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->distinct('Departamento')->select('Departamento')->get();

        foreach($departamentos as $departamento){
            $causas_deptos = Casos::where('Reportar', 'Si')->where('Departamento', $departamento->Departamento)->whereBetween('Fecha', [$fechaInicio, $fechaFin])->select('Causa', DB::raw('count(*) as total'))->groupBy('Causa')->get();
            $departamento->Causas_arreglo = $causas_deptos;
        }

        $pdf = PDF::loadView('Personal.Reportes.Plantillas.General', ['Casos' => $casos, 'Conteo' => $conteo, 'Conteo_funerarias' => $conteo_funerarias, 'Departamentos' => $departamentos, 'FechaInicio' => $fechaInicio, 'FechaFin' => $fechaFin])->setPaper('a2', 'landscape');
        return $pdf->download('Reporte-Lugares.pdf');
    }
}
