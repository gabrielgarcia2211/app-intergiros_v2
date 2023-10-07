@extends('layouts.app')

@section('content')
    <div class="container login">
        <div class="text-center">
            <h4><strong>¡Nos alegra que estés de vuelta!</strong></h4>
        </div>
        <hr>
        <br>
        <div class="text-center mt-5">
            <h5>Ingresa tus datos de usuario</h5>
        </div>
        <form id="formLogin">
            @csrf
            <div class="form-row mt-5">
                <div class="form-group col-md-6">
                    <div id="inputEmail"></div>
                </div>
                <div class="form-group col-md-6">
                    <div class="input-group">
                        <div id="inputPassword"></div>
                    </div>
                </div>
            </div>
            <br>
            <div class="text-center mt-5 button">
                <div id="btn_login"></div>
            </div>
            <div class="text-center mt-3">
                <h5>¿Eres nuevo? <a href="{{ asset('registro') }}">¡Únete a la familia intergiros!</a></h5>
            </div>
        </form>
    </div>
    <br><br><br><br><br>
    <!-- FOOTER -->
    @include('layouts.footer')

    <!-- Modal -->
    <div class="modal fade" id="popupLogin" tabindex="-1" role="dialog" aria-labelledby="popupLoginLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="text-center">
                        <i class="fas fa-bell fa-3x"></i>
                    </div>
                </div>
                <div class="modal-body">
                    <p id="popupDataLogin"></p>
                    Si has olvidado tu contraseña pulsa "Restablecer"
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Intentar de nuevo</button>
                    <a href="#" type="button" class="btn btn-primary new-password">Restablecer</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/login/index.js') }}"></script>
@endsection
