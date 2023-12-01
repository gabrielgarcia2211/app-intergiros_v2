@extends('layouts.nav-user')

@section('content')
    <div class="container mt-5 contenedor-perfil">
        <div class="row">
            <div class="col-md-3 text-center">
                <img src="{{ asset('img/perfil/people.jpg') }}" alt="" width="200px">
                <img src="{{ asset('img/perfil/verificado.png') }}" alt="" width="50px" class="verificado">
            </div>
            <div class="col-md-9">
                <h4><strong>User ID #0001</strong></h4>
                <h4>Nombre del usuario</h4>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-3 text-center">
                <a href="">Cambiar foto</a>
            </div>
            <div class="col-md-9">

            </div>
        </div>
        <div class="container">
            <ul class="nav nav-tabs" id="myTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab"
                        aria-controls="tab1" aria-selected="true">Datos personales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2"
                        aria-selected="false">Verificacion de usuario</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabsContent">
                <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                    <!-- Contenido de la pestaña 1 -->
                    <form action="" id="formActualizarInfo">
                        <div class="form-row mt-5">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" class="form-control input-registro" id="email" name="email"
                                        placeholder="Email" disabled>
                                    <div class="text-center">
                                        <label for="email" class="error"></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select class="form-control input-registro" id="pais" name="pais" disabled>
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
                                <div class="form-group" style="margin-bottom: 16px;">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <select class="form-control input-indicativo" id="paisTelefono"
                                                name="paisTelefono" disabled>
                                                <option value="1">+57</option>
                                                <option value="2">+58</option>
                                                <option value="3">+51</option>
                                            </select>
                                            <div class="text-center">
                                                <label for="paisTelefono" class="error"></label>
                                            </div>
                                        </div>
                                        <input type="number" class="form-control input-telefono" id="telefono"
                                            name="telefono" placeholder="Número celular" disabled>
                                    </div>
                                    <div class="text-center">
                                        <label for="telefono" class="error"></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="date" class="form-control input-registro" id="fehaNacimiento"
                                        name="fehaNacimiento" placeholder="Fecha de nacimiento" disabled>
                                    <div class="text-center">
                                        <label for="fehaNacimiento" class="error"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row" id="ocultar">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="password" class="form-control" id="esteNo" placeholder="Contraseña"
                                        disabled>
                                    <div class="text-center">
                                        <label></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">

                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6" style="display: none;" id="passwordDisplay1">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="inputPassword1"
                                        name="inputPassword1" placeholder="Contraseña">
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
                            <div class="form-group col-md-6" style="display: none;" id="passwordDisplay2">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="inputPassword2"
                                        name="inputPassword2" placeholder="Nueva contraseña">
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
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control input-registro" id="redes1" name="redes1" disabled>
                                        <option value="1">Facebook</option>
                                        <option value="2">Instagram</option>
                                        <!-- Agrega más opciones aquí -->
                                    </select>
                                    <div class="text-center">
                                        <label for="redes1" class="error"></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control input-registro" id="nombreUsuario1" name="nombreUsuario1"
                                        placeholder="Nombre de usuario" disabled>
                                    <div class="text-center">
                                        <label for="nombreUsuario1" class="error"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="otroP">
                                    <select class="form-control input-registro" id="redes2" name="redes2"disabled>
                                        <option value="1">Facebook</option>
                                        <option value="2">Instagram</option>
                                        <!-- Agrega más opciones aquí -->
                                    </select>
                                    <div class="text-center">
                                        <label for="redes2" class="error"></label>
                                    </div>
                                </div>
                                <div class="form-group" id="otroN">
                                    <input type="text" class="form-control input-registro" id="nombreUsuario2" name="nombreUsuario2"
                                        placeholder="Nombre de usuario" disabled>
                                    <div class="text-center">
                                        <label for="nombreUsuario2" class="error"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="text-center mt-5 button" id="habilitarDatos">
                            <a type="button" class="btn btn-primary mb-2" onclick="habilitarElementos()">Actualizar
                                datos</a>
                        </div>
                        <div class="text-center mt-5 button" style="display: none" id="actualizarDatos">
                            <button type="button" class="btn btn-primary mb-2" onclick="updateUser()">Guardar datos</button>
                        </div>
                    </form>
                </div>


                <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                    <form action="" id="formVerificacion">
                        <div class="text-center mt-5">
                            <p class="estado">Estado de la verificación: <strong>Sin verificar</strong></p>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <select class="form-control input-indicativo" id="tipoDocumento">
                                            <option value="1">T</option>
                                            <option value="2">CC</option>
                                            <option value="3">A</option>
                                            <!-- Agrega más opciones aquí -->
                                        </select>
                                        <div class="text-center">
                                            <label for="tipoDocumento" class="error"></label>
                                        </div>
                                    </div>
                                    <input type="number" class="form-control input-telefono" id="documento"
                                        placeholder="Número documento">
                                </div>
                                <div class="text-center">
                                    <label for="documento" class="error"></label>
                                </div>
                                <div class="mt-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile01">
                                        <label class="custom-file-label input-registro" for="inputGroupFile01">Adjunta
                                            selfie</label>
                                        <div class="text-center">
                                            <label for="inputGroupFile01" class="error"></label>
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
                                        <input type="file" class="custom-file-input" id="inputGroupFile02">
                                        <label class="custom-file-label input-registro" for="inputGroupFile02">Adjunta
                                            documento</label>
                                        <div class="text-center">
                                            <label for="inputGroupFile02" class="error"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="text-center mt-5 button">
                            <button type="button" class="btn btn-primary mb-2">Solicitar
                                verificación</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <br><br><br><br><br>
    <!-- FOOTER -->
    @include('layouts.footer')
@endsection
