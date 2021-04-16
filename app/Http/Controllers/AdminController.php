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
        }

        $data = ['password' => $random_password];

        Mail::send('mailslayouts.nuevousuario', $data, function($message) use($mail)
            {
                $message->to($mail, 'Nuevo Usuario')->subject('Usuario creado')->from('no-reply@excess.software', 'Urgencias Médicas');
            });

        //return $this->verUsuarios(1);
        return redirect('/Personal/verUsuarios')->with('alerta', 'Se ha creado el usuario exitosamente.');
    }
    public function guardarFuneraria(Request $request){

        //Almacenar data detalles
        $data = ['paso_uno' => 'No', 'paso_dos' => 'No', 'paso_tres' => 'No'];
        $id_detalle = DetallesFuneraria::insertGetId($data);

        Funerarias::create([
            'Id_Funeraria' => $request->funeraria,
            'Nombre' => $request->nombre,
            'Email' => $request->mail,
            'Telefono' => $request->telefono,
            'Monto_Base' => $request->MontoBase,
            'Activa' => 'Si',
            'Id_Detalle' => $id_detalle
        ]);
        //$user = User::create([
        //    'name' => $request->nombre,
        //    'email' => $request->mail,
        //    'password' => Hash::make('password'),
        //    'created_at' => time(),
        //    'funeraria' => $request->funeraria,
        //    'activo' => 'No',
        //    'detalle' => $id_detalle
        //]);

        //$user->assignRole('Funeraria');

        //return $this->verFunerarias(1);
        return redirect('/Personal/verFunerarias')->with('alerta', 'Se ha creado la funeraria exitosamente.');
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
        return redirect('/Personal/verUsuariosFunerarias')->with('alerta', 'Se ha creado el usuario exitosamente.');
    }

    public function verUsuarios($msg = 0){
        $users = User::with('roles')->get();

        $users = $users->reject(function ($user, $key) {
            return $user->hasRole(['Funeraria', 'Super Admin']);
        });

        foreach($users as $user){
            $user->rol = $user->roles->first()->name;
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

        $api_uri = "https://umbd.excess.software/api/getFuneraria";
        $client = new \GuzzleHttp\Client([
            'headers' => [ 'Content-Type' => 'application/json' ]
        ]);
        $res = $client->request('GET', $api_uri, [
            
        ]);
        $data = json_decode($res->getBody());

        if($msg == 0){
            return view('Admin.Crear.verFunerarias', ['Funerarias' => $data]);
        }else{
            return view('Admin.Crear.verFunerarias', ['Funerarias' => $data])->with('alerta', 'Se ha creado la funeraria exitosamente.');
        }
    }

    public function eliminarUsuario($id){
        $user = User::find($id)->delete();

        return 'Hecho';
    }

    public function eliminarFuneraria($id){
        $funeraria = Funerarias::find($id)->delete();

        return 'Hecho';
    }

    public function editarUsuario($id){
        $user = User::find($id);

        return view('Admin.Editar.usuario', ['usuario' => $user]);
    }

    public function editarFuneraria($id, $nombre){
        $funeraria = Funerarias::where('Id_Funeraria', $id)->first();

        if($funeraria){
            $api_uri = "https://umbd.excess.software/api/getFuneraria";
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
            $data = json_decode($res->getBody());

            $funeraria->Departamento = $data[0]->departamento;
            $detalle = DetallesFuneraria::find($funeraria->Id_Detalle);
            $campanias = Campanias::all();
            $checks = Configuracion::where('opcion', 'Campos_Check')->value('valor');
            return view('Admin.Editar.funeraria', ['Funeraria' => $funeraria, 'Detalle' => $detalle, 'Campanias' => $campanias, 'Checks' => $checks]);
        }else{
            //Almacenar data detalles
            $data = ['Campos' => '[{"campo":1,"result":"No"}'];
            $id_detalle = DetallesFuneraria::insertGetId($data);

            $funeraria = Funerarias::create([
                'Id_Funeraria' => $id,
                'Nombre' => $nombre,
                'Email' => '',
                'Telefono' => '',
                'Monto_Base' => 0,
                'Activa' => 'Si',
                'Id_Detalle' => $id_detalle
            ]);

            //return view('Admin.Editar.funeraria', ['Funeraria' => $funeraria, 'Detalle' => $id_detalle]);

            return redirect('/Personal/editarFuneraria/'.$id.'/'.$nombre);
        }
    }

    public function guardarCambiosUsuario($id, Request $request){
        $user = User::find($id);

        $user->name = $request->nombre;
        $user->email = $request->mail;
        
        $user->save();

        return redirect('/Personal/verUsuarios');
    }

    public function guardarCambiosFuneraria($id, $detalle, Request $request){
        $array_campanias = array();
        foreach($request->campania as $campania){
            array_push($array_campanias, array("id" => $campania['id'], "nombre" => $campania['campania'], "monto" => $campania['monto_base'], "edad_inicial" => $campania['edad_inicial'], "edad_final" => $campania['edad_final']));
        }
        $json_campanias = json_encode($array_campanias);
        $user = Funerarias::find($id)->update(['Email' => $request->email, 'Telefono' => $request->telefono, 'Activa' => $request->activo, 'Campanias' => $json_campanias]);

        $pasos = array();

        for($i = 1; $i <= $request->cantidadJson; $i++){
            if($request->input('campo_'.$i) == ''){
                array_push($pasos, array('campo' => $i, 'result' => 'No'));
            }else{
                array_push($pasos, array('campo' => $i, 'result' => 'Si'));
            }
        }

        $json_pasos = json_encode($pasos);

        $detalle = DetallesFuneraria::find($detalle)->update(['Campos' => $json_pasos]);
        return redirect('/Personal/verFunerarias');
    }

    public function verCampanias(){
        $campanias = Campanias::get();

        return view('Admin.Crear.verCampanias', ['Campanias' => $campanias]);
    }

    public function crearCampania(){
        return view('Admin.Crear.campanias');
    }

    public function guardarCampania(Request $request){
        $campania = Campanias::create([
            'Nombre' => $request->Nombre,
            'Nombre_Aseguradora' => $request->NombreAseguradora,
            'Aseguradora' => $request->CodigoAseguradora,
            'Moneda' => $request->Moneda,
        ]);

        return redirect('Personal/Campanias/')->with('alerta', 'Campaña creada exitosamente.');
    }

    public function eliminarCampania($id){
        $campania = Campanias::find($id)->delete();

        return back()->with('alerta', 'Se eliminó la campaña.');
    }
}
