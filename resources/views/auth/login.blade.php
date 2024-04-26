@extends('layouts.app')

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
    <login-component></login-component>
    <br><br><br><br><br><br><br><br><br>
    <!-- FOOTER -->
    @include('layouts.footer')
@endsection

<style>
    .error {
        color: red;
    }

    .invalid-feedback {
        display: block;
        width: 100%;
        margin-top: .25rem;
    }
</style>
