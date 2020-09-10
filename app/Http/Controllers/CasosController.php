<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use App\Casos;

class CasosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Agente||Personal');
    }
    public function viewCrear(){
        return view('Agentes.Casos.crear');
    }
    public function guardarNuevo(Request $request){
        $suceso = Carbon::parse($request->fecha);
        $fecha = $suceso->format('Y-m-d');
        $data = ['Codigo' => $request->codEstudiante, 'Nombre' => $request->nombre, 
        'Fecha' => $fecha, 'Hora' => $request->hora, 'Causa' => $request->causa, 
        'Direccion' => $request->direccion, 'Departamento' => $request->departamento, 
        'Municipio' => $request->municipio, 'Padre' => $request->padre, 
        'Madre' => $request->madre, 'Lugar' => $request->lugar];
        Casos::create($data);
        return redirect('/home');
    }
    public function verCasos(){
        $casos = Casos::orderBy('id', 'ASC')->get();
        return view('Personal.Casos.ver', ['Casos' => $casos]);
    }
    public function detallesCaso($id){
        $caso = Casos::find($id);
        return view('Personal.Casos.detalle', ['Caso' => $caso]);
    }
    public function asignarFuneraria($caso, $funeraria){
        $caso = Casos::find($caso);
        $caso->Funeraria = $funeraria;
        $caso->save();
        return 'Hecho';
    }
}
