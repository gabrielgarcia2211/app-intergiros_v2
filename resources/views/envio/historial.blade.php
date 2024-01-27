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
            <a class="nav-link w-100" id="opcion2-tab" data-toggle="tab" href="#opcion2" role="tab"
                aria-controls="opcion2" aria-selected="false">Por solucionar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link w-100" id="opcion3-tab" data-toggle="tab" href="#opcion3" role="tab"
                aria-controls="opcion3" aria-selected="false">Procesados</a>
        </li>
        <li class="nav-item">
            <a class="nav-link w-100" id="opcion4-tab" data-toggle="tab" href="#opcion4" role="tab"
                aria-controls="opcion4" aria-selected="false">Rechazados</a>
        </li>
    </ul>
    <!-- En proceso -->
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="en_proceso" role="tabpanel" aria-labelledby="en_proceso-tab">
            <div class="seccion mt-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="text-center">
                                <img src="{{ asset('img/notificaciones/proceso.png') }}" class="img-fluid" alt="" width="100px">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-left">
                                        <p style="margin-bottom: 0px;">ID#35167</p>
                                        <p style="color: #0035aa;">Pedido en proceso</p>
                                        <p style="margin-bottom: 0px; color: #009d2c;">Monto pagado</p>
                                        <p style="color: #009d2c;">USD 30</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <p>06/09/2024 1:00pm</p>

                                        <p style="margin-bottom: 0px; color: #009d2c;">Monto a recibir</p>
                                        <p style="color: #009d2c;">301,20 BS.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="#proceso" data-toggle="collapse" style="color: #818181;">
                            <i class="fas fa-chevron-down" id="iconoColapsable1"></i>
                        </a>
                    </div>
                </div>
                <div id="proceso" class="collapse container">
                    <div class="text-center">
                        <p><strong>Su solicitud ha sido rechazada debido a que el pago realizado no figura en nuestra
                                cuenta.</strong></p>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="text-left">
                                <p>Tasa de cambio:</p>
                                <p>Pagado desde:</p>
                                <p>Enviado por:</p>
                                <p>Enviado a:</p>
                                <br><br><br><br>
                                <a class="btn btn-primary">Reclamar</a>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <p>USD 1=10,00 Bs.</p>
                                <p>PayPal</p>
                                <p>Héctor Perez</p>
                                <p>Carlos Matecol</p>
                                <p>V-24555859</p>
                                <p>Banesco</p>
                                <p>A-5164654065165486</p>
                                <p>48794616789</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Por solucionar -->
        <div class="tab-pane fade" id="opcion2" role="tabpanel" aria-labelledby="opcion2-tab">
            <div class="seccion mt-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="text-center">
                                <img src="{{ asset('img/notificaciones/solucionar.png') }}" class="img-fluid" alt="" width="100px">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-left">
                                        <p style="margin-bottom: 0px;">ID#35167</p>
                                        <p style="color: #cf0000;">Datos erróneos del beneficiario</p>
                                        <p style="margin-bottom: 0px; color: #009d2c;">Monto pagado</p>
                                        <p style="color: #009d2c;">USD 30</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <p>06/09/2024 1:00pm</p>

                                        <p style="margin-bottom: 0px; color: #009d2c;">Monto a recibir</p>
                                        <p style="color: #009d2c;">301,20 BS.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="#solucionar" data-toggle="collapse" style="color: #818181;">
                            <i class="fas fa-chevron-down" id="iconoColapsable2"></i>
                        </a>
                    </div>
                </div>
                <div id="solucionar" class="collapse container">
                    <div class="text-center">
                        <p><strong>Su solicitud ha sido rechazada debido a que el pago realizado no figura en nuestra
                                cuenta.</strong></p>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="text-left">
                                <p>Tasa de cambio:</p>
                                <p>Pagado desde:</p>
                                <p>Enviado por:</p>
                                <p>Enviado a:</p>
                                <br><br><br><br>
                                <a class="btn btn-primary">Solucionar</a>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <p>USD 1=10,00 Bs.</p>
                                <p>PayPal</p>
                                <p>Héctor Perez</p>
                                <p>Carlos Matecol</p>
                                <p>V-24555859</p>
                                <p>Banesco</p>
                                <p>A-5164654065165486</p>
                                <p>48794616789</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Procesados -->
        <div class="tab-pane fade" id="opcion3" role="tabpanel" aria-labelledby="opcion3-tab">
            <div class="seccion mt-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="text-center">
                                <img src="{{ asset('img/notificaciones/aprobados.png') }}" class="img-fluid" alt="" width="100px">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-left">
                                        <p style="margin-bottom: 0px;">ID#35167</p>
                                        <p style="color: #0035aa;">Procesado</p>
                                        <p style="margin-bottom: 0px; color: #009d2c;">Monto pagado</p>
                                        <p style="color: #009d2c;">USD 30</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <p>06/09/2024 1:00pm</p>

                                        <p style="margin-bottom: 0px; color: #009d2c;">Monto a recibir</p>
                                        <p style="color: #009d2c;">301,20 BS.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="#procesados" data-toggle="collapse" style="color: #818181;">
                            <i class="fas fa-chevron-down" id="iconoColapsable3"></i>
                        </a>
                    </div>
                </div>
                <div id="procesados" class="collapse container">
                    <div class="text-center">
                        <p><strong>Su solicitud ha sido rechazada debido a que el pago realizado no figura en nuestra
                                cuenta.</strong></p>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="text-left">
                                <p>Tasa de cambio:</p>
                                <p>Pagado desde:</p>
                                <p>Enviado por:</p>
                                <p>Enviado a:</p>
                                <br><br>
                                <a href="#" style="color: #0035aa;" id="openModal">Ver comprobante</a>
                                <br><br>
                                <a class="btn btn-primary" id="openReclamo"> Reclamar </a>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <p>USD 1=10,00 Bs.</p>
                                <p>PayPal</p>
                                <p>Héctor Perez</p>
                                <p>Carlos Matecol</p>
                                <p>V-24555859</p>
                                <p>Banesco</p>
                                <p>A-5164654065165486</p>
                                <p>48794616789</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Rechazados -->
        <div class="tab-pane fade" id="opcion4" role="tabpanel" aria-labelledby="opcion4-tab">
            <div class="seccion mt-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="text-center">
                                <img src="{{ asset('img/notificaciones/rechazados.png') }}" class="img-fluid" alt="" width="100px">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-left">
                                        <p style="margin-bottom: 0px;">ID#35167</p>
                                        <p>Rechazado</p>
                                        <p style="margin-bottom: 0px;">Monto pagado</p>
                                        <p>USD 30</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <p>06/09/2024 1:00pm</p>

                                        <p style="margin-bottom: 0px;">Monto a recibir</p>
                                        <p>301,20 BS.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="#rechazados" data-toggle="collapse" style="color: #818181;">
                            <i class="fas fa-chevron-down" id="iconoColapsable4"></i>
                        </a>
                    </div>
                </div>
                <div id="rechazados" class="collapse container">
                    <div class="text-center">
                        <p><strong>Su solicitud ha sido rechazada debido a que el pago realizado no figura en nuestra
                                cuenta.</strong></p>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="text-left">
                                <p>Tasa de cambio:</p>
                                <p>Pagado desde:</p>
                                <p>Enviado por:</p>
                                <p>Enviado a:</p>
                                <br><br><br><br>
                                <a class="btn btn-primary" id="openContacto">Contáctanos</a>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <p>USD 1=10,00 Bs.</p>
                                <p>PayPal</p>
                                <p>Héctor Perez</p>
                                <p>Carlos Matecol</p>
                                <p>V-24555859</p>
                                <p>Banesco</p>
                                <p>A-5164654065165486</p>
                                <p>48794616789</p>
                            </div>
                        </div>
                    </div>
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
            <span class="closeReclamo">&times;</span>
        </div>
        <div class="container">
            <p><strong>ID#32164</strong></p>
            <div class="form-group">
                <select class="form-control" id="pais">
                    <option value="1">Motivos de reclamo</option>
                    <option value="2">Mi beneficiario no recibió el pago</option>
                    <!-- Agrega más opciones aquí -->
                </select>

                <div class="text-center">
                    <button class="btn btn-primary mt-5">Enviar reclamo</button>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br><br><br><br>

<!-- FOOTER -->
@include('layouts.footer')

@endsection

@section('script')
    <script src="{{ asset('js/envio/historial.js') }}"></script>
@endsection