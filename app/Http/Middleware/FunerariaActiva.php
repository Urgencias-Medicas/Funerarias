<?php

namespace App\Http\Middleware;

use Closure;
use App\Funerarias;
//use App\User;

class FunerariaActiva
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        $user = auth()->user();
        $funeraria = Funerarias::where('Id', $user['funeraria'])->value('Activa');
        $funeraria_user = Funerarias::where('Id_Funeraria', $user['id'])->value('Activa');
        $activo = $funeraria;
        $activa = $funeraria_user;
        if($activo == 'No' || $activo == 'no' || $activo != 'Si'){
            return redirect('/Funerarias/Inactiva');
        }else{
            return $next($request);
        }
    }
}
