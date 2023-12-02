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
    <link href="{{ asset('css/home.css') }}" rel="stylesheet" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <!-- DevExtreme -->
    <link rel="stylesheet" href="{{ asset('libraries/css/dx.light.css') }}">

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('img/Logo3-5.png') }}" alt="Logo" class="navbar-logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Servicios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Tasas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Noticias</a>
                        </li>
                        <li class="nav-item" id="child5">
                            <a class="nav-link" href="{{ asset('login') }}">Inicia Sesión</a>
                        </li>
                        <li class="nav-item" id="child6">
                            <a class="nav-link" href="{{ asset('registro') }}">Regístrate</a>
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

    <!-- DevExtreme -->
    <script type="text/javascript" src="{{ asset('libraries/js/axios.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('libraries/js/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"></script>

    <script src="{{ asset('js/general/index.js') }}"></script>
    <script src="{{ asset('js/home/index.js') }}"></script>
    @yield('script')

</body>

</html>
