<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DetallesFuneraria;
use App\InfoFunerariasRegistradas;
use App\Funerarias;
use App\User;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $activo = 'No';
        
        $this->validator($request->all())->validate();

        //Almacenar data detalles
        $data = ['Campos' => json_encode(array(array('campo' => 'InfoGeneral',  'result' => 'No'), array('campo' => 'Documentos' , 'result' => 'No'), array('campo' => 'Contrato', 'result' => 'No')))];
        $id_funeraria_registrada = InfoFunerariasRegistradas::insertGetId(['funeraria' => $request->name, 'estado' => 'Inactivo']);
        $id_funeraria = Funerarias::insertGetId(['Id_Funeraria' => $id_funeraria_registrada, 'Funeraria_Registrada' => $id_funeraria_registrada, 'Nombre' => $request->name, 'Activa' => 'No']);
        $id_detalle = DetallesFuneraria::insertGetId($data);

        event(new Registered($user = $this->create($request->all() + ['activo' => $activo, 'detalle' => $id_detalle, 'funeraria' => $id_funeraria_registrada])));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        $user->assignRole('Funeraria');

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}
