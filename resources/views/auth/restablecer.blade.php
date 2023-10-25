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
    <div class="form-row mt-5">
        <div class="form-group col-md-6">
            <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
        </div>
        <div class="form-group col-md-6"></div>
    </div>
    <div class="form-row mt-1" style="display: none;">
        <div class="form-group col-md-6">
            <div class="input-group">
                <input type="password" class="form-control" id="inputPassword4" placeholder="Contraseña nueva">
                <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="fa fa-eye toggle-password" toggle="#inputPassword4"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <div class="input-group">
                <input type="password" class="form-control" id="inputPassword4" placeholder="Confirma la contraseña">
                <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="fa fa-eye toggle-password" toggle="#inputPassword4"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="text-center mt-5">
        <div class="row">
            <div class="col-md-6 button">
                <a href="{{ asset('login') }}" type="button" class="btn btn-primary mb-2 button-login">Cancelar</a>
            </div>
            <div class="col-md-6 button">
                <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">Restablecer</button>
            </div>
        </div>
    </div>
</div>
<br><br><br><br><br>
<!-- FOOTER -->
@include('layouts.footer')

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="text-center">
                    <i class="fas fa-bell fa-3x"></i>
                </div>
            </div>
            <div class="modal-body">
                Ingrese el código que recibirás en tu correo electrónico para restablecer tu contraseña.
                <form action="">
                    <div class="codigo">
                        <input type="number" class="form-control" id="inputEmail4" placeholder="CÓDIGO">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Reenviar código</button>
                <button type="button" class="btn btn-primary">Enviar</button>
            </div>
            <div class="text-center cancel">
                <a href="" data-dismiss="modal">Cancelar</a>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/recuperacion/index.js') }}"></script>
@endsection