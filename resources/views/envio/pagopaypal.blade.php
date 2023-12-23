@extends('layouts.css-pago')

@section('content')
    
<div class="container mt-5">
        <div class="text-center">
            <h3><strong>SOLICITUD DE SERVICIOS</strong></h3>
        </div>
        <div class="text-center mt-5">
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead style="background-color: #e99700; color: white;">
                        <tr>
                            <th scope="col"><strong>Cantidad</strong></th>
                            <th scope="col"><strong>Servicio</strong></th>
                            <th scope="col"><strong>Costo</strong></th>
                            <th scope="col"><strong>Total</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Juan Pérez</td>
                            <td>juan@example.com</td>
                            <td>nnn</td>
                        </tr>
                    </tbody>
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
                    <p><strong>$10 USD</strong></p>
                    <p><strong>$0,89 USD</strong></p>
                    <p><strong>$10,89 USD</strong></p>
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
                                <select class="form-control input-indicativo" id="paypalTipoDocumentoBeneficiario"
                                    disabled>
                                    <option value="1">T</option>
                                    <option value="2">CC</option>
                                    <option value="3">A</option>
                                    <!-- Agrega más opciones aquí -->
                                </select>
                            </div>
                            <input type="number" class="form-control input-telefono miInput1"
                                id="paypalDocumentoBeneficiario" placeholder="Número documento" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control input-registro" id="email" placeholder="Email" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group style=" margin-bottom: 16px;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <select class="form-control input-indicativo" id="paisTelefono" disabled>
                                    <option value="1">+57</option>
                                    <option value="2">+58</option>
                                    <option value="3">+51</option>
                                    <!-- Agrega más opciones aquí -->
                                </select>
                            </div>
                            <input type="number" class="form-control input-telefono" id="telefono"
                                placeholder="Número celular" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="form-control input-registro" id="pais" disabled>
                            <option value="1">País</option>
                            <option value="2">Colombia</option>
                            <option value="3">Venezuela</option>
                            <option value="3">Perú</option>
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
            <button type="submit" class="btn btn-primary mb-2"><strong>Realizar pago</strong></button>
        </div>
    </div>

    <br><br><br>

@endsection

@section('script')
    <script src="{{ asset('js/pagos/index.js') }}"></script>
@endsection
