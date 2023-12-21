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

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <!-- DevExtreme -->
    <link rel="stylesheet" href="{{ asset('libraries/css/dx.light.css') }}">

    <style>
        th {
            font-size: 20px;
            font-family: 'Lato', sans-serif !important;
        }

        td {
            font-size: 20px;
            font-family: 'Lato', sans-serif !important;
        }

        .input-registro {
            border-radius: 25px;
            font-size: 20px;
            font-family: 'Lato', sans-serif !important;
        }

        .input-indicativo {
            border-bottom-left-radius: 25px;
            border-top-left-radius: 25px;
            font-size: 20px;
            font-family: 'Lato', sans-serif !important;
        }

        .input-telefono {
            border-bottom-right-radius: 25px;
            border-top-right-radius: 25px;
            font-size: 20px;
            font-family: 'Lato', sans-serif !important;
        }

        p,h3,h4 {
            font-family: 'Lato', sans-serif !important;
        }

        p {
            font-size: 20px;
        }

        .boton>button {
            background-color: #e99700;
            border-color: #e99700;
            font-size: 20px;
            border-radius: 25px;
            width: 20%;
            font-family: 'Lato', sans-serif !important;
        }

        .boton>button:hover {
            background-color: #eba422;
            border-color: #eba422;
        }
		
		body {
			background-color: #fcf9ea;
		}
    </style>

</head>

<body>
    <div id="app">
        <main class="">
            @yield('content')
        </main>
    </div>

    <!-- DevExtreme -->
    <script type="text/javascript" src="{{ asset('libraries/js/axios.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('libraries/js/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>

    <script src="{{ asset('js/general/index.js') }}"></script>
    @yield('script')

</body>

</html>
