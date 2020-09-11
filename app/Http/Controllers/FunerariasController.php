<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\File;
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
        $casos = Casos::where('Funeraria', $funeraria)->orderBy('id', 'DESC')->get();
        return view('Funerarias.Casos.ver', ['Casos' => $casos]);
    }
    public function detallesCaso($id){
        $caso = Casos::find($id);
        $files = File::files(public_path('images'));
        $archivos = array();
        foreach ($files as $file) {
            $nombre = basename($file);
            $posicion_indicador = strpos($nombre, '-');
            $nuevonombre = substr($nombre, $posicion_indicador+1);
            $nombrecaso = substr($nombre, 0, $posicion_indicador-1);
            $posicion_caso = strpos($nombrecaso, 'Caso');
            $no_caso = substr($nombre, $posicion_caso+4, $posicion_indicador-4);
            if($no_caso == $id){
                array_push($archivos, $nuevonombre);
            }
        }
        return view('Funerarias.Casos.detalle', ['Caso' => $caso, 'Archivos' => $archivos]);
    }
    public function guardarMedia($caso, Request $request){
        $image = $request->file('file');
        $imageName = 'Caso'.$caso.'-'.$image->getClientOriginalName();
        $upload_success = $image->move(public_path('images'),$imageName);
        
        if ($upload_success) {
            return response()->json($upload_success, 200);
        }
        // Else, return error 400
        else {
            return response()->json('error', 400);
        }
    }
}
