@extends('layouts.css-envios')
@include('layouts.nav-user')

@section('content')
    <div class="text-center mt-5">
        <h1><strong>¡Hola {{ Auth::user()->name }}!</strong></h1>
    </div>
    <div class="text-center mt-5">
        <button class="btn btn-primary" type="button" id="tasas-venezuela">Tasas para cambios a Venezuela</button>
    </div>
    <div class="text-center mt-5" id="slide-tasas">
        <div class="container">
            <div id="myCarousel" class="carousel slide" data-ride="carousel" style="padding-top: 45px; padding-bottom: 30px;">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="card bg-transparent">
                                    <img src="{{ asset('img/home/TDC Intergiros - Skrill.png') }}" class="img-fluid"
                                        alt="">
                                    <div class="text-center mt-5">
                                        <h5><strong>Todos los bancos</strong></h5>
                                        <h5><strong>1 USD=31,00 BS.</strong></h5>
                                    </div>
                                </div>
                            </div>
                            <!-- Repite este bloque para cada tarjeta -->
                            <div class="col-12 col-md-4">
                                <div class="card bg-transparent">
                                    <img src="{{ asset('img/home/TDC Intergiros - PayPal.png') }}" class="img-fluid"
                                        alt="">
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
                                    <img src="{{ asset('img/home/TDC Intergiros - Bitcoin.png') }}" class="img-fluid"
                                        alt="">
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
                                    <img src="{{ asset('img/home/TDC Intergiros - Skrill.png') }}" class="img-fluid"
                                        alt="">
                                    <div class="text-center mt-5">
                                        <h5><strong>Todos los bancos</strong></h5>
                                        <h5><strong>1 USD=31,00 BS.</strong></h5>
                                    </div>
                                </div>
                            </div>
                            <!-- Repite este bloque para cada tarjeta -->
                            <div class="col-12 col-md-4">
                                <div class="card bg-transparent">
                                    <img src="{{ asset('img/home/TDC Intergiros - PayPal.png') }}" class="img-fluid"
                                        alt="">
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
                                    <img src="{{ asset('img/home/TDC Intergiros - Bitcoin.png') }}" class="img-fluid"
                                        alt="">
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
                                    <img src="{{ asset('img/home/TDC Intergiros - Skrill.png') }}" class="img-fluid"
                                        alt="">
                                    <div class="text-center mt-5">
                                        <h5><strong>Todos los bancos</strong></h5>
                                        <h5><strong>1 USD=31,00 BS.</strong></h5>
                                    </div>
                                </div>
                            </div>
                            <!-- Repite este bloque para cada tarjeta -->
                            <div class="col-12 col-md-4">
                                <div class="card bg-transparent">
                                    <img src="{{ asset('img/home/TDC Intergiros - PayPal.png') }}" class="img-fluid"
                                        alt="">
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
                                    <img src="{{ asset('img/home/TDC Intergiros - Bitcoin.png') }}" class="img-fluid"
                                        alt="">
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
                        <label class="input-group-text" for="inputGroupSelect01" id="izquierda"><strong>de</strong></label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01">
                        <option value="0" selected>Selecciona</option>
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
                        <label class="input-group-text" for="inputGroupSelect01"><strong></strong>&ensp;a</strong></label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect02">
                        <option value="0" selected>Selecciona</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <!-- paypal -->
    <div class="panel container mt-5" id="panel-paypal" style="display: none;">
        <div class="text-center">
            <p><strong>Monto minimo:</strong> $5USD+comisión PayPal($5,60USD)</p>
            <p><strong>Tiempo aproximado de espera:</strong> 8 horas laborales</p>
        </div>
        <div class="row mt-5">
            <!-- beneficiario -->
            <div class="col-md-6">
                <select class="form-control input-registro" id="selectBeneficiario" onchange="verificarSelect1()">
                    <option value="0" selected disabled>Beneficiarios afiliados</option>
                </select>
                <div class="text-center">
                    <p onclick="activarBeneficiario()"
                        style="color: #0035aa; cursor: pointer; text-decoration: underline;">
                        <i class="fas fa-plus"></i>
                        Afiliar nuevo beneficiario
                    </p>
                </div>

                <form action="" id="formBeneficiario">
                    <div class="text-center mt-4" style="display: none;" id="beneficiario">
                        <div class="form-group">
                            <input type="text" class="form-control input-registro miInput1"
                                id="paypalAliasBeneficiario" name="paypalAliasBeneficiario" placeholder="Alias">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control input-registro miInput1"
                                id="paypalNombreBeneficiario" name="paypalNombreBeneficiario"
                                placeholder="Nombres y apellidos">
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <select class="form-control input-indicativo miSelect1"
                                        id="paypalTipoDocumentoBeneficiario" name="paypalTipoDocumentoBeneficiario">
                                        <!-- Agrega más opciones aquí -->
                                    </select>
                                </div>
                                <input type="number" class="form-control input-telefono miInput1"
                                    id="paypalDocumentoBeneficiario" name="paypalDocumentoBeneficiario"
                                    placeholder="Número documento">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control input-registro miInput1"
                                id="paypalBancoBeneficiario" name="paypalBancoBeneficiario" placeholder="Banco">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control input-registro miInput1"
                                id="paypalCuentaBeneficiario" name="paypalCuentaBeneficiario"
                                placeholder="Número de cuenta">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control input-registro miInput1"
                                id="paypalPagoMovilBeneficiario" name="paypalPagoMovilBeneficiario"
                                placeholder="Pago móvil">
                        </div>
                        <div class="text-center">
                            <div class="text-center" style="display: flex; justify-content: center;">
                                <button type="button" class="btn btn-primary" onclick="addTercero('TB', 'TP-01', event)"
                                    id="cuentaNueva1"
                                    style="display: none;background-color: transparent; border: none; color: #0035aa;">Guardar</button>
                            </div>
                            <div id="cuentaExistente1" style="display: none;">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-primary" id="editBeneficiario"
                                            onclick="activarEditBeneficiario()"
                                            style="background-color: transparent; border: none; color: #0035aa; margin-left: 22%;">Editar</button>
                                        <button type="button" class="btn btn-primary" id="guardarEdit1"
                                            onclick="setTercero('TB', 'TP-01')"
                                            style="display: none;background-color: transparent; border: none; color: #0035aa; margin-left: 22%;">Guardar
                                            Edicion</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-primary"
                                            onclick="deleteTercero('TB', 'TP-01')"
                                            style="background-color: transparent; border: none; color: #0035aa;"> <i
                                                class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- depositante -->
            <div class="col-md-6">
                <select class="form-control input-registro" id="selectDepositante" onchange="verificarSelect2()">
                    <option value="0" selected disabled>Depositantes afiliados</option>
                </select>
                <div class="text-center">
                    <p onclick="activarDepositante()"
                        style="color: #0035aa; cursor: pointer; text-decoration: underline;">
                        <i class="fas fa-plus"></i>
                        Afiliar nuevo depositante
                    </p>
                </div>
                <form action="" id="formDepositante">
                    <div class="text-center mt-4" style="display: none;" id="depositante">
                        <div class="form-group">
                            <input type="text" class="form-control input-registro miInput2"
                                id="paypalAliasDepositante" name="paypalAliasDepositante" placeholder="Alias">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control input-registro miInput2"
                                id="paypalNombreDepositante" name="paypalNombreDepositante"
                                placeholder="Nombres y apellidos">
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <select class="form-control input-indicativo miSelect2"
                                        id="paypalTipoDocumentoDepositante" name="paypalTipoDocumentoDepositante">
                                        <!-- Agrega más opciones aquí -->
                                    </select>
                                </div>
                                <input type="number" class="form-control input-telefono miInput2"
                                    id="paypalDocumentoDepositante" name="paypalDocumentoDepositante"
                                    placeholder="Número documento">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control input-registro miInput2"
                                id="paypalCorreoDepositante" name="paypalCorreoDepositante"
                                placeholder="Correo PayPal de pago">
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <select class="form-control input-indicativo miSelect2"
                                        id="paypalIndicativoDepositante" name="paypalIndicativoDepositante">
                                        <!-- Agrega más opciones aquí -->
                                    </select>
                                </div>
                                <input type="number" class="form-control input-telefono miInput2"
                                    id="paypalCelularDepositante" name="paypalCelularDepositante"
                                    placeholder="Número celular">
                            </div>
                        </div>
                        <div class="form-group">
                            <select class="form-control input-registro miSelect2" id="paypalPaisDepositante"
                                name="paypalPaisDepositante">
                                <option value="0" selected disabled>País</option>
                                <!-- Agrega más opciones aquí -->
                            </select>
                        </div>
                        <div class="form-group" id="adjuntarFoto" name="adjuntarFoto" style="display: none;">
                            <div class="input-group">
                                <div class="custom-file">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary" type="button" id="btnPreview02">
                                            <i class="fas fa-eye-slash"></i>
                                        </button>
                                    </div>
                                    <input type="file" class="custom-file-input" id="adjuntarDocumento"
                                        name="adjuntarDocumento">
                                    <label class="custom-file-label input-registro" for="adjuntarDocumento"
                                        id="labelFile01" style="text-align: left;">Adjunta
                                        foto del documento</label>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <div class="text-center" style="display: flex; justify-content: center;">
                                <button type="button" class="btn btn-primary" onclick="addTercero('TD', 'TP-01', event)"
                                    id="cuentaNueva2"
                                    style="display: none;background-color: transparent; border: none; color: #0035aa;">Guardar</button>
                            </div>
                            <div id="cuentaExistente2" style="display: none;">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-primary" id="editDepositante"
                                            onclick="activarEditDepositante()"
                                            style="background-color: transparent; border: none; color: #0035aa; margin-left: 22%;">Editar</button>
                                        <button type="button" class="btn btn-primary" id="guardarEdit2"
                                            onclick="setTercero('TD', 'TP-01')"
                                            style="display: none;background-color: transparent; border: none; color: #0035aa; margin-left: 22%;">Guardar
                                            Edicion</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-primary"
                                            onclick="deleteTercero('TD', 'TP-01')"
                                            style="background-color: transparent; border: none; color: #0035aa;"> <i
                                                class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- monto -->
        <div class="row">
            <div class="col-md-6">
                <div class="text-center mt-4">
                    <div class="form-group">
                        <input type="number" class="form-control input-registro" id="montoCambiar"
                            placeholder="Monto a cambiar">
                        <div class="mt-2 payment-info">
                            <p style="color: #0035aa"><strong>Monto a pagar: <span id="monto_a_pagar_paypal"
                                        style="display: inline-block">0.00</span> USD</strong></p>
                            <p style="color: #0035aa"><strong>Monto a recibir: <span id="monto_a_recibir_paypal"
                                        style="display: inline-block">0.00</span> BS.</strong></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="text-center mt-4">
                    <button class="btn btn-primary" onclick="addSolicitudPago()" type="button" id="realizarPago"
                        style="width: 80%;" disabled>Realizar
                        pago</button>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    <p>Acepto los <a href="#" style="color: #0035aa;"><strong>Terminos y Condiciones</strong></a>
                        del
                        servicio de intergiros.</p>
                </label>
            </div>
        </div>
        <div class="text-center mt-5">
            <button class="btn btn-primary" type="button" id="tasas-venezuela" style="width: 25%;"
                disabled>Enviar</button>
        </div>
    </div>
    <!-- paypal -->

    <!-- usdt -->
    <div class="panel container mt-5" id="panel-usdt" style="display: none;">
        <div class="text-center">
            <p><strong>Monto minimo:</strong> $5USD+comisión PayPal($5,60USD)</p>
            <p><strong>Tiempo aproximado de espera:</strong> 8 horas laborales</p>
        </div>
        <div class="row mt-5">
            <div class="col-md-6">
                <select class="form-control input-registro" id="selectBeneficiarioUsdt"
                    onchange="verificarSelectUsdt1()">
                    <option value="0" selected disabled>Beneficiarios afiliados</option>
                </select>
                <div class="text-center">
                    <p onclick="activarBeneficiarioUsdt()"
                        style="color: #0035aa; cursor: pointer; text-decoration: underline;"><i class="fas fa-plus"></i>
                        Afiliar nuevo beneficiario</p>
                </div>
                <form action="" id="formBeneficiarioUsdt">
                    <div class="text-center mt-4" id="usdtBeneficiario" style="display: none;">
                        <div class="form-group">
                            <input type="text" class="form-control input-registro inputUsdt1" placeholder="Alias"
                                id="usdtAliasBeneficiario" name="usdtAliasBeneficiario">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control input-registro inputUsdt1"
                                placeholder="Nombre y apellidos" id="usdtNombreBeneficiario"
                                name="usdtNombreBeneficiario">
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <select class="form-control input-indicativo selectUsdt1" id="usdtTipoDocBeneficiario"
                                        name="usdtTipoDocBeneficiario">
                                    </select>
                                </div>
                                <input type="number" class="form-control input-telefono inputUsdt1"
                                    placeholder="Número documento" id="usdtDocBeneficiario" name="usdtDocBeneficiario">
                            </div>
                        </div>
                        <div class="form-group">
                            <select class="form-control input-registro selectUsdt1" id="usdtBancoBeneficiario"
                                name="usdtBancoBeneficiario">
                                <option value="0" selected disabled>Banco</option>
                                <option value="1">Banco 1</option>
                                <option value="2">Banco 2</option>
                                <option value="3">Banco 3</option>
                                <!-- Agrega más opciones aquí -->
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <select class="form-control input-indicativo selectUsdt1"
                                        id="usdtTipoCuentaBeneficiario" name="usdtTipoCuentaBeneficiario">
                                    </select>
                                </div>
                                <input type="number" class="form-control input-telefono inputUsdt1"
                                    placeholder="Número cuenta" id="usdtCuentaBeneficiario"
                                    name="usdtCuentaBeneficiario">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control input-registro inputUsdt1"
                                id="usdtPagoMovilBeneficiario" name="usdtPagoMovilBeneficiario" placeholder="Pago móvil">
                        </div>
                        <div class="text-center mt-3">
                            <div class="text-center" style="display: flex; justify-content: center;">
                                <button type="button" class="btn btn-primary" onclick="addTercero('TB', 'TP-02', event)"
                                    id="usdtNueva1"
                                    style="display: none;background-color: transparent; border: none; color: #0035aa;">Guardar</button>
                            </div>
                            <div id="usdtExistente1" style="display: none;">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-primary" id="editUsdt1"
                                            onclick="editBeneficiarioUsdt()"
                                            style="background-color: transparent; border: none; color: #0035aa; margin-left: 22%;">Editar</button>
                                        <button type="button" class="btn btn-primary" id="guardarEditUsdt1"
                                            onclick=""
                                            style="display: none;background-color: transparent; border: none; color: #0035aa; margin-left: 22%;">Guardar
                                            Edicion</button>
                                    </div>
                                    <div class="col-6">
                                        <i class="fas fa-trash-alt"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-6">
                <select class="form-control input-registro" id="selectDepositanteUsdt" onchange="verificarSelectUsdt2()">
                    <option value="0" selected disabled>Depositantes afiliados</option>
                    <option value="1">Nombre 1</option>
                    <option value="2">Nombre 2</option>
                    <option value="3">Nombre 3</option>
                </select>
                <div class="text-center">
                    <p onclick="activarDepositanteUsdt()"
                        style="color: #0035aa; cursor: pointer; text-decoration: underline;"><i class="fas fa-plus"></i>
                        Afiliar nuevo depositante</p>
                </div>
                <form action="" id="formDepositanteUsdt">
                    <div class="text-center mt-4" id="usdtDepositante" style="display: none;">
                        <div class="form-group">
                            <input type="text" class="form-control input-registro inputUsdt2" placeholder="Alias"
                                id="usdtAliasDepositante" name="usdtAliasDepositante">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control input-registro inputUsdt2"
                                id="usdtNombreDepositante" name="usdtNombreDepositante" placeholder="Nombre y apellidos">
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <select class="form-control input-indicativo selectUsdt2" id="usdtTipoDocDepositante"
                                        name="usdtTipoDocDepositante">
                                    </select>
                                </div>
                                <input type="number" class="form-control input-telefono inputUsdt2"
                                    placeholder="Número documento" id="usdtDocDepositante" name="usdtDocDepositante">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control input-registro inputUsdt2"
                                id="usdtEmailDepositante" name="usdtEmailDepositante"
                                placeholder="Email Binance Pay de pago">
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <select class="form-control input-indicativo selectUsdt2"
                                        id="usdtIndicativoDepositante" name="usdtIndicativoDepositante">
                                        <option value="1">+57</option>
                                        <option value="2">+58</option>
                                        <option value="3">+51</option>
                                        <!-- Agrega más opciones aquí -->
                                    </select>
                                </div>
                                <input type="number" class="form-control input-telefono inputUsdt2"
                                    placeholder="Número celular" id="usdtCelularDepositante"
                                    name="usdtCelularDepositante">
                            </div>
                        </div>
                        <div class="form-group">
                            <select class="form-control input-registro selectUsdt2" id="usdtPaisDepositante"
                                name="usdtPaisDepositante">
                                <option value="0" selected disabled>País</option>
                                <option value="1">Colombia</option>
                                <option value="2">Venezuela</option>
                                <option value="3">Perú</option>
                                <!-- Agrega más opciones aquí -->
                            </select>
                        </div>
                        <div class="form-group" id="adjuntarFotoUsdt" name="adjuntarFotoUsdt" style="display: none;">
                            <div class="input-group">
                                <div class="custom-file text-left">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary" type="button" id="btnPreview01">
                                            <i class="fas fa-eye-slash"></i>
                                        </button>
                                    </div>
                                    <input type="file" class="custom-file-input" id="adjuntarDocumentoUsdt"
                                        name="adjuntarDocumentoUsdt">
                                    <label class="custom-file-label input-registro" for="adjuntarDocumentoUsdt"
                                        id="labelFile02">Adjuntar foto documento</label>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <div class="text-center" style="display: flex; justify-content: center;">
                                <button type="button" class="btn btn-primary" onclick="addTercero('TD', 'TP-02', event)"
                                    id="usdtNueva2"
                                    style="display: none;background-color: transparent; border: none; color: #0035aa;">Guardar</button>
                            </div>
                            <div id="usdtExistente2" style="display: none;">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-primary" id="editUsdt2"
                                            onclick="editDepositanteUsdt()"
                                            style="background-color: transparent; border: none; color: #0035aa; margin-left: 22%;">Editar</button>
                                        <button type="button" class="btn btn-primary" id="guardarEditUsdt2"
                                            onclick=""
                                            style="display: none;background-color: transparent; border: none; color: #0035aa; margin-left: 22%;">Guardar
                                            Edicion</button>
                                    </div>
                                    <div class="col-6">
                                        <i class="fas fa-trash-alt"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
                    <p>Acepto los <a href="#" style="color: #0035aa;"><strong>Terminos y Condiciones</strong></a>
                        del
                        servicio de intergiros.</p>
                </label>
            </div>
        </div>
        <div class="text-center mt-5">
            <button class="btn btn-primary" type="button" id="tasas-venezuela" style="width: 25%;"
                disabled>Enviar</button>
        </div>
    </div>
    <!-- usdt -->
    <br><br><br><br><br>

    <!-- FOOTER -->
    @include('layouts.footer')
@endsection
