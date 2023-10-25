@extends('layouts.app')
@section('content')
    <div class="container login">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="row mb-3">
                <div class="col-md-12">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ $email ?? old('email') }}" placeholder="Correo Electronico" required
                        autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="input-group" style="width: 97% !important">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" placeholder="Contraseña nueva" required autocomplete="new-password">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fa fa-eye toggle-password" toggle="#password"></i>
                        </span>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="input-group" style="width: 97% !important">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        placeholder="Confirmar contraseña" required autocomplete="new-password">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fa fa-eye toggle-password" toggle="#password-confirm"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <div class="row">
                    <div class="col-md-12 button">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Reset Password') }}
                        </button>
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
