@extends('layouts.nav-admin')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Envio de Noticias</h1>
    </div>
    <hr>
    <!-- Contenido principal -->
    <div class="row mt-5">
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="asunto" aria-describedby="asuntoHelp"
                    placeholder="Asunto">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <select id="tipoNoticia" class="form-control form-control-user">
                    <option value="" selected>Tipo noticia</option>
                    <option value="">Noticias</option>
                    <option value="">Promiciones</option>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <textarea class="form-control form-control-user" id="mensaje" placeholder="Mensaje"></textarea>
    </div>
    <div class="text-center mt-3">
        <button class="btn btn-primary btn-user btn-block">Enviar</button>
    </div>

</div>
@endsection