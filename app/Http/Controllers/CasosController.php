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
        'Municipio' => $request->municipio, 'Padre' => $request->padre, 'TelPadre' => $request->TelPadre,
        'Madre' => $request->madre, 'TelMadre' => $request->TelMadre, 'NombreReporta' => $request->NombreReporta, 'RelacionReporta' => $request->RelacionReporta, 
        'TelReporta' => $request->TelReporta, 'Lugar' => $request->lugar, 'Estatus' => 'Abierto', 'Reportar' => 'No'];
        Casos::create($data);
        
        return redirect('/Casos/vistaCrear');
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
        $casos = Casos::orderBy('id', 'DESC')->get();
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
        $pagos = HistorialPagos::where('caso', $id)->get();
        $solicitudes = SolicitudesCobro::where('caso', $id)->orderBy('id', 'DESC')->get();
        return view('Personal.Casos.detalle', ['Caso' => $caso, 'Archivos' => $archivos, 'Pagos' => $pagos, 'Solicitudes' => $solicitudes]);
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
        Notificaciones::create(['funeraria' => $getCaso->Funeraria, 'contenido' => $respuesta, 'estatus' => 'Activa']);
        echo 'Hecho';
    }

    public function asignarFuneraria($caso, $funeraria, $correo, $wp){
        $costo_servicio = 0;
        $casos = Casos::find($caso);
        $casos->Funeraria = $funeraria;
        $casos->Estatus = 'Asignado';
        if($funeraria == '6'){
            $costo_servicio = 1500;
        }elseif($funeraria == '7'){
            $costo_servicio = 1300;
        }else{
            $costo_servicio = 1000;
        }
        $casos->Costo = $costo_servicio;
        $casos->save();

        $api_uri = "https://umbd.excess.software/api/getFuneraria";
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
        $data = json_decode($res->getBody());
        $nombre_funeraria = $data[0]->funeraria;

        $mensaje = 'Caso #'.$caso.' asignado. ';
        $mensaje .= 'Más información en http://umfunerarias.local/Funerarias/Casos/'.$caso.'/ver';
        $casos_array = ['id' => $caso];  
        if($correo == 'Si'){
            Mail::send('mailslayouts.asignado', $casos_array, function($message) use($caso, $nombre_funeraria, $mensaje)
            {
                $message->to('samuelambrosio99@gmail.com', $nombre_funeraria)->subject($mensaje)->from('no-reply@excess.software', 'Urgencias Médicas');
            });
        }
        if($wp == 'Si'){
            $this->mensajeWhatsApp($mensaje, 'whatsapp:+50249750995');
        }
        Notificaciones::create(['funeraria' => $funeraria, 'contenido' => 'Caso #'.$caso.' asignado.', 'estatus' => 'Activa']);
        return 'Hecho';
    }

    public function actualizarPago($caso, Request $request){
        $total = 0;
        for ($i=1; $i <= $request->filas ; $i++) { 
            $monto = $request->input("monto".$i);
            $total = $total + $monto;
            $date = Carbon::parse($request->input("fecha".$i));
            $fecha = $date->format('Y-m-d');
            HistorialPagos::create(['caso' => $caso, 'monto' => $monto, 'fecha' => $fecha]);
        }
        $caso = Casos::find($caso);
        $caso->Pagado = $caso->Pagado + $total;
        $caso->Pendiente = $caso->Costo - $caso->Pagado;
        $caso->save();
        return back();
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
        Notificaciones::create(['funeraria' => $caso->funeraria, 'contenido' => 'El caso #'.$caso->id.' se ha cerrado.', 'estatus' => 'Activa']);
        return 'Hecho';
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
}
