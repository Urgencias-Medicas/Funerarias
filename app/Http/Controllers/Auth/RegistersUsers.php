<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DetallesFuneraria;

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
        $data = ['paso_uno' => 'No', 'paso_dos' => 'No', 'paso_tres' => 'No'];
        $id_detalle = DetallesFuneraria::insertGetId($data);

        event(new Registered($user = $this->create($request->all() + ['activo' => $activo, 'detalle' => $id_detalle])));


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
