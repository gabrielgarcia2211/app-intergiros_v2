@extends('layouts.css-perfil')

@section('content')
    @if (Auth::check())
        <menu-component :home="'{{ route('home') }}'" :servicio="'{{ route('servicios.index') }}'"
            :usuario="'{{ Auth::user()->name }}'" :verificado="{{ Auth::user()->verificado }}"
            :notificacion="'{{ route('notificaciones.index') }}'" :perfil="'{{ route('perfil') }}'"
            :historial="'{{ route('historial') }}'" :logout="'{{ route('logout') }}'">
        </menu-component>
    @else
        <menu-component :home="'{{ route('home') }}'" :servicio="'{{ route('servicios.index') }}'"
            :notificacion="'{{ route('notificaciones.index') }}'" :registro="'{{ route('registro') }}'"
            :login="'{{ route('login') }}'">
        </menu-component>
    @endif
    <div class="container mt-5 contenedor-perfil">
        <div class="row">
            <div class="col-md-3 text-center">
                @if (empty(Auth()->user()->path_foto_perfil))
                    <img src="{{ asset('img/perfil/people.jpg') }}" alt="" width="200px">
                @else
                    <img src="{{ asset('comprobantes/' . Auth()->user()->path_foto_perfil) }}" alt="" width="200px"
                        height="200px">
                @endif
                @if (Auth()->user()->verificado == 1)
                    <img src="{{ asset('img/perfil/verificado.png') }}" alt="" width="50px" class="verificado">
                @endif
            </div>
            <div class="col-md-9">
                <h4><strong>User ID #000-{{ Auth()->user()->id }}</strong></h4>
                <h4>{{ Auth()->user()->name }} {{ Auth()->user()->apellidos }}</h4>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-3 text-center">
                @if (empty(Auth()->user()->path_foto_perfil))
                    <label for="file-upload" class="custom-file-upload">Subir foto</label>
                    <input id="file-upload" type="file" style="display:none;" onchange="updateFoto(this, 'UP')">
                @else
                    <a href="#" onclick="updateFoto({}, 'DELETE')">Eliminar foto</a>
                @endif
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
                                </div>
                                <div class="form-group">
                                    <select class="form-control input-registro" id="pais" name="pais" disabled>
                                        <!-- Agrega más opciones aquí -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" style="margin-bottom: 16px;">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <select class="form-control input-indicativo" id="paisTelefono"
                                                name="paisTelefono" disabled>
                                            </select>
                                        </div>
                                        <input type="number" class="form-control input-telefono" id="telefono"
                                            name="telefono" placeholder="Número celular" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="date" class="form-control input-registro" id="fehaNacimiento"
                                        name="fehaNacimiento" placeholder="Fecha de nacimiento" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-row" id="ocultar">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="password" class="form-control" id="esteNo" value="**********" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">

                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6" style="display: none;" id="passwordDisplay1">
                                <input type="password" class="form-control" id="inputPassword1" name="inputPassword1"
                                    placeholder="Contraseña">
                            </div>
                            <div class="form-group col-md-6" style="display: none;" id="passwordDisplay2">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="inputPassword2"
                                        name="inputPassword2" placeholder="Nueva contraseña">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-eye toggle-password" data-toggle="password"
                                                onclick="togglePasswordVisibility()"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control input-registro" id="redes1" name="redes1" disabled
                                        style="display: none">
                                        <!-- Agrega más opciones aquí -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control input-registro" id="nombreUsuario1"
                                        name="nombreUsuario1" placeholder="Nombre de usuario" disabled
                                        style="display: none">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="otroP">
                                    <select class="form-control input-registro" id="redes2" name="redes2" disabled
                                        style="display: none">
                                        <!-- Agrega más opciones aquí -->
                                    </select>
                                </div>
                                <div class="form-group" id="otroN">
                                    <input type="text" class="form-control input-registro" id="nombreUsuario2"
                                        name="nombreUsuario2" placeholder="Nombre de usuario" disabled
                                        style="display: none">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="text-center mt-5 button" id="habilitarDatos">
                            <a type="button" class="btn btn-primary mb-2" onclick="habilitarElementos()">Actualizar
                                datos</a>
                        </div>
                        <div class="text-center mt-5 button" style="display: none" id="actualizarDatos">
                            <button type="button" class="btn btn-primary mb-2" onclick="updateUser()">Guardar
                                datos</button>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                    <form action="" id="formVerificacion">
                        <div class="text-center mt-5">
                            <p class="estado">Estado de la verificación:
                                @if (Auth()->user()->verificado == 0)
                                    <strong>Sin verificar</strong>
                                @elseif(Auth()->user()->verificado == 1)
                                    <strong style="color: rgb(85, 170, 0)">Aprobado</strong>
                                @elseif(Auth()->user()->verificado == 2)
                                    <strong style="color: red">Rechazado</strong>
                                @elseif(Auth()->user()->verificado == 3)
                                    <strong style="color: rgb(0, 53, 170)">Verificación en proceso</strong>
                                @endif
                            </p>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <select class="form-control input-indicativo" id="tipoDocumento"
                                                name="tipoDocumento">
                                            </select>
                                        </div>
                                        <input type="text" class="form-control input-telefono" id="documento"
                                            name="documento" placeholder="Número documento" maxlength="15">
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-outline-secondary" type="button"
                                                        id="btnPreview01">
                                                        <i class="fas fa-eye-slash"></i>
                                                    </button>
                                                </div>
                                                <input type="file" class="custom-file-input" id="inputGroupFile01"
                                                    name="inputGroupFile01">
                                                <label class="custom-file-label input-registro" for="inputGroupFile01"
                                                    id="labelFile01">Adjunta
                                                    selfie</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <h6>Tomate una foto tipo selfie con el documento de identidad en la mano.</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary" type="button"
                                                    id="btnPreview02">
                                                    <i class="fas fa-eye-slash"></i>
                                                </button>
                                            </div>
                                            <input type="file" class="custom-file-input" id="inputGroupFile02"
                                                name="inputGroupFile02">
                                            <label class="custom-file-label input-registro" for="inputGroupFile02"
                                                id="labelFile02">Adjunta
                                                documento</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="text-center mt-5 button">
                            <button type="button" class="btn btn-primary mb-2" onclick="updateVerification()"
                                style="background-color: #0035aa" @if (auth()->user()->verificado === 3 || auth()->user()->verificado === 1) disabled @endif>
                                Solicitar verificación
                            </button>
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

@section('script')
    <script>
        var user_verificado = {!! json_encode(auth()->user()->verificado) !!}
    </script>
    <script src="{{ asset('js/perfil/input.js') }}?v={{ uniqid() }}"></script>
    <script src="{{ asset('js/perfil/index.js') }}?v={{ uniqid() }}"></script>
@endsection
