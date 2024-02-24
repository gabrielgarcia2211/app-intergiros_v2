@extends('layouts.nav-admin')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Envio de Noticias</h1>
    </div>
    <hr>
    <!-- Contenido principal -->
    <noticia-component></noticia-component>

</div>
@endsection