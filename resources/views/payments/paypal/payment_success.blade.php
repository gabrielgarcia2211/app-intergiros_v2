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
        const channel = new BroadcastChannel("completPayPaypal");
        channel.postMessage({
            STATUS_PAYMENT: "success",
            MESSAGE_PAYMENT: "¡Tu pago se ha realizado con éxito!",
        });
        channel.close();
        window.setTimeout(() => {
            window.close();
        }, 3000);
    </script>
@endsection
