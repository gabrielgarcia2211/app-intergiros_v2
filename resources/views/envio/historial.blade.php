@extends('layouts.css-historial')

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
    <historial-component></historial-component>
    <!-- FOOTER -->
    <br><br><br><br><br>
    <!-- FOOTER -->
    @include('layouts.footer')
@endsection

@section('script')
@endsection
