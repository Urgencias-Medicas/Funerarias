<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;
use App\Notificaciones;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $notificaciones = Notificaciones::where('estatus', 'Activa')->orderBy('id', 'DESC')->limit(10)->get();
        view()->share('Notificaciones_head', $notificaciones); 

        view()->composer('*', function($view)
    {
        if (Auth::check()) {
            $view->with('user', Auth::user());
        }else {
            $view->with('user', null);
        }
    });
    }
}
