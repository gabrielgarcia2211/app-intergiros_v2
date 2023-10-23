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
                    <input type="email" class="form-control" id="loginEmail" placeholder="Email" required>
                </div>
                <div class="form-group col-md-6">
                    <div class="input-group">
                        <input type="password" class="form-control" id="loginPassword" placeholder="Contraseña" required>
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fa fa-eye toggle-password" toggle="#inputPassword4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="text-center mt-5 button">
                <button type="submit" class="btn btn-primary mb-2">Iniciar Sesión</button>
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
                    Alguno de los datos ingresados no son correctos. Si has olvidado tu contraseña pulsa "Restablecer"
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Intentar de nuevo</button>
                    <a href="{{ asset('restablecer') }}" type="button" class="btn btn-primary new-password">Restablecer</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/login/index.js') }}"></script>
@endsection
