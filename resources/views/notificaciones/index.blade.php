@include('layouts.nav-user')

@extends('layouts.css-noticias')

@section('content')
    <div class="container notificaciones">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active w-100" id="opcion1-tab" data-toggle="tab" href="#opcion1" role="tab"
                    aria-controls="opcion1" aria-selected="true" style="color: #0035aa !important;">Solicitudes<span
                        class="notification-badge"></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link w-100" id="opcion2-tab" data-toggle="tab" href="#opcion2" role="tab"
                    aria-controls="opcion2" aria-selected="false" style="color: #0035aa !important;">Noticias<span
                        class="notification-badge"></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link w-100" id="opcion3-tab" data-toggle="tab" href="#opcion3" role="tab"
                    aria-controls="opcion3" aria-selected="false" style="color: #0035aa !important;">Promociones</span></a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="opcion1" role="tabpanel" aria-labelledby="opcion1-tab">
                <div class="seccion mt-5">
                    <div id="nuevas-notificaciones" class="mt-3">
                        <div class="text-center">
                            <h4 style="color: #0035aa;">Nuevas notificaciones</h4>
                        </div>
                    </div>
                    <div id="anteriores-notificaciones" style="margin-top: 10%">
                        <div class="text-center">
                            <h4 style="color: #523f3f;">Notificaciones anteriores</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="opcion2" role="tabpanel" aria-labelledby="opcion2-tab">
                <div class="seccion mt-5">
                    <div class="text-center">
                        <h4 style="color: #0035aa;">Nuevas notificaciones</h4>
                    </div>
                    <div class="mt-3">
                        <div class="text-right">
                            Fecha <i class="fas fa-trash-alt"></i>
                        </div>
                        <h5>Titulo</h5>
                        <h5>Referencia</h5>
                        <p>Texto</p>
                    </div>
                    <div class="mt-3">
                        <div class="text-right">
                            Fecha <i class="fas fa-trash-alt"></i>
                        </div>
                        <h5>Titulo</h5>
                        <h5>Referencia</h5>
                        <p>Texto</p>
                    </div>
                    <div class="text-center">
                        <h4 style="color: #575757;">Notificaciones anteriores</h4>
                    </div>
                    <div class="mt-3">
                        <div class="text-right">
                            Fecha <i class="fas fa-trash-alt"></i>
                        </div>
                        <h5>Titulo</h5>
                        <h5>Referencia</h5>
                        <p>Texto</p>
                    </div>
                    <div class="mt-3">
                        <div class="text-right">
                            Fecha <i class="fas fa-trash-alt"></i>
                        </div>
                        <h5>Titulo</h5>
                        <h5>Referencia</h5>
                        <p>Texto</p>
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
