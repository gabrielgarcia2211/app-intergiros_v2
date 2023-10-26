@extends('layouts.app')

@section('content')
<div class="container login">
    <div class="text-center">
        <h4><strong>¿Olvidaste tu contraseña? ¡No te preocupes!</strong></h4>
    </div>
    <hr>
    <br>
    <div class="text-center mt-5">
        <h5>Ingresa tu correo electrónico para restablecer la contraseña</h5>
    </div>
    @if (session('status'))
    <div class="alert alert-success text-center" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-row mt-5">
            <div class="form-group col-md-12">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" placeholder="Email" autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback text-center" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group col-md-6"></div>
        </div>
        <div class="text-center mt-5">
            <div class="row">
                <div class="col-md-6 button">
                    <button type="submit" class="btn btn-primary mb-2">Restablecer</button>
                </div>
                <div class="col-md-6 button">
                    <a href="{{ asset('login') }}" type="button" class="btn btn-primary mb-2 button-login">Cancelar</a>
                </div>
            </div>
        </div>
    </form>
    <br>
</div>
<br><br><br><br><br>
<!-- FOOTER -->
@include('layouts.footer')
@endsection

@section('script')
<script src="{{ asset('js/recuperacion/index.js') }}"></script>
@endsection