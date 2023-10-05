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
        <form>
            <div class="form-row mt-5">
                <div class="form-group col-md-6">
                    <div id="inputEmail"></div>
                </div>
                <div class="form-group col-md-6"></div>
            </div>
            <div class="form-row mt-1" hidden>
                <div class="form-group col-md-6">
                    <div class="input-group">
                        <div id="inputPasswordNuevo"></div>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="input-group">
                        <div id="inputPasswordConfirma"></div>
                    </div>
                </div>
            </div>
            <br>
            <div class="text-center mt-5 button">
                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary mb-2">Cancelar</button>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary mb-2">Restablecer</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <br><br><br><br><br>
    <!-- FOOTER -->
    @include('layouts.footer')

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
                            <div id="codigoRecuperacion"></div>
                            <input type="number" class="form-control" id="inputEmail4" placeholder="CÓDIGO">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div id="reenviarButton"></div>
                        <div id="enviarButton"></div>
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
    {{-- <script src="{{ asset('js/home/index.js') }}"></script> --}}
@endsection