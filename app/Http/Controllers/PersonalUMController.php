<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\DetallesFuneraria;
use App\Casos;
use PDF;

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

        $pdf = PDF::loadView('Personal.Reportes.Plantillas.Edades', ['Casos' => $casos]);
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

        $pdf = PDF::loadView('Personal.Reportes.Plantillas.Causas', ['Casos' => $casos]);
        return $pdf->download('Reporte-Causas.pdf');
    }
    public function reporteLugares($fechaInicio, $fechaFin){

        if($fechaInicio != '' && $fechaFin == '0'){
            //Seleccionar de un sólo día
            $casos = Casos::where('Reportar', 'Si')->whereDate('Fecha', '=', $fechaInicio)->orderBy('Lugar', 'DESC')->select('Nombre', 'Lugar')->get();
        }else{
            //Seleccionar entre días, meses o años
            $casos = Casos::where('Reportar', 'Si')->whereBetween('Fecha', [$fechaInicio, $fechaFin])->orderBy('Lugar', 'DESC')->select('Nombre', 'Lugar')->get();
        }

        $pdf = PDF::loadView('Personal.Reportes.Plantillas.Lugares', ['Casos' => $casos]);
        return $pdf->download('Reporte-Lugares.pdf');
    }
}
