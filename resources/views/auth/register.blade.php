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
                        <div class="text-center">
                            <label for="nombre" class="error"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control input-registro" name="email" id="email"
                            placeholder="Email">
                        <div class="text-center">
                            <label for="email" class="error"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="form-control input-registro" name="pais" id="pais">
                            <option value="1">País</option>
                            <option value="1">Colombia</option>
                            <option value="2">Venezuela</option>
                            <option value="3">Perú</option>
                            <!-- Agrega más opciones aquí -->
                        </select>
                        <div class="text-center">
                            <label for="pais" class="error"></label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control input-registro" name="apellidos" id="apellidos"
                            placeholder="Apellidos">
                        <div class="text-center">
                            <label for="apellidos" class="error"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <select class="form-control input-indicativo" name="paisTelefono1" id="paisTelefono1">
                                    <option value="1">+57</option>
                                    <option value="2">+58</option>
                                    <option value="3">+51</option>
                                    <!-- Agrega más opciones aquí -->
                                </select>
                                <div class="text-center">
                                    <label for="paisTelefono1" class="error"></label>
                                </div>
                            </div>
                            <input type="number" class="form-control input-telefono" name="telefono1" id="telefono1"
                                placeholder="Número celular">
                        </div>
                        <div class="text-center">
                            <label for="telefono1" class="error"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control input-registro" name="fehaNacimiento" id="fehaNacimiento"
                            placeholder="Fecha de nacimiento">
                        <div class="text-center">
                            <label for="fehaNacimiento" class="error"></label>
                        </div>
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
            <div class="form-row mt-5">
                <div class="form-group col-md-6">
                    <input type="email" class="form-control" name="inputEmail" id="inputEmail" placeholder="Email">
                    <div class="text-center">
                        <label for="inputEmail" class="error"></label>
                    </div>
                </div>
                <div class="form-group col-md-6"></div>
            </div>
            <div class="form-row mt-1">
                <div class="form-group col-md-6">
                    <div class="input-group">
                        <input type="password" class="form-control" name="inputPassword1" id="inputPassword1"
                            placeholder="Contraseña">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fa fa-eye toggle-password" toggle="#inputPassword1"></i>
                            </span>
                        </div>
                    </div>
                    <div class="text-center">
                        <label for="inputPassword1" class="error"></label>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="input-group">
                        <input type="password" class="form-control" name="inputPassword2" id="inputPassword2"
                            placeholder="Confirma la contraseña">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fa fa-eye toggle-password" toggle="#inputPassword2"></i>
                            </span>
                        </div>
                    </div>
                    <div class="text-center">
                        <label for="inputPassword2" class="error"></label>
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
                    <select class="form-control input-registro" id="redes1">
                        <option value="1">Plataforma</option>
                        <option value="2">Facebook</option>
                        <option value="3">Instagram</option>
                        <!-- Agrega más opciones aquí -->
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control input-registro" id="nombreUsuario1"
                        placeholder="Nombre de usuario">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group" id="otroP" style="display: none;">
                    <select class="form-control input-registro" id="redes2">
                        <option value="1">Plataforma</option>
                        <option value="2">Facebook</option>
                        <option value="3">Instagram</option>
                        <!-- Agrega más opciones aquí -->
                    </select>
                </div>
                <div class="form-group" id="otroN" style="display: none;">
                    <input type="text" class="form-control input-registro" id="nombrUsuario2"
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
        <a href="#" onclick="atrasDiv3()" class="atras"><i class="fas fa-solid fa-chevron-left"></i>
            Atrás</a>
        <br>
        <div class="text-center mt-5">
            <h5>Verifica tu identidad</h5>
            <h5>¡Ayúdanos a que todo el proceso sea más seguro!</h5>
        </div>
        <div class="form-row mt-5">
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <select class="form-control input-indicativo" id="paisTelefono2">
                            <option value="1">T</option>
                            <option value="2">CC</option>
                            <option value="3">A</option>
                            <!-- Agrega más opciones aquí -->
                        </select>
                    </div>
                    <input type="number" class="form-control input-telefono" id="telefono2"
                        placeholder="Número documento">
                </div>
                <div class="mt-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01">
                        <label class="custom-file-label input-registro" for="inputGroupFile01">Adjunta
                            selfie</label>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <h6>Tomate una foto tipo selfie con el documento de identidad en la mano.</h6>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile02">
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
            <div class="col-md-4 button text-center">
                <button type="button" class="btn btn-primary mb-2">Contactarnos</button>
            </div>
            <div class="col-md-4 button text-center">
                <button type="button" class="btn btn-primary mb-2">Ver mi perfil</button>
            </div>
            <div class="col-md-4 button text-center">
                <button type="button" class="btn btn-primary mb-2">Ir al panel de envios</button>
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
</style>
@endsection

@section('script')
<script src="{{ asset('js/registro/index.js') }}"></script>
@endsection