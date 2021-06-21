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
use App\Configuracion;
use App\Campanias;
use App\InfoFunerariasRegistradas;

class CasosController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('role:Agente||Personal');
    // }

    public function viewCrear($msg = 0){

        $causas = Causas::get();

        $url = "https://gist.githubusercontent.com/tian2992/7439705/raw/1e5d0a766775a662039f3a838f422a1fc1600f74/guatemala.json";

        $json = file_get_contents($url);

        if($msg == 1){
            return view('Agentes.Casos.crear', ['Causas' => $causas, 'Json' => $json])->with('alerta', 'El caso ha sido creado exitosamente.');
        }elseif($msg == 2){
            return back()->with('alerta', 'El caso ha sido modificado exitosamente');
        }else{
            return view('Agentes.Casos.crear', ['Causas' => $causas, 'Json' => $json]);
        }

        return view('Agentes.Casos.crear', ['Causas' => $causas, 'Json' => $json]);

    }
    public function guardarNuevo(Request $request){
        $user = auth()->user();
        $suceso = Carbon::parse($request->fecha);
        $fecha = $suceso->format('Y-m-d');
        $data = ['Agente' => $user->id, 'Codigo' => $request->codEstudiante, 'Edad' => $request->edad, 'Nombre' => $request->nombre, 'Aseguradora' => $request->aseguradora, 'Nombre_Aseguradora' => $request->Nombre_Aseguradora,
        'Fecha' => $fecha, 'Hora' => $request->hora, 'Causa' => $request->causa, 'Causa_Desc' => $request->descripcion_causa != '' ? $request->descripcion_causa : $request->descripcion_causa_select,  
        'Causa_Especifica' => $request->causa_especifica, 'Direccion' => $request->direccion, 'Departamento' => strtoupper(Helper::eliminar_acentos($request->departamento)), 
        'Municipio' => strtoupper(Helper::eliminar_acentos($request->municipio)), 'Padre' => $request->padre, 'TelPadre' => $request->TelPadre,
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
        
        //return $this->viewCrear(1);
        activity()->log('Se creo el nuevo caso No. '.$caso->id);
        return redirect('/Casos/vistaCrear')->with('alerta', 'El caso ha sido modificado exitosamente');

    }
    public function guardarMedia($caso, Request $request){
        $date = Carbon::now()->format('Ymd');
        $user = auth()->user();
        $image = $request->file('file');
        $originalName = $image->getClientOriginalName();
        $fileName = pathinfo($originalName,PATHINFO_FILENAME);
        $imageName = 'Caso'.$caso.'-'.$fileName.'-'.$user->name.'-'.$date.'.'.$image->getClientOriginalExtension();
        $upload_success = $image->move(public_path('images'),$imageName);
        
        if ($upload_success) {
            activity()->log('Se subió el archivo '.$imageName.' al caso #'.$caso);
            return response()->json($upload_success, 200);
        }
        // Else, return error 400
        else {
            return response()->json('error', 400);
        }
    }
    public function verCasos(){
        $casos = Casos::orderBy('id', 'asc')->get();

        return view('Personal.Casos.ver', ['Casos' => $casos]);
    }

    public function verCasosCHN(){
        //$casos = Casos::where('Aseguradora_Nombre', 'CHN')->where('Causa', 'Accidente')->orderBy('id', 'asc')->get();
        $casos = Casos::where('Aseguradora_Nombre', 'CHN')->orderBy('id', 'asc')->get();

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
        $url = "https://gist.githubusercontent.com/tian2992/7439705/raw/1e5d0a766775a662039f3a838f422a1fc1600f74/guatemala.json";

        $json = file_get_contents($url);
        $pagos = HistorialPagos::where('caso', $id)->get();
        $solicitudes = SolicitudesCobro::where('caso', $id)->orderBy('id', 'desc')->get();
        $causas = Causas::get();
        $tasa_cambio = Configuracion::where('opcion', 'Tasa_Cambio')->value('valor');

        //Aseguradoras
        if($caso->Aseguradora == '1'){
            $caso->Aseguradora = 'Seguro Escolar';
        }elseif($caso->Aseguradora == '2'){
            $caso->Aseguradora = 'CHN';
        }elseif($caso->Aseguradora == '7'){
            $caso->Aseguradora = 'SeguRed';
        }

        if($msg == 0){
            return view('Personal.Casos.detalle', ['Caso' => $caso, 'Json' => $json, 'Archivos' => $archivos, 'Descargables' => $descargables, 'Pagos' => $pagos, 'Solicitudes' => $solicitudes, 'Causas' => $causas, 'Tasa_Cambio' => $tasa_cambio]);
        }else if($msg == 2){
            return view('Personal.Casos.detalle', ['Caso' => $caso, 'Json' => $json, 'Archivos' => $archivos, 'Descargables' => $descargables, 'Pagos' => $pagos, 'Solicitudes' => $solicitudes, 'Causas' => $causas, 'Tasa_Cambio' => $tasa_cambio])->with('alerta', 'El caso ha sido modificado exitosamente');
        }else{
            return view('Personal.Casos.detalle', ['Caso' => $caso, 'Json' => $json, 'Archivos' => $archivos, 'Descargables' => $descargables, 'Pagos' => $pagos, 'Solicitudes' => $solicitudes, 'Causas' => $causas, 'Tasa_Cambio' => $tasa_cambio])->with('alerta', 'Pago ingresado exitosamente.');
        }
        return view('Personal.Casos.detalle', ['Caso' => $caso, 'Json' => $json, 'Archivos' => $archivos, 'Descargables' => $descargables, 'Pagos' => $pagos, 'Solicitudes' => $solicitudes, 'Causas' => $causas]);
    }
    
    public function evaluarFuneraria($id, Request $request){
        $caso = Casos::find($id);
        $caso->Evaluacion = $request->evaluacion;
        $caso->save();

        activity()->log('Se evaluó la funeraria en el caso No. '.$id);
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
        }else if($opcion == 'Preaprobar'){
            $respuesta = 'La solicitud del caso #'.$caso.' ha sido pre-aprobada.';
        }else{
            $respuesta = 'La solicitud del caso #'.$caso.' ha sido rechazada.';
        }
        Notificaciones::create(['funeraria' => $getCaso->Funeraria, 'contenido' => $respuesta, 'estatus' => 'Activa', 'caso' => $caso]);
        activity()->log($respuesta);
        echo 'Hecho';
    }

    public function asignarFuneraria($caso, $funeraria, $campania, $moneda, $correo, $wp){
        $costo_servicio = 0;

        $campania_seleccionada = Campanias::find($campania);

        /*$api_uri = "https://umbd.excess.software/api/getFuneraria";
        $client = new \GuzzleHttp\Client([
            'headers' => [ 'Content-Type' => 'application/json' ]
        ]);
        $res = $client->request('GET', $api_uri, [
            'body' => json_encode(
                [
                    'cols' => 'funeraria',
                    'conds' => array('id' => $funeraria)
                ]
            ),
        ]);
        $data = json_decode($res->getBody());*/

        $data = InfoFunerariasRegistradas::find($funeraria);

        $nombre_funeraria = $data->funeraria;

        $diminutivo_funeraria = Funerarias::where('Funeraria_Registrada', $funeraria)->value('Diminutivo');

        $monto_campania = Funerarias::where('Funeraria_Registrada', $funeraria)->value('Campanias');
        
        $monto_campania = json_decode($monto_campania);

        $monto = 0;
        $aseguradora = $campania_seleccionada->Nombre_Aseguradora;

        foreach($monto_campania as $montos){
            if($campania == $montos->id){
                $monto = $montos->monto;
            }
        }

        //$correlativo = Casos::max('Correlativo');

        //Asignación de correlativo

        $correlativo = 0;
        $correlativo_completo = '';

        $mes_actual = Carbon::now()->format('m');
        $anio_actual = Carbon::now()->format('Y');

        if(strcasecmp($aseguradora, 'Seguro Escolar') == 0){
            $correlativo = Casos::where('Campania', $campania_seleccionada->Diminutivo)->where('Mes', $mes_actual)->where('Anio', $anio_actual)->max('Correlativo');
            $correlativo = $correlativo+1;
            $correlativo = sprintf("%03d", $correlativo);
            $correlativo_completo = $campania_seleccionada->Diminutivo.'-'.$diminutivo_funeraria.'-'.$correlativo.$mes_actual.$anio_actual;
        }elseif(strcasecmp($aseguradora, 'CHN') == 0){
            $correlativo = Casos::where('Campania', $campania_seleccionada->Diminutivo)->where('Mes', $mes_actual)->where('Anio', $anio_actual)->max('Correlativo');
            $correlativo = $correlativo+1;
            $correlativo = sprintf("%03d", $correlativo);
            $correlativo_completo = $aseguradora.'-'.$campania_seleccionada->Diminutivo.'-'.$correlativo.$mes_actual.$anio_actual;
        }elseif(strcasecmp($aseguradora, 'SeguRed') == 0){
            $correlativo = Casos::where('Campania', $campania_seleccionada->Diminutivo)->where('Mes', $mes_actual)->where('Anio', $anio_actual)->max('Correlativo');
            $correlativo = $correlativo+1;
            $correlativo = sprintf("%03d", $correlativo);
            $correlativo_completo = $campania_seleccionada->Diminutivo.'-'.$correlativo.$mes_actual.$anio_actual;
        }

        $casos = Casos::find($caso);
        $casos->Funeraria = $funeraria;
        $casos->Funeraria_Nombre = $nombre_funeraria;
        $casos->Estatus = 'Asignado';
        $casos->Costo = $monto;
        $casos->Moneda = $moneda;
        $casos->Correlativo = $correlativo;
        $casos->Correlativo_Completo = $correlativo_completo;
        $casos->Mes = $mes_actual;
        $casos->Anio = $anio_actual;
        $casos->Aseguradora_Nombre = $aseguradora;
        $casos->Campania = $campania_seleccionada->Diminutivo;
        $casos->save();

        $correo_funeraria = Funerarias::where('Id_Funeraria', $funeraria)->value('Email');
        $mensaje = 'Caso #'.$caso.' asignado. ';
        $mensaje .= 'Más información en '.url('/Funerarias/Casos/'.$caso.'/ver');
        $casos_array = ['id' => $caso];  
        //if($correo == 'Si'){
            Mail::send('mailslayouts.asignado', $casos_array, function($message) use($caso, $correo_funeraria, $nombre_funeraria, $mensaje)
            {
                $message->to($correo_funeraria, $nombre_funeraria)->subject($mensaje)->from('no-reply@excess.software', 'Urgencias Médicas');
            });
        //}
        /*if($wp == 'Si'){
            $this->mensajeWhatsApp($mensaje, 'whatsapp:+50249750995');
        }*/
        Notificaciones::create(['funeraria' => $funeraria, 'contenido' => 'Caso #'.$caso.' asignado.', 'estatus' => 'Activa', 'caso' => $caso]);
        activity()->log('Caso #'.$caso.' asignado a la funeraria No. '.$funeraria);
        return 'Hecho';
    }

    public function actualizarPago($caso, Request $request){
        $total = 0;

        $caso = Casos::find($caso);

        $funeraria = Funerarias::where('Id_Funeraria', $caso->Funeraria)->get()->first();

        if(empty($caso->token)){
            $correo_funeraria = $funeraria->Email;
            $nombre_funeraria = $funeraria->Nombre;
        }   
        $caso = $caso->id;
        $mensaje = 'Se ha registrado un nuevo pago en el caso #'.$caso;

        $correo_admin = 'samedgar15@gmail.com'; 


        for ($i=1; $i <= $request->filas ; $i++) { 
            $monto = $request->input("monto".$i);
            $total = $total + $monto;
            $date = Carbon::parse($request->input("fecha".$i));
            $fecha = $date->format('Y-m-d');

            $image = $request->file("comprobante".$i);
            $imageName = 'Caso'.$caso.'-'.$image->getClientOriginalName();
            $upload_success = $image->move(public_path('images'),$imageName);

            $url_comprobante = $imageName;
            $casos_array = ['id' => $caso, 'comprobante' => $url_comprobante];

            if(isset($correo_funeraria)){
                Mail::send('mailslayouts.pagoregistrado', $casos_array, function($message) use($caso, $correo_funeraria, $nombre_funeraria, $mensaje)
                {
                    $message->to($correo_funeraria, $nombre_funeraria)->subject($mensaje)->from('no-reply@excess.software', 'Urgencias Médicas');
                });
    
                Mail::send('mailslayouts.pagoregistrado', $casos_array, function($message) use($caso, $correo_admin, $nombre_funeraria, $mensaje)
                {
                    $message->to($correo_admin, $nombre_funeraria)->subject($mensaje)->from('no-reply@excess.software', 'Urgencias Médicas');
                });
            }

            HistorialPagos::create(['caso' => $caso, 'monto' => $monto, 'fecha' => $fecha, 'factura' => $request->input("factura".$i), 'serie' => $request->input("serie".$i), 'comprobante' => '/images/'.$imageName]);
        }
        $caso = Casos::find($caso);
        $caso->Pagado = $caso->Pagado + $total;
        $caso->Pendiente = $caso->Costo - $caso->Pagado;
        $caso->save();
        //return back()->with('msg', 'Pagos añadidos exitosamente.');
        //return $this->detallesCaso($caso->id, 1);} 

        activity()->log('Se ha ingresado un nuevo pago en el caso No. '.$caso->id);
        return redirect('/Casos/'.$caso->id.'/ver')->with('alerta', 'Pago ingresado exitosamente.');
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

        //return $data;

        $client = new \GuzzleHttp\Client();
        $api_uri = "http://umwsdl.smartla.net/wsdl_um.php";
        $res = $client->request('POST', $api_uri, ['form_params' => [
            'data' => $data,
            ],
        ]);
        
        $data = json_decode($res->getBody());
        activity()->log('Se cerró el caso No. '.$caso->Funeraria);
        return $data;
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
        activity()->log('El caso No. '.$caso.' se reportará '.$instruccion);
        echo 'Hecho';
    }

    public function insertData(Request $request) {
        
        $data = Helper::cryptR($request->input('data'), 0);

        $data->Estatus = 'Abierto';

        if(isset($data->Motivo)){
            $data->Causa_Especifica = $data->Motivo; 
        }

        if(isset($data->Funeraria)){
            unset($data->Funeraria);
        }

        if(isset($data->ServicioFunerarioContratado)){
            unset($data->ServicioFunerarioContratado);
        }

        if(isset($data->Comentario)){
            if($data->Comentario == ''){
                unset($data->Comentario);
            }
        }

        if(isset($data->TelTutor)){
            $data->TelTutor = trim($data->TelTutor);
        }

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
        $data = ['Aseguradora' => $request->aseguradora, 'Edad' => $request->edad, 'Fecha' => $fecha, 'Hora' => $request->hora, 'Causa' => $request->causa, 'Causa_Desc' => $request->descripcion_causa_input != '' ? $request->descripcion_causa_input : $request->descripcion_causa_select,  
        'Causa_Especifica' => $request->causa_especifica, 'Direccion' => $request->direccion, 'Departamento' => strtoupper(Helper::eliminar_acentos($request->departamento)), 
        'Municipio' => strtoupper(Helper::eliminar_acentos($request->municipio)), 'Padre' => $request->padre, 'TelPadre' => $request->TelPadre,
        'Madre' => $request->madre, 'TelMadre' => $request->TelMadre, 'NombreReporta' => $request->NombreReporta, 'RelacionReporta' => $request->RelacionReporta, 
        'TelReporta' => $request->TelReporta, 'Lugar' => $request->lugar, 'Tutor' => $request->Tutor, 'TelTutor' => $request->TelTutor, 'DPITutor' => $request->DPITutor,
        'ParentescoTutor' => $request->ParentescoTutor, 'EmailTutor' => $request->EmailTutor, 'Comentario' => $request->ComentarioTutor, 'Medico' => $request->Medico, 'Idioma' => $request->Idioma,
        'Certificado' => $request->certificado, 'Poliza' => $request->poliza, 'TipoAsegurado' => $request->tipoAsegurado];
        $caso_update = Casos::find($caso)->update($data);

        if($request->descripcion_causa != ''){
            $causa = Causas::find($request->causa_id);
            $causa->Causa = $request->descripcion_causa_input;
            $causa->save();
        }

        Notificaciones::create(['funeraria' => NULL, 'contenido' => 'Caso #'.$caso.' actualizado.', 'estatus' => 'Activa', 'caso' => $caso]);
        
        //return $this->detallesCaso($caso, 2);
        activity()->log('Caso #'.$caso.' modificado.');
        return redirect('/Casos/'.$caso.'/ver')->with('alerta', 'El caso ha sido modificado exitosamente.');
    }

    public function getInfoFuneraria($id){
        $costo = Funerarias::where('Id_Funeraria', $id)->select('Email', 'Campanias')->first()->toJson();

        return $costo;
    }

    public function casoExterno($token, $msg = 0){
        $caso = Casos::where('token', $token)->get()->first();
        if(!$caso){
            abort(404);
        }

        if($caso->Estatus == 'Cerrado'){
            $pagos = HistorialPagos::where('caso', $caso->id)->get();
            $tasa_cambio = Configuracion::where('opcion', 'Tasa_Cambio')->value('valor');

            return view('Funerarias.Externa.pagos', ['Caso' => $caso, 'Pagos' => $pagos, 'Tasa_Cambio' => $tasa_cambio]);

        }

        $files = File::files(public_path('images'));
        $archivos = array();
        foreach ($files as $file) {
            $nombre = basename($file);
            $posicion_indicador = strpos($nombre, '-');
            $nuevonombre = substr($nombre, $posicion_indicador+1);
            $nombrecaso = substr($nombre, 0, $posicion_indicador-1);
            $posicion_caso = strpos($nombrecaso, 'Caso');
            $no_caso = substr($nombre, $posicion_caso+4, $posicion_indicador-4);
            if($no_caso == $caso->id){
                array_push($archivos, $nuevonombre);
            }
        }
        $url = "https://gist.githubusercontent.com/tian2992/7439705/raw/1e5d0a766775a662039f3a838f422a1fc1600f74/guatemala.json";
        
        $json = file_get_contents($url);
        $solicitudes = SolicitudesCobro::where('caso', $caso->id)->orderBy('id', 'desc')->get();
        $causas = Causas::get();
        if($msg == 1){
            return view('Funerarias.Externa.detalle', ['Caso' => $caso, 'Json' => $json, 'Archivos' => $archivos, 'Solicitudes' => $solicitudes, 'Causas' => $causas])->with('alerta', 'Su solicitud ha sido ingresada');
        }else if($msg == 2){
            return view('Funerarias.Externa.detalle', ['Caso' => $caso, 'Json' => $json, 'Archivos' => $archivos, 'Solicitudes' => $solicitudes, 'Causas' => $causas])->with('alerta', 'El caso fue actualizado exitosamente.');
        }else{
            return view('Funerarias.Externa.detalle', ['Caso' => $caso, 'Json' => $json, 'Archivos' => $archivos, 'Solicitudes' => $solicitudes, 'Causas' => $causas]);
        }
    }

    public function modificarCasoExterno($caso, Request $request){
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
        //activity()->log('Se actualizó el caso No. '. $caso);
        return back()->with('alerta', 'El caso fue actualizado exitosamente.');
    }

    public function actualizarCostoExterno($caso, Request $request){
        //$caso = Casos::find($caso);
        //$caso->Costo = $request->Costo;
        //$caso->save();
        //return back();
        $getCaso = Casos::find($caso);
        $getCaso->Solicitud = 'Pendiente';
        $getCaso->Moneda = 'GTQ';
        $getCaso->save();

        SolicitudesCobro::create(['caso' => $caso, 'estatus' => 'Pendiente', 'costo' => $request->Costo, 'descripcion' => $request->Descripcion]);
        Notificaciones::create(['funeraria' => NULL, 'contenido' => 'El caso #'.$caso.' tiene una nueva solicitud.', 'estatus' => 'Activa', 'caso' => $caso]);
        
        //return $this->detallesCaso($caso, 1);
        //activity()->log('El hizo una solicitud para actualizar el costo del caso No. '.$caso);
        return back()->with('alerta', 'Su solicitud ha sido ingresada.');
    }

    public function guardarMediaExterno($caso, Request $request){
        $date = Carbon::now()->format('Ymd');
        //$user = auth()->user();
        $image = $request->file('file');
        $originalName = $image->getClientOriginalName();
        $fileName = pathinfo($originalName,PATHINFO_FILENAME);
        $imageName = 'Caso'.$caso.'-'.$fileName.'-'.$date.'.'.$image->getClientOriginalExtension();
        $upload_success = $image->move(public_path('images'),$imageName);
        
        if ($upload_success) {
            //activity()->log('Se subió el archivo '.$imageName.' al caso #'.$caso);
            return response()->json($upload_success, 200);
        }
        // Else, return error 400
        else {
            return response()->json('error', 400);
        }
    }

    public function modificarFunerariaCasoExterno($id, Request $request){
        $caso = Casos::find($id);
        $caso->Funeraria_Externa_Nombre = $request->Nombre;
        $caso->Funeraria_Externa_NIT = $request->NIT;
        $caso->Funeraria_Externa_Banco = $request->Banco;
        $caso->Funeraria_Externa_NoCuenta = $request->Cuenta;
        $caso->save();

        return back()->with('alerta', 'Sus datos fueron actualizados correctamente.');
    }
}

