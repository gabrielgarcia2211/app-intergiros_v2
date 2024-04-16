<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link href="{{ asset('css/perfil.css') }}" rel="stylesheet" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="/home">
                    <img src="{{ asset('img/Logo3-5.png') }}" alt="Logo" class="navbar-logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('servicios.index') }}">Servicios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Tasas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Noticias</a>
                        </li>
                        <li class="nav-item dropdown" id="child5">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                aria-expanded="false">
                                {{ Auth::user()->name }} 
                                 @if(Auth()->user()->verificado)
                                    <img src="{{ asset('img/perfil/verificado.png') }}" alt="" width="20px">
                                @endif
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('perfil') }}"><i class="fas fa-user"></i> Mi Perfil</a>
                                <a class="dropdown-item" href="{{ route('historial') }}"><i class="fas fa-coins"></i> Panel de envíos</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i>
                                    Cerrar sesion</a>
                            </div>
                        </li>
                        <li class="nav-item" id="child6">
                            <a class="nav-link" href="{{ route('notificaciones.index') }}"><i class="fas fa-comment-dots"></i><span id="pointPadre" class="notification-badge" style="display: none"></a>
                        </li>
                        <li class="nav-item" id="child7">
                            <a class="nav-link" href="#"><i class="fab fa-instagram"></i></a>
                        </li>
                        <li class="nav-item" id="child8">
                            <a class="nav-link" href="#"><i class="fab fa-facebook"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="">
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/general/index.js') }}"></script>
    <script src="{{ asset('js/navbar/index.js') }}"></script>
    @yield('script')

</body>

</html>
