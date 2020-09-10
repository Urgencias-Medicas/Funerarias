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
            return view('Agentes.home');
        }elseif($user->hasRole('Personal')){
            return view('Personal.home');
        }elseif($user->hasRole('Funeraria')){
            return view('Funerarias.home');
        }elseif($user->hasRole('Super Admin')){
            return view('Admin.home');
        }
    }
}
