@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Verificacion de Usuarios</h1>
    </div>
    <hr>
    <!-- Contenido principal -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Numero de documento</th>
                            <th>Selfie con el documento</th>
                            <th>Foto del documento</th>
                            <th>Estado de la verificacion</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Numero de documento</th>
                            <th>Selfie con el documento</th>
                            <th>Foto del documento</th>
                            <th>Estado de la verificacion</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>Michael Bruce</td>
                            <td>Bruce</td>
                            <td>2165461564</td>
                            <td><button class="btn btn-user btn-block" id="selfieFoto"><i
                                        class="fas fa-eye"></i></button></td>
                            <td><button class="btn btn-user btn-block" id="documentoFoto"><i
                                        class="fas fa-eye"></i></button></td>
                            <td>
                                <div class="row">
                                    <div class="col-md-8">
                                        <select id="estado" class="form-control form-control-user">
                                            <option value="">En proceso</option>
                                            <option value="">Verificado</option>
                                            <option value="">Rechazado</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-user btn-block" id="guardarEstado"><i
                                                class="fas fa-save"></i></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Donna</td>
                            <td>Snider</td>
                            <td>23156423</td>
                            <td><button class="btn btn-user btn-block" id="selfieFoto"><i
                                        class="fas fa-eye"></i></button></td>
                            <td><button class="btn btn-user btn-block" id="documentoFoto"><i
                                        class="fas fa-eye"></i></button></td>
                            <td>
                                <div class="row">
                                    <div class="col-md-8">
                                        <select id="estado" class="form-control form-control-user">
                                            <option value="">En proceso</option>
                                            <option value="">Verificado</option>
                                            <option value="">Rechazado</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-user btn-block" id="guardarEstado"><i
                                                class="fas fa-save"></i></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection