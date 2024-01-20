@auth
@include('layouts.nav-user')
@extends('layouts.css-home-auth')
@else
@include('layouts.nav-home')
@extends('layouts.css-home')
@endauth

@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Columna de texto (se coloca primero en dispositivos pequeños) -->
        <div class="col-md-5 columna-texto order-2 order-md-1">
            <h1>¡Bienvenidos a Intergiros!</h1>
            <p>
                Tu página de cambios segura y confiable.
            </p>
            <div class="row opcion-reseñas align-items-center">
                <div class="col-6">
                    <a href="#referencias" class="enlace-reseñas">Ver reseñas</a>
                </div>
                <div class="col-6">
                    <div class="estrellas">
                        ★ ★ ★ ★ ★
                    </div>
                </div>
            </div>
        </div>
        <!-- Columna de imagen (se coloca después en dispositivos pequeños) -->
        <div class="col-md-7 columna-imagen order-1 order-md-2">
            <img src="{{ asset('img/home/bienvenidos.png') }}" alt="Imagen">
        </div>
    </div>
</div>

<div class="container py-5">
    <p class="text-center">
        <strong>Únete alafamilia Intergiros</strong> y disfruta de cambiar y recargar tu saldo PayPal, Skrill,
        Bitcoin, USDT y Zinli
        en Venezuela, cambiar y recargar tu saldo PayPal en Perú, y además, hacer envíos de dinero rápidos y seguros
        entre Perú, Colombia y Venezuela.
    </p>
</div>

<div class="container">
    <div class="form-group text-center">
        <div class="custom-select-container">
            <select class="custom-select custom-select-lg mb-3 text-white" id="selectorCambioHome"
                name="selectorCambioHome">
                <option value="null" selected>Selecciona el servicio de tu interés</option>
                <option value="pay_ven" data-code="TP-01">Cambiar saldo PayPal</option>
                <option value="usd_ven" data-code="TP-09">Cambiar saldo USDT</option>
                <option value="zinli_ven" data-code="">Cambiar saldo Zinli en Venezuela</option>
                <option value="peru_ven" data-code="TP-05">Enviar dinero de Perú</option>
                <option value="col_ven" data-code="TP-07">Enviar dinero de Colombia</option>
                <option value="ven_col" data-code="">Enviar dinero de Venezuela</option>
                <option value="zinli" data-code="">Recargar saldo Zinli</option>
                <option value="paypal" data-code="">Recargar saldo PayPal</option>
            </select>
        </div>
    </div>
    <p class="text-select">Para desplegar su información general y tasas</p>
</div>


<!-- pay_ven -->
<div class="container cambios" style="display: none;" id="pay_ven">
    <div class="row">
        <div class="col-md-5 info">
            <img src="{{ asset('img/home/TDC Intergiros - PayPal.png') }}" class="img-fluid" alt="">
            <div class="row mt-5">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono de Monto mínimo.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5>Monto mínimo</h5>
                    <p><span id="monto_minimo_paypal">$5 USD + comisión PayPal</span></p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono traansferencias en.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5>Transferencias en</h5>
                    <p>Máximo <span id="tiempo_transferencia_paypal">8h laborales</span></p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono pagamos desde.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5>Pagamos desde</h5>
                    <p><span id="bancos_paypal">BDV, pago móvil</span></p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono términos y condiciones.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5><span class="resaltar">Consulta aquí los</span></h5>
                    <a href="">
                        <p><span class="resaltar">términos y condiciones</span></p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-7 data">
            <div class="form-group">
                <input type="number" class="form-control w-100%" id="monto_cambiar_pay_ven" placeholder="Monto a enviar"
                    onkeyup="obtenerValor(this.value)">
            </div>
            <div class="text-center">
                <img src="{{ asset('img/home/Ícono para la calculadora.png') }}" class="img-fluid" alt="">
            </div>
            <div class="form-group mt-4">
                <div class="input-group" style="width: 100% !important;">
                    <input type="text" class="form-control" id="monto_recibir_pay_ven" placeholder="Monto a recibir"
                        readonly>
                    <div class="input-group-append">
                        <div id="imagenPais"><img src="{{ asset('img/home/venezuela.png') }}" alt=""
                                style="margin-top: 8px;margin-left: 10px; width: 50px;"></div>
                        <select class="form-control" id="paisesPaypal">
                            <option data-image="{{ asset('img/home/venezuela.png') }}" value="venezuela">Bolívares
                            </option>
                            <option data-image="{{ asset('img/home/peru.png') }}" value="peru">Soles</option>
                            <option data-image="{{ asset('img/home/peru.png') }}" value="peru-dolar">Dólares</option>
                            <option data-image="{{ asset('img/home/colombia.png') }}" value="colombia">Pesos colombianos
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-6">
                    <h4>Comisiones:</h4>
                    <h4>Total a pagar:</h4>
                    <h4>Tipo de cambio:</h4>
                </div>
                <div class="col-6 text-right">
                    <h4>$ <span id="monto_pagar_pay_ven">0.00</span> USD</h4>
                    <h4>$ <span id="monto_recibir_comision_pay_ven" style="display: inline-block">0.00</span> USD</h4>
                    <h4>$1 USD=30,00 <span id="tipo_cambio_paypal">BS</span></h4>
                </div>
            </div>
            <div class="mt-5">
                <h4>No cobramos comisión por envíos. La única comisión que debe ser asumida por el cliente es la
                    comisión cobrada por PayPal en sus transacciones.</h4>
            </div>
            <div class="mt-5 text-center">
                    <h6>Si realizas un pedido ahora:</h6>
                    <button type="button" class="btn btn-primary">Recibirás el dinero máximo el 29 de agosto</button>
                </div>
        </div>
    </div>
