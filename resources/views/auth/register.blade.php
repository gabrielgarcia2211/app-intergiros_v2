@extends('layouts.app')

@section('content')
<div class="container login">
        <form action="" id="registro">
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
                <div class="row mt-5">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control input-registro" id="nombre" placeholder="Nombres">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control input-registro" id="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <select class="form-control input-registro" id="pais">
                                <option value="1">País</option>
                                <option value="2">Colombia</option>
                                <option value="3">Venezuela</option>
                                <option value="3">Perú</option>
                                <!-- Agrega más opciones aquí -->
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control input-registro" id="apellidos"
                                placeholder="Apellidos">
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <select class="form-control input-indicativo" id="paisTelefono">
                                        <option value="1">+57</option>
                                        <option value="2">+58</option>
                                        <option value="3">+51</option>
                                        <!-- Agrega más opciones aquí -->
                                    </select>
                                </div>
                                <input type="number" class="form-control input-telefono" id="telefono"
                                    placeholder="Número celular">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control input-registro" id="fehaNacimiento"
                                placeholder="Fecha de nacimiento">
                        </div>
                    </div>
                </div>
                <br>
                <div class="text-center mt-5 button">
                    <button type="button" class="btn btn-primary mb-2" onclick="mostrarDiv2()">Continuar</button>
                </div>
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
                <a href="#" onclick="atrasDiv1()" class="atras"><i class="fas fa-solid fa-chevron-left"></i> Atrás</a>
                <br>
                <div class="text-center mt-5">
                    <h5>Crea tu contraseña</h5>
                </div>
                <div class="form-row mt-5">
                    <div class="form-group col-md-6">
                        <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                    </div>
                    <div class="form-group col-md-6"></div>
                </div>
                <div class="form-row mt-1">
                    <div class="form-group col-md-6">
                        <div class="input-group">
                            <input type="password" class="form-control" id="inputPassword4" placeholder="Contraseña">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fa fa-eye toggle-password" toggle="#inputPassword4"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="input-group">
                            <input type="password" class="form-control" id="inputPassword4"
                                placeholder="Confirma la contraseña">
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
                    <button type="button" class="btn btn-primary mb-2" onclick="mostrarDiv3()">Continuar</button>
                </div>
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
                <a href="#" onclick="atrasDiv2()" class="atras"><i class="fas fa-solid fa-chevron-left"></i> Atrás</a>
                <br>
                <div class="text-center mt-5">
                    <h5>¿Por cuáles otras vías podemos contactarte?</h5>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <select class="form-control input-registro" id="pais">
                                <option value="1">Plataforma</option>
                                <option value="2">Facebook</option>
                                <option value="3">Instagram</option>
                                <!-- Agrega más opciones aquí -->
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control input-registro" id="nombre"
                                placeholder="Nombre de usuario">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="otroP" style="display: none;">
                            <select class="form-control input-registro" id="pais">
                                <option value="1">Plataforma</option>
                                <option value="2">Facebook</option>
                                <option value="3">Instagram</option>
                                <!-- Agrega más opciones aquí -->
                            </select>
                        </div>
                        <div class="form-group" id="otroN" style="display: none;">
                            <input type="text" class="form-control input-registro" id="nombre"
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
                <a href="#" onclick="atrasDiv3()" class="atras"><i class="fas fa-solid fa-chevron-left"></i> Atrás</a>
                <br>
                <div class="text-center mt-5">
                    <h5>Verifica tu identidad</h5>
                    <h5>¡Ayúdanos a que todo el proceso sea más seguro!</h5>
                </div>
                <div class="form-row mt-5">
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <select class="form-control input-indicativo" id="paisTelefono">
                                    <option value="1">T</option>
                                    <option value="2">CC</option>
                                    <option value="3">A</option>
                                    <!-- Agrega más opciones aquí -->
                                </select>
                            </div>
                            <input type="number" class="form-control input-telefono" id="telefono"
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
                                <input type="file" class="custom-file-input" id="inputGroupFile01">
                                <label class="custom-file-label input-registro" for="inputGroupFile01">Adjunta
                                    documento</label>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="text-center mt-5 button">
                    <button type="button" class="btn btn-primary mb-2">Continuar</button>
                </div>
                <div class="text-center">
                    <a href="#" class="atras" data-toggle="modal" data-target="#myModal">Omitir por ahora</a>
                </div>
            </div>
            <!-- DIV BIENVENIDA -->
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
        </form>
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
