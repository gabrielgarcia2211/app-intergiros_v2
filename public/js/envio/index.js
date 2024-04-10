var beneficiario = document.getElementById("beneficiario");
var depositante = document.getElementById("depositante");

var elementos1 = document.getElementsByClassName("miInput1");
var selects1 = document.getElementsByClassName("miSelect1");
var elementos2 = document.getElementsByClassName("miInput2");
var selects2 = document.getElementsByClassName("miSelect2");

var miSelect1 = document.getElementById("selectBeneficiario");
var miSelect2 = document.getElementById("selectDepositante");

var cuentaNueva1 = document.getElementById("cuentaNueva1");
var cuentaExistente1 = document.getElementById("cuentaExistente1");
var cuentaNueva2 = document.getElementById("cuentaNueva2");
var cuentaExistente2 = document.getElementById("cuentaExistente2");
var adjuntarFoto = document.getElementById("adjuntarFoto");

var formDataBeneficiario;
var formDataDepositante;
var tipoFormularioCode;

var calculoFormulario = {
    monto_a_pagar: null,
    monto_a_recibir: null,
};
var depositantesPaypal = null;
var beneficiariosPaypal = null;

$(document).ready(async function () {
    $("#inputGroupSelect01").change(function () {
        var selectedValue = $(this).val();
        var selectedOption = $(this).find("option:selected");
        tipoFormularioCode = selectedOption.data("code");
        localStorage.setItem("selectedService", $("#inputGroupSelect01").val());
        $(".panel").hide();
        switch (selectedValue) {
            case "1":
                initServicePaypal();
                $("#panel-paypal").show();
                break;
            case "6":
                initServiceUsdt();
                $("#panel-usdt").show();
                break;
            default:
                break;
        }
    });
});

