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

    <!-- Reclamo Por solucionar-->
    <div id="popupPorSolucionar" class="modal">
        <!-- Contenido del modal -->
        <div class="modal-content" style="width: 40%">
            <div class="text-center">
                <span class="closeReclamo" onclick="closePopupPorSolucionar()">&times;</span>
            </div>
            <div class="modal-body">
                <p id="idReclamo"></p>
                <div class="form-group" style="text-align: center">
                    <select class="form-control" id="motivoReclamo" style="width: 100%">
                        <option value="1">Motivos de reclamo</option>
                        <option value="2">Mi pedido no ha sido procesado</option>
                    </select>
                </div>
                <div id="info">
                    <p>Para este tipo de reclamo posee tres opciones disponibles. Cúentenos ¿qué desea hacer?</p>
                </div>
                <div id="divChecks">
                </div>
                <div class="mt-5" id="divMensaje">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Escribenos un mensaje (Opcional)</label>
                        <textarea class="form-control" id="comentarioReclamo" rows="3" maxlength="255"></textarea>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary mt-3" id="botonEnviarReclamo" onclick="sendReclamo()" disabled>Enviar
                        reclamo</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Reclamo Entrgado-->
    <div id="popupEntregado" class="modal">
        <!-- Contenido del modal -->
        <div class="modal-content" style="width: 40%">
            <div class="text-center">
                <span class="closeReclamo" onclick="closePopupEntregado()">&times;</span>
            </div>
            <div class="modal-body">
                <p id="idReclamoEntregado"></p>
                <div class="form-group" style="text-align: center">
                    <select class="form-control" id="motivoReclamoEntregado" style="width: 100%">
                        <option value="1">Motivos de reclamo</option>
                        <option value="2">Mi pedido no ha sido procesado</option>
                    </select>
                </div>
                <div id="infoEntregado">
                    <p>Para este tipo de reclamo posee tres opciones disponibles. Cuéntanos, ¿qué deseas hacer?</p>
                </div>
                <div id="divChecksEntregado">
                </div>
                <div class="mt-3" id="divMensajeBeneficiario">
                    <div class="form-group mt-4" style="text-align: center">
                        <div class="custom-file">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary" type="button" id="btnPreview03">
                                    <i class="fas fa-eye-slash"></i>
                                </button>
                            </div>
                            <input type="file" class="custom-file-input" id="adjuntarEstadoCuenta"
                                name="adjuntarEstadoCuenta" onchange="uploadImageAfiliado()">
                            <label class="custom-file-label input-registro" for="adjuntarEstadoCuenta" id="labelFile03"
                                style="text-align: left;">Adjunta
                                estado cuenta</label>
                        </div>
                    </div>
                    <div class="form-group mt-3" style="text-align: center">
                        <select class="form-control" id="afiliadoEntregado" onchange="verificarAfiliado()"
                            style="width: 100%">
                            <option value="0" selected disabled>Beneficiarios afiliados</option>
                        </select>
                        <a href="#" onclick="openPopupBeneficiarioAfiliado()">Añadir Afiliado</a>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="aliasBeneficiario" placeholder="Alias"
                                readonly>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="nombreBeneficiario" placeholder="Nombre"
                                readonly>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="documentoBeneficiario"
                                placeholder="Documento" readonly>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="bancoBeneficiario" placeholder="Banco"
                                readonly>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="cuentaBeneficiario" placeholder="Cuenta"
                                readonly>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="pagoMovilBeneficiario"
                                placeholder="Pago Movil" readonly>
                        </div>
                    </div>
                </div>
                <div class="mt-3" id="divMensajeEntregado">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Escribenos un mensaje (Opcional)</label>
                        <textarea class="form-control" id="comentarioReclamoEntregado" rows="3" maxlength="255"></textarea>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary mt-3" id="botonEnviarReclamoEntregado"
                        onclick="sendReclamoEntregado()" disabled>Enviar
                        reclamo</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Reclamo Entrgado-->
    <div id="popupBeneficiarioAfiliado" class="modal">
        <!-- Contenido del modal -->
        <div class="modal-content" style="width: 40%">
            <div class="text-center">
                <span class="closeReclamo" onclick="closePopupBeneficiarioAfiliado(event)">&times;</span>
            </div>
            <div class="modal-body">
                <form id="formBeneficiarioAfiliado">
                    <div class="form-group">
                        <label for="addAliasBeneficiario">Alias</label>
                        <input type="text" class="form-control" id="addAliasBeneficiario"
                            name="addAliasBeneficiario">
                    </div>
                    <div class="form-group">
                        <label for="addNombreBeneficiario">Nombre</label>
                        <input type="text" class="form-control" id="addNombreBeneficiario"
                            name="addNombreBeneficiario">
                    </div>
                    <div class="form-group">
                        <label for="addDocumentoBeneficiario">Documento</label>
                        <input type="text" class="form-control" id="addDocumentoBeneficiario"
                            name="addDocumentoBeneficiario">
                    </div>
                    <div class="form-group">
                        <label for="addBancoBeneficiario">Banco</label>
                        <input type="text" class="form-control" id="addBancoBeneficiario"
                            name="addBancoBeneficiario">
                    </div>
                    <div class="form-group">
                        <label for="addCuentaBeneficiario">Cuenta</label>
                        <input type="text" class="form-control" id="addCuentaBeneficiario"
                            name="addCuentaBeneficiario">
                    </div>
                    <div class="form-group">
                        <label for="addPagoMovilBeneficiario">Pago Móvil</label>
                        <input type="text" class="form-control" id="addPagoMovilBeneficiario"
                            name="addPagoMovilBeneficiario">
                    </div>
                    <div class="form-group">
                        <label for="addTipoDocumentoBeneficiario">Tipo de Documento</label>
                        <select class="form-control" id="addTipoDocumentoBeneficiario"
                            name="addTipoDocumentoBeneficiario">
                        </select>
                    </div>
                    <div class="text-center">
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <button class="btn btn-primary mt-3" onclick="addTercero('TAF', event)">Guardar</button>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-secondary mt-3" style="border-radius: 25px"
                                    onclick="closePopupBeneficiarioAfiliado(event)">Cerrar</button>
                            </div>
                        </div>
                    </div>

                </form>
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
    <script src="{{ asset('js/envio/input.js') }}"></script>
    <script src="{{ asset('js/envio/historial.js') }}"></script>
@endsection
