@extends('layouts.css-envios')

@section('content')
    @if (Auth::check())
        <menu-component :home="'{{ route('home') }}'" :servicio="'{{ route('servicios.index') }}'"
            :usuario="'{{ Auth::user()->name }}'" :verificado="{{ Auth::user()->verificado }}"
            :notificacion="'{{ route('notificaciones.index') }}'" :perfil="'{{ route('perfil') }}'"
            :historial="'{{ route('historial') }}'" :logout="'{{ route('logout') }}'">
        </menu-component>
    @else
        <menu-component :home="'{{ route('home') }}'" :servicio="'{{ route('servicios.index') }}'"
            :notificacion="'{{ route('notificaciones.index') }}'" :registro="'{{ route('registro') }}'"
            :login="'{{ route('login') }}'">
        </menu-component>
    @endif
    <div class="text-center mt-5">
        <h1><strong>¡Hola {{ Auth::user()->name }}!</strong></h1>
    </div>
    <div class="text-center mt-5">
        <button class="btn btn-primary" type="button" id="tasas-venezuela">Tasas para cambios a Venezuela</button>
    </div>
    <carousel-component class="mt-5 mb-5"></carousel-component>

    <div class="text-center mt-5">
        @if (Auth::user()->verificado == 1)
            <h3><strong>¡Solicita tu pedido aquí!</strong></h3>
        @else
            <h3 style="color: red; margin-bottom: 200px"><strong>¡Debes verificarte primero para acceder a los paneles de
                    envio!</strong></h3>
        @endif
    </div>
    @if (Auth::user()->verificado == 1)
        <servicio-component></servicio-component>
    @endif
    <!-- FOOTER -->
    @include('layouts.footer')
@endsection
