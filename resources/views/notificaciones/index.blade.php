@extends('layouts.css-noticias')

@section('content')

@if (Auth::check())
        <menu-component :home="'{{ route('home') }}'" :servicio="'{{ route('servicios.index') }}'"
            :usuario="'{{ Auth::user()->name }}'" :verificado="{{ !Auth::user()->verificado }}"
            :notificacion="'{{ route('notificaciones.index') }}'" :perfil="'{{ route('perfil') }}'"
            :historial="'{{ route('historial') }}'" :logout="'{{ route('logout') }}'">
        </menu-component>
    @else
        <menu-component :home="'{{ route('home') }}'" :servicio="'{{ route('servicios.index') }}'"
            :notificacion="'{{ route('notificaciones.index') }}'" :registro="'{{ route('registro') }}'"
            :login="'{{ route('login') }}'">
        </menu-component>
    @endif

    <div class="container notificaciones">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active w-100" id="opcion1-tab" data-toggle="tab" href="#opcion1" role="tab"
                    aria-controls="opcion1" aria-selected="true" style="color: #0035aa !important;">Solicitudes<span
                        id="pointNotificacion" class="notification-badge" style="display: none"></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link w-100" id="opcion2-tab" data-toggle="tab" href="#opcion2" role="tab"
                    aria-controls="opcion2" aria-selected="false" style="color: #0035aa !important;">Noticias<span
                        id="pointNoticias" class="notification-badge" style="display: none"></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link w-100" id="opcion3-tab" data-toggle="tab" href="#opcion3" role="tab"
                    aria-controls="opcion3" aria-selected="false" style="color: #0035aa !important;">Promociones</span></a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="opcion1" role="tabpanel" aria-labelledby="opcion1-tab">
                <div class="seccion mt-5">
                    <div id="nuevasNotificaciones" style="display:none" class="mt-3">
                        <div class="text-center">
                            <h4 style="color: #0035aa;">Nuevas notificaciones</h4>
                        </div>
                    </div>
                    <div id="anterioresNotificaciones" style="margin-top: 5%;display:none">
                        <div class="text-center">
                            <h4 style="color: #0035aa;">Notificaciones anteriores</h4>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center mt-4">
                        <img src="{{ asset('img/notificaciones/Sin mensajes.png') }}" class="img-fluid sinMsjNotificacion"
                            alt="" width="400px">
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="opcion2" role="tabpanel" aria-labelledby="opcion2-tab">
                <div class="seccion mt-5">
                    <div id="nuevasNoticias" style="display:none" class="mt-3">
                        <div class="text-center">
                            <h4 style="color: #0035aa;">Nuevas notificaciones</h4>
                        </div>
                    </div>
                    <div id="anterioresNoticias" style="display:none" class="mt-3">
                        <div class="text-center">
                            <h4 style="color: #575757;">Notificaciones anteriores</h4>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center mt-4">
                        <img src="{{ asset('img/notificaciones/Sin mensajes.png') }}" class="img-fluid sinMsjNoticias"
                            alt="" width="400px">
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="opcion3" role="tabpanel" aria-labelledby="opcion3-tab">
                <div class="d-flex align-items-center justify-content-center mt-4">
                    <img src="{{ asset('img/notificaciones/Sin mensajes.png') }}" class="img-fluid" alt=""
                        width="400px">
                </div>
            </div>
        </div>
    </div>

    <br><br><br><br><br>

    <!-- FOOTER -->
    @include('layouts.footer')


    <style>
        .error {
            color: red;
        }
    </style>
@endsection

@section('script')
    <script src="{{ asset('js/notificaciones/index.js') }}"></script>
@endsection
