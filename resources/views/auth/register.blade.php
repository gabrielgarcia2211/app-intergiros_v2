@extends('layouts.app')

@section('content')
<div class="container login">
    <!-- DIV INFORMACION GENERAL -->
    <form action="" id="formInfoGeneral">
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
            <div class="row mt-5">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control input-registro" name="nombre" id="nombre"
                            placeholder="Nombres">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control input-registro" name="email" id="email"
                            placeholder="Email">
                    </div>
                    <div class="form-group">
                        <select class="form-control input-registro" name="pais" id="pais">
                            <!-- Agrega más opciones aquí -->
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control input-registro" name="apellidos" id="apellidos"
                            placeholder="Apellidos">
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <select class="form-control input-indicativo" name="paisTelefono" id="paisTelefono">
                                    <!-- Agrega más opciones aquí -->
                                </select>
                            </div>
                            <input type="number" class="form-control input-telefono" name="telefono" id="telefono"
                                placeholder="Número celular">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control input-registro" name="fehaNacimiento" id="fehaNacimiento"
                            placeholder="Fecha de nacimiento">
                    </div>
                </div>
            </div>
            <br>
            <div class="text-center mt-5 button">
                <button type="button" class="btn btn-primary mb-2" onclick="mostrarDiv2()">Continuar</button>
            </div>
        </div>
    </form>
    <!-- DIV CONTRASEÑA -->
    <form action="" id="formPassword">
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
            <a href="#" onclick="atrasDiv1()" class="atras"><i class="fas fa-solid fa-chevron-left"></i>
                Atrás</a>
            <br>
            <div class="text-center mt-5">
                <h5>Crea tu contraseña</h5>
            </div>
            <div class="form-row mt-1">
                <div class="form-group col-md-6">
                    <div class="input-group">
                        <input type="password" class="form-control" name="inputPassword1" id="inputPassword1"
                            placeholder="Contraseña">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fa fa-eye toggle-password1" data-toggle="inputPassword1"
                                    onclick="togglePasswordVisibility1()"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="input-group">
                        <input type="password" class="form-control" name="inputPassword2" id="inputPassword2"
                            placeholder="Confirma la contraseña">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fa fa-eye toggle-password2" data-toggle="inputPassword2"
                                    onclick="togglePasswordVisibility2()"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="text-center mt-5 button">
                <button type="button" class="btn btn-primary mb-2" onclick="mostrarDiv3()">Continuar</button>
            </div>
        </div>
    </form>
    <!-- DIV REDES -->
    <form action="" id="formRedes">
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
            <a href="#" onclick="atrasDiv2()" class="atras"><i class="fas fa-solid fa-chevron-left"></i>
                Atrás</a>
            <br>
            <div class="text-center mt-5">
                <h5>¿Por cuáles otras vías podemos contactarte?</h5>
            </div>
            <div class="form-row mt-5">
                <div class="col-md-6">
                    <div class="form-group">
                        <select class="form-control input-registro" name="redes1" id="redes1">
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control input-registro" name="nombreUsuario1" id="nombreUsuario1"
                            placeholder="Nombre de usuario">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" id="otroP" style="display: none;">
                        <select class="form-control input-registro" name="redes2" id="redes2">
                        </select>
                    </div>
                    <div class="form-group" id="otroN" style="display: none;">
                        <input type="text" class="form-control input-registro" name="nombreUsuario2" id="nombreUsuario2"
                            placeholder="Nombre de usuario">
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="#" onclick="agregar()" id="agregar"><i class="fas fa-plus"></i> Agregar otro</a>
            </div>
            <br>
            <div class="text-center mt-5 button">
                <button type="button" class="btn btn-primary mb-2" onclick="mostrarDiv4()">Continuar</button>
            </div>
        </div>
    </form>
    <!-- DIV VERIFICACION -->
    <form action="" id="formVerificacion">
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
            <a href="#" onclick="atrasDiv3()" class="atras"><i class="fas fa-solid fa-chevron-left"></i>
                Atrás</a>
            <br>
            <div class="text-center mt-5">
                <h5>Verifica tu identidad</h5>
                <h5>¡Ayúdanos a que todo el proceso sea más seguro!</h5>
            </div>
            <div class="form-row mt-5">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <select class="form-control input-indicativo" name="tipoDocumento" id="tipoDocumento">
                                </select>
                            </div>
                            <input type="number" class="form-control input-telefono" name="documento" id="documento"
                                placeholder="Número documento">
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="inputGroupFile01"
                                    id="inputGroupFile01">
                                <label class="custom-file-label input-registro" for="inputGroupFile01">Adjunta
                                    selfie</label>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <h6>Tomate una foto tipo selfie con el documento de identidad en la mano.</h6>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="inputGroupFile02" id="inputGroupFile02">
                            <label class="custom-file-label input-registro" for="inputGroupFile02">Adjunta
                                documento</label>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="text-center mt-5 button">
                <button type="button" class="btn btn-primary mb-2" onclick="mostrarDiv5()">Continuar</button>
            </div>
            <div class="text-center">
                <a href="#" class="atras" data-toggle="modal" data-target="#myModal" onclick="omitirDiv5()">Omitir por ahora</a>
            </div>
        </div>
    </form>
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
            <h2 id="miH2"><strong></strong></h2>
            <h4><strong>!Te damos la bienvenida a la familia Intergiros!</strong></h4>
            <br><br>
            <h4>Cuéntanos qué deseas hacer</h4>
        </div>
        <div class="form-row mt-5">
            <div class="col-md-4 button text-center">
                <a class="btn btn-primary mb-2" href="">Contactarnos</a>
            </div>
            <div class="col-md-4 button text-center">
                <a class="btn btn-primary mb-2" href="{{ route('perfil') }}">Ver mi perfil</a>
            </div>
            <div class="col-md-4 button text-center">
                <a class="btn btn-primary mb-2" href="">Ir al panel de envios</a>
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


<style>
    .error {
        color: red;
    }

    .invalid-feedback {
        display: block;
        width: 100%;
        margin-top: .25rem;
    }
</style>
@endsection

@section('script')
<script src="{{ asset('js/registro/inputs.js') }}"></script>
<script src="{{ asset('js/registro/index.js') }}"></script>
@endsection