var popupPorSolucionar = "";
var popupEntregado = "";
var popupBeneficiarioAfiliado = "";
var solicitudId = "";
var adjuntarEstadoCuenta = "";

$(document).ready(function () {
    $("#formBeneficiarioAfiliado").validate({
        rules: {
            addAliasBeneficiario: {
                required: true,
            },
            addNombreBeneficiario: {
                required: true,
            },
            addDocumentoBeneficiario: {
                required: true,
                integer: true,
            },
            addBancoBeneficiario: {
                required: true,
            },
            addCuentaBeneficiario: {
                required: true,
            },
            addPagoMovilBeneficiario: {
                required: true,
            },
            addTipoDocumentoBeneficiario: {
                required: true,
            },
        },
        messages: {
            addAliasBeneficiario: {
                required: "El campo alias es obligatorio",
            },
            addNombreBeneficiario: {
                required: "El campo de nombre es obligatorio",
            },
            addDocumentoBeneficiario: {
                required: "El campo documento es obligatorio",
                integer: "Por favor, ingresa solo números enteros." 
            },
            addBancoBeneficiario: {
                required: "El campo banco es obligatorio",
            },
            addCuentaBeneficiario: {
                required: "El campo cuenta es obligatorio",
            },
            addPagoMovilBeneficiario: {
                required: "El campo pago movil es obligatorio",
            },
            addTipoDocumentoBeneficiario: {
                required: "El campo tipo documento es obligatorio",
            },
        },
        errorElement: "div",
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback text-center");
            element.closest(".form-group").append(error);
        },
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },
    });

    $("#divChecks, #divMensaje").hide();
    $(
        "#divChecksEntregado, #divMensajeEntregado, #divMensajeBeneficiario"
    ).hide();

    $('[data-toggle="collapse"]').on("click", function () {
        // Obtén el ID del icono
        var iconoId = $(this).find("i").attr("id");

        // Cambia la clase del icono específico
        $("#" + iconoId).toggleClass("fa-chevron-down fa-chevron-up");
    });

    popupPorSolucionar = new bootstrap.Modal(
        document.getElementById("popupPorSolucionar"),
        {
            keyboard: false,
        }
    );

    popupEntregado = new bootstrap.Modal(
        document.getElementById("popupEntregado"),
        {
            keyboard: false,
        }
    );

    popupBeneficiarioAfiliado = new bootstrap.Modal(
        document.getElementById("popupBeneficiarioAfiliado"),
        {
            keyboard: false,
        }
    );

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
                                <a class="btn btn-primary" onclick='openPopupPorSolucionar(${JSON.stringify(
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
                                    <p style="margin-bottom: 0px;">ID#${
                                        data[i].id
                                    }</p>
                                        <p style="color: #0035aa;">Procesado</p>
                                        <p style="margin-bottom: 0px; color: #009d2c;">Monto pagado</p>
                                        <p style="color: #009d2c;">USD ${
                                            data[i].monto_a_pagar
                                        }</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <p>${data[i].created_at}</p>
    
                                        <p style="color: #009d2c;">${
                                            data[i].monto_a_recibir
                                        } BS.</p>
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
                                <a href="#" style="color: #0035aa;" id="openModal${i}" onclick='viewComprobante(this, ${JSON.stringify(
                data[i]
            )})'>Ver comprobante </a>
                                <br><br>
                                <a class="btn btn-primary" id="openReclamo" onclick='openPopupEntregado(${JSON.stringify(
                                    data[i]
                                )})'> Reclamar </a>
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

    window.openPopupPorSolucionar = function (data) {
        removeElementsReclamoPorSolucionar();
        popupPorSolucionar.show();
        $("#idReclamo").html("<strong>ID # " + data.id + "</strong>");
        solicitudId = data.id;
    };

    window.closePopupPorSolucionar = function () {
        popupPorSolucionar.hide();
    };

    // popup reclamo
    $("#motivoReclamo").change(function () {
        if ($(this).val() !== "1") {
            $("#divChecks").show();
            $("#divMensaje").show();
        } else {
            $("#divChecks").hide();
            $("#divMensaje").hide();
        }
    });

    window.sendReclamo = function () {
        var opcionesSeleccionadas = [];
        $(".opcion-reclamo:checked").each(function () {
            opcionesSeleccionadas.push($(this).val());
        });
        var comentario = $("#comentarioReclamo").val();

        if (opcionesSeleccionadas.length === 0) {
            showError("Por favor, selecciona al menos una opción.");
            return;
        }

        var formData = {
            solicitud_id: solicitudId,
            opciones: opcionesSeleccionadas,
            comentario: comentario,
        };

        axios
            .post("/historial/store", formData)
            .then((response) => {
                showSuccess("Solicitud realizada correctamente!");
                popupPorSolucionar.hide();
            })
            .catch((actualizarError) => {
                handleErrors(actualizarError);
            });
    };

    function removeElementsReclamoPorSolucionar() {
        adjuntarEstadoCuenta = "";
        $(".opcion-reclamo:checked").prop("checked", false);
        $("#comentarioReclamo").val("");
        $("#motivoReclamo").val(1);
        $("#divChecks, #divMensaje").hide();
    }

    // popup entregado
    $("#motivoReclamoEntregado").change(function () {
        if ($(this).val() !== "1") {
            $("#divChecksEntregado").show();
            $("#divMensajeEntregado").show();
        } else {
            $("#divChecksEntregado").hide();
            $("#divMensajeEntregado").hide();
            $("#divMensajeBeneficiario").hide();
        }
    });

    window.viewComprobante = function (element, data) {
        let path = data.imagen_comprobante;
        let header = {
            id: data.id,
            fecha: data.created_at,
            correo: data.user.email,
        };

        showImageAlert(path, header);
    };

    window.uploadImageAfiliado = function () {
        var input = document.getElementById("adjuntarEstadoCuenta");
        var file = input.files[0];
        adjuntarEstadoCuenta = input.files[0];

        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var imageUrl = e.target.result;
                loadImageFromURL(imageUrl, "#adjuntarEstadoCuenta");
                updateButtonAndBindClick("btnPreview03", imageUrl);
            };
            reader.readAsDataURL(file);
        }
    };

    window.openPopupEntregado = function (data) {
        removeElementsReclamoEntregado();
        popupEntregado.show();
        $("#idReclamoEntregado").html("<strong>ID # " + data.id + "</strong>");
        solicitudId = data.id;
        loadTerceros();
    };

    window.verificarAfiliado = async function () {
        let detail = await showTercero($("#afiliadoEntregado").val(), "TB");
        setFieldsBeneficiario(detail);
    };

    window.closePopupEntregado = function () {
        popupEntregado.hide();
    };

    window.sendReclamoEntregado = function () {
        var opcionesSeleccionadas = [];
        var reintentarBeneficiarioESeleccionado = false;

        $(".opcion-reclamo-entregado:checked").each(function () {
            opcionesSeleccionadas.push($(this).val());
            if ($(this).attr("data-code") === "reintentar_beneficiario_e") {
                reintentarBeneficiarioESeleccionado = true;
            }
        });

        var comentario = $("#comentarioReclamoEntregado").val();
        var afiliadoSeleccionado = $("#afiliadoEntregado").val();

        if (opcionesSeleccionadas.length === 0) {
            showError("Por favor, selecciona al menos una opción.");
            return;
        }

        if (
            reintentarBeneficiarioESeleccionado &&
            afiliadoSeleccionado == null
        ) {
            showError("Por favor, selecciona un afiliado.");
            return;
        }

        var formData = {
            solicitud_id: solicitudId,
            opciones: opcionesSeleccionadas,
            comentario: comentario,
            beneficiario_id: afiliadoSeleccionado,
            estadoCuenta: adjuntarEstadoCuenta,
        };

        axios
            .post("/historial/store", formData, {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            })
            .then((response) => {
                showSuccess("Solicitud realizada correctamente!");
                popupEntregado.hide();
            })
            .catch((actualizarError) => {
                handleErrors(actualizarError);
            });
    };

    // popup benfeciario - afiliado
    window.openPopupBeneficiarioAfiliado = function () {
        popupBeneficiarioAfiliado.show();
        popupEntregado.hide();
    };

    window.closePopupBeneficiarioAfiliado = function (e) {
        e.preventDefault();
        popupBeneficiarioAfiliado.hide();
        popupEntregado.show();
    };

    function removeElementsReclamoEntregado() {
        adjuntarEstadoCuenta = "";
        $("#adjuntarEstadoCuenta").val("");
        loadImageFromURL("", "#adjuntarEstadoCuenta");
        updateButtonAndBindClick("btnPreview03", "");
        $(".opcion-reclamo-entregado:checked").prop("checked", false);
        $("#comentarioReclamoEntregado").val("");
        $("#afiliadoEntregado").val(0);
        $("#motivoReclamoEntregado").val(1);
        $("#aliasBeneficiario").val("");
        $("#nombreBeneficiario").val("");
        $("#documentoBeneficiario").val("");
        $("#bancoBeneficiario").val("");
        $("#cuentaBeneficiario").val("");
        $("#pagoMovilBeneficiario").val("");
        $("#tipoDocumentoBeneficiario").val("");
        $(
            "#divChecksEntregado, #divMensajeEntregado, #divMensajeBeneficiario"
        ).hide();
    }

    function setFieldsBeneficiario(beneficiario) {
        formDataBeneficiario = beneficiario.data;
        $("#aliasBeneficiario").val(beneficiario.data.alias);
        $("#nombreBeneficiario").val(beneficiario.data.nombre);
        $("#documentoBeneficiario").val(beneficiario.data.documento);
        $("#bancoBeneficiario").val(beneficiario.data.banco);
        $("#cuentaBeneficiario").val(beneficiario.data.cuenta);
        $("#pagoMovilBeneficiario").val(beneficiario.data.pago_movil);
        $("#tipoDocumentoBeneficiario").val(
            beneficiario.data.tipo_documento_id
        );
    }

    function getTerceros(code) {
        return new Promise(async (resolve, reject) => {
            try {
                const response = await axios.get("/terceros/list/" + code);
                resolve(response.data);
            } catch (error) {
                handleErrors(error);
                reject(error);
            }
        });
    }

    async function loadTerceros(){
        var beneficiarios = await getTerceros("TB");
        $("#afiliadoEntregado option").not('[value="0"]').remove();
        $.each(beneficiarios, function (key, value) {
            $("#afiliadoEntregado").append(
                $("<option>", { value: value.id }).text(value.nombre)
            );
        });
    }

    function showTercero(selectedValue, code) {
        return new Promise(async (resolve, reject) => {
            try {
                const response = await axios.get(
                    "/terceros/show/" + selectedValue + "/" + code
                );
                resolve(response.data);
            } catch (error) {
                handleErrors(error);
                reject(error);
            }
        });
    }

    window.addTercero = function (code, e) {
        e.preventDefault();
        if ($("#formBeneficiarioAfiliado").valid()) {
            var formData = new FormData($("#formBeneficiarioAfiliado")[0]);
            formData.append("code", code);
            axios
                .post("/terceros/store", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((response) => {
                    showSuccess(response.data.message);
                    loadTerceros();
                    popupBeneficiarioAfiliado.hide();
                    popupEntregado.show();
                })
                .catch((error) => {
                    handleErrors(error);
                });
        }
    };
});
