<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Notificaciones;
use Illuminate\Support\Facades\Hash;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        if($user->hasRole('Agente')){
            return redirect('/Casos/vistaCrear');
        }elseif($user->hasRole('Personal')){
            return redirect('/Casos/ver');
        }elseif($user->hasRole('Funeraria')){
            return redirect('/Funerarias/Casos/ver');
        }elseif($user->hasRole('Super Admin')){
            return view('Admin.home');
        }
    }
    public function funerariaInactiva(){
        return view('Funerarias.Inactiva');
    }
    public function quitarNotificacion($id){
        $notificacion = Notificaciones::find($id);
        $notificacion->estatus = 'Inactiva';
        $notificacion->save();
        echo 'Hecho';
    }
    public function notificaciones(){
        $user = auth()->user();
        if($user->hasRole('Personal')){
            $notificaciones = Notificaciones::where('funeraria', NULL)->orderBy('id', 'DESC')->get();
        }elseif($user->hasRole('Funeraria')){
            $notificaciones = Notificaciones::where('funeraria', $user->funeraria)->orderBy('id', 'DESC')->get();
        }
        return view('General.notificaciones', ['Notificaciones' => $notificaciones]);
    }

    public function cambioPassword(){
        return view('General.cambioPassword');
    }
    public function verificarPassword($password){
        $user = auth()->user();
        $current_password = $user['password'];
        if(Hash::check($password, $current_password)){
            return true;
        }else{
            return false;
        }
    }
    public function guardarPassword(Request $request){
        $user = auth()->user();
        $id = $user['id'];
        User::where("id", $id)->update(['Password' => Hash::make($request->newPassword)]);
        return redirect("/home");
    }
    public function cambioMail(){
        return view('General.changemail');
    }
    public function verificarMail($mail){
        $mail_find = User::where('email', $mail)->get();
        if($mail_find->isEmpty()){
            return true;
        }else{
            return false;
        }
    }
    public function guardarMail(Request $request){
        $user = auth()->user();
        $id = $user['id'];
        User::where("id", $id)->update(['Email' => $request->mail]);
        return redirect("/home");
    }
}
