<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\File;
use Illuminate\Routing\Redirector;
use App\Casos;
use App\SolicitudesCobro;
use App\Notificaciones;
use App\Causas;
use Carbon\Carbon;
use App\Helpers\Helper;

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
    public function detallesCaso($id, $msg = 0){
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
        $url = "https://gist.githubusercontent.com/tian2992/7439705/raw/1e5d0a766775a662039f3a838f422a1fc1600f74/guatemala.json";

        $json = file_get_contents($url);
        $solicitudes = SolicitudesCobro::where('caso', $id)->orderBy('id', 'desc')->get();
        $causas = Causas::get();
        if($msg == 1){
            return view('Funerarias.Casos.detalle', ['Caso' => $caso, 'Json' => $json, 'Archivos' => $archivos, 'Solicitudes' => $solicitudes, 'Causas' => $causas])->with('alerta', 'Su solicitud ha sido ingresada');
        }else if($msg == 2){
            return view('Funerarias.Casos.detalle', ['Caso' => $caso, 'Json' => $json, 'Archivos' => $archivos, 'Solicitudes' => $solicitudes, 'Causas' => $causas])->with('alerta', 'El caso fue actualizado exitosamente.');
        }else{
            return view('Funerarias.Casos.detalle', ['Caso' => $caso, 'Json' => $json, 'Archivos' => $archivos, 'Solicitudes' => $solicitudes, 'Causas' => $causas]);
        }
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
        
        //return $this->detallesCaso($caso, 1);
        return redirect('/Funerarias/Casos/'.$caso.'/ver')->with('alerta', 'Su solicitud ha sido ingresada.');
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
    public function modificarCaso($caso, Request $request){
        $user = auth()->user();
        $suceso = Carbon::parse($request->fecha);
        $fecha = $suceso->format('Y-m-d');
        $data = ['Edad' => $request->edad, 'Fecha' => $fecha, 'Hora' => $request->hora, 'Causa' => $request->causa, 'Causa_Desc' => $request->descripcion_causa_input != '' ? $request->descripcion_causa_input : $request->descripcion_causa_select,  
        'Causa_Especifica' => $request->causa_especifica, 'Direccion' => $request->direccion, 'Departamento' => strtoupper(Helper::eliminar_acentos($request->departamento)), 
        'Municipio' => strtoupper(Helper::eliminar_acentos($request->municipio)), 'Padre' => $request->padre, 'TelPadre' => $request->TelPadre,
        'Madre' => $request->madre, 'TelMadre' => $request->TelMadre, 'NombreReporta' => $request->NombreReporta, 'RelacionReporta' => $request->RelacionReporta, 
        'TelReporta' => $request->TelReporta, 'Lugar' => $request->lugar, 'Tutor' => $request->Tutor, 'TelTutor' => $request->TelTutor, 'DPITutor' => $request->DPITutor,
        'ParentescoTutor' => $request->ParentescoTutor, 'EmailTutor' => $request->EmailTutor, 'Comentario' => $request->ComentarioTutor, 'Medico' => $request->Medico, 'Idioma' => $request->Idioma];
        $caso_update = Casos::find($caso)->update($data);

        if($request->descripcion_causa != ''){
            $causa = Causas::find($request->causa_id);
            $causa->Causa = $request->descripcion_causa_input;
            $causa->save();
        }

        Notificaciones::create(['funeraria' => NULL, 'contenido' => 'Caso #'.$caso.' actualizado.', 'estatus' => 'Activa', 'caso' => $caso]);
        
        //return $this->detallesCaso($caso, 2);
        return redirect('/Funerarias/Casos/'.$caso.'/ver')->with('alerta', 'El caso fue actualizado exitosamente.');
    }
}
