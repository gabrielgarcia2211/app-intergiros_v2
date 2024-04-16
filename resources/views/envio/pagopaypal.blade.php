@extends('layouts.css-pago')

@section('content')
    <div class="container mt-5">
        <div class="text-center">
            <h3><strong>SOLICITUD DE SERVICIOS</strong></h3>
        </div>
        <pago-paypal-component :solicitud="{{ json_encode(request()->get('solicitud')) }}"></pago-paypal-component>
    </div>
@endsection
