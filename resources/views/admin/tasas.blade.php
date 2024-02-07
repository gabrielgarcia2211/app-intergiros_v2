@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cambio de Tasas</h1>
</div>
<hr>
<!-- Contenido principal -->
<div class="row mt-5">
    <div class="col-md-4">
        <div class="form-group">
            <select id="monedaOrigen" class="form-control form-control-user">
                <option value="" selected>Moneda de origen</option>
                <option value="" >PayPal</option>
                <option value="" >Zinli</option>
                <option value="" >Bolivares</option>
                <option value="" >Pesos colombianos</option>
                <option value="" >Bolivares</option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <select id="monedaDestino" class="form-control form-control-user">
                <option value="" selected>Moneda destino</option>
                <option value="" >Bolivares</option>
                <option value="" >Pesos colombianos</option>
                <option value="" >Soles</option>
                <option value="" >Dolares</option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <input type="number" class="form-control form-control-user"
                id="tasa" aria-describedby="tasaHelp"
                placeholder="Tasa">
        </div>
    </div>
</div>

<div class="text-center mt-3">
    <button class="btn btn-primary btn-user btn-block">Guardar</button>
</div>

</div>
<!-- /.container-fluid -->
@endsection