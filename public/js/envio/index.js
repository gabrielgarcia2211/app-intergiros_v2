/* PayPal */
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

/* inputs paypal*/
$(document).ready(async function () {
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

    var beneficiarios = await getTerceros("TB");
    var depositantes = await getTerceros("TD");

    $.each(beneficiarios, function (key, value) {
        $("#selectBeneficiario").append(
            $("<option>", { value: value.id }).text(value.nombre)
        );
    });

    $.each(depositantes, function (key, value) {
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

    $("#inputGroupSelect01").change(function () {
        var selectedValue = $(this).val();
        var selectedOption = $(this).find("option:selected");
        tipoFormularioCode = selectedOption.data("code");
        localStorage.setItem("selectedService", $("#inputGroupSelect01").val());
        $(".panel").hide();
        switch (selectedValue) {
            case "1":
                $("#panel-paypal").show();
                break;
            case "2":
                //$("#panel-otro").show();
                break;
            default:
                break;
        }
    });
});
/* fin input paypal */

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

        var details = await showTercero("TB");
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

        var details = await showTercero("TD");
        setFieldsDepositante(details);
        checkRealizarPago();
    } else {
        // Oculta el div si la opción es la por defecto
        depositante.style.display = "none";
    }
}
/* Fin PayPal */

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

function showTercero(code) {
    var selectedValue = mapTercero(code, "select");
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

function addTercero(code) {
    if (mapTercero(code, "validateForm")) {
        localStorage.setItem("actionService", true);
        var formData = mapTercero(code, "dataForm");
        formData.append("code", code);
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

function setTercero(code) {
    if (mapTercero(code, "validateForm")) {
        localStorage.setItem("actionService", true);
        const id = mapTercero(code, "dataFormVariable").id;
        var formData = mapTercero(code, "dataForm");
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

function deleteTercero(code) {
    const id = mapTercero(code, "dataFormVariable").id;

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

function mapTercero(code, tipo) {
    switch (tipo) {
        case "select":
            return code == "TB"
                ? $("#selectBeneficiario").val()
                : $("#selectDepositante").val();
            break;
        case "validateForm":
            return code == "TB"
                ? $("#formBeneficiario").valid()
                : $("#formDepositante").valid();
            break;
        case "dataForm":
            return code == "TB"
                ? new FormData($("#formBeneficiario")[0])
                : new FormData($("#formDepositante")[0]);
            break;
        case "dataFormVariable":
            return code == "TB" ? formDataBeneficiario : formDataDepositante;
            break;
        default:
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
