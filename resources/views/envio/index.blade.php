@extends('layouts.css-envios')
{{-- @include('layouts.nav-user') --}}

@section('content')
    <div class="text-center mt-5">
        <h1><strong>¡Hola {{ Auth::user()->name }}!</strong></h1>
    </div>
    <div class="text-center mt-5">
        <button class="btn btn-primary" type="button" id="tasas-venezuela">Tasas para cambios a Venezuela</button>
    </div>
    <!-- <div class="text-center mt-5" id="slide-tasas">
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
                        </div>
                    </div>
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
                        </div>
                    </div>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <carousel-component></carousel-component>

    <div class="text-center mt-5">
        <h3><strong>¡Solicita tu pedido aquí!</strong></h3>
    </div>
    
    <servicio-component></servicio-component>
    <!-- FOOTER -->
    @include('layouts.footer')
@endsection
