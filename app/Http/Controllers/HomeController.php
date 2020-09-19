<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

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
}
