@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Pago Cancelado</div>

                    <div class="card-body">
                        Has cancelado el proceso de pago.
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
        var STATUS_PAYMENT = "error";
        var MESSAGE_PAYMENT = "¡Has cancelado el proceso de pago!";
    </script>
    <script src="{{ asset('js/payments/paypal/index.js') }}"></script>
@endsection
