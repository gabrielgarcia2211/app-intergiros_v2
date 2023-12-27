@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Pago Exitoso</div>

                    <div class="card-body">
                        ¡Tu pago se ha realizado con éxito!
                        <br><br>
                        <a href="{{ route('perfil') }}">Volver al inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var STATUS_PAYMENT = "success";
        var MESSAGE_PAYMENT = "¡Tu pago se ha realizado con éxito!";
    </script>
    <script src="{{ asset('js/payments/paypal/index.js') }}"></script>
@endsection
