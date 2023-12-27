@extends('layouts.css-pago')

@section('content')
    
<div class="container mt-5">
        <div class="text-center">
            <h3><strong>SOLICITUD DE SERVICIOS</strong></h3>
        </div>
        <div class="text-center mt-5">
            <div class="table-responsive">
                <table class="table table-borderless" id="tablaProductos">
                </table>
            </div>
        </div>
        <div class="mt-5">
            <div class="row no-gutters">
                <div class="col-6 col-md-8" style="text-align: right;">
                    <p><strong>Subtotal</strong></p>
                    <p><strong>Comisiones</strong></p>
                    <p><strong>TOTAL</strong></p>
                </div>
                <div class="col-6 col-md-4" style="text-align: right;">
                    <p>$ <strong><span id="monto_a_pagar"style="display: inline-block">0.00</span> USD</strong></p>
                    <p>$ <strong><span id="monto_comision"style="display: inline-block">0.00</span> USD</strong></p>
                    <p>$ <strong><span id="monto_total"style="display: inline-block">0.00</span> USD</strong></p>
                </div>
            </div>
        </div>
        <div class="mt-5">
            <h4><strong>Datos del contratante</strong></h4>
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control input-registro" id="nombre" placeholder="Nombre"
                            disabled>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <select class="form-control input-indicativo" id="tipoDocumentoPago"
                                    disabled>
                                </select>
                            </div>
                            <input type="number" class="form-control input-telefono miInput1"
                                id="numeroDocumento" placeholder="Número documento" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control input-registro" id="email" placeholder="Email" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" style="margin-bottom: 16px;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <select class="form-control input-indicativo" id="paisTelefonoPago" disabled>
                                </select>
                            </div>
                            <input type="number" class="form-control input-telefono" id="telefono"
                                placeholder="Número celular" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="form-control input-registro" id="paisPago" disabled>
                            <!-- Agrega más opciones aquí -->
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-justify mt-5">
            <p>Será redirigido a la página de pago de Paypal una vez dé clic en el botón <strong>"Realizar
                    pago".</strong> Después de completar su pago, será redirigido a nuestro sitio para completar el
                envío.</p>
        </div>
        <div class="text-center mt-5 boton">
            <button type="submit" class="btn btn-primary mb-2" onclick="sendPaytoPaypal()"><strong>Realizar pago</strong></button>
        </div>
    </div>

    <br><br><br>

@endsection

@section('script')
    <script src="{{ asset('js/pagos/input.js') }}"></script>
    <script src="{{ asset('js/pagos/index.js') }}"></script>
@endsection
