<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\File;
use Illuminate\Routing\Redirector;
use App\Casos;
use App\SolicitudesCobro;
use App\Notificaciones;

class FunerariasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Funeraria');
        $this->middleware('activo');
        //$user = auth()->user();
        //$activo = $user['activo'];
        //if($activo == 'No'){
        //$this->activo = auth()->user();
        //if($this->activo){
        //    $redirect->to('test')->send();
        //}
    }
    public function verCasos(){
        $user = auth()->user();
        $funeraria = $user['funeraria'];
        $casos = Casos::where('funeraria', $funeraria)->orderBy('id', 'DESC')->get();
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
        $solicitudes = SolicitudesCobro::where('caso', $id)->get();
        return view('Funerarias.Casos.detalle', ['Caso' => $caso, 'Archivos' => $archivos, 'Solicitudes' => $solicitudes]);
    }
    public function actualizarCosto($caso, Request $request){
        //$caso = Casos::find($caso);
        //$caso->Costo = $request->Costo;
        //$caso->save();
        //return back();
        $getCaso = Casos::find($caso);
        $getCaso->Solicitud = 'Pendiente';
        $getCaso->save();

        SolicitudesCobro::create(['caso' => $caso, 'estatus' => 'Pendiente', 'costo' => $request->Costo, 'descripcion' => $request->Descripcion]);
        Notificaciones::create(['funeraria' => NULL, 'contenido' => 'El caso #'.$caso.' tiene una nueva solicitud.', 'estatus' => 'Activa', 'caso' => $caso]);
        return back();
    }
    public function guardarMedia($caso, Request $request){
        $image = $request->file('file');
        $imageName = 'Caso'.$caso.'-'.$image->getClientOriginalName();
        $upload_success = $image->move(public_path('images'),$imageName);
        $getCaso = Caso::find($caso);
        if ($upload_success) {
            Notificaciones::create(['funeraria' => $getCaso->Funeraria, 'contenido' => 'El caso #'.$caso.' tiene un nuevo archivo.', 'estatus' => 'Activa', 'caso' => $caso]);
            Notificaciones::create(['funeraria' => NULL, 'contenido' => 'El caso #'.$caso.' tiene un nuevo archivo.', 'estatus' => 'Activa', 'caso' => $caso]);
            return response()->json($upload_success, 200);
        }
        // Else, return error 400
        else {
            return response()->json('error', 400);
        }
    }
    public function noActivo(){
        return 'test';
    }
    public function descargas(){
        $files = File::files(public_path('images/requeridos'));
        return view('Funerarias.descargas', ['Archivos' => $files]);
    }
}
