<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    UM-Funerarias
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @role('Agente')
                                <li class="nav-item">
                                    <a href="/Casos/vistaCrear" class="nav-link active">Nuevo caso</a>
                                </li>
                            @endrole
                            @role('Personal')
                                <li class="nav-item">
                                    <a href="/Casos/ver" class="nav-link {{ (request()->is('Casos*')) ? 'active' : '' }}">Ver Casos</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/Personal/Funerarias/ver" class="nav-link {{ (request()->is('Personal/Funerarias*')) ? 'active' : '' }}"><span> Funerarias </span><i class="fa fa-users"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a href="/Personal/Reportes/ver" class="nav-link {{ (request()->is('Personal/Reportes*')) ? 'active' : '' }}"><span> Reportes </span><i class="fa fa-file"></i></a>
                                </li>
                            @endrole
                            @role('Funeraria')
                            <li class="nav-item">
                                <a href="/Funerarias/Casos/ver" class="nav-link {{ (request()->is('Funerarias/Casos*')) ? 'active' : '' }}">Ver Casos</a>
                            </li>
                            <li class="nav-item">
                                <span> _ </span>
                            </li>
                            <li class="nav-item">
                                <a href="/Funerarias/Descargas" class="nav-link {{ (request()->is('Funerarias/Descargas*')) ? 'active' : '' }}">Portal de Descargas</a>
                            </li>
                            @endrole
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
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
</body>
</html>
