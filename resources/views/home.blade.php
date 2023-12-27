@extends('layouts.nav-home')

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
                <select class="custom-select custom-select-lg mb-3 text-white" id="selectorCambioHome">
                    <option value="null" selected>Selecciona el servicio de tu interés</option>
                    <option value="TP-01">Cambiar saldo PayPal a Venezuela</option>
                    <option value="TP-01">Cambiar saldo PayPal a Perú</option>
                    <option value="TP-09">Cambiar saldo USDT a Venezuela</option>
                    <option value="TP-05">Enviar dinero de Perú a Venezuela</option>
                    <option value="TP-07">Enviar dinero de Colombia a Venezuela</option>
                </select>
            </div>
        </div>
        <p class="text-select">Para desplegar su información general y tasas</p>
    </div>
    <!-- TP-01 -->
    <div class="container cambios" style="display: none;" id="TP-01">
        <div class="row">
            <div class="col-md-5 info">
                <img src="{{ asset('img/home/TDC Intergiros - PayPal.png') }}" class="img-fluid" alt="">
                <div class="row mt-5">
                    <div class="col-3 icon">
                        <img src="{{ asset('img/home/Ícono de Monto mínimo.png') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-9">
                        <h5>Monto mínimo</h5>
                        <p>$5 USD + comisión PayPal</p>
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
                        <p>Banesco,BDV,pago móvil</p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-3 icon">
                        <img src="{{ asset('img/home/Ícono términos y condiciones.png') }}" class="img-fluid"
                            alt="">
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
                    <input type="number" class="form-control w-100%" id="montoCambiarHome" placeholder="Monto a enviar"
                        onkeyup="obtenerValor(this.value)">
                </div>
                <div class="text-center">
                    <img src="{{ asset('img/home/Ícono para la calculadora.png') }}" class="img-fluid" alt="">
                </div>
                <div class="form-group mt-4">
                    <input type="number" class="form-control w-100%" id="montoRecibirHome" placeholder="Monto a recibir"
                        readonly>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <h4>Comisiones:</h4>
                        <h4>Total a pagar:</h4>
                        <h4>Tipo de cambio:</h4>
                    </div>
                    <div class="col-6 text-right">
                        <h4>$ <span id="monto_a_pagar_home">0.00</span> USD</h4>
                        <h4>$ <span id="monto_a_recibir_comision" style="display: inline-block">0.00</span> USD</h4>
                        <h4>$1 USD=30,00 BS</h4>
                    </div>
                </div>
                <div class="mt-5">
                    <h4>No cobramos comisión por envíos. La única comisión que debe ser asumida por el cliente es la
                        comisión cobrada por PayPal en sus transacciones.</h4>
                </div>
                <!-- <div class="mt-5 text-center">
                                            <h6>Si realizas un pedido ahora:</h6>
                                            <button type="button" class="btn btn-primary">Recibirás el dinero máximo el 29 de agosto</button>
                                        </div> -->
            </div>
        </div>
    </div>

    <!-- TP-01 -->
    <div class="container cambios" style="display: none;" id="TP-01">
        <div class="row">
            <div class="col-md-5 info">
                <img src="{{ asset('img/home/TDC Intergiros - PayPal.png') }}" class="img-fluid" alt="">
                <div class="row mt-5">
                    <div class="col-3 icon">
                        <img src="{{ asset('img/home/Ícono de Monto mínimo.png') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-9">
                        <h5>Monto mínimo</h5>
                        <p>$5 USD + comisión PayPal</p>
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
                        <p>Banesco,BDV,pago móvil</p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-3 icon">
                        <img src="{{ asset('img/home/Ícono términos y condiciones.png') }}" class="img-fluid"
                            alt="">
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
                    <input type="number" class="form-control w-100%" id="montoCambiarHome" placeholder="Monto a enviar"
                        onkeyup="obtenerValor(this.value)">
                </div>
                <div class="text-center">
                    <img src="{{ asset('img/home/Ícono para la calculadora.png') }}" class="img-fluid" alt="">
                </div>
                <div class="form-group mt-4">
                    <input type="number" class="form-control w-100%" id="montoRecibirHome"
                        placeholder="Monto a recibir">
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <h4>Comisiones:</h4>
                        <h4>Total a pagar:</h4>
                        <h4>Tipo de cambio:</h4>
                    </div>
                    <div class="col-6 text-right">
                        <h4>$ <span id="monto_a_pagar_home">0.00</span> USD</h4>
                        <h4>$ <span id="monto_a_recibir_comision" style="display: inline-block">0.00</span> USD</h4>
                        <h4>$1 USD=30,00 BS</h4>
                    </div>
                </div>
                <div class="mt-5">
                    <h4>No cobramos comisión por envíos. La única comisión que debe ser asumida por el cliente es la
                        comisión cobrada por PayPal en sus transacciones.</h4>
                </div>
                <!-- <div class="mt-5 text-center">
                                        <h6>Si realizas un pedido ahora:</h6>
                                        <button type="button" class="btn btn-primary">Recibirás el dinero máximo el 29 de agosto</button>
                                    </div> -->
            </div>
        </div>
    </div>

    <!-- TP-09 -->
    <div class="container cambios" style="display: none;" id="TP-09">
        <div class="row">
            <div class="col-md-5 info">
                <img src="{{ asset('img/home/TDC Intergiros - USDT.png') }}" class="img-fluid" alt="">
                <div class="row mt-5">
                    <div class="col-3 icon">
                        <img src="{{ asset('img/home/Ícono de Monto mínimo.png') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-9">
                        <h5>Monto mínimo</h5>
                        <p>$5 USD + comisión PayPal</p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-3 icon">
                        <img src="{{ asset('img/home/Ícono traansferencias en.png') }}" class="img-fluid"
                            alt="">
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
                        <p>Banesco,BDV,pago móvil</p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-3 icon">
                        <img src="{{ asset('img/home/Ícono términos y condiciones.png') }}" class="img-fluid"
                            alt="">
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
                    <input type="number" class="form-control w-100%" id="montoCambiarHome" placeholder="Monto a enviar"
                        onkeyup="obtenerValor(this.value)">
                </div>
                <div class="text-center">
                    <img src="{{ asset('img/home/Ícono para la calculadora.png') }}" class="img-fluid" alt="">
                </div>
                <div class="form-group mt-4">
                    <input type="number" class="form-control w-100%" id="montoRecibirHome"
                        placeholder="Monto a recibir" readonly>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <h4>Comisiones:</h4>
                        <h4>Total a pagar:</h4>
                        <h4>Tipo de cambio:</h4>
                    </div>
                    <div class="col-6 text-right">
                        <h4>$ <span id="monto_a_pagar_home">0.00</span> USD</h4>
                        <h4>$ <span id="monto_a_recibir_comision" style="display: inline-block">0.00</span> USD</h4>
                        <h4>$1 USD=30,00 BS</h4>
                    </div>
                </div>
                <div class="mt-5">
                    <h4>No cobramos comisión por envíos. La única comisión que debe ser asumida por el cliente es la
                        comisión cobrada por PayPal en sus transacciones.</h4>
                </div>
                <!-- <div class="mt-5 text-center">
                                        <h6>Si realizas un pedido ahora:</h6>
                                        <button type="button" class="btn btn-primary">Recibirás el dinero máximo el 29 de agosto</button>
                                    </div> -->
            </div>
        </div>
    </div>

    <!-- TP-05 -->
    <div class="container cambios" style="display: none;" id="TP-05">
        <div class="row">
            <div class="col-md-5 info">
                <img src="{{ asset('img/home/TDC Intergiros - Perú.png') }}" class="img-fluid" alt="">
                <div class="row mt-5">
                    <div class="col-3 icon">
                        <img src="{{ asset('img/home/Ícono de Monto mínimo.png') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-9">
                        <h5>Monto mínimo</h5>
                        <p>$5 USD + comisión PayPal</p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-3 icon">
                        <img src="{{ asset('img/home/Ícono traansferencias en.png') }}" class="img-fluid"
                            alt="">
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
                        <p>Banesco,BDV,pago móvil</p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-3 icon">
                        <img src="{{ asset('img/home/Ícono términos y condiciones.png') }}" class="img-fluid"
                            alt="">
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
                    <input type="number" class="form-control w-100%" id="montoCambiarHome" placeholder="Monto a enviar"
                        onkeyup="obtenerValor(this.value)">
                </div>
                <div class="text-center">
                    <img src="{{ asset('img/home/Ícono para la calculadora.png') }}" class="img-fluid" alt="">
                </div>
                <div class="form-group mt-4">
                    <input type="number" class="form-control w-100%" id="montoRecibirHome"
                        placeholder="Monto a recibir" readonly>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <h4>Comisiones:</h4>
                        <h4>Total a pagar:</h4>
                        <h4>Tipo de cambio:</h4>
                    </div>
                    <div class="col-6 text-right">
                        <h4>$ <span id="monto_a_pagar_home">0.00</span> USD</h4>
                        <h4>$ <span id="monto_a_recibir_comision" style="display: inline-block">0.00</span> USD</h4>
                        <h4>$1 USD=30,00 BS</h4>
                    </div>
                </div>
                <div class="mt-5">
                    <h4>No cobramos comisión por envíos. La única comisión que debe ser asumida por el cliente es la
                        comisión cobrada por PayPal en sus transacciones.</h4>
                </div>
                <!-- <div class="mt-5 text-center">
                                        <h6>Si realizas un pedido ahora:</h6>
                                        <button type="button" class="btn btn-primary">Recibirás el dinero máximo el 29 de agosto</button>
                                    </div> -->
            </div>
        </div>
    </div>

    <!-- TP-07 -->
    <div class="container cambios" style="display: none;" id="TP-07">
        <div class="row">
            <div class="col-md-5 info">
                <img src="{{ asset('img/home/TDC Intergiros - Colombia.png') }}" class="img-fluid" alt="">
                <div class="row mt-5">
                    <div class="col-3 icon">
                        <img src="{{ asset('img/home/Ícono de Monto mínimo.png') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-9">
                        <h5>Monto mínimo</h5>
                        <p>$5 USD + comisión PayPal</p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-3 icon">
                        <img src="{{ asset('img/home/Ícono traansferencias en.png') }}" class="img-fluid"
                            alt="">
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
                        <p>Banesco,BDV,pago móvil</p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-3 icon">
                        <img src="{{ asset('img/home/Ícono términos y condiciones.png') }}" class="img-fluid"
                            alt="">
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
                    <input type="number" class="form-control w-100%" id="montoCambiarHome" placeholder="Monto a enviar"
                        onkeyup="obtenerValor(this.value)">
                </div>
                <div class="text-center">
                    <img src="{{ asset('img/home/Ícono para la calculadora.png') }}" class="img-fluid" alt="">
                </div>
                <div class="form-group mt-4">
                    <input type="number" class="form-control w-100%" id="montoRecibirHome"
                        placeholder="Monto a recibir" readonly>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <h4>Comisiones:</h4>
                        <h4>Total a pagar:</h4>
                        <h4>Tipo de cambio:</h4>
                    </div>
                    <div class="col-6 text-right">
                        <h4>$ <span id="monto_a_pagar_home">0.00</span> USD</h4>
                        <h4>$ <span id="monto_a_recibir_comision" style="display: inline-block">0.00</span> USD</h4>
                        <h4>$1 USD=30,00 BS</h4>
                    </div>
                </div>
                <div class="mt-5">
                    <h4>No cobramos comisión por envíos. La única comisión que debe ser asumida por el cliente es la
                        comisión cobrada por PayPal en sus transacciones.</h4>
                </div>
                <!-- <div class="mt-5 text-center">
                                        <h6>Si realizas un pedido ahora:</h6>
                                        <button type="button" class="btn btn-primary">Recibirás el dinero máximo el 29 de agosto</button>
                                    </div> -->
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
