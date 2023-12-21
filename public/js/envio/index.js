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

/* inputs paypal*/
$(document).ready(async function () {
    $("#formPaytoPaypal").validate({
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
            error.addClass('invalid-feedback text-center'); 
            element.closest(".form-group").append(error); 
        },
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid"); 
        },
    });
    $("#formPaytoBolivares").validate({
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
            },
        },
        errorElement: "div",
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback text-center'); 
            element.closest(".form-group").append(error); 
        },
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid"); 
        },
    });

    var beneficiarios = await getBeneficiarios();
    var depositantes = await getDepositantes();

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

});
/* fin input paypal */

function activarBeneficiario() {
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
    var guardarEdit = document.getElementById("guardarEdit2");3
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

for (var i = 0; i < elementos1.length; i++) {
    elementos1[i].addEventListener("input", verificarInputs);
}

function verificarInputs() {
    // Obtén todos los inputs y el select con la clase 'miInput'

    // Obtén el botón
    var miBoton = document.getElementById("realizarPago");

    // Establece una bandera para verificar si todos los elementos están llenos
    var todosLlenos = true;

    // Recorre los elementos y verifica si alguno está vacío (o es el valor por defecto en el caso del select)
    for (var i = 0; i < elementos1.length; i++) {
        if (elementos1[i].type === "select-one") {
            // Para el select, verifica si no es el valor por defecto
            if (elementos1[i].value === "" || elementos1[i].value === null) {
                todosLlenos = false;
                break;
            }
        } else {
            // Para otros elementos, verifica si el valor está vacío
            if (elementos1[i].value.trim() === "") {
                todosLlenos = false;
                break;
            }
        }
    }

    for (var j = 0; j < elementos2.length; j++) {
        if (elementos2[j].type === "select-one") {
            // Para el select, verifica si no es el valor por defecto
            if (elementos2[j].value === "" || elementos2[j].value === null) {
                todosLlenos = false;
                break;
            }
        } else {
            // Para otros elementos, verifica si el valor está vacío
            if (elementos2[j].value.trim() === "") {
                todosLlenos = false;
                break;
            }
        }
    }

    for (var k = 0; k < selects1.length; k++) {
        if (selects1[k].type === "select-one") {
            // Para el select, verifica si no es el valor por defecto
            if (selects1[k].value === "" || selects1[k].value === null) {
                todosLlenos = false;
                break;
            }
        } else {
            // Para otros elementos, verifica si el valor está vacío
            if (selects1[k].value.trim() === "") {
                todosLlenos = false;
                break;
            }
        }
    }

    for (var l = 0; l < selects2.length; l++) {
        if (selects2[l].type === "select-one") {
            // Para el select, verifica si no es el valor por defecto
            if (selects2[l].value === "" || selects2[l].value === null) {
                todosLlenos = false;
                break;
            }
        } else {
            // Para otros elementos, verifica si el valor está vacío
            if (selects2[l].value.trim() === "") {
                todosLlenos = false;
                break;
            }
        }
    }

    // Habilita o deshabilita el botón según si todos los elementos están llenos o no
    if (todosLlenos) {
        miBoton.removeAttribute("disabled");
    } else {
        miBoton.setAttribute("disabled", "disabled");
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

        var details = await showBeneficiario();
        setFieldsBeneficiario(details);
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

        var details = await showDepositante();
        setFieldsDepositante(details);
    } else {
        // Oculta el div si la opción es la por defecto
        depositante.style.display = "none";
    }
}

function mostrarOcultarDiv() {
    var select1 = document.getElementById("inputGroupSelect01");
    var miDiv = document.getElementById("panel-envios");

    // Mostrar el div si el valor seleccionado es 1
    miDiv.style.display = select1.value === "1" ? "block" : "none";
}

// Asociar la función al evento "change" del select1
document
    .getElementById("inputGroupSelect01")
    .addEventListener("change", mostrarOcultarDiv);
/* Fin PayPal */

function getBeneficiarios() {
    return new Promise(async (resolve, reject) => {
        try {
            const response = await axios.get("/beneficiario/list");
            resolve(response.data);
        } catch (error) {
            handleErrors(error);
            reject(error);
        }
    });
}

function showBeneficiario() {
    var selectedValue = $("#selectBeneficiario").val();
    return new Promise(async (resolve, reject) => {
        try {
            const response = await axios.get(
                "/beneficiario/show/" + selectedValue
            );
            resolve(response.data);
        } catch (error) {
            handleErrors(error);
            reject(error);
        }
    });
}

function addBeneficiario() {
    if ($("#formPaytoPaypal").valid()) {
        var formData = $("#formPaytoPaypal").serialize();
        axios
            .post("/beneficiario/store", formData)
            .then((response) => {
                showSuccess(response.data.message);
            })
            .catch((error) => {
                handleErrors(error);
            });
    }
}

function setBeneficiario() {
    if ($("#formPaytoPaypal").valid()) {
        const id = formDataBeneficiario.id;
        var formData = $("#formPaytoPaypal").serialize();
        axios
            .post("/beneficiario/update/" + id, formData)
            .then((response) => {
                showSuccess(response.data.message);
            })
            .catch((error) => {
                handleErrors(error);
            });
    }
}

function deleteBeneficiario() {
    const id = formDataBeneficiario.id;

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
                .post("/beneficiario/destroy/" + id)
                .then((response) => {
                    showSuccess(response.data.message);
                })
                .catch((error) => {
                    handleErrors(error);
                });
        }
    });
}

