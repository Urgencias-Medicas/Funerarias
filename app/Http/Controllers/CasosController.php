<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use GuzzleHttp\Exception\RequestException;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailable;
use Carbon\Carbon;
use App\Casos;
use App\HistorialPagos;
use App\SolicitudesCobro;
use App\Notificaciones;
use App\Helpers\Helper;
use App\Causas;
use App\Funerarias;

class CasosController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('role:Agente||Personal');
    // }
    public function viewCrear($msg = 0){

        $causas = Causas::get();

        if($msg == 1){
            return view('Agentes.Casos.crear', ['Causas' => $causas])->with('alerta', 'El caso ha sido creado exitosamente.');
        }elseif($msg == 2){
            return back()->with('alerta', 'El caso ha sido modificado exitosamente');
        }else{
            return view('Agentes.Casos.crear', ['Causas' => $causas]);
        }

    }
    public function guardarNuevo(Request $request){
        $user = auth()->user();
        $suceso = Carbon::parse($request->fecha);
        $fecha = $suceso->format('Y-m-d');
        $data = ['Agente' => $user->id, 'Codigo' => $request->codEstudiante, 'Edad' => $request->edad, 'Nombre' => $request->nombre, 'Aseguradora' => $user->aseguradora,
        'Fecha' => $fecha, 'Hora' => $request->hora, 'Causa' => $request->causa, 'Causa_Desc' => $request->descripcion_causa != '' ? $request->descripcion_causa : $request->descripcion_causa_select,  
        'Causa_Especifica' => $request->causa_especifica, 'Direccion' => $request->direccion, 'Departamento' => strtoupper($request->departamento), 
        'Municipio' => strtoupper($request->municipio), 'Padre' => $request->padre, 'TelPadre' => $request->TelPadre,
        'Madre' => $request->madre, 'TelMadre' => $request->TelMadre, 'NombreReporta' => $request->NombreReporta, 'RelacionReporta' => $request->RelacionReporta, 
        'TelReporta' => $request->TelReporta, 'Lugar' => $request->lugar, 'Estatus' => 'Abierto', 'Reportar' => 'No', 'Idioma' => $request->Idioma, 
        'Medico' => $request->Medico, 'Tutor' => $request->Tutor, 'TelTutor' => $request->TelTutor, 'DPITutor' => $request->DPITutor,
        'ParentescoTutor' => $request->ParentescoTutor, 'EmailTutor' => $request->EmailTutor, 'Comentario' => $request->ComentarioTutor];
        $caso = Casos::create($data);

        if($request->descripcion_causa != ''){
            $causa = Causas::find($request->causa_id);
            $causa->Causa = $request->descripcion_causa;
            $causa->save();
        }

        Notificaciones::create(['funeraria' => NULL, 'contenido' => 'Caso #'.$caso->id.' creado.', 'estatus' => 'Activa', 'caso' => $caso->id]);
        
        return $this->viewCrear(1);

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
    public function verCasos(){
        $casos = Casos::orderBy('id', 'asc')->get();
        foreach($casos as $caso){
            $api_uri = "https://umbd.excess.software/api/getFuneraria";
            $client = new \GuzzleHttp\Client([
                'headers' => [ 'Content-Type' => 'application/json' ]
            ]);
            $res = $client->request('GET', $api_uri, [
                'body' => json_encode(
                    [
                        'cols' => 'funeraria',
                        'conds' => array('id' => $caso->Funeraria)
                    ]
                ),
            ]);
            $data = json_decode($res->getBody());
            if($data){
                $caso->Funeraria = $data[0]->funeraria;
            }
        }
        return view('Personal.Casos.ver', ['Casos' => $casos]);
    }
    public function detallesCaso($id, $msg = 0){

        $caso = Casos::find($id);
        $files = File::files(public_path('images'));
        $allowed='png,jpg,jpeg,gif,tiff';  //which file types are allowed seperated by comma
        $extension_allowed=  explode(',', $allowed);
        $archivos = array();
        $descargables = array();
        $contador = 1;
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

            if($no_caso == $id && !array_search(pathinfo($file, PATHINFO_EXTENSION), $extension_allowed)){
                array_push($descargables, array('id' => $contador, 'archivo' => $nombre));
                $contador = $contador + 1;
            }
        }
        $pagos = HistorialPagos::where('caso', $id)->get();
        $solicitudes = SolicitudesCobro::where('caso', $id)->orderBy('id', 'desc')->get();
        $causas = Causas::get();
        if($msg == 0){
            return view('Personal.Casos.detalle', ['Caso' => $caso, 'Archivos' => $archivos, 'Descargables' => $descargables, 'Pagos' => $pagos, 'Solicitudes' => $solicitudes, 'Causas' => $causas]);
        }else if($msg == 2){
            return view('Personal.Casos.detalle', ['Caso' => $caso, 'Archivos' => $archivos, 'Descargables' => $descargables, 'Pagos' => $pagos, 'Solicitudes' => $solicitudes, 'Causas' => $causas])->with('alerta', 'El caso ha sido modificado exitosamente');
        }else{
            return view('Personal.Casos.detalle', ['Caso' => $caso, 'Archivos' => $archivos, 'Descargables' => $descargables, 'Pagos' => $pagos, 'Solicitudes' => $solicitudes, 'Causas' => $causas])->with('alerta', 'Pago ingresado exitosamente.');
        }
    }
    
    public function evaluarFuneraria($id, Request $request){
        $caso = Casos::find($id);
        $caso->Evaluacion = $request->evaluacion;
        $caso->save();

        return back();
    }

    public function actualizarSolicitud($caso, $solicitud, $opcion){
        $getSolicitud = SolicitudesCobro::find($solicitud);
        $getSolicitud->estatus = $opcion;
        $getSolicitud->save();

        $getCaso = Casos::find($caso);
        $getCaso->Solicitud = $opcion;
        if($opcion == 'Aprobar'){
            $getCaso->Costo = $getSolicitud->costo;
            $getCaso->Pendiente = $getCaso->Costo - $getCaso->Pagado;
        }
        $getCaso->save();
        $respuesta = '';
        if($opcion == 'Aprobar'){
            $respuesta = 'La solicitud del caso #'.$caso.' ha sido aprobada.';
        }else{
            $respuesta = 'La solicitud del caso #'.$caso.' ha sido rechazada.';
        }
        Notificaciones::create(['funeraria' => $getCaso->Funeraria, 'contenido' => $respuesta, 'estatus' => 'Activa', 'caso' => $caso]);
        echo 'Hecho';
    }

    public function asignarFuneraria($caso, $funeraria, $nombre_funeraria, $correo, $wp){
        $costo_servicio = 0;
        $casos = Casos::find($caso);
        $casos->Funeraria = $funeraria;
        $casos->Funeraria_Nombre = $nombre_funeraria;
        $casos->Estatus = 'Asignado';

        $costo_servicio = Funerarias::where('Id_Funeraria', $funeraria)->value('Monto_Base');

        $casos->Costo = $costo_servicio;
        $casos->save();

        $correo_funeraria = Funerarias::where('Id_Funeraria', $funeraria)->value('Email');
        $mensaje = 'Caso #'.$caso.' asignado. ';
        $mensaje .= 'Más información en '.url('/Funerarias/Casos/'.$caso.'/ver');
        $casos_array = ['id' => $caso];  
        if($correo == 'Si'){
            Mail::send('mailslayouts.asignado', $casos_array, function($message) use($caso, $correo_funeraria, $nombre_funeraria, $mensaje)
            {
                $message->to($correo_funeraria, $nombre_funeraria)->subject($mensaje)->from('no-reply@excess.software', 'Urgencias Médicas');
            });
        }
        /*if($wp == 'Si'){
            $this->mensajeWhatsApp($mensaje, 'whatsapp:+50249750995');
        }*/
        Notificaciones::create(['funeraria' => $funeraria, 'contenido' => 'Caso #'.$caso.' asignado.', 'estatus' => 'Activa', 'caso' => $caso]);
        return 'Hecho';
    }

    public function actualizarPago($caso, Request $request){
        $total = 0;
        for ($i=1; $i <= $request->filas ; $i++) { 
            $monto = $request->input("monto".$i);
            $total = $total + $monto;
            $date = Carbon::parse($request->input("fecha".$i));
            $fecha = $date->format('Y-m-d');
            HistorialPagos::create(['caso' => $caso, 'monto' => $monto, 'fecha' => $fecha, 'factura' => $request->input("factura".$i), 'serie' => $request->input("serie".$i)]);
        }
        $caso = Casos::find($caso);
        $caso->Pagado = $caso->Pagado + $total;
        $caso->Pendiente = $caso->Costo - $caso->Pagado;
        $caso->save();
        //return back()->with('msg', 'Pagos añadidos exitosamente.');
        return $this->detallesCaso($caso->id, 1);
        //return redirect('/Casos/'.$caso->id.'/ver')->with('alerta', 'Pago ingresado exitosamente.');
    }

    public function cerrarCaso($caso){
        $caso = Casos::find($caso);
        $caso->Estatus = 'Cerrado';
        $caso->save();

        $data = array();

        Mail::send('mailslayouts.encuesta', $data, function($message)
            {
                $message->to('samuelambrosio99@gmail.com', 'test')->subject('Encuesta UMFunerarias')->from('no-reply@excess.software', 'Urgencias Médicas');
            });
        Notificaciones::create(['funeraria' => $caso->Funeraria, 'contenido' => 'El caso #'.$caso->id.' se ha cerrado.', 'estatus' => 'Activa', 'caso' => $caso->id]);

        //POST API Smart
        $arrayCaso = array(array(
            "method" => "603",
            "IdAseg" => $caso->Aseguradora,
            "IdAfiliado" => $caso->Codigo,
            "Fecha" => $caso->Fecha,
            "Hora" => $caso->Hora,
            "Motivo" => $caso->Causa,
            "LugarCuerpo" => $caso->Lugar,
            "Funeraria" => $caso->Funeraria_Nombre,
            "ServicioFunerarioContratado" => $caso->Funeraria_Nombre,
            "Direccion" => $caso->Direccion
        ));

        $data = Helper::cryptR($arrayCaso, 1, 1);

        $client = new \GuzzleHttp\Client();
        $api_uri = "http://umwsdl.smartla.net/wsdl_um.php";
        $res = $client->request('POST', $api_uri, ['form_params' => [
            'data' => $data,
            ],
        ]);
        
        $data = json_decode($res->getBody());

        var_dump($data);
    }
    public function mensajeWhatsApp($message, $recipient){
        $twilio_whatsapp_number = getenv('TWILIO_WHATSAPP_NUMBER');
        $account_sid = "AC3246e625e6c614b611d3cda61f4122bd";
        $auth_token = "0b71671d573c4a5ad9ad1db37b09791c";

        $client = new Client($account_sid, $auth_token);
        return $client->messages->create($recipient, array('from' => "whatsapp:+14155238886", 'body' => $message));
    }
    public function reportarCaso($caso, $instruccion){
        $casos = Casos::find($caso);
        $casos->Reportar = $instruccion;
        $casos->save();
        echo 'Hecho';
    }

    public function insertData(Request $request) {

        $data = Helper::cryptR($request->input('data'), 0);

        $data->Estatus = 'Abierto';

        $res = Casos::create( (array) $data);

        $content = array(
            'respuesta' => $res
        );

        $data = array('data' => Helper::cryptR($content, 1));
        return response()->json($data, 200);
    }

    public function nuevaCausa($causa){
        $causa_consulta = Causas::where('Causa', $causa)->get();
        if($causa_consulta->isEmpty()){
            $causa_insert = Causas::create(['Causa' => $causa]);
            $respuesta = array('estatus' => 'guardado', 'id' => $causa_insert->id);
        }else{
            $respuesta = 'existente';
        }
        return $respuesta;
    }

    public function actualizarCausa($caso, Request $request){
        $actualizar_caso = Casos::find($caso);
        $actualizar_caso->causa_Desc = $request->descripcion_causa != '' ? $request->descripcion_causa : $request->descripcion_causa_select;
        $actualizar_caso->save();

        if($request->descripcion_causa != ''){
            $causa = Causas::find($request->causa_id);
            $causa->Causa = $request->descripcion_causa;
            $causa->save();
        }

        return back();
    }

    public function modificarCaso($caso, Request $request){
        $user = auth()->user();
        $suceso = Carbon::parse($request->fecha);
        $fecha = $suceso->format('Y-m-d');
        $data = ['Aseguradora' => $user->aseguradora, 'Edad' => $request->edad, 'Fecha' => $fecha, 'Hora' => $request->hora, 'Causa' => $request->causa, 'Causa_Desc' => $request->descripcion_causa_input != '' ? $request->descripcion_causa_input : $request->descripcion_causa_select,  
        'Causa_Especifica' => $request->causa_especifica, 'Direccion' => $request->direccion, 'Departamento' => strtoupper($request->departamento), 
        'Municipio' => strtoupper($request->municipio), 'Padre' => $request->padre, 'TelPadre' => $request->TelPadre,
        'Madre' => $request->madre, 'TelMadre' => $request->TelMadre, 'NombreReporta' => $request->NombreReporta, 
        'Lugar' => $request->lugar, 'Tutor' => $request->Tutor, 'TelTutor' => $request->TelTutor, 'DPITutor' => $request->DPITutor,
        'ParentescoTutor' => $request->ParentescoTutor, 'EmailTutor' => $request->EmailTutor, 'Comentario' => $request->ComentarioTutor];
        $caso_update = Casos::find($caso)->update($data);

        if($request->descripcion_causa != ''){
            $causa = Causas::find($request->causa_id);
            $causa->Causa = $request->descripcion_causa_input;
            $causa->save();
        }

        Notificaciones::create(['funeraria' => NULL, 'contenido' => 'Caso #'.$caso.' actualizado.', 'estatus' => 'Activa', 'caso' => $caso]);
        
        return $this->detallesCaso($caso, 2);
    }

    public function getCostoFuneraria($id){
        $costo = Funerarias::where('Id_Funeraria', $id)->value('Monto_Base');

        return $costo;
    }
}

