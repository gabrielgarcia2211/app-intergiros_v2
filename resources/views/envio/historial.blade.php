@include('layouts.nav-user')
@extends('layouts.css-historial')

@section('content')
    <div class="container notificaciones">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active w-100" id="en_proceso-tab" data-toggle="tab" href="#en_proceso" role="tab"
                    aria-controls="en_proceso" aria-selected="true">En proceso</a>
            </li>
            <li class="nav-item">
                <a class="nav-link w-100" id="pendiente-tab" data-toggle="tab" href="#pendiente" role="tab"
                    aria-controls="pendiente" aria-selected="false">Por solucionar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link w-100" id="entregado-tab" data-toggle="tab" href="#entregado" role="tab"
                    aria-controls="entregado" aria-selected="false">Procesados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link w-100" id="cancelado-tab" data-toggle="tab" href="#cancelado" role="tab"
                    aria-controls="cancelado" aria-selected="false">Rechazados</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <!-- En proceso -->
            <div class="tab-pane fade show active" id="en_proceso" role="tabpanel" aria-labelledby="en_proceso-tab">
                <div class="seccion mt-5" id="content_en_proceso">
                    <div class="d-flex align-items-center justify-content-center mt-4">
                        <img src="{{ asset('img/notificaciones/Sin mensajes.png') }}"
                            class="img-fluid sinMsjNotificacionEnProceso" alt="" width="400px"
                            style="display: none">
                    </div>
                </div>
            </div>
            <!-- Por solucionar -->
            <div class="tab-pane fade" id="pendiente" role="tabpanel" aria-labelledby="pendiente-tab">
                <div class="seccion mt-5" id="content_pendiente">
                    <div class="d-flex align-items-center justify-content-center mt-4">
                        <img src="{{ asset('img/notificaciones/Sin mensajes.png') }}"
                            class="img-fluid sinMsjNotificacionPendiente" alt="" width="400px"
                            style="display: none">
                    </div>
                </div>
            </div>
            <!-- Procesados -->
            <div class="tab-pane fade" id="entregado" role="tabpanel" aria-labelledby="entregado-tab">
                <div class="seccion mt-5" id="content_entregado">
                    <div class="d-flex align-items-center justify-content-center mt-4">
                        <img src="{{ asset('img/notificaciones/Sin mensajes.png') }}"
                            class="img-fluid sinMsjNotificacionEntregado" alt="" width="400px"
                            style="display: none">
                    </div>
                </div>
            </div>
            <!-- Rechazados -->
            <div class="tab-pane fade" id="cancelado" role="tabpanel" aria-labelledby="cancelado-tab">
                <div class="seccion mt-5" id="content_cancelado">
                    <div class="d-flex align-items-center justify-content-center mt-4">
                        <img src="{{ asset('img/notificaciones/Sin mensajes.png') }}"
                            class="img-fluid sinMsjNotificacionCancelado" alt="" width="400px"
                            style="display: none">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ver comprobante -->
    <div id="myModal" class="modal">
        <!-- Contenido del modal -->
        <div class="modal-content">
            <div class="text-center">
                <span class="close">&times;</span>
            </div>
            <div class="text-center">
                <img src="{{ asset('img/home/noticias.png') }}" alt="" class="img-fluid" width="500px">
            </div>
            <div class="text-center">
                <a href="#" class="btn btn-primary">Descargar</a>
                <a href="#" class="btn btn-primary">Imprimir</a>
            </div>
        </div>
    </div>

    <!-- Contactanos -->
    <div id="myContacto" class="modal">
        <!-- Contenido del modal -->
        <div class="modal-content">
            <div class="text-center">
                <span class="closeContacto">&times;</span>
            </div>
            <div class="text-center">
                <a href="#" class="btn btn-primary">Facebook</a>
                <a href="#" class="btn btn-primary">Instagram</a>
            </div>
        </div>
    </div>

    <!-- Reclamo -->
    <div id="myReclamo" class="modal">
        <!-- Contenido del modal -->
        <div class="modal-content">
            <div class="text-center">
                <span class="closeReclamo" onclick="closeReclamo()">&times;</span>
            </div>
            <div class="modal-body">
                <div class="container">
                    <p id="idReclamo"></p>
                    <div class="form-group">
                        <select class="form-control">
                            <option value="1">Motivos de reclamo</option>
                            <option value="2">Mi beneficiario no recibió el pago</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="comentarioReclamo">Comentario</label>
                        <textarea class="form-control" id="comentarioReclamo" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <button class="btn btn-primary">Enviar reclamo</button>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br><br>

    <!-- FOOTER -->
    @include('layouts.footer')

    <style>
        .modal {
            z-index: 1050;
        }
    </style>
@endsection

@section('script')
    <script src="{{ asset('js/envio/historial.js') }}"></script>
@endsection
