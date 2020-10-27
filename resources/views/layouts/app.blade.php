<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>UMFunerarias</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">

</head>

<body>
    <div id="app">
        <nav class="navbar-expand-md navbar navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    UMFunerarias
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <!--@if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif -->
                        @else
                        @role('Agente')
                        <li class="nav-item">
                            <a href="/Casos/vistaCrear" class="nav-link active">Nuevo caso</a>
                        </li>
                        @endrole
                        @role('Personal')

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Usuarios
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/Personal/verUsuarios">Ver usuarios</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/Personal/CrearUsuario"
                                    class="nav-link {{ (request()->is('Personal/CrearUsuario*')) ? 'active' : '' }}">Crear
                                    Usuario</a>
                                <a class="dropdown-item" href="/Personal/CrearFuneraria"
                                    class="nav-link {{ (request()->is('Personal/CrearFuneraria*')) ? 'active' : '' }}">Crear
                                    Funeraria</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="/Casos/ver"
                                class="nav-link {{ (request()->is('Casos*')) ? 'active' : '' }}">Casos</a>
                        </li>
                        <li class="nav-item">
                            <a href="/Personal/Funerarias/ver"
                                class="nav-link {{ (request()->is('Personal/Funerarias*')) ? 'active' : '' }}"><span>
                                    Funerarias </span></a>
                        </li>
                        <li class="nav-item">
                            <a href="/Personal/Reportes/ver"
                                class="nav-link {{ (request()->is('Personal/Reportes*')) ? 'active' : '' }}"><span>
                                    Reportes </span></a>
                        </li>
                        @endrole
                        @role('Funeraria')
                        <li class="nav-item">
                            <a href="/Funerarias/Casos/ver"
                                class="nav-link {{ (request()->is('Funerarias/Casos*')) ? 'active' : '' }}">Casos</a>
                        </li>
                        <li class="nav-item">
                            <a href="/Funerarias/Descargas"
                                class="nav-link {{ (request()->is('Funerarias/Descargas*')) ? 'active' : '' }}">Descargas</a>
                        </li>
                        @endrole
                        @php
                        $contador = 0
                        @endphp
                        @foreach($Notificaciones_head as $Notificacion)
                        @role('Funeraria')
                        @if($Notificacion->funeraria == $user->funeraria)

                        @php
                        $contador = $contador + 1
                        @endphp

                        @endif
                        @endrole
                        @role('Personal')
                        @if($Notificacion->funeraria === NULL)

                        @php
                        $contador = $contador + 1
                        @endphp

                        @endif
                        @endrole
                        @endforeach
                        @role('Funeraria|Personal')
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span id="contadorNotificaciones"
                                    class="badge badge-pill badge-danger">{{$contador}}</span> Notificaciones
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @php
                                $contandor = 0
                                @endphp
                                @foreach($Notificaciones_head as $Notificacion)
                                @role('Funeraria')
                                @if($Notificacion->funeraria == $user->funeraria)
                                <span class="dropdown-item" id="Notificacion-{{$Notificacion->id}}"><span
                                        class="fa fa-times-circle"
                                        onclick="quitarNotificacion({{$Notificacion->id}})"></span><a
                                        href="/Funerarias/Casos/{{$Notificacion->caso}}/ver"
                                        style="text-decoration: none;"> {{$Notificacion->contenido}}
                                    </a></span>
                                @endif
                                @endrole
                                @role('Personal')
                                @if($Notificacion->funeraria === NULL)
                                <span class="dropdown-item" id="Notificacion-{{$Notificacion->id}}"><span
                                        class="fa fa-times-circle"
                                        onclick="quitarNotificacion({{$Notificacion->id}})"></span><a
                                        href="/Casos/{{$Notificacion->caso}}/ver" style="text-decoration: none;">
                                        {{$Notificacion->contenido}}
                                    </a></span>
                                @endif
                                @endrole
                                @endforeach
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-center" href="/Notificaciones">
                                    Ver todo
                                </a>
                            </div>
                        </li>
                        @endrole
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script>
        function quitarNotificacion(id) {
            $.ajax({
                url: "/Notificacion/" + id + "/quitar/",
                type: 'get',
                success: function (response) {
                    $('#Notificacion-' + id).remove();
                    var cant_Notificaciones = $('#contadorNotificaciones').text();
                    $('#contadorNotificaciones').text(cant_Notificaciones - 1);
                }
            });
        }

    </script>
</body>
<footer class="text-center my-3">
    Excess, S.A. | Urgencias Medicas, S.A.
</footer>

</html>
