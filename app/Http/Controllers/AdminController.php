<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\DetallesFuneraria;
use App\Casos;

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

    public function nuevaFuneraria(){
        return view('Admin.Crear.funeraria');
    }

    public function guardarUsuario(Request $request){
        $user = User::create([
            'name' => $request->nombre,
            'email' => $request->mail,
            'password' => Hash::make('password'),
            'created_at' => time()
        ]);

        if($request->tipo_usuario == 'Agente'){
            $user->assignRole('Agente');
        }elseif($request->tipo_usuario == 'Personal'){
            $user->assignRole('Personal');
        }

        return back();
    }

    public function guardarFuneraria(Request $request){

        //Almacenar data detalles
        $data = ['paso_uno' => 'No', 'paso_dos' => 'No', 'paso_tres' => 'No'];
        $id_detalle = DetallesFuneraria::insertGetId($data);

        $user = User::create([
            'name' => $request->nombre,
            'email' => $request->mail,
            'password' => Hash::make('password'),
            'created_at' => time(),
            'funeraria' => $request->funeraria,
            'activo' => 'No',
            'detalle' => $id_detalle
        ]);

        $user->assignRole('Funeraria');

        return back();
    }

    public function verUsuarios(){
        $users = User::with('roles')->get();

        foreach($users as $user){
            $user->rol = $user->roles->first()->name;
        }
        return view('Admin.Crear.verUsuarios', ['usuarios' => $users]);
    }
}
