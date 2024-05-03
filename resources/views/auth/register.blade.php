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
<registro-component></registro-component>

<br><br><br><br><br>
<!-- FOOTER -->
@include('layouts.footer')
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="text-center">
                    <i class="fas fa-bell fa-3x"></i>
                </div>
            </div>
            <div class="modal-body">
                Si omites este paso ahora, podrás completarlo en otro memonto, crear tu usuario y acceder a él,
                <strong>pero no podrás realizar pedidos</strong>
            </div>
            <div class="modal-footer">
                <div id="btn_omitirValidacion"></div>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Ir atrás</button>
            </div>
        </div>
    </div>
</div>
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