</div>

<!-- zinli_ven -->
<div class="container cambios" style="display: none;" id="zinli_ven">
    <div class="row">
        <div class="col-md-5 info">
            <img src="{{ asset('img/home/TDC Intergiros - Zinli.png') }}" class="img-fluid" alt="">
            <div class="row mt-5">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono de Monto mínimo.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5>Monto mínimo</h5>
                    <p>$5 USD</p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono traansferencias en.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5>Transferencias en</h5>
                    <p>Máximo 8h laborales</p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono pagamos desde.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5>Pagamos desde</h5>
                    <p>BDV, pago móvil</p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono términos y condiciones.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5><span class="resaltar">Consulta aquí los</span></h5>
                    <a href="">
                        <p><span class="resaltar">términos y condiciones</span></p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-7 data">
            <div class="form-group">
                <input type="number" class="form-control w-100%" id="monto_cambiar_pay_peru"
                    placeholder="Monto a enviar" onkeyup="obtenerValor(this.value)">
            </div>
            <div class="text-center">
                <img src="{{ asset('img/home/Ícono para la calculadora.png') }}" class="img-fluid" alt="">
            </div>
            <div class="form-group mt-4">
                <div class="input-group" style="width: 100% !important;">
                    <input type="text" class="form-control" id="monto_recibir_pay_ven" placeholder="Monto a recibir"
                        readonly>
                    <div class="input-group-append">
                        <div id="imagenPaisZinli"><img src="{{ asset('img/home/venezuela.png') }}" alt=""
                                style="margin-top: 8px;margin-left: 10px; width: 50px;"></div>
                        <select class="form-control" id="paisesZinli">
                            <option data-image="{{ asset('img/home/venezuela.png') }}" value="venezuela">Bolívares
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-6">
                    <h4>Comisiones:</h4>
                    <h4>Total a pagar:</h4>
                    <h4>Tipo de cambio:</h4>
                </div>
                <div class="col-6 text-right">
                    <h4>$ <span id="monto_pagar_pay_peru">0.00</span> USD</h4>
                    <h4>$ <span id="monto_recibir_comision_pay_peru" style="display: inline-block">0.00</span> USD
                    </h4>
                    <h4>$1 USD=30,00 BS</h4>
                </div>
            </div>
            <div class="mt-5">
                <h4>No cobramos comisión por envíos.</h4>
            </div>
            <div class="mt-5 text-center">
                    <h6>Si realizas un pedido ahora:</h6>
                    <button type="button" class="btn btn-primary">Recibirás el dinero máximo el 29 de agosto</button>
                </div>
        </div>
    </div>
</div>

