<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\DetallesFuneraria;
use App\Casos;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Super Admin');
    }
    public function nuevoAgente(){
        return view('Admin.Crear.agente');
    }

    public function nuevoPersonal(){
        return view('Admin.Crear.personal');
    }

    public function nuevaFuneraria(){
        return view('Admin.Crear.funeraria');
    }
}