/* ---- INICIO PAYPAL*/
async function initServicePaypal() {
    beneficiariosPaypal = null;
    depositantesPaypal = null;
    $("#selectBeneficiario")
        .empty()
        .append('<option value="0" selected>Selecciona</option>');
    $("#selectDepositante")
        .empty()
        .append('<option value="0" selected>Selecciona</option>');

    $("#formBeneficiario").validate({
        rules: {
            paypalAliasBeneficiario: {
                required: true,
            },
            paypalNombreBeneficiario: {
                required: true,
            },
            paypalDocumentoBeneficiario: {
                required: true,
                integer: true,
            },
            paypalBancoBeneficiario: {
                required: true,
            },
            paypalCuentaBeneficiario: {
                required: true,
            },
            paypalPagoMovilBeneficiario: {
                required: true,
            },
            paypalTipoDocumentoBeneficiario: {
                required: true,
            },
        },
        messages: {
            paypalAliasBeneficiario: {
                required: "El campo alias es obligatorio",
            },
            paypalNombreBeneficiario: {
                required: "El campo de nombre es obligatorio",
            },
            paypalDocumentoBeneficiario: {
                required: "El campo documento es obligatorio",
                integer: "Por favor, ingresa solo números enteros.",
            },
            paypalBancoBeneficiario: {
                required: "El campo banco es obligatorio",
            },
            paypalCuentaBeneficiario: {
                required: "El campo cuenta es obligatorio",
            },
            paypalPagoMovilBeneficiario: {
                required: "El campo pago movil es obligatorio",
            },
            paypalTipoDocumentoBeneficiario: {
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
    $("#formDepositante").validate({
        rules: {
            paypalAliasDepositante: {
                required: true,
            },
            paypalNombreDepositante: {
                required: true,
            },
            paypalTipoDocumentoDepositante: {
                required: true,
            },
            paypalDocumentoDepositante: {
                required: true,
                integer: true,
            },
            paypalCorreoDepositante: {
                required: true,
            },
            paypalIndicativoDepositante: {
                required: true,
            },
            paypalCelularDepositante: {
                required: true,
            },
            paypalPaisDepositante: {
                required: true,
            },
            adjuntarDocumento: {
                required: true,
                filesize: FILE_MAX_SIZE,
            },
        },
        messages: {
            paypalAliasDepositante: {
                required: "El campo alias es obligatorio",
            },
            paypalNombreDepositante: {
                required: "El campo de nombre es obligatorio",
            },
            paypalTipoDocumentoDepositante: {
                required: "El campo tipo documento es obligatorio",
            },
            paypalDocumentoDepositante: {
                required: "El campo documento es obligatorio",
                integer: "Por favor, ingresa solo números enteros.",
            },
            paypalCorreoDepositante: {
                required: "El campo correo depositante es obligatorio",
            },
            paypalIndicativoDepositante: {
                required: "El campo celular es obligatorio",
            },
            paypalCelularDepositante: {
                required: "El campo celular es obligatorio",
            },
            paypalPaisDepositante: {
                required: "El campo pais es obligatorio",
            },
            adjuntarDocumento: {
                required: "La foto del documento es obligatoria",
                filesize: "El tamaño del archivo debe ser menor a 2MB",
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

    beneficiariosPaypal = await getTerceros("TB", "TP-01");
    depositantesPaypal = await getTerceros("TD", "TP-01");

    $.each(beneficiariosPaypal, function (key, value) {
        $("#selectBeneficiario").append(
            $("<option>", { value: value.id }).text(value.nombre)
        );
    });

    $.each(depositantesPaypal, function (key, value) {
        $("#selectDepositante").append(
            $("<option>", { value: value.id }).text(value.nombre)
        );
    });

    $("#montoCambiar").keyup(async function () {
        let calculo = await devFormatoMoneda(tipoFormularioCode, $(this).val());
        $("#monto_a_pagar_paypal").html(calculo.data.monto_a_pagar);
        $("#monto_a_recibir_paypal").html(calculo.data.monto_a_recibir);
        calculoFormulario.monto_a_pagar = calculo.data.monto_a_pagar;
        calculoFormulario.monto_a_recibir = calculo.data.monto_a_recibir;
        checkRealizarPago();
    });
}

function activarBeneficiario() {
    var editBeneficiario = document.getElementById("editBeneficiario");
    var guardarEdit = document.getElementById("guardarEdit1");
    editBeneficiario.style.display = "block";
    guardarEdit.style.display = "none";
    for (var i = 0; i < elementos1.length; i++) {
        elementos1[i].removeAttribute("disabled");
        elementos1[i].value = "";
    }
    for (var j = 0; j < selects1.length; j++) {
        selects1[j].removeAttribute("disabled");
    }
    miSelect1.value = "0";
    cuentaExistente1.style.display = "none";
    cuentaNueva1.style.display = "block";
    beneficiario.style.display = "block";
}

function activarEditBeneficiario() {
    var editBeneficiario = document.getElementById("editBeneficiario");
    var guardarEdit = document.getElementById("guardarEdit1");
    editBeneficiario.style.display = "none";
    guardarEdit.style.display = "block";
    for (var i = 0; i < elementos1.length; i++) {
        elementos1[i].removeAttribute("disabled");
    }
    for (var j = 0; j < selects1.length; j++) {
        selects1[j].removeAttribute("disabled");
    }
}

function activarDepositante() {
    var editDepositante = document.getElementById("editDepositante");
    var guardarEdit = document.getElementById("guardarEdit2");
    editDepositante.style.display = "block";
    guardarEdit.style.display = "none";
    for (var i = 0; i < elementos2.length; i++) {
        elementos2[i].removeAttribute("disabled");
        elementos2[i].value = "";
    }
    for (var j = 0; j < selects2.length; j++) {
        selects2[j].removeAttribute("disabled");
    }
    miSelect2.value = "0";
    cuentaExistente2.style.display = "none";
    adjuntarFoto.style.display = "block";
    cuentaNueva2.style.display = "block";
    depositante.style.display = "block";
    $("#btnPreview01").prop("disabled", true);
}

function activarEditDepositante() {
    var editDepositante = document.getElementById("editDepositante");
    var guardarEdit = document.getElementById("guardarEdit2");
    var adjuntarFoto = document.getElementById("adjuntarFoto");
    adjuntarFoto.style.display = "block";
    editDepositante.style.display = "none";
    guardarEdit.style.display = "block";
    for (var i = 0; i < elementos2.length; i++) {
        elementos2[i].removeAttribute("disabled");
    }
    for (var j = 0; j < selects2.length; j++) {
        selects2[j].removeAttribute("disabled");
    }
}

async function verificarSelect1() {
    if (miSelect1.value !== "") {
        // Muestra el div si la opción no es la por defecto
        for (var i = 0; i < elementos1.length; i++) {
            elementos1[i].setAttribute("disabled", "disabled");
            elementos1[i].value = "";
        }
        for (var j = 0; j < selects1.length; j++) {
            selects1[j].setAttribute("disabled", "disabled");
        }
        cuentaNueva1.style.display = "none";
        cuentaExistente1.style.display = "block";
        beneficiario.style.display = "block";

        var details = await showTercero("TB", "TP-01");
        setFieldsBeneficiario(details);
        checkRealizarPago();
    } else {
        // Oculta el div si la opción es la por defecto
        beneficiario.style.display = "none";
    }
}

async function verificarSelect2() {
    if (miSelect2.value !== "") {
        // Muestra el div si la opción no es la por defecto
        for (var i = 0; i < elementos2.length; i++) {
            elementos2[i].setAttribute("disabled", "disabled");
            elementos2[i].value = "";
        }
        for (var j = 0; j < selects2.length; j++) {
            selects2[j].setAttribute("disabled", "disabled");
        }
        cuentaNueva2.style.display = "none";
        adjuntarFoto.style.display = "none";
        cuentaExistente2.style.display = "block";
        depositante.style.display = "block";

        var details = await showTercero("TD", "TP-01");
        setFieldsDepositante(details);
        checkRealizarPago();
    } else {
        // Oculta el div si la opción es la por defecto
        depositante.style.display = "none";
    }
}

function setFieldsBeneficiario(beneficiario) {
    formDataBeneficiario = beneficiario.data;
    $("#paypalAliasBeneficiario").val(beneficiario.data.alias);
    $("#paypalNombreBeneficiario").val(beneficiario.data.nombre);
    $("#paypalDocumentoBeneficiario").val(beneficiario.data.documento);
    $("#paypalBancoBeneficiario").val(beneficiario.data.banco);
    $("#paypalCuentaBeneficiario").val(beneficiario.data.cuenta);
    $("#paypalPagoMovilBeneficiario").val(beneficiario.data.pago_movil);
    $("#paypalTipoDocumentoBeneficiario").val(
        beneficiario.data.tipo_documento_id
    );
}

function setFieldsDepositante(depositante) {
    formDataDepositante = depositante.data;
    $("#paypalAliasDepositante").val(depositante.data.alias);
    $("#paypalNombreDepositante").val(depositante.data.nombre);
    $("#paypalDocumentoDepositante").val(depositante.data.documento);
    $("#paypalCorreoDepositante").val(depositante.data.correo);
    $("#paypalCelularDepositante").val(depositante.data.celular);
    $("#paypalIndicativoDepositante").val(depositante.data.pais_telefono_id);
    $("#paypalTipoDocumentoDepositante").val(
        depositante.data.tipo_documento_id
    );
    $("#paypalPaisDepositante").val(depositante.data.pais_id);
    if (depositante.data.path_documento) {
        loadImageFromURL(depositante.data.path_documento, "#adjuntarDocumento");
        updateButtonAndBindClick(
            "btnPreview01",
            depositante.data.path_documento
        );
    }
}
/* FIN PAYPAL */

var usdtBeneficiario = document.getElementById("usdtBeneficiario");
var usdtDepositante = document.getElementById("usdtDepositante");

var selectUsdt1 = document.getElementsByClassName("selectUsdt1");
var selectUsdt2 = document.getElementsByClassName("selectUsdt2");

var selectBeneficiarioUsdt = document.getElementById("selectBeneficiarioUsdt");
var selectDepositanteUsdt = document.getElementById("selectDepositanteUsdt");

var elementosUsdt1 = document.getElementsByClassName("inputUsdt1");
var elementosUsdt2 = document.getElementsByClassName("inputUsdt2");

var usdtExistente1 = document.getElementById("usdtExistente1");
var usdtExistente2 = document.getElementById("usdtExistente2");
var usdtNueva1 = document.getElementById("usdtNueva1");
var usdtNueva2 = document.getElementById("usdtNueva2");

var adjuntarDocumentoUsdt = document.getElementById("adjuntarFotoUsdt");

var depositantesUsdt = null;
var beneficiariosUsdt = null;

var formDataBeneficiarioUsdt;
var formDataDepositanteUsdt;

/* ------- INICIO USDT */
async function initServiceUsdt() {
    beneficiariosUsdt = null;
    depositantesUsdt = null;
    $("#selectBeneficiarioUsdt")
        .empty()
        .append('<option value="0" selected>Selecciona</option>');
    $("#selectDepositanteUsdt")
        .empty()
        .append('<option value="0" selected>Selecciona</option>');

    $("#formBeneficiarioUsdt").validate({
        rules: {
            usdtAliasBeneficiario: {
                required: true,
            },
            usdtNombreBeneficiario: {
                required: true,
            },
            usdtDocBeneficiario: {
                required: true,
                integer: true,
            },
            usdtBancoBeneficiario: {
                required: true,
            },
            usdtCuentaBeneficiario: {
                required: true,
            },
            usdtTipoCuentaBeneficiario: {
                required: true,
            },
            usdtPagoMovilBeneficiario: {
                required: true,
            },
            usdtTipoDocBeneficiario: {
                required: true,
            },
        },
        messages: {
            usdtAliasBeneficiario: {
                required: "El campo alias es obligatorio",
            },
            usdtNombreBeneficiario: {
                required: "El campo de nombre es obligatorio",
            },
            usdtDocBeneficiario: {
                required: "El campo documento es obligatorio",
                integer: "Por favor, ingresa solo números enteros.",
            },
            usdtBancoBeneficiario: {
                required: "El campo banco es obligatorio",
            },
            usdtCuentaBeneficiario: {
                required: "El campo cuenta es obligatorio",
            },
            usdtTipoCuentaBeneficiario: {
                required: "El campo tipo cuenta es obligatorio",
            },
            usdtPagoMovilBeneficiario: {
                required: "El campo pago movil es obligatorio",
            },
            usdtTipoDocBeneficiario: {
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
    $("#formDepositanteUsdt").validate({
        rules: {
            usdtAliasDepositante: {
                required: true,
            },
            usdtNombreDepositante: {
                required: true,
            },
            usdtTipoDocDepositante: {
                required: true,
            },
            usdtDocDepositante: {
                required: true,
                integer: true,
            },
            usdtEmailDepositante: {
                required: true,
            },
            usdtIndicativoDepositante: {
                required: true,
            },
            usdtCelularDepositante: {
                required: true,
            },
            usdtPaisDepositante: {
                required: true,
            },
            adjuntarDocumentoUsdt: {
                required: true,
                filesize: FILE_MAX_SIZE,
            },
        },
        messages: {
            usdtAliasDepositante: {
                required: "El campo alias es obligatorio",
            },
            usdtNombreDepositante: {
                required: "El campo de nombre es obligatorio",
            },
            usdtTipoDocDepositante: {
                required: "El campo tipo documento es obligatorio",
            },
            usdtDocDepositante: {
                required: "El campo documento es obligatorio",
                integer: "Por favor, ingresa solo números enteros.",
            },
            usdtEmailDepositante: {
                required: "El campo correo depositante es obligatorio",
            },
            usdtIndicativoDepositante: {
                required: "El campo celular es obligatorio",
            },
            usdtCelularDepositante: {
                required: "El campo celular es obligatorio",
            },
            usdtPaisDepositante: {
                required: "El campo pais es obligatorio",
            },
            adjuntarDocumentoUsdt: {
                required: "La foto del documento es obligatoria",
                filesize: "El tamaño del archivo debe ser menor a 2MB",
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

    beneficiariosUsdt = await getTerceros("TB", "TP-02");
    depositantesUsdt = await getTerceros("TD", "TP-02");

    $.each(beneficiariosUsdt, function (key, value) {
        $("#selectBeneficiarioUsdt").append(
            $("<option>", { value: value.id }).text(value.nombre)
        );
    });

    $.each(depositantesUsdt, function (key, value) {
        $("#selectDepositanteUsdt").append(
            $("<option>", { value: value.id }).text(value.nombre)
        );
    });
}

function activarBeneficiarioUsdt() {
    for (var i = 0; i < elementosUsdt1.length; i++) {
        elementosUsdt1[i].removeAttribute("disabled");
        elementosUsdt1[i].value = "";
    }
    for (var j = 0; j < selectUsdt1.length; j++) {
        selectUsdt1[j].removeAttribute("disabled");
    }
    selectBeneficiarioUsdt.value = "0";
    usdtExistente1.style.display = "none";
    usdtNueva1.style.display = "block";
    usdtBeneficiario.style.display = "block";
}

function editBeneficiarioUsdt() {
    var editUsdt1 = document.getElementById("editUsdt1");
    var guardarEditUsdt1 = document.getElementById("guardarEditUsdt1");
    editUsdt1.style.display = "none";
    guardarEditUsdt1.style.display = "block";
    for (var i = 0; i < elementosUsdt1.length; i++) {
        elementosUsdt1[i].removeAttribute("disabled");
    }
    for (var j = 0; j < selectUsdt1.length; j++) {
        selectUsdt1[j].removeAttribute("disabled");
    }
}

function activarDepositanteUsdt() {
    for (var i = 0; i < elementosUsdt2.length; i++) {
        elementosUsdt2[i].removeAttribute("disabled");
        elementosUsdt2[i].value = "";
    }
    for (var j = 0; j < selectUsdt2.length; j++) {
        selectUsdt2[j].removeAttribute("disabled");
    }
    selectDepositanteUsdt.value = "0";
    usdtExistente2.style.display = "none";
    usdtNueva2.style.display = "block";
    adjuntarDocumentoUsdt.removeAttribute("disabled");
    adjuntarDocumentoUsdt.style.display = "block";
    usdtDepositante.style.display = "block";
}

function editDepositanteUsdt() {
    var editUsdt2 = document.getElementById("editUsdt2");
    var guardarEditUsdt2 = document.getElementById("guardarEditUsdt2");
    editUsdt2.style.display = "none";
    guardarEditUsdt2.style.display = "block";
    for (var i = 0; i < elementosUsdt2.length; i++) {
        elementosUsdt2[i].removeAttribute("disabled");
    }
    for (var j = 0; j < selectUsdt2.length; j++) {
        selectUsdt2[j].removeAttribute("disabled");
    }
}

async function verificarSelectUsdt1() {
    if (selectBeneficiarioUsdt.value !== "") {
        // Muestra el div si la opción no es la por defecto
        for (var i = 0; i < elementosUsdt1.length; i++) {
            elementosUsdt1[i].setAttribute("disabled", "disabled");
            elementosUsdt1[i].value = "";
        }
        for (var j = 0; j < selectUsdt1.length; j++) {
            selectUsdt1[j].setAttribute("disabled", "disabled");
        }
        usdtNueva1.style.display = "none";
        usdtExistente1.style.display = "block";
        usdtBeneficiario.style.display = "block";

        var details = await showTercero("TB", "TP-02");
        setFieldsBeneficiarioUsdt(details);
    } else {
        // Oculta el div si la opción es la por defecto
        usdtBeneficiario.style.display = "none";
    }
}

async function verificarSelectUsdt2() {
    if (selectDepositanteUsdt.value !== "") {
        // Muestra el div si la opción no es la por defecto
        for (var i = 0; i < elementosUsdt2.length; i++) {
            elementosUsdt2[i].setAttribute("disabled", "disabled");
            elementosUsdt2[i].value = "";
        }
        for (var j = 0; j < selectUsdt2.length; j++) {
            selectUsdt2[j].setAttribute("disabled", "disabled");
        }
        usdtNueva2.style.display = "none";
        adjuntarDocumentoUsdt.setAttribute("disabled", "disabled");
        usdtExistente2.style.display = "block";
        usdtDepositante.style.display = "block";

        var details = await showTercero("TD", "TP-02");
        setFieldsDepositanteUsdt(details);
    } else {
        // Oculta el div si la opción es la por defecto
        usdtDepositante.style.display = "none";
    }
}

function setFieldsBeneficiarioUsdt(beneficiario) {
    formDataBeneficiarioUsdt = beneficiario.data;
    $("#usdtAliasBeneficiario").val(beneficiario.data.alias);
    $("#usdtNombreBeneficiario").val(beneficiario.data.nombre);
    $("#usdtDocBeneficiario").val(beneficiario.data.documento);
    $("#usdtBancoBeneficiario").val(beneficiario.data.banco);
    $("#usdtCuentaBeneficiario").val(beneficiario.data.cuenta);
    $("#usdtTipoCuentaBeneficiario").val(beneficiario.data.tipo_cuenta_id);
    $("#usdtPagoMovilBeneficiario").val(beneficiario.data.pago_movil);
    $("#usdtTipoDocBeneficiario").val(beneficiario.data.tipo_documento_id);
}

function setFieldsDepositanteUsdt(depositante) {
    formDataDepositanteUsdt = depositante.data;
    $("#usdtAliasDepositante").val(depositante.data.alias);
    $("#usdtNombreDepositante").val(depositante.data.nombre);
    $("#usdtDocDepositante").val(depositante.data.documento);
    $("#usdtTipoDocDepositante").val(depositante.data.tipo_documento_id);
    $("#usdtEmailDepositante").val(depositante.data.correo);
    $("#usdtCelularDepositante").val(depositante.data.celular);
    $("#usdtIndicativoDepositante").val(depositante.data.pais_telefono_id);
    $("#usdtPaisDepositante").val(depositante.data.pais_id);
    if (depositante.data.path_documento) {
        loadImageFromURL(
            depositante.data.path_documento,
            "#adjuntarDocumentoUsdt"
        );
        updateButtonAndBindClick(
            "btnPreview02",
            depositante.data.path_documento
        );
    }
}

/* Fin Usdt */

/** ----------------------------------------------------------------------------- */
function getTerceros(code, servicio) {
    return new Promise(async (resolve, reject) => {
        try {
            const response = await axios.get(
                "/terceros/list/" + code + "/" + servicio
            );
            resolve(response.data);
        } catch (error) {
            handleErrors(error);
            reject(error);
        }
    });
}

function showTercero(code, servicio) {
    var selectedValue = mapTercero(code, "select", servicio);
    return new Promise(async (resolve, reject) => {
        try {
            const response = await axios.get(
                "/terceros/show/" + selectedValue + "/" + code + "/" + servicio
            );
            resolve(response.data);
        } catch (error) {
            handleErrors(error);
            reject(error);
        }
    });
}

function addTercero(code, servicio, e) {
    e.preventDefault();
    if (mapTercero(code, "validateForm", servicio)) {
        localStorage.setItem("actionService", true);
        var formData = mapTercero(code, "dataForm", servicio);
        formData.append("code", code);
        formData.append("servicio", servicio);
        axios
            .post("/terceros/store", formData, {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            })
            .then((response) => {
                showSuccess(response.data.message);
                setTimeout(function () {
                    location.reload();
                }, 1500);
            })
            .catch((error) => {
                handleErrors(error);
            });
    }
}

function setTercero(code, servicio) {
    if (mapTercero(code, "validateForm", servicio)) {
        localStorage.setItem("actionService", true);
        const id = mapTerceroForm(code, servicio).id;
        var formData = mapTercero(code, "dataForm", servicio);
        formData.append("code", code);
        axios
            .post("/terceros/update/" + id, formData, {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            })
            .then((response) => {
                showSuccess(response.data.message);
                setTimeout(function () {
                    location.reload();
                }, 1500);
            })
            .catch((error) => {
                handleErrors(error);
            });
    }
}

function deleteTercero(code, servicio) {
    const id = mapTerceroForm(code, servicio).id;
    Swal.fire({
        title: "Estas seguro de eliminar el registro?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar!",
    }).then((result) => {
        if (result.isConfirmed) {
            axios
                .post("/terceros/destroy/" + id + "/" + code)
                .then((response) => {
                    showSuccess(response.data.message);
                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                })
                .catch((error) => {
                    handleErrors(error);
                });
        }
    });
}

function mapTercero(code, tipo, servicio) {
    let tipoForm = mapServicio(servicio);
    switch (tipo) {
        case "select":
            return code == "TB"
                ? $("#selectBeneficiario" + tipoForm).val()
                : $("#selectDepositante" + tipoForm).val();
            break;
        case "validateForm":
            return code == "TB"
                ? $("#formBeneficiario" + tipoForm).valid()
                : $("#formDepositante" + tipoForm).valid();
            break;
        case "dataForm":
            return code == "TB"
                ? new FormData($("#formBeneficiario" + tipoForm)[0])
                : new FormData($("#formDepositante" + tipoForm)[0]);
            break;
        default:
            break;
    }
}

function mapTerceroForm(code, servicio) {
    switch (servicio) {
        case "TP-01":
            return code == "TB" ? formDataBeneficiario : formDataDepositante;
            break;
        case "TP-02":
            return code == "TB"
                ? formDataBeneficiarioUsdt
                : formDataDepositanteUsdt;
            break;
        default:
            break;
    }
}

function mapServicio(servicio) {
    switch (servicio) {
        case "TP-01":
            return "";
            break;
        case "TP-02":
            return "Usdt";
            break;
        default:
            return "";
            break;
    }
}

function checkRealizarPago() {
    if (
        formDataBeneficiario != null &&
        formDataDepositante != null &&
        $("#montoCambiar").val().trim() !== ""
    ) {
        $("#realizarPago").prop("disabled", false);
    } else {
        $("#realizarPago").prop("disabled", true);
    }
}

function addSolicitudPago() {
    Swal.fire({
        title: "Estas seguro que se desea continuar?",
        icon: "info",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, Continuar!",
    }).then((result) => {
        if (result.isConfirmed) {
            axios
                .post("/solicitudes/pago", {
                    beneficiario_id: formDataBeneficiario
                        ? formDataBeneficiario.id
                        : "",
                    depositante_id: formDataDepositante
                        ? formDataDepositante.id
                        : "",
                    tipo_formulario_id:
                        $("#inputGroupSelect01").val() != 0
                            ? $("#inputGroupSelect01").val()
                            : "",
                    tipo_moneda_id:
                        $("#inputGroupSelect02").val() != 0
                            ? $("#inputGroupSelect02").val()
                            : "",
                    monto_a_pagar: calculoFormulario.monto_a_pagar,
                    monto_a_recibir: calculoFormulario.monto_a_recibir,
                })
                .then((response) => {
                    const id = response.data.data.id;
                    handlePeticion(`/solicitudes/proceso?solicitud=${id}`);
                })
                .catch((error) => {
                    handleErrors(error);
                });
        }
    });
}

var inputs = document.querySelectorAll(
    'input[type="text"], input[type="email"]'
);

// Función para convertir texto a mayúsculas
function toUpperCaseInput() {
    this.value = this.value.toUpperCase();
}

// Aplica el event listener a cada input
inputs.forEach(function (input) {
    input.addEventListener("input", toUpperCaseInput);
});
