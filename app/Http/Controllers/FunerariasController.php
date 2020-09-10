<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Casos;

class FunerariasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Funeraria');
    }
    public function verCasos(){
        $user = auth()->user();
        $funeraria = $user['funeraria'];
        $casos = Casos::where('Funeraria', $funeraria)->orderBy('id', 'ASC')->get();
        return view('Funerarias.Casos.ver', ['Casos' => $casos]);
    }
    public function detallesCaso($id){
        $caso = Casos::find($id)->get();
        return view('Funerarias.Casos.detalle', ['Caso' => $caso[0]]);
    }
}