<!-- usd_ven -->
<div class="container cambios" style="display: none;" id="usd_ven">
    <div class="row">
        <div class="col-md-5 info">
            <img src="{{ asset('img/home/TDC Intergiros - USDT.png') }}" class="img-fluid" alt="">
            <div class="row mt-5">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono de Monto mínimo.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5>Monto mínimo</h5>
                    <p>$5 USD</p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono traansferencias en.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5>Transferencias en</h5>
                    <p>Máximo 8h laborales</p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono pagamos desde.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5>Pagamos desde</h5>
                    <p><span id="bancos_usdt">Banesco,BDV,pago móvil</span></p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono términos y condiciones.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5><span class="resaltar">Consulta aquí los</span></h5>
                    <a href="">
                        <p><span class="resaltar">términos y condiciones</span></p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-7 data">
            <div class="form-group">
                <input type="number" class="form-control w-100%" id="monto_cambiar_usdt_ven" placeholder="Monto a enviar"
                    onkeyup="obtenerValor(this.value)">
            </div>
            <div class="text-center">
                <img src="{{ asset('img/home/Ícono para la calculadora.png') }}" class="img-fluid" alt="">
            </div>
            <div class="form-group mt-4">
                <div class="input-group" style="width: 100% !important;">
                    <input type="text" class="form-control" id="monto_recibir_usdt_ven" placeholder="Monto a recibir"
                        readonly>
                    <div class="input-group-append">
                        <div id="imagenPaisUsdt"><img src="{{ asset('img/home/venezuela.png') }}" alt=""
                                style="margin-top: 8px;margin-left: 10px; width: 50px;"></div>
                        <select class="form-control" id="paisesUsdt">
                            <option data-image="{{ asset('img/home/venezuela.png') }}" value="venezuela">Bolívares
                            </option>
                            <option data-image="{{ asset('img/home/peru.png') }}" value="peru">Soles</option>
                            <option data-image="{{ asset('img/home/peru.png') }}" value="peru-dolar">Dólares</option>
                            <option data-image="{{ asset('img/home/colombia.png') }}" value="colombia">Pesos colombianos
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-6">
                    <h4>Comisiones:</h4>
                    <h4>Total a pagar:</h4>
                    <h4>Tipo de cambio:</h4>
                </div>
                <div class="col-6 text-right">
                    <h4>$ <span id="monto_pagar_usd_ven">0.00</span> USD</h4>
                    <h4>$ <span id="monto_recibir_comision_usd_ven" style="display: inline-block">0.00</span> USD</h4>
                    <h4>$1 USD=30,00 <span id="tipo_cambio_usdt">BS</span></h4>
                </div>
            </div>
            <div class="mt-5">
                <h4>No cobramos comisión por envíos. IMPORTANTE, en caso de que la plataforma de pago realice algún
                    cobro de comisión por su transacción, ésta deberá ser asumida por el cliente. Se recomienda realizar
                    pagos a través de Binance Pay para evitar cobro de comisiones.</h4>
            </div>
            <div class="mt-5 text-center">
                    <h6>Si realizas un pedido ahora:</h6>
                    <button type="button" class="btn btn-primary">Recibirás el dinero máximo el 29 de agosto</button>
                </div>
        </div>
    </div>
</div>