function setFieldsBeneficiario(data) {
    formDataBeneficiario = data;
    $("#paypalAliasBeneficiario").val(data.alias);
    $("#paypalNombreBeneficiario").val(data.nombre);
    $("#paypalDocumentoBeneficiario").val(data.documento);
    $("#paypalBancoBeneficiario").val(data.banco);
    $("#paypalCuentaBeneficiario").val(data.cuenta);
    $("#paypalPagoMovilBeneficiario").val(data.pago_movil);
    $("#paypalTipoDocumentoBeneficiario").val(data.tipo_documento_id);
}

function getDepositantes() {
    return new Promise(async (resolve, reject) => {
        try {
            const response = await axios.get("/depositante/list");
            resolve(response.data);
        } catch (error) {
            handleErrors(error);
            reject(error);
        }
    });
}

function showDepositante() {
    var selectedValue = $("#selectDepositante").val();
    return new Promise(async (resolve, reject) => {
        try {
            const response = await axios.get(
                "/depositante/show/" + selectedValue
            );
            resolve(response.data);
        } catch (error) {
            handleErrors(error);
            reject(error);
        }
    });
}

function addDepositante() {
    if ($("#formPaytoBolivares").valid()) {
        var formData = new FormData($("#formPaytoBolivares")[0]);
        axios
            .post("/depositante/store", formData, {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            })
            .then((response) => {
                showSuccess(response.data.message);
            })
            .catch((error) => {
                handleErrors(error);
            });
    }
}

function setDepositante() {
    if ($("#formPaytoBolivares").valid()) {
        const id = formDataDepositante.id;
        var formData = new FormData($("#formPaytoBolivares")[0]);

        axios
            .post("/depositante/update/" + id, formData, {
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

function deleteDepositante() {
    const id = formDataDepositante.id;

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
                .post("/depositante/destroy/" + id)
                .then((response) => {
                    showSuccess(response.data.message);
                })
                .catch((error) => {
                    handleErrors(error);
                });
        }
    });
}

function setFieldsDepositante(data) {
    formDataDepositante = data;
    $("#paypalAliasDepositante").val(data.alias);
    $("#paypalNombreDepositante").val(data.nombre);
    $("#paypalDocumentoDepositante").val(data.documento);
    $("#paypalCorreoDepositante").val(data.correo);
    $("#paypalCelularDepositante").val(data.celular);
    $("#paypalIndicativoDepositante").val(data.pais_telefono_id);
    $("#paypalTipoDocumentoDepositante").val(data.tipo_documento_id);
    $("#paypalPaisDepositante").val(data.pais_id);
}


/* Agregar al guardar la edicion */
/* var adjuntarFoto = document.getElementById("adjuntarFoto");
adjuntarFoto.style.display = "none"; */