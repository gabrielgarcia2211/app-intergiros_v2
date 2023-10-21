@extends('layouts.app')

@section('content')
<div class="container login">
    <!-- DIV INFORMACION GENERAL -->
    <div id="div1">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="timeline">
                    <div class="circle">1</div>
                    <div class="line"></div>
                    <div class="circle">2</div>
                    <div class="line"></div>
                    <div class="circle">3</div>
                    <div class="line"></div>
                    <div class="circle">4</div>
                </div>
            </div>
        </div>
        <hr>
        <br>
        <div class="text-center mt-5">
            <h5>Suminístranos tus datos personales</h5>
        </div>
        <form id="formInfoGeneral">
            <div class="row mt-5">
                <div class="col-md-6">
                    <div class="form-group">
                        <div id="inputNombresRegistro"></div>
                    </div>
                    <div class="form-group">
                        <div id="inputEmailRegistro"></div>
                    </div>
                    <div class="form-group">
                        <div id="inputPaisRegistro"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div id="inputApellidosRegistro"></div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div id="inputIndicativoRegistro"></div>
                            </div>
                            <div id="inputTelefonoRegistro"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div id="inputNacimientoRegistro"></div>
                    </div>
                </div>
            </div>
            <br>
            <div class="text-center mt-5">
                <div id="btn_infoGeneral"></div>
            </div>
        </form>

    </div>

    <!-- DIV CONTRASEÑA -->
    <div id="div2" style="display: none;">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="timeline">
                    <div class="circle" style="background-color: #0035aa; color: white;">1</div>
                    <div class="line"></div>
                    <div class="circle">2</div>
                    <div class="line"></div>
                    <div class="circle">3</div>
                    <div class="line"></div>
                    <div class="circle">4</div>
                </div>
            </div>
        </div>
        <hr>
        {{-- <a href="#" onclick="atrasDiv1()" class="atras"><i class="fas fa-solid fa-chevron-left"></i>
            Atrás</a>
        <br> --}}
        <div id="atrasDiv1"></div>
        <div class="text-center mt-5">
            <h5>Crea tu contraseña</h5>
        </div>
        <form id="formInfoPassword">
            <div class="form-row mt-5">
                <div class="form-group col-md-6">
                    <div class="input-group">
                        <div id="inputContraseñaRegistro"></div>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div id="inputConfirmaRegistro"></div>
                </div>
            </div>
            <br>
            <div class="text-center mt-5">
                <div id="btn_infoPassword"></div>
            </div>
        </form>
    </div>

    <!-- DIV REDES -->
    <div id="div3" style="display: none;">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="timeline">
                    <div class="circle" style="background-color: #0035aa; color: white;">1</div>
                    <div class="line"></div>
                    <div class="circle" style="background-color: #0035aa; color: white;">2</div>
                    <div class="line"></div>
                    <div class="circle">3</div>
                    <div class="line"></div>
                    <div class="circle">4</div>
                </div>
            </div>
        </div>
        <hr>
        {{--  <a href="#" onclick="atrasDiv2()" class="atras"><i class="fas fa-solid fa-chevron-left"></i>
            Atrás</a>
        <br> --}}
        <div id="atrasDiv2"></div>
        <div class="text-center mt-5">
            <h5>¿Por cuáles otras vías podemos contactarte?</h5>
        </div>
        <form id="formInfoRedes">
            <div class="form-row mt-5">
                <div class="col-md-6">
                    <div id="inputPlataforma1Registro"></div>
                    <div class="mt-3"></div>
                    <div id="inputRed1Registro"></div>
                </div>
                <div class="col-md-6">
                    <div id="otroP" style="display: none;">
                        <div id="inputPlataforma2Registro"></div>
                        <div class="mt-3"></div>
                        <div id="inputRed2Registro"></div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="#" onclick="agregar()" id="agregar"><i class="fas fa-plus"></i> Agregar otro</a>
            </div>
            <br>
            <div class="text-center mt-5 ">
                <div id="btn_infoRedes"></div>
            </div>
        </form>
    </div>

    <!-- DIV VERIFICACION -->
    <div id="div4" style="display: none;">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="timeline">
                    <div class="circle" style="background-color: #0035aa; color: white;">1</div>
                    <div class="line"></div>
                    <div class="circle" style="background-color: #0035aa; color: white;">2</div>
                    <div class="line"></div>
                    <div class="circle" style="background-color: #0035aa; color: white;">3</div>
                    <div class="line"></div>
                    <div class="circle">4</div>
                </div>
            </div>
        </div>
        <hr>
        {{-- <a href="#" onclick="atrasDiv3()" class="atras"><i class="fas fa-solid fa-chevron-left"></i>
            Atrás</a>
        <br> --}}
        <div id="atrasDiv3"></div>
        <div class="text-center mt-5">
            <h5>Verifica tu identidad</h5>
            <h5>¡Ayúdanos a que todo el proceso sea más seguro!</h5>
        </div>
        <form id="formInfoValidacion">
            <div class="form-row mt-5">
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div id="inputTipoDocRegistro"></div>
                        </div>
                        <div id="inputDocumentoRegistro"></div>
                    </div>
                </div>
                <div class="col-md-6">
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6">
                    <div class="mt-3">
                        <div id="fileSelfieRegistro"></div>
                    </div>
                    <div class="text-center mt-4">
                        <h6>Tomate una foto tipo selfie con el documento de identidad en la mano.</h6>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mt-3" id="fileUploaderContainer">
                        <div id="fileDocumentoRegistro"></div>
                    </div>
                </div>
            </div>
            <br>
            <div class="text-center mt-5">
                <div id="btn_infoValidacion"></div>
            </div>
        </form>
        <div class="text-center">
            <a href="#" class="atras" data-toggle="modal" data-target="#myModal">Omitir por ahora</a>
        </div>
    </div>
    <!-- DIV BIENVENIDA -->
    <div id="div5" style="display: none;">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="timeline">
                    <div class="circle" style="background-color: #0035aa; color: white;">1</div>
                    <div class="line"></div>
                    <div class="circle" style="background-color: #0035aa; color: white;">2</div>
                    <div class="line"></div>
                    <div class="circle" style="background-color: #0035aa; color: white;">3</div>
                    <div class="line"></div>
                    <div class="circle" style="background-color: #0035aa; color: white;">4</div>
                </div>
            </div>
        </div>
        <hr>
        <br>
        <div class="text-center mt-5">
            <i class="fas fa-check fa-7x"></i>
            <br>
            <h2><strong>Nombre del registrado</strong></h2>
            <h4><strong>!Te damos la bienvenida a la familia Intergiros!</strong></h4>
            <br><br>
            <h4>Cuéntanos qué deseas hacer</h4>
        </div>
        <div class="form-row mt-5">
            <div class="col-md-4 text-center">
                <button type="button" class="btn btn-primary mb-2 button-login">Contactarnos</button>
            </div>
            <div class="col-md-4 text-center">
                <button type="button" class="btn btn-primary mb-2 button-login">Ver mi perfil</button>
            </div>
            <div class="col-md-4 text-center">
                <button type="button" class="btn btn-primary mb-2 button-login">Ir al panel de envios</button>
            </div>
        </div>
    </div>
</div>

<br><br><br><br><br>
<!-- FOOTER -->
@include('layouts.footer')
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="text-center">
                    <i class="fas fa-bell fa-3x"></i>
                </div>
            </div>
            <div class="modal-body">
                Si omites este paso ahora, podrás completarlo en otro memonto, crear tu usuario y acceder a él,
                <strong>pero no podrás realizar pedidos</strong>
            </div>
            <div class="modal-footer">
                <div id="btn_omitirValidacion"></div>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Ir atrás</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/registro/index.js') }}"></script>
@endsection