<!-- peru_ven -->
<div class="container cambios" style="display: none;" id="peru_ven">
    <div class="row">
        <div class="col-md-5 info">
            <img src="{{ asset('img/home/TDC Intergiros - Perú.png') }}" class="img-fluid" alt="">
            <div class="row mt-5">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono de Monto mínimo.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5>Monto mínimo</h5>
                    <p><span id="monto_minimo_peru">20 Soles</span></p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono traansferencias en.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5>Transferencias en</h5>
                    <p>Máximo 8h laborales</p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono pagamos desde.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5>Recibimos desde</h5>
                    <p>BCP, BBVA, Interbank, Scotiabank</p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono pagamos desde.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5>Pagamos desde</h5>
                    <p><span id="bancos_peru">BDV, pago móvil</span></p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono términos y condiciones.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5><span class="resaltar">Consulta aquí los</span></h5>
                    <a href="">
                        <p><span class="resaltar">términos y condiciones</span></p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-7 data">
            <div class="form-group">
                <div class="input-group" style="width: 100% !important;">
                    <input type="number" class="form-control w-100%" id="monto_cambiar_peru_ven"
                        placeholder="Monto a enviar" onkeyup="obtenerValor(this.value)">
                    <div class="input-group-append">
                        <div id="imagenMontoPeru"><img src="{{ asset('img/home/peru.png') }}" alt=""
                                style="margin-top: 8px;margin-left: 10px; width: 50px;"></div>
                        <select class="form-control" id="montoPeru">
                            <option data-image="{{ asset('img/home/peru.png') }}" value="peru">Soles
                            </option>
                            <option data-image="{{ asset('img/home/peru.png') }}" value="peru-dolar">Dólar
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <img src="{{ asset('img/home/Ícono para la calculadora.png') }}" class="img-fluid" alt="">
            </div>
            <div class="form-group mt-4">
                <div class="input-group" style="width: 100% !important;">
                    <input type="text" class="form-control" id="monto_recibir_peru_ven" placeholder="Monto a recibir"
                        readonly>
                    <div class="input-group-append">
                        <div id="imagenPaisPeru"><img src="{{ asset('img/home/venezuela.png') }}" alt=""
                                style="margin-top: 8px;margin-left: 10px; width: 50px;"></div>
                        <select class="form-control" id="paisesPeru">
                            <option data-image="{{ asset('img/home/venezuela.png') }}" value="venezuela">Bolívares
                            </option>
                            <option data-image="{{ asset('img/home/colombia.png') }}" value="colombia">Pesos colombianos
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-6">
                    <h4>Comisiones:</h4>
                    <h4>Total a pagar:</h4>
                    <h4>Tipo de cambio:</h4>
                </div>
                <div class="col-6 text-right">
                    <h4>$ <span id="monto_pagar_peru_ven">0.00</span> USD</h4>
                    <h4>$ <span id="monto_recibir_comision_peru_ven" style="display: inline-block">0.00</span> USD
                    </h4>
                    <h4>$1 <span id="tipo_moneda_peru">PEN</span>=30,00 <span id="tipo_cambio_peru">BS</span></h4>
                </div>
            </div>
            <div class="mt-5">
                <h4>No cobramos comisión por envíos. IMPORTANTE, en caso de que el banco realice algún cobro de comisión
                    por el pago que realice, se ajustará el cambio por el monto que recibamos en nuestra cuenta.</h4>
            </div>
            <div class="mt-5 text-center">
                    <h6>Si realizas un pedido ahora:</h6>
                    <button type="button" class="btn btn-primary">Recibirás el dinero máximo el 29 de agosto</button>
                </div>
        </div>
    </div>
</div>

<!-- col_ven -->
<div class="container cambios" style="display: none;" id="col_ven">
    <div class="row">
        <div class="col-md-5 info">
            <img src="{{ asset('img/home/TDC Intergiros - Colombia.png') }}" class="img-fluid" alt="">
            <div class="row mt-5">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono de Monto mínimo.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5>Monto mínimo</h5>
                    <p>10.000 COP</p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono traansferencias en.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5>Transferencias en</h5>
                    <p>Máximo 8h laborales</p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono pagamos desde.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5>Recibimos desde</h5>
                    <p>Banco de Bogotá, Bancolombia y Nequi</p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono pagamos desde.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5>Pagamos desde</h5>
                    <p><span id="bancos_colombia">Banesco,BDV,pago móvil</span></p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono términos y condiciones.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5><span class="resaltar">Consulta aquí los</span></h5>
                    <a href="">
                        <p><span class="resaltar">términos y condiciones</span></p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-7 data">
            <div class="form-group">
                <div class="input-group" style="width: 100% !important;">
                    <input type="number" class="form-control w-100%" id="monto_cambiar_col_ven"
                        placeholder="Monto a enviar" onkeyup="obtenerValor(this.value)">
                    <div class="input-group-append">
                        <div id="imagenMontoColombia"><img src="{{ asset('img/home/colombia.png') }}" alt=""
                                style="margin-top: 8px;margin-left: 10px; width: 50px;"></div>
                        <select class="form-control" id="montoColombia">
                            <option data-image="{{ asset('img/home/colombia.png') }}" value="colombia">Pesos colombianos
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <img src="{{ asset('img/home/Ícono para la calculadora.png') }}" class="img-fluid" alt="">
            </div>
            <div class="form-group mt-4">
                <div class="input-group" style="width: 100% !important;">
                    <input type="text" class="form-control" id="monto_recibir_col_ven" placeholder="Monto a recibir"
                        readonly>
                    <div class="input-group-append">
                        <div id="imagenPaisColombia"><img src="{{ asset('img/home/venezuela.png') }}" alt=""
                                style="margin-top: 8px;margin-left: 10px; width: 50px;"></div>
                        <select class="form-control" id="paisesColombia">
                            <option data-image="{{ asset('img/home/venezuela.png') }}" value="venezuela">Bolívares
                            </option>
                            <option data-image="{{ asset('img/home/peru.png') }}" value="peru">Soles
                            </option>
                            <option data-image="{{ asset('img/home/peru.png') }}" value="peru-dolar">Dólares
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-6">
                    <h4>Comisiones:</h4>
                    <h4>Total a pagar:</h4>
                    <h4>Tipo de cambio:</h4>
                </div>
                <div class="col-6 text-right">
                    <h4>$ <span id="monto_pagar_col_ven">0.00</span> USD</h4>
                    <h4>$ <span id="monto_recibir_comision_col_ven" style="display: inline-block">0.00</span> USD</h4>
                    <h4>1000 COP=30,00 <span id="tipo_cambio_colombia">BS</span></h4>
                </div>
            </div>
            <div class="mt-5">
                <h4>No cobramos comisión por envíos. IMPORTANTE, en caso de que el banco realice algún cobro de comisión
                    por el pago que realice, se ajustará el cambio por el monto que recibamos en nuestra cuenta.</h4>
            </div>
            <div class="mt-5 text-center">
                    <h6>Si realizas un pedido ahora:</h6>
                    <button type="button" class="btn btn-primary">Recibirás el dinero máximo el 29 de agosto</button>
                </div>
        </div>
    </div>
