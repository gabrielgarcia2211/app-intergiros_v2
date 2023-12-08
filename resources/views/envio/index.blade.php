@extends('layouts.css-perfil')

@section('content')

<div class="text-center mt-5">
        <h1><strong>¡Hola Usuario!</strong></h1>
    </div>
    <div class="text-center mt-5">
        <button class="btn btn-primary" type="button" id="tasas-venezuela">Tasas para cambios a Venezuela</button>
    </div>
    <div class="text-center mt-5" id="slide-tasas">
        <div class="container">
            <div id="myCarousel" class="carousel slide" data-ride="carousel"
                style="padding-top: 45px; padding-bottom: 30px;">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="card bg-transparent">
                                    <img src="{{ asset('img/home/TDC Intergiros - Skrill.png') }}" class="img-fluid" alt="">
                                    <div class="text-center mt-5">
                                        <h5><strong>Todos los bancos</strong></h5>
                                        <h5><strong>1 USD=31,00 BS.</strong></h5>
                                    </div>
                                </div>
                            </div>
                            <!-- Repite este bloque para cada tarjeta -->
                            <div class="col-12 col-md-4">
                                <div class="card bg-transparent">
                                    <img src="{{ asset('img/home/TDC Intergiros - PayPal.png') }}" class="img-fluid" alt="">
                                    <div class="text-center mt-5">
                                        <h5><strong>Banesco</strong></h5>
                                        <h5><strong>1 USD=31,03 BS.</strong></h5>
                                        <h5><strong>Otros bancos</strong></h5>
                                        <h5><strong>1 USD=31,00 BS.</strong></h5>
                                    </div>
                                </div>
                            </div>
                            <!-- Repite este bloque para cada tarjeta -->
                            <div class="col-12 col-md-4">
                                <div class="card bg-transparent">
                                    <img src="{{ asset('img/home/TDC Intergiros - Bitcoin.png') }}" class="img-fluid" alt="">
                                    <div class="text-center mt-5">
                                        <h5><strong>Todos los bancos</strong></h5>
                                        <h5><strong>1 USD=31,00 BS.</strong></h5>
                                    </div>
                                </div>
                            </div>
                            <!-- Repite este bloque para cada grupo de 3 tarjetas -->
                            <!-- Puedes añadir más tarjetas según sea necesario -->
                        </div>
                    </div>
                    <!-- Repite este bloque para cada grupo de 3 tarjetas -->
                    <div class="carousel-item">
                        <div class="row">
                        <div class="col-12 col-md-4">
                                <div class="card bg-transparent">
                                    <img src="{{ asset('img/home/TDC Intergiros - Skrill.png') }}" class="img-fluid" alt="">
                                    <div class="text-center mt-5">
                                        <h5><strong>Todos los bancos</strong></h5>
                                        <h5><strong>1 USD=31,00 BS.</strong></h5>
                                    </div>
                                </div>
                            </div>
                            <!-- Repite este bloque para cada tarjeta -->
                            <div class="col-12 col-md-4">
                                <div class="card bg-transparent">
                                    <img src="{{ asset('img/home/TDC Intergiros - PayPal.png') }}" class="img-fluid" alt="">
                                    <div class="text-center mt-5">
                                        <h5><strong>Banesco</strong></h5>
                                        <h5><strong>1 USD=31,03 BS.</strong></h5>
                                        <h5><strong>Otros bancos</strong></h5>
                                        <h5><strong>1 USD=31,00 BS.</strong></h5>
                                    </div>
                                </div>
                            </div>
                            <!-- Repite este bloque para cada tarjeta -->
                            <div class="col-12 col-md-4">
                                <div class="card bg-transparent">
                                    <img src="{{ asset('img/home/TDC Intergiros - Bitcoin.png') }}" class="img-fluid" alt="">
                                    <div class="text-center mt-5">
                                        <h5><strong>Todos los bancos</strong></h5>
                                        <h5><strong>1 USD=31,00 BS.</strong></h5>
                                    </div>
                                </div>
                            </div>
                            <!-- Repite este bloque para cada grupo de 3 tarjetas -->
                            <!-- Puedes añadir más tarjetas según sea necesario -->
                        </div>
                    </div>
                    <!-- Repite este bloque para cada grupo de 3 tarjetas -->
                    <div class="carousel-item">
                        <div class="row">
                        <div class="col-12 col-md-4">
                                <div class="card bg-transparent">
                                    <img src="{{ asset('img/home/TDC Intergiros - Skrill.png') }}" class="img-fluid" alt="">
                                    <div class="text-center mt-5">
                                        <h5><strong>Todos los bancos</strong></h5>
                                        <h5><strong>1 USD=31,00 BS.</strong></h5>
                                    </div>
                                </div>
                            </div>
                            <!-- Repite este bloque para cada tarjeta -->
                            <div class="col-12 col-md-4">
                                <div class="card bg-transparent">
                                    <img src="{{ asset('img/home/TDC Intergiros - PayPal.png') }}" class="img-fluid" alt="">
                                    <div class="text-center mt-5">
                                        <h5><strong>Banesco</strong></h5>
                                        <h5><strong>1 USD=31,03 BS.</strong></h5>
                                        <h5><strong>Otros bancos</strong></h5>
                                        <h5><strong>1 USD=31,00 BS.</strong></h5>
                                    </div>
                                </div>
                            </div>
                            <!-- Repite este bloque para cada tarjeta -->
                            <div class="col-12 col-md-4">
                                <div class="card bg-transparent">
                                    <img src="{{ asset('img/home/TDC Intergiros - Bitcoin.png') }}" class="img-fluid" alt="">
                                    <div class="text-center mt-5">
                                        <h5><strong>Todos los bancos</strong></h5>
                                        <h5><strong>1 USD=31,00 BS.</strong></h5>
                                    </div>
                                </div>
                            </div>
                            <!-- Repite este bloque para cada grupo de 3 tarjetas -->
                            <!-- Puedes añadir más tarjetas según sea necesario -->
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev"
                    style="margin-left: -100px; color: black; margin-top: -65px;">
                    <i class="fas fa-chevron-left fa-2x"></i>
                    <span class="sr-only">Anterior</span>
                </a>
                <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next"
                    style="margin-right: -100px; color: black; margin-top: -65px;">
                    <i class="fas fa-chevron-right fa-2x"></i>
                    <span class="sr-only">Siguiente</span>
                </a>
            </div>
        </div>
    </div>
    <div class="text-center mt-5">
        <h3><strong>¡Solicita tu pedido aquí!</strong></h3>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-5">
                <div class="input-group mt-4">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01"
                            id="izquierda"><strong>de</strong></label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01">
                        <option selected>Selecciona</option>
                        <option value="1">Paypal</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2 text-center" style="color: #0035aa; padding: 0px;">
                <i class="fas fa-exchange-alt fa-5x"
                    style="border: 1px solid #0035aa; border-radius: 55px; padding: 10px;"></i>
            </div>
            <div class="col-md-5">
                <div class="input-group mt-4">
                    <div class="input-group-prepend">
                        <label class="input-group-text"
                            for="inputGroupSelect01"><strong></strong>&ensp;a</strong></label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect02">
                        <option selected>Selecciona</option>
                        <option value="1">Bolívares, VE</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5" id="panel-envios" style="display: none;">
        <div class="text-center">
            <p><strong>Monto minimo:</strong> $5USD+comisión PayPal($5,60USD)</p>
            <p><strong>Tiempo aproximado de espera:</strong> 8 horas laborales</p>
        </div>
        <div class="row mt-5">
            <!-- beneficiario -->
            <div class="col-md-6">
                <select class="form-control input-registro" id="selectBeneficiario" onchange="verificarSelect1()">
                    <option value="0" selected disabled>Beneficiarios afiliados</option>
                    <option value="1">Nombre 1</option>
                    <option value="2">Nombre 2</option>
                    <option value="3">Nombre 3</option>
                </select>
                <div class="text-center">
                    <p onclick="activarBeneficiario()"
                        style="color: #0035aa; cursor: pointer; text-decoration: underline;"><i class="fas fa-plus"></i>
                        Afiliar nuevo beneficiario</p>
                </div>

                <div class="text-center mt-4" style="display: none;" id="beneficiario">
                    <div class="form-group">
                        <input type="text" class="form-control input-registro miInput1" id="paypalAliasBeneficiario"
                            placeholder="Alias">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control input-registro miInput1" id="paypalNombreBeneficiario"
                            placeholder="Nombres y apellidos">
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <select class="form-control input-indicativo miSelect1" id="paypalTipoDocumentoBeneficiario">
                                    <option value="1">T</option>
                                    <option value="2">CC</option>
                                    <option value="3">A</option>
                                    <!-- Agrega más opciones aquí -->
                                </select>
                            </div>
                            <input type="number" class="form-control input-telefono miInput1" id="paypalDocumentoBeneficiario"
                                placeholder="Número documento">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control input-registro miInput1" id="paypalBancoBeneficiario"
                            placeholder="Banco">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control input-registro miInput1" id="paypalCuentaBeneficiario"
                            placeholder="Número de cuenta">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control input-registro miInput1" id="paypalPagoMovilBeneficiario"
                            placeholder="Pago móvil">
                    </div>
                    <div class="text-center">
                        <a href="#" style="color: #0035aa;" id="cuentaNueva1" style="display: none;">Guardar</a>
                        <div id="cuentaExistente1" style="display: none;">
                            <div class="row">
                                <div class="col-6">
                                    <a href="#" style="color: #0035aa;">Editar</a>
                                </div>
                                <div class="col-6">
                                    <i class="fas fa-trash-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- depositante -->
            <div class="col-md-6">
                <select class="form-control input-registro" id="selectDepositante" onchange="verificarSelect2()">
                    <option value="0" selected disabled>Depositantes afiliados</option>
                    <option value="1">Nombre 1</option>
                    <option value="2">Nombre 2</option>
                    <option value="3">Nombre 3</option>
                </select>
                <div class="text-center">
                    <p onclick="activarDepositante()"
                        style="color: #0035aa; cursor: pointer; text-decoration: underline;"><i class="fas fa-plus"></i>
                        Afiliar nuevo depositante</p>
                </div>

                <div class="text-center mt-4" style="display: none;" id="depositante">
                    <div class="form-group">
                        <input type="text" class="form-control input-registro miInput2" id="paypalAliasDepositante" placeholder="Alias">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control input-registro miInput2" id="paypalNombreDepositante"
                            placeholder="Nombres y apellidos">
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <select class="form-control input-indicativo miSelect2" id="paypalTipoDocumentoDepositante">
                                    <option value="1">T</option>
                                    <option value="2">CC</option>
                                    <option value="3">A</option>
                                    <!-- Agrega más opciones aquí -->
                                </select>
                            </div>
                            <input type="number" class="form-control input-telefono miInput2" id="paypalDocumentoDepositante"
                                placeholder="Número documento">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control input-registro miInput2" id="paypalCorreoDepositante"
                            placeholder="Correo PayPal de pago">
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <select class="form-control input-indicativo miSelect2" id="paypalIndicativoDepositante">
                                    <option value="1">+57</option>
                                    <option value="2">+58</option>
                                    <option value="3">+51</option>
                                    <!-- Agrega más opciones aquí -->
                                </select>
                            </div>
                            <input type="number" class="form-control input-telefono miInput2" id="paypalCelularDepositante"
                                placeholder="Número celular">
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="form-control input-registro miSelect2" id="paypalPaisDepositante">
                            <option value="0" selected disabled>País</option>
                            <option value="1">Colombia</option>
                            <option value="2">Venezuela</option>
                            <option value="3">Perú</option>
                            <!-- Agrega más opciones aquí -->
                        </select>
                    </div>
                    <div class="text-center" id="adjuntarFoto" style="display: none;">
                        <button class="btn btn-primary" type="button" id="adjuntarDocumento">Adjuntar foto del
                            documento</button>
                    </div>
                    <div class="text-center mt-3">
                        <a href="#" style="color: #0035aa;" id="cuentaNueva2" style="display: none;">Guardar</a>
                        <div id="cuentaExistente2" style="display: none;">
                            <div class="row">
                                <div class="col-6">
                                    <a href="#" style="color: #0035aa;">Editar</a>
                                </div>
                                <div class="col-6">
                                    <i class="fas fa-trash-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- monto -->
        <div class="row">
            <div class="col-md-6">
                <div class="text-center mt-4">
                    <div class="form-group">
                        <input type="number" class="form-control input-registro" id="nombre"
                            placeholder="Monto a cambiar">
                        <div class="mt-2">
                            <p style="color: #0035aa;"><strong>Monto a pagar: $0.00 USD</strong></p>
                            <p style="color: #0035aa;"><strong>Monto a recibir: 0.00 BS.</strong></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="text-center mt-4">
                    <button class="btn btn-primary" type="button" id="realizarPago" style="width: 80%;"
                        disabled>Realizar
                        pago</button>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    <p>Acepto los <a href="#" style="color: #0035aa;"><strong>Terminos y Condiciones</strong></a> del
                        servicio de intergiros.</p>
                </label>
            </div>
        </div>
        <div class="text-center mt-5">
            <button class="btn btn-primary" type="button" id="tasas-venezuela" style="width: 25%;"
                disabled>Enviar</button>
        </div>
    </div>
    <br><br><br><br><br>

<!-- FOOTER -->
@include('layouts.footer')
@endsection