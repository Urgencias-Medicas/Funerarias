<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\DetallesFuneraria;
use App\Casos;
use App\Funerarias;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Aseguradoras;
use App\Campanias;
use App\Configuracion;
use App\InfoFunerariasRegistradas;
use App\DetallesDeFuneraria;
use App\DocumentosFuneraria;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Personal');
    }

    public function nuevoUsuario(){
        return view('Admin.Crear.usuario');
    }

    public function nuevoUsuarioFuneraria(){
        return view('Admin.Crear.usuarioFuneraria');
    }


    public function nuevaFuneraria(){
        return view('Admin.Crear.funeraria');
    }

    public function guardarUsuario(Request $request){
        $random_password = Str::random(8);
        $mail = $request->mail;
        $user = User::create([
            'name' => $request->nombre,
            'email' => $request->mail,
            'password' => Hash::make($random_password),
            'created_at' => time()
        ]);

        if($request->tipo_usuario == 'Agente'){
            $user->assignRole('Agente');
        }elseif($request->tipo_usuario == 'Personal'){
            $user->assignRole('Personal');
        }elseif($request->tipo_usuario == 'Contabilidad'){
            $user->assignRole('Contabilidad');
        }elseif($request->tipo_usuario == 'CHN'){
            $user->assignRole('CHN');
        }

        $data = ['password' => $random_password];

        Mail::send('mailslayouts.nuevousuario', $data, function($message) use($mail)
            {
                $message->to($mail, 'Nuevo Usuario')->subject('Usuario creado')->from('no-reply@excess.software', 'Urgencias Médicas');
            });
        activity()->log('Se ha creado un nuevo usuario con el siguiente email '.$mail);
        //return $this->verUsuarios(1);
        return redirect('/Personal/verUsuarios')->with('alerta', 'Se ha creado el usuario exitosamente.');
    }
    public function guardarFuneraria(Request $request){

        $mail = $request->mail;
        $random_password = Str::random(8);

        $data = ['Campos' => json_encode(array(array('campo' => 'InfoGeneral',  'result' => 'No'), array('campo' => 'Documentos' , 'result' => 'No'), array('campo' => 'Contrato', 'result' => 'No')))];
        $id_detalle = DetallesFuneraria::insertGetId($data);
        
        $user = User::create([
            'name' => $request->nombre,
            'email' => $request->mail,
            'password' => Hash::make($random_password),
            'created_at' => time(),
            'funeraria' => $request->funeraria,
            'activo' => 'No',
            'detalle' => $id_detalle,
        ]);

        $user->assignRole('Funeraria');

        $data = ['password' => $random_password];

        Mail::send('mailslayouts.nuevaFuneraria', $data, function($message) use($mail)
            {
                $message->to($mail, 'Nueva funeraria')->subject('Usuario creado')->from('no-reply@excess.software', 'Urgencias Médicas');
            });

        return redirect('Personal/Funeraria/'.$user->id.'/ver')->with('alerta', 'Se ha creado la funeraria exitosamente.');
    }
    public function guardarUsuarioFuneraria(Request $request){
        $mail = $request->mail;
        $random_password = Str::random(8);
        $user = User::create([
            'name' => $request->nombre,
            'email' => $request->mail,
            'password' => Hash::make($random_password),
            'created_at' => time(),
            'funeraria' => $request->funeraria
        ]);

        $user->assignRole('Funeraria');

        $data = ['password' => $random_password];

        Mail::send('mailslayouts.nuevousuario', $data, function($message) use($mail)
            {
                $message->to($mail, 'Nuevo Usuario')->subject('Usuario creado')->from('no-reply@excess.software', 'Urgencias Médicas');
            });

        //return $this->verUsuarios(1);
        activity()->log('Se ha creado el usuario con el email '.$mail.' para la funeraria No. '.$request->funeraria);
        return redirect('/Personal/verUsuariosFunerarias')->with('alerta', 'Se ha creado el usuario exitosamente.');
    }

    public function verUsuarios($msg = 0){
        $users = User::with('roles')->get();

        $users = $users->reject(function ($user, $key) {
            return $user->hasRole(['Super Admin']);
        });

        foreach($users as $user){
            $user->rol = $user->roles->first()->name;
            if($user->funeraria){
                $nombre_funeraria = Funerarias::where('id', $user->funeraria)->value('Nombre');
                $user->funeraria = $nombre_funeraria;
            }
        }
        if($msg == 0){
            return view('Admin.Crear.verUsuarios', ['usuarios' => $users]);
        }else{
            return view('Admin.Crear.verUsuarios', ['usuarios' => $users])->with('alerta', 'Se ha creado el usuario exitosamente.');
        }
    }

    public function verUsuariosFunerarias($msg = 0){
        $users = User::whereNotNull('funeraria')->with('roles')->get();

        foreach($users as $user){
            $funeraria = Funerarias::where('Id_Funeraria', $user->funeraria)->value('Nombre');
            $user->nombre_funeraria = $funeraria;
        }
        if($msg == 0){
            return view('Admin.Crear.verUsuariosFunerarias', ['usuarios' => $users]);
        }else{
            return view('Admin.Crear.verUsuariosFunerarias', ['usuarios' => $users])->with('alerta', 'Se ha creado el usuario exitosamente.');
        }
    }

    public function verFunerarias($msg = 0){
        //$funerarias = Funerarias::get();
        
        $data = InfoFunerariasRegistradas::get();

        /*$api_uri = url('/getFuneraria');
        $client = new \GuzzleHttp\Client([
            'headers' => [ 'Content-Type' => 'application/json' ]
        ]);
        $res = $client->request('GET', $api_uri, [
            
        ]);
        $data = json_decode($res->getBody());

        return $data;*/

        if($msg == 0){
            return view('Admin.Crear.verFunerarias', ['Funerarias' => $data]);
        }else{
            return view('Admin.Crear.verFunerarias', ['Funerarias' => $data])->with('alerta', 'Se ha creado la funeraria exitosamente.');
        }
    }

    public function eliminarUsuario($id){
        $user = User::find($id)->delete();
        activity()->log('Se ha eliminado el usuario No. '.$id);
        return 'Hecho';
    }

    public function eliminarFuneraria($id){
        $funeraria = Funerarias::find($id)->delete();
        activity()->log('Se ha eliminado la funeraria No. '.$id);
        return 'Hecho';
    }

    public function editarUsuario($id){
        $user = User::find($id);

        return view('Admin.Editar.usuario', ['usuario' => $user]);
    }

    public function editarFuneraria($id, $nombre){
        $funeraria = Funerarias::where('Funeraria_Registrada', $id)->first();

        if($funeraria){
            /*$api_uri = "https://umbd.excess.software/api/getFuneraria";
            $client = new \GuzzleHttp\Client([
                'headers' => [ 'Content-Type' => 'application/json' ]
            ]);
            $res = $client->request('GET', $api_uri, [
                'body' => json_encode(
                    [
                        'cols' => 'departamento',
                        'conds' => array('id' => $id)
                    ]
                ),
            ]);
            $data = json_decode($res->getBody());*/

            $data = InfoFunerariasRegistradas::where('id', $id)->first();

            $funeraria->Departamento = $data->departamento;
            $detalle = DetallesFuneraria::find($funeraria->Id_Detalle);
            $campanias = Campanias::all();
            $checks = Configuracion::where('opcion', 'Campos_Check')->value('valor');

            $documentos_funeraria = DocumentosFuneraria::where('Funeraria', $funeraria->Id_Funeraria)->get();

            $detalles_funeraria = DetallesDeFuneraria::where('Funeraria', $funeraria->Id_Funeraria)->get();

            $array_detalles = array();
            foreach($detalles_funeraria as $detalle){
                $array_detalles[$detalle->Campo] = $detalle->Valor;
            }
            //return $funeraria->Id_Funeraria;
            return view('Admin.Editar.funeraria', ['Funeraria' => $funeraria, 'Detalle' => $detalle, 'Campanias' => $campanias, 'Checks' => $checks, 'Detalles_Funeraria' => $array_detalles, 'DoctosFuneraria' => $documentos_funeraria]);
        }else{

            $funeraria_registrada = InfoFunerariasRegistradas::where('id', $id)->where('funeraria', $nombre)->first();

            if(!$funeraria_registrada){
                $data = ['Campos' => '[{"campo":1,"result":"No"}'];
                $id_detalle = DetallesFuneraria::insertGetId($data);

                $funeraria = Funerarias::updateOrcreate([
                    'Id_Funeraria' => $id,
                    'Funeraria_Registrada' => $id,
                    'Nombre' => $nombre,
                    'Email' => '',
                    'Telefono' => '',
                    'Monto_Base' => 0,
                    'Activa' => 'Si',
                    'Id_Detalle' => $id_detalle
                ]);

                //return view('Admin.Editar.funeraria', ['Funeraria' => $funeraria, 'Detalle' => $id_detalle]);

                return redirect('/Personal/editarFuneraria/'.$id.'/'.$nombre);
            }else{
                 
                $update_existente = Funerarias::where('Id_Funeraria', $id)->where('Nombre', $nombre)->update(['Funeraria_Registrada' => $id]);

                return redirect('/Personal/editarFuneraria/'.$id.'/'.$nombre);
            }
        }
    }

    public function guardarCambiosUsuario($id, Request $request){
        $user = User::find($id);

        $user->name = $request->nombre;
        $user->email = $request->mail;
        
        $user->save();
        activity()->log('Se ha modificado el usuario No. '.$id);
        return redirect('/Personal/verUsuarios');
    }

    public function guardarCambiosFuneraria($id, Request $request){
        $old_Activa = Funerarias::where('Id_Funeraria', $id)->value('Activa');
        $array_campanias = array();
        if(isset($request->campania)){
            foreach($request->campania as $campania){
                array_push($array_campanias, array("id" => $campania['id'], "nombre" => $campania['campania'], "monto" => $campania['monto_base'], "edad_inicial" => $campania['edad_inicial'], "edad_final" => $campania['edad_final']));
            }
        }
        $json_campanias = json_encode($array_campanias);
        $user = Funerarias::where('Id_Funeraria', $id)->update(['Nombre' => $request->nombre, 'Diminutivo' => $request->diminutivo, 'Email' => $request->email, 'Telefono' => $request->telefono, 'NIT' => $request->NIT, 'Banco' => $request->Banco, 'Cuenta' => $request->Cuenta, 'Activa' => $request->activo, 'Campanias' => $json_campanias]);

        $activa = '';
        if($request->activo == 'Si'){
            $activa = 'Activo';
        }else{
            $activa = 'Inactivo';
        }

        $id_fun_registrada = Funerarias::where('Id_Funeraria', $id)->value('Funeraria_Registrada');

        $update_fun_registrada = InfoFunerariasRegistradas::where('id', $id_fun_registrada)->update(['tel_contacto' => $request->telefono, 'tel_coordinador' => $request->telefono, 'estado' => $activa]);

        $funeraria_id = Funerarias::where('Id_Funeraria', $id)->value('id');

        $user_funeraria = User::where('id', $id)->update(['activo' => $request->activo, 'funeraria' => $funeraria_id]);

        $pasos = array();

        for($i = 1; $i <= $request->cantidadJson; $i++){
            if($request->input('campo_'.$i) == ''){
                array_push($pasos, array('campo' => $i, 'result' => 'No'));
            }else{
                array_push($pasos, array('campo' => $i, 'result' => 'Si'));
            }
        }

        $json_pasos = json_encode($pasos);

        //$detalle = DetallesFuneraria::find($detalle)->updateOrCreate(['Campos' => $json_pasos]);

        $data = [];

        if($old_Activa != $request->activo){
            if($activa == 'Activo'){

                $mail = $request->email;
    
                Mail::send('mailslayouts.funeraria_activa', $data, function($message) use($mail)
                {
                    $message->to($mail, 'Funeraria')->subject('Su usuario ha sido activado')->from('no-reply@excess.software', 'Urgencias Médicas');
                });
    
                activity()->log('Se ha activado la funeraria No. '.$id.' con el nombre '.$request->nombre);
            }else{
    
                $mail = $request->email;
    
                Mail::send('mailslayouts.funeraria_inactiva', $data, function($message) use($mail)
                {
                    $message->to($mail, 'Funeraria')->subject('Su usuario ha sido desactivado')->from('no-reply@excess.software', 'Urgencias Médicas');
                });
    
                activity()->log('Se ha desactivado la funeraria No. '.$id.' con el nombre '.$request->nombre);
            }
        }

        activity()->log('Se ha modificado la funeraria No. '.$id);
        //return redirect('/Personal/verFunerarias');
        return back();
    }

    public function guardarCambiosFunerariaNueva($id, Request $request){

        $array_campanias = array();
        if(isset($request->campania)){
            foreach($request->campania as $campania){
                array_push($array_campanias, array("id" => $campania['id'], "nombre" => $campania['campania'], "monto" => $campania['monto_base'], "edad_inicial" => $campania['edad_inicial'], "edad_final" => $campania['edad_final']));
            }
        }

        $nueva_funeraria_insertada = InfoFunerariasRegistradas::create(['funeraria' => $request->nombre]);

        $funeraria = Funerarias::create([
            'Id_Funeraria' => $id,
            'Funeraria_Registrada' => $nueva_funeraria_insertada->id,
            'Nombre' => $request->nombre,
            'Email' => $request->email,
            'Telefono' => $request->telefono,
            'Monto_Base' => 0,
            'Activa' => $request->activo,
            //'Id_Detalle' => $detalle
        ]);

        $json_campanias = json_encode($array_campanias);

        $user_funeraria = User::where('id', $id)->update(['activo' => $request->activo, 'funeraria' => $funeraria->id]);

        $detalles_funeraria = DetallesDeFuneraria::where('Funeraria', $id)->get();

        foreach($detalles_funeraria as $detalles){
            if($detalles->Campo == 'Direccion'){
                $test = InfoFunerariasRegistradas::where('id', $nueva_funeraria_insertada->id)->update(['direccion' => $detalles->Valor]);
            }elseif($detalles->Campo == 'Departamento'){
                InfoFunerariasRegistradas::where('id', $nueva_funeraria_insertada->id)->update(['departamento' => $detalles->Valor]);
            }elseif($detalles->Campo == 'TelContacto'){
                InfoFunerariasRegistradas::where('id', $nueva_funeraria_insertada->id)->update(['tel_contacto' => $detalles->Valor, 'tel_coordinador' => $detalles->Valor]);
                Funerarias::where('id', $funeraria->id)->update(['Telefono' => $detalles->Valor]);
            }elseif($detalles->Campo == 'TipoFuneraria'){
                InfoFunerariasRegistradas::where('id', $nueva_funeraria_insertada->id)->update(['tipo' => $detalles->Valor]);
            }
        }

        $data = [];

        if($request->activo == 'Si'){
            $request->activo = 'Activo';
            $mail = $request->email;

            Mail::send('mailslayouts.funeraria_activa', $data, function($message) use($mail)
            {
                $message->to($mail, 'Funeraria')->subject('Su usuario ha sido activado')->from('no-reply@excess.software', 'Urgencias Médicas');
            });

            activity()->log('Se ha activado la funeraria No. '.$id.' con el nombre '.$request->nombre);
        }else{
            $request->activo = 'Inactivo';
            $mail = $request->email;

            Mail::send('mailslayouts.funeraria_inactiva', $data, function($message) use($mail)
            {
                $message->to($mail, 'Funeraria')->subject('Su usuario ha sido desactivado')->from('no-reply@excess.software', 'Urgencias Médicas');
            });

            activity()->log('Se ha desactivado la funeraria No. '.$id.' con el nombre '.$request->nombre);
        }

        InfoFunerariasRegistradas::where('id', $nueva_funeraria_insertada->id)->update(['estado' => $request->activo]);

        $pasos = array();

        for($i = 1; $i <= $request->cantidadJson; $i++){
            if($request->input('campo_'.$i) == ''){
                array_push($pasos, array('campo' => $i, 'result' => 'No'));
            }else{
                array_push($pasos, array('campo' => $i, 'result' => 'Si'));
            }
        }

        $json_pasos = json_encode($pasos);

        //$detalle = DetallesFuneraria::find($detalle)->updateOrCreate(['Campos' => $json_pasos]);
        activity()->log('Se ha modificado la funeraria No. '.$id);
        return redirect('/Personal/editarFuneraria/'.$nueva_funeraria_insertada->id.'/'.$request->nombre);
        //return back();
    }

    public function verCampanias(){
        $campanias = Campanias::get();

        return view('Admin.Crear.verCampanias', ['Campanias' => $campanias]);
    }

    public function crearCampania(){
        return view('Admin.Crear.campanias');
    }

    public function detallesCampanias($id){
        $campania = Campanias::find($id);

        return view('Admin.Editar.campanias', ['Campania' => $campania]);
    }

    public function guardarCampania(Request $request){
        $campania = Campanias::create([
            'Nombre' => $request->Nombre,
            'Diminutivo' => $request->Diminutivo,
            'Nombre_Aseguradora' => $request->NombreAseguradora,
            'Aseguradora' => $request->CodigoAseguradora,
            'Moneda' => $request->Moneda,
        ]);
        activity()->log('Se ha creado la campañia '.$request->Nombre);
        return redirect('Personal/Campanias/')->with('alerta', 'Campaña creada exitosamente.');
    }

    public function actualizarCampania($id, Request $request){
        $campania = Campanias::find($id);
        $campania->Nombre = $request->Nombre;
        $campania->Diminutivo = $request->Diminutivo;
        $campania->Aseguradora = $request->CodigoAseguradora;
        $campania->Nombre_Aseguradora = $request->NombreAseguradora;
        $campania->Moneda = $request->Moneda;
        $campania->save();

        return back();
    }

    public function eliminarCampania($id){
        $campania = Campanias::find($id)->delete();
        activity()->log('Se ha eliminado la campañia No. '.$id);
        return back()->with('alerta', 'Se eliminó la campaña.');
    }
}
