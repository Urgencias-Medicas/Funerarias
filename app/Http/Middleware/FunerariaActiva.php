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
        $funeraria = Funerarias::where('Id_Funeraria', $user['funeraria'])->value('Activa');
        $activo = $funeraria;
        if($activo == 'No' || $activo == 'no' || $activo != 'Si'){
            return redirect('/Funerarias/Inactiva');
        }else{
            return $next($request);
        }
    }
}
