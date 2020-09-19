<?php

namespace App\Http\Middleware;

use Closure;
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
        $activo = $user['activo'];
        if($activo == 'No'){
            return redirect('/Funerarias/Inactiva');
        }else{
            return $next($request);
        }
    }
}
