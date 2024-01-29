var popupReclamo = "";

$(document).ready(function () {
    $('[data-toggle="collapse"]').on("click", function () {
        // Obtén el ID del icono
        var iconoId = $(this).find("i").attr("id");

        // Cambia la clase del icono específico
        $("#" + iconoId).toggleClass("fa-chevron-down fa-chevron-up");
    });

    popupReclamo = new bootstrap.Modal(document.getElementById("myReclamo"), {
        keyboard: false,
    });

    $("#myTab a").on("click", async function (e) {
        e.preventDefault();
        var tabId = $(this).attr("href");
        let solicitudesEnProceso = await getSolicitudes(tabId.replace("#", ""));
        if (tabId == "#en_proceso") {
            listSolicitudEnProceso(solicitudesEnProceso);
        } else if (tabId == "#pendiente") {
            listSolicitudPendiente(solicitudesEnProceso);
        } else if (tabId == "#entregado") {
            listSolicitudEntregado(solicitudesEnProceso);
        } else if (tabId == "#cancelado") {
            listSolicitudCancelado(solicitudesEnProceso);
        }
    });

    $("#myTab a:first").click();

    function getSolicitudes(estado) {
        return new Promise((resolve, reject) => {
            axios
                .get(`/historial/solicitudes/${estado}`)
                .then(function (response) {
                    resolve(response.data.data);
                })
                .catch(function (error) {
                    handleErrors(error);
                    reject(error);
                });
        });
    }

    function listSolicitudEnProceso(data) {
        let contenido = "";
        if (data.length == 0) {
            $(".sinMsjNotificacionEnProceso").show();
            return;
        }
        for (let i = 0; i < data.length; i++) {
            contenido += `<div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="text-center">
                                <img src="img/notificaciones/proceso.png" class="img-fluid"
                                    alt="" width="100px">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-left">
                                        <p style="margin-bottom: 0px;">ID#${
                                            data[i].id
                                        }</p>
                                        <p style="color: #0035aa;">Pedido en proceso</p>
                                        <p style="margin-bottom: 0px; color: #009d2c;">Monto pagado</p>
                                        <p style="color: #009d2c;">USD ${
                                            data[i].monto_a_pagar
                                        }</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <p>${data[i].created_at}</p>
    
                                        <p style="margin-bottom: 0px; color: #009d2c;">Monto a recibir</p>
                                        <p style="color: #009d2c;">${
                                            data[i].monto_a_recibir
                                        } BS.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="#proceso${i}" data-toggle="collapse" style="color: #818181;">
                            <i class="fas fa-chevron-down" id="iconoProceso1"></i>
                        </a>
                    </div>
                </div>
                <div id="proceso${i}" class="collapse container">
                    <div class="row">
                        <div class="col-6">
                            <div class="text-left">
                                <p>Tasa de cambio:</p>
                                <p>Pagado desde:</p>
                                <p>Enviado por:</p>
                                <p>Enviado a:</p>
                                <br>
                                <a class="btn btn-primary" onclick='openReclamo(${JSON.stringify(
                                    data[i]
                                )})'>Reclamar</a>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <p>USD 1 = ${
                                    data[i].tipo_formulario.tasa_cambios.valor
                                } Bs.</p>
                                <p>${data[i].tipo_formulario.descripcion}</p>
                                <p>${data[i].depositante.alias}</p>
                                <p>${data[i].beneficiario.alias}</p>
                                <p>${data[i].beneficiario.banco}</p>
                                <p>V ${data[i].beneficiario.cuenta}</p>
                                <p>${data[i].beneficiario?.pago_movil}</p>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>`;

            if (i != data.length) {
                contenido += "<hr>";
            }
        }

        $("#content_en_proceso").html(contenido);
    }

    function listSolicitudPendiente(data) {
        let contenido = "";
        if (data.length == 0) {
            $(".sinMsjNotificacionPendiente").show();
            return;
        }
        for (let i = 0; i < data.length; i++) {
            contenido += `<div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="text-center">
                                <img src="img/notificaciones/solucionar.png" class="img-fluid"
                                    alt="" width="100px">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-left">
                                        <p style="margin-bottom: 0px;">ID#${data[i].id}</p>
                                        <p style="color: #cf0000;">Datos erróneos del beneficiario</p>
                                        <p style="margin-bottom: 0px; color: #009d2c;">Monto pagado</p>
                                        <p style="color: #009d2c;">USD ${data[i].monto_a_pagar}</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <p>${data[i].created_at}</p>
    
                                        <p style="margin-bottom: 0px; color: #009d2c;">Monto a recibir</p>
                                        <p style="color: #009d2c;">${data[i].monto_a_recibir} BS.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="#solucionar${i}" data-toggle="collapse" style="color: #818181;">
                            <i class="fas fa-chevron-down" id="iconoSolucionar2"></i>
                        </a>
                    </div>
                </div>
                <div id="solucionar${i}" class="collapse container">
                    <div class="text-center">
                        <p><strong>Su solicitud ha sido rechazada debido a que el pago realizado no figura en
                                nuestra
                                cuenta.</strong></p>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="text-left">
                                <p>Tasa de cambio:</p>
                                <p>Pagado desde:</p>
                                <p>Enviado por:</p>
                                <p>Enviado a:</p>
                                <br>
                                <a class="btn btn-primary">Reclamar</a>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <p>USD 1 = ${data[i].tipo_formulario.tasa_cambios.valor} Bs.</p>
                                <p>${data[i].tipo_formulario.descripcion}</p>
                                <p>${data[i].depositante.alias}</p>
                                <p>${data[i].beneficiario.alias}</p>
                                <p>${data[i].beneficiario.banco}</p>
                                <p>V ${data[i].beneficiario.cuenta}</p>
                                <p>${data[i].beneficiario?.pago_movil}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;

            if (i != data.length) {
                contenido += "<hr>";
            }
        }

        $("#content_pendiente").html(contenido);
    }

    function listSolicitudEntregado(data) {
        let contenido = "";
        if (data.length == 0) {
            $(".sinMsjNotificacionEntregado").show();
            return;
        }
        for (let i = 0; i < data.length; i++) {
            contenido += ` 
            <div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="text-center">
                                <img src="img/notificaciones/aprobados.png" class="img-fluid"
                                    alt="" width="100px">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-left">
                                    <p style="margin-bottom: 0px;">ID#${data[i].id}</p>
                                        <p style="color: #0035aa;">Procesado</p>
                                        <p style="margin-bottom: 0px; color: #009d2c;">Monto pagado</p>
                                        <p style="color: #009d2c;">USD ${data[i].monto_a_pagar}</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <p>${data[i].created_at}</p>
    
                                        <p style="color: #009d2c;">${data[i].monto_a_recibir} BS.</p>
                                        <p style="color: #009d2c;">301,20 BS.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="#procesados${i}" data-toggle="collapse" style="color: #818181;">
                            <i class="fas fa-chevron-down" id="iconoProcesado1"></i>
                        </a>
                    </div>
                </div>
                <div id="procesados${i}" class="collapse container">
                    <div class="row">
                        <div class="col-6">
                            <div class="text-left">
                                <p>Tasa de cambio:</p>
                                <p>Pagado desde:</p>
                                <p>Enviado por:</p>
                                <p>Enviado a:</p>
                                <br><br>
                                <a href="#" style="color: #0035aa;" id="openModal">Ver comprobante</a>
                                <br><br>
                                <a class="btn btn-primary" id="openReclamo"> Reclamar </a>
                            </div>
                        </div>
                        <div class="col-6">
                        <div class="text-right">
                            <p>USD 1 = ${data[i].tipo_formulario.tasa_cambios.valor} Bs.</p>
                            <p>${data[i].tipo_formulario.descripcion}</p>
                            <p>${data[i].depositante.alias}</p>
                            <p>${data[i].beneficiario.alias}</p>
                            <p>${data[i].beneficiario.banco}</p>
                            <p>V ${data[i].beneficiario.cuenta}</p>
                            <p>${data[i].beneficiario?.pago_movil}</p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>`;

            if (i != data.length) {
                contenido += "<hr>";
            }
        }

        $("#content_entregado").html(contenido);
    }

    function listSolicitudCancelado(data) {
        let contenido = "";
        if (data.length == 0) {
            $(".sinMsjNotificacionCancelado").show();
            return;
        }
        for (let i = 0; i < data.length; i++) {
            contenido += `
            <div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="text-center">
                                <img src="img/notificaciones/rechazados.png" class="img-fluid"
                                    alt="" width="100px">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-left">
                                        <p style="margin-bottom: 0px;">ID#${data[i].id}</p>
                                        <p>Rechazado</p>
                                        <p style="margin-bottom: 0px;">Monto pagado</p>
                                        <p>USD ${data[i].monto_a_pagar}</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <p>${data[i].created_at}</p>
    
                                        <p style="margin-bottom: 0px;">Monto a recibir</p>
                                        <p>${data[i].monto_a_recibir} BS.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="#rechazados${i}" data-toggle="collapse" style="color: #818181;">
                            <i class="fas fa-chevron-down" id="iconoRechazado1"></i>
                        </a>
                    </div>
                </div>
                <div id="rechazados${i}" class="collapse container">
                    <div class="text-center">
                        <p><strong>Su solicitud ha sido rechazada debido a que el pago realizado no figura en
                                nuestra
                                cuenta.</strong></p>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="text-left">
                                <p>Tasa de cambio:</p>
                                <p>Pagado desde:</p>
                                <p>Enviado por:</p>
                                <p>Enviado a:</p>
                                <br><br>
                                <a class="btn btn-primary" id="openContacto">Contáctanos</a>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <p>USD 1 = ${data[i].tipo_formulario.tasa_cambios.valor} Bs.</p>
                                <p>${data[i].tipo_formulario.descripcion}</p>
                                <p>${data[i].depositante.alias}</p>
                                <p>${data[i].beneficiario.alias}</p>
                                <p>${data[i].beneficiario.banco}</p>
                                <p>V ${data[i].beneficiario.cuenta}</p>
                                <p>${data[i].beneficiario?.pago_movil}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;

            if (i != data.length) {
                contenido += "<hr>";
            }
        }

        $("#content_cancelado").html(contenido);
    }

    window.openReclamo = function (data) {
        popupReclamo.show();
        $("#idReclamo").html("<strong>ID # " + data.id + "</strong>");
    };

    window.closeReclamo = function () {
        popupReclamo.hide();
    };
});