</div>

<!-- ven_col -->
<div class="container cambios" style="display: none;" id="ven_col">
    <div class="row">
        <div class="col-md-5 info">
            <img src="{{ asset('') }}" class="img-fluid" alt="">
            <div class="row mt-5">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono de Monto mínimo.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5>Monto mínimo</h5>
                    <p>xxxxxx BS</p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono traansferencias en.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5>Transferencias en</h5>
                    <p>Máximo 8h laborales</p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono pagamos desde.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5>Recibimos desde</h5>
                    <p>BDV y pago móvil</p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono pagamos desde.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5>Pagamos desde</h5>
                    <p><span id="bancos_venezuela">Banco de Bogotá, Bancolombia y Nequi</span></p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono términos y condiciones.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5><span class="resaltar">Consulta aquí los</span></h5>
                    <a href="">
                        <p><span class="resaltar">términos y condiciones</span></p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-7 data">
            <div class="form-group">
                <div class="input-group" style="width: 100% !important;">
                    <input type="number" class="form-control w-100%" id="monto_cambiar_ven_col"
                        placeholder="Monto a enviar" onkeyup="obtenerValor(this.value)">
                    <div class="input-group-append">
                        <div id="imagenMontoVenezuela"><img src="{{ asset('img/home/venezuela.png') }}" alt=""
                                style="margin-top: 8px;margin-left: 10px; width: 50px;"></div>
                        <select class="form-control" id="montoVenezuela">
                            <option data-image="{{ asset('img/home/venezuela.png') }}" value="venezuela">Bolívares
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <img src="{{ asset('img/home/Ícono para la calculadora.png') }}" class="img-fluid" alt="">
            </div>
            <div class="form-group mt-4">
                <div class="input-group" style="width: 100% !important;">
                    <input type="text" class="form-control" id="monto_recibir_ven_col" placeholder="Monto a recibir"
                        readonly>
                    <div class="input-group-append">
                        <div id="imagenPaisVenezuela"><img src="{{ asset('img/home/venezuela.png') }}" alt=""
                                style="margin-top: 8px;margin-left: 10px; width: 50px;"></div>
                        <select class="form-control" id="paisesVenezuela">
                            <option data-image="{{ asset('img/home/colombia.png') }}" value="colombia">Pesos colombianos
                            </option>
                            <option data-image="{{ asset('img/home/peru.png') }}" value="peru">Soles
                            </option>
                            <option data-image="{{ asset('img/home/peru.png') }}" value="peru-dolar">Dólares
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-6">
                    <h4>Comisiones:</h4>
                    <h4>Total a pagar:</h4>
                    <h4>Tipo de cambio:</h4>
                </div>
                <div class="col-6 text-right">
                    <h4>$ <span id="monto_pagar_col_ven">0.00</span> USD</h4>
                    <h4>$ <span id="monto_recibir_comision_col_ven" style="display: inline-block">0.00</span> USD</h4>
                    <h4>xxxx BS=30,00 <span id="tipo_cambio_venezuela">COP</span></h4>
                </div>
            </div>
            <div class="mt-5">
                <h4>No cobramos comisión por envíos. IMPORTANTE, en caso de que el banco realice algún cobro de comisión
                    por el pago que realice, se ajustará el cambio por el monto que recibamos en nuestra cuenta.</h4>
            </div>
            <div class="mt-5 text-center">
                    <h6>Si realizas un pedido ahora:</h6>
                    <button type="button" class="btn btn-primary">Recibirás el dinero máximo el 29 de agosto</button>
                </div>
        </div>
    </div>
