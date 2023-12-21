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

    <!-- DevExtreme -->
    <link rel="stylesheet" href="{{ asset('libraries/css/dx.light.css') }}">

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
                            <a class="nav-link" href="{{ route('servicios') }}">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('servicios') }}">Servicios</a>
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
                                Nombre Usuario <img src="{{ asset('img/perfil/verificado.png') }}" alt=""
                                    width="20px">
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('perfil') }}"><i class="fas fa-user"></i> Mi Perfil</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-coins"></i> Panel de envíos</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i>
                                    Cerrar sesion</a>
                            </div>
                        </li>
                        <li class="nav-item" id="child6">
                            <a class="nav-link" href="{{ route('notificaciones') }}"><i class="fas fa-comment-dots"></i></a>
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

        <style>
            h4 {
                color: #0035aa;
            }

            p {
                font-family: 'Lato', sans-serif !important;
            }

            /*  CSS MENU */
            .nav-bar {
                background-color: white !important;
            }

            .navbar-nav {
                display: flex !important;
                align-items: center !important;
            }

            .navbar-logo {
                max-width: 150px !important;
            }

            .navbar-nav .nav-link {
                color: black !important;
                font-family: 'Lato', sans-serif !important;
            }

            .navbar-nav .nav-link:hover {
                color: #414141 !important;
            }

            .navbar-nav #child5 .nav-link {
                color: white !important; 
                background-color: #009d2c !important; 
                border-radius: 20px !important; 
                padding: 5px 15px !important; 
            }

            .navbar-nav  #child5 .nav-link:hover {
                background-color: #02c73a !important;
            }

            .navbar-nav #child6 .nav-link, .navbar-nav #child7 .nav-link, .navbar-nav #child8 .nav-link {
                font-size: 24px !important;
            }

            .dropdown-item {
                color: #000000 !important;
            }
            /* FIN CSS MENU */

        </style>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

    <script src="{{ asset('js/general/index.js') }}"></script>
    @yield('script')

</body>

</html>
