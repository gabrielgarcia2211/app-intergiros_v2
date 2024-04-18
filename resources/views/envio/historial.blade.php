@extends('layouts.css-historial')

@section('content')
    <menu-component :home="'{{ route('home') }}'" :servicio="'{{ route('servicios.index') }}'"
        :usuario="'{{ Auth::user()->name }}'" :verificado="{{ Auth::user()->verificado }}"
        :notificacion="'{{ route('notificaciones.index') }}'" :perfil="'{{ route('perfil') }}'"
        :historial="'{{ route('historial') }}'" :logout="'{{ route('logout') }}'">
    </menu-component>
    <historial-component></historial-component>
    <!-- FOOTER -->
@endsection

@section('script')
@endsection