document.getElementById('motivoReclamo').addEventListener('change', function () {
    var divParaMostrar = document.getElementById('divChecks');
    var info = document.getElementById('info');
    var texto = document.getElementById('texto');
    divParaMostrar.style.display = this.value === '2' ? 'block' : 'none';
    info.style.display = this.value === '2' ? 'block' : 'none';
    texto.style.display = this.value === '2' ? 'none' : 'block';
});

document.getElementById('otraCuenta').addEventListener('change', function () {
    var selectParaMostrar = document.getElementById('selectCuenta');
    selectParaMostrar.style.display = this.checked ? 'block' : 'none';
});

document.getElementById('cuentas').addEventListener('change', function () {
    var divParaMostrar = document.getElementById('infoCuenta');
    divParaMostrar.style.display = 'block';
});






/* Modal Comprobate
// Obtén el modal
var modal = document.getElementById("myModal");

// Obtén el botón que abre el modal
var btn = document.getElementById("openModal");

// Obtén el elemento <span> que cierra el modal
var span = document.getElementsByClassName("close")[0];

// Cuando el usuario haga clic en el botón, abre el modal
btn.onclick = function () {
    modal.style.display = "block";
};

// Cuando el usuario haga clic en <span> (x), cierra el modal
span.onclick = function () {
    modal.style.display = "none";
};

// Cuando el usuario haga clic en cualquier lugar fuera del modal, cierra el modal
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};

/* Modal Contacto 
// Obtén el modal
var modal = document.getElementById("myContacto");

// Obtén el botón que abre el modal
var btn = document.getElementById("openContacto");

// Obtén el elemento <span> que cierra el modal
var span = document.getElementsByClassName("closeContacto")[0];

// Cuando el usuario haga clic en el botón, abre el modal
btn.onclick = function () {
    modal.style.display = "block";
};

// Cuando el usuario haga clic en <span> (x), cierra el modal
span.onclick = function () {
    modal.style.display = "none";
};

// Cuando el usuario haga clic en cualquier lugar fuera del modal, cierra el modal
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};

/* Modal Reclamo 
// Obtén el modal
var modal = document.getElementById("myReclamo");

// Obtén el botón que abre el modal
var btn = document.getElementById("openReclamo");

// Obtén el elemento <span> que cierra el modal
var span = document.getElementsByClassName("closeReclamo")[0];

// Cuando el usuario haga clic en el botón, abre el modal
btn.onclick = function () {
    modal.style.display = "block";
};

// Cuando el usuario haga clic en <span> (x), cierra el modal
span.onclick = function () {
    modal.style.display = "none";
};

// Cuando el usuario haga clic en cualquier lugar fuera del modal, cierra el modal
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};
*/