</div>

<!-- zinli -->
<div class="container cambios" style="display: none;" id="zinli">
    <div class="row">
        <div class="col-md-5 info">
            <img src="{{ asset('img/home/TDC Intergiros - Zinli.png') }}" class="img-fluid" alt="">
            <div class="row mt-5">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono de Monto mínimo.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5>Monto mínimo</h5>
                    <p>$5 USD + comisión por servicio</p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono traansferencias en.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5>Transferencias en</h5>
                    <p>Máximo 8h laborales</p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono pagamos desde.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5>Recibimos desde</h5>
                    <p><span id="recibe_zinli">BDV y pago móvil</span></p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono términos y condiciones.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5><span class="resaltar">Consulta aquí los</span></h5>
                    <a href="">
                        <p><span class="resaltar">términos y condiciones</span></p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-7 data">
            <div class="form-group">
                <div class="input-group" style="width: 100% !important;">
                    <input type="number" class="form-control w-100%" id="monto_cambiar_recarga_zinli"
                        placeholder="Monto a enviar" onkeyup="obtenerValor(this.value)">
                    <div class="input-group-append">
                        <div id="imagenRecargaZinli"><img src="{{ asset('img/home/venezuela.png') }}" alt=""
                                style="margin-top: 8px;margin-left: 10px; width: 50px;"></div>
                        <select class="form-control" id="paisesRecargaZinli">
                            <option data-image="{{ asset('img/home/venezuela.png') }}" value="venezuela">Bolívares
                            </option>
                            <option data-image="{{ asset('img/home/colombia.png') }}" value="colombia">Pesos colombianos
                            </option>
                            <option data-image="{{ asset('img/home/peru.png') }}" value="peru">Soles
                            </option>
                            <option data-image="{{ asset('img/home/peru.png') }}" value="peru-dolar">Dólares
                            </option>
                        </select>
                    </div>

                </div>
            </div>
            <div class="text-center">
                <img src="{{ asset('img/home/Ícono para la calculadora.png') }}" class="img-fluid" alt="">
            </div>
            <div class="form-group mt-4">
                <div class="input-group" style="width: 100% !important;">
                    <input type="text" class="form-control" id="monto_recibir_recarga_zinli" placeholder="Monto a recibir"
                        readonly>
                    <div class="input-group-append">
                        <div id="imagenMontoZinli"><img src="{{ asset('img/home/zinli.png') }}" alt=""
                                style="margin-top: 13px;margin-left: 10px; width: 50px;"></div>
                        <select class="form-control" id="montoZinli">
                            <option data-image="{{ asset('img/home/Zinli.png') }}" value="zinli">Zinli
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-6">
                    <h4>Comisiones:</h4>
                    <h4>Total a pagar:</h4>
                    <h4>Tipo de cambio:</h4>
                </div>
                <div class="col-6 text-right">
                    <h4>$ <span id="monto_pagar_col_ven">0.00</span> USD</h4>
                    <h4>$ <span id="monto_recibir_comision_col_ven" style="display: inline-block">0.00</span> USD</h4>
                    <h4>$1 USD=30,00 <span id="tipo_cambio_zinli">BS</span></h4>
                </div>
            </div>
            <div class="mt-5">
                <h4>El servicio de recargas Zinli posee un cobro de comisión del 8% sobre el monto a recargar. El monto
                    que recibirá será exactamente el que coloque en el campo “Monto a enviar”.</h4>
            </div>
            <div class="mt-5 text-center">
                    <h6>Si realizas un pedido ahora:</h6>
                    <button type="button" class="btn btn-primary">Recibirás el dinero máximo el 29 de agosto</button>
                </div>
        </div>
    </div>
</div>


<!-- Paypal -->
<div class="container cambios" style="display: none;" id="paypal">
    <div class="row">
        <div class="col-md-5 info">
            <img src="{{ asset('img/home/TDC Intergiros - PayPal.png') }}" class="img-fluid" alt="">
            <div class="row mt-5">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono de Monto mínimo.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5>Monto mínimo</h5>
                    <p>$5 USD + comisión por servicio</p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono traansferencias en.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5>Transferencias en</h5>
                    <p>Máximo 8h laborales</p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono pagamos desde.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5>Recibimos desde</h5>
                    <p><span id="recibe_paypal">BDV y pago móvil</span></p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3 icon">
                    <img src="{{ asset('img/home/Ícono términos y condiciones.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-9">
                    <h5><span class="resaltar">Consulta aquí los</span></h5>
                    <a href="">
                        <p><span class="resaltar">términos y condiciones</span></p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-7 data">
            <div class="form-group">
                <div class="input-group" style="width: 100% !important;">
                    <input type="number" class="form-control w-100%" id="monto_cambiar_recarga_paypal"
                        placeholder="Monto a enviar" onkeyup="obtenerValor(this.value)">
                    <div class="input-group-append">
                        <div id="imagenRecargaPaypal"><img src="{{ asset('img/home/venezuela.png') }}" alt=""
                                style="margin-top: 8px;margin-left: 10px; width: 50px;"></div>
                        <select class="form-control" id="paisesRecargaPaypal">
                            <option data-image="{{ asset('img/home/venezuela.png') }}" value="venezuela">Bolívares
                            </option>
                            <option data-image="{{ asset('img/home/colombia.png') }}" value="colombia">Pesos colombianos
                            </option>
                            <option data-image="{{ asset('img/home/peru.png') }}" value="peru">Soles
                            </option>
                            <option data-image="{{ asset('img/home/peru.png') }}" value="peru-dolar">Dólares
                            </option>
                        </select>
                    </div>

                </div>
            </div>
            <div class="text-center">
                <img src="{{ asset('img/home/Ícono para la calculadora.png') }}" class="img-fluid" alt="">
            </div>
            <div class="form-group mt-4">
                <div class="input-group" style="width: 100% !important;">
                    <input type="text" class="form-control" id="monto_recibir_recarga_paypal" placeholder="Monto a recibir"
                        readonly>
                    <div class="input-group-append">
                        <div id="imagenMontoPaypal"><img src="{{ asset('img/home/paypal.png') }}" alt=""
                                style="margin-top: 10px;margin-left: 10px; width: 50px;"></div>
                        <select class="form-control" id="montoPaypal">
                            <option data-image="{{ asset('img/home/paypal.png') }}" value="paypal">PayPal
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-6">
                    <h4>Comisiones:</h4>
                    <h4>Total a pagar:</h4>
                    <h4>Tipo de cambio:</h4>
                </div>
                <div class="col-6 text-right">
                    <h4>$ <span id="monto_pagar_col_ven">0.00</span> USD</h4>
                    <h4>$ <span id="monto_recibir_comision_col_ven" style="display: inline-block">0.00</span> USD</h4>
                    <h4>$1 USD=30,00 <span id="tipo_cambio_paypal_recarga">BS</span></h4>
                </div>
            </div>
            <div class="mt-5">
                <h4>El servicio de recargas PayPal posee un cobro de comisión del 18% sobre el monto a recargar. Esta
                    comisión incluye la comisión cobrada por PayPal en cada transacción, es decir, el monto que recibirá
                    será exactamente el que coloque en el campo “Monto a enviar”.
                </h4>
            </div>
            <div class="mt-5 text-center">
                    <h6>Si realizas un pedido ahora:</h6>
                    <button type="button" class="btn btn-primary">Recibirás el dinero máximo el 29 de agosto</button>
                </div>
        </div>
    </div>
</div>


<div class="container py-5" id="referencias">
    <div class="clientes">
        <h2>Ya son más de <span class="resaltar">2.000</span> clientes satisfechos</h2>
    </div>
</div>

<div class="puntuaciones">
    <div class="container mt-4">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <img src="{{ asset('img/home/people.jpg') }}" class="card-img-top" alt="Imagen 1">
                                <div class="card-body">
                                    <h6 class="card-title"><strong>Nombre Persona #1</strong></h6>
                                    <div class="estrellas mt-3">
                                        ★ ★ ★ ★ ★
                                    </div>
                                    <p class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                        Sed quasi non aperiam itaque earum voluptatem sequi, ut rem veniam hic
                                        nesciunt numquam veritatis quaerat laboriosam possimus, nulla libero
                                        temporibus! Laudantium.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img src="{{ asset('img/home/people.jpg') }}" class="card-img-top" alt="Imagen 2">
                                <div class="card-body">
                                    <h6 class="card-title"><strong>Nombre Persona #2</strong></h6>
                                    <div class="estrellas mt-3">
                                        ★ ★ ★ ★ ★
                                    </div>
                                    <p class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                        Sed quasi non aperiam itaque earum voluptatem sequi, ut rem veniam hic
                                        nesciunt numquam veritatis quaerat laboriosam possimus, nulla libero
                                        temporibus! Laudantium.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img src="{{ asset('img/home/people.jpg') }}" class="card-img-top" alt="Imagen 3">
                                <div class="card-body">
                                    <h6 class="card-title"><strong>Nombre Persona #3</strong></h6>
                                    <div class="estrellas mt-3">
                                        ★ ★ ★ ★ ★
                                    </div>
                                    <p class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                        Sed quasi non aperiam itaque earum voluptatem sequi, ut rem veniam hic
                                        nesciunt numquam veritatis quaerat laboriosam possimus, nulla libero
                                        temporibus! Laudantium.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <img src="{{ asset('img/home/people.jpg') }}" class="card-img-top" alt="Imagen 4">
                                <div class="card-body">
                                    <h6 class="card-title"><strong>Nombre Persona #4</strong></h6>
                                    <div class="estrellas mt-3">
                                        ★ ★ ★ ★ ★
                                    </div>
                                    <p class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                        Sed quasi non aperiam itaque earum voluptatem sequi, ut rem veniam hic
                                        nesciunt numquam veritatis quaerat laboriosam possimus, nulla libero
                                        temporibus! Laudantium.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img src="{{ asset('img/home/people.jpg') }}" class="card-img-top" alt="Imagen 5">
                                <div class="card-body">
                                    <h6 class="card-title"><strong>Nombre Persona #5</strong></h6>
                                    <div class="estrellas mt-3">
                                        ★ ★ ★ ★ ★
                                    </div>
                                    <p class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                        Sed quasi non aperiam itaque earum voluptatem sequi, ut rem veniam hic
                                        nesciunt numquam veritatis quaerat laboriosam possimus, nulla libero
                                        temporibus! Laudantium.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img src="{{ asset('img/home/people.jpg') }}" class="card-img-top" alt="Imagen 6">
                                <div class="card-body">
                                    <h6 class="card-title"><strong>Nombre Persona #6</strong></h6>
                                    <div class="estrellas mt-3">
                                        ★ ★ ★ ★ ★
                                    </div>
                                    <p class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                        Sed quasi non aperiam itaque earum voluptatem sequi, ut rem veniam hic
                                        nesciunt numquam veritatis quaerat laboriosam possimus, nulla libero
                                        temporibus! Laudantium.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Agrega más tarjetas para más elementos del carrusel -->
            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev"
                style="margin-left: -80px;">
                <i class="fas fa-chevron-left fa-2x"></i>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next"
                style="margin-right: -80px;">
                <i class="fas fa-chevron-right fa-2x"></i>
                <span class="sr-only">Siguiente</span>
            </a>
        </div>
    </div>
</div>
<br>
<div class="text-center">
    <button class="btn btn-primary btn-reseña" type="button">Escribe una reseña</button>
</div>
<br>
<div class="container">
    <img src="{{ asset('img/home/noticias.png') }}" alt="" width="100%">
</div>

<br><br><br><br><br>
<!-- FOOTER -->
@include('layouts.footer')
@endsection