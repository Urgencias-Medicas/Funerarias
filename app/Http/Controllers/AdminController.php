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

        return $this->verUsuarios(1);
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

        return $this->verFunerarias(1);
    }
    public function guardarUsuarioFuneraria(Request $request){
        $mail = $request->mail;
        $random_password = Str::random(8);
        $user = User::create([
            'name' => $request->nombre,
            'email' => $request->mail,
            'password' => Hash::make('password'),
            'created_at' => time(),
            'funeraria' => $request->funeraria
        ]);

        $user->assignRole('Funeraria');

        $data = ['password' => $random_password];

        Mail::send('mailslayouts.nuevousuario', $data, function($message) use($mail)
            {
                $message->to($mail, 'Nuevo Usuario')->subject('Usuario creado')->from('no-reply@excess.software', 'Urgencias Médicas');
            });

        return $this->verUsuarios(1);
    }

    public function verUsuarios($msg = 0){
        $users = User::with('roles')->get();

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
            $detalle = DetallesFuneraria::find($funeraria->Id_Detalle);
            return view('Admin.Editar.funeraria', ['Funeraria' => $funeraria, 'Detalle' => $detalle]);
        }else{
            //Almacenar data detalles
            $data = ['paso_uno' => 'No', 'paso_dos' => 'No', 'paso_tres' => 'No'];
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
        $user = Funerarias::find($id)->update(['Email' => $request->email, 'Telefono' => $request->telefono, 'Monto_Base' => $request->MontoBase, 'Activa' => $request->activo]);

        $pasos = array();
        if($request->paso_uno == ''){
            array_push($pasos, 'No');
        }else{
            array_push($pasos, 'Si');
        }
        
        if($request->paso_dos == ''){
            array_push($pasos, 'No');
        }else{
            array_push($pasos, 'Si');
        }

        if($request->paso_tres == ''){
            array_push($pasos, 'No');
        }else{
            array_push($pasos, 'Si');
        }

        $detalle = DetallesFuneraria::find($detalle)->update(['paso_uno' => $pasos[0], 'paso_dos' => $pasos[1], 'paso_tres' => $pasos[2]]);
        return redirect('/Personal/verFunerarias');
    }
}
