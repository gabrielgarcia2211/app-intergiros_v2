var formData = {
    formActualizarInfo: {},
    formVerificacion: {},
};

$(document).ready(async function () {
    $("#formActualizarInfo").validate({
        rules: {
            email: {
                required: true,
            },
            paisTelefono: {
                required: true,
            },
            pais: {
                required: true,
            },
            telefono: {
                required: true,
            },
            fehaNacimiento: {
                required: true,
            },
            inputPassword1: {
                required: true,
                minlength: 6,
            },
            nombreUsuario1: {
                required: true,
            },
            redes1: {
                required: true,
            },
        },
        messages: {
            email: {
                required: "El campo email es obligatorio",
            },
            paisTelefono: {
                required: "El indicativo del telefono es obligatorio",
            },
            pais: {
                required: "El campo de pais es obligatorio",
            },
            telefono: {
                required: "El campo de telefono es obligatorio",
            },
            fehaNacimiento: {
                required: "El campo de fecha nacimiento es obligatorio",
            },
            inputPassword1: {
                required: "Por favor, ingresa una contraseña.",
                minlength: "La contraseña debe tener al menos 6 caracteres.",
            },
            inputPassword2: {
                required: "Por favor, confirma la contraseña.",
                equalTo: "Las contraseñas no coinciden.",
            },
            nombreUsuario1: {
                required: "El campo de nombre de usuario 1 es obligatorio",
            },
            redes1: {
                required: "El campo redes 1 es obligatorio",
            },
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
    });
    $("#formVerificacion").validate({
        rules: {
            documento: {
                required: true,
            },
            tipoDocumento: {
                required: true,
            },
            inputGroupFile01: {
                required: true,
            },
            inputGroupFile02: {
                required: true,
            },
        },
        messages: {
            documento: {
                required: "El campo documento es obligatorio",
            },
            tipoDocumento: {
                required: "El campo tipo de documento es obligatorio",
            },
            inputGroupFile01: {
                required: "El campo selfie es requerido.",
            },
            inputGroupFile02: {
                required: "El campo foto del documento es requerido.",
            },
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
    });

    var details = await getUser();
    setUserDataFields(details);
    setVerificationDataFields(details);

    updateButtonAndBindClick("btnPreview01", details.data.path_selfie);
    updateButtonAndBindClick("btnPreview02", details.data.path_documento);

    var activeTab = getCookie("activeTab");
    if (activeTab) {
        $('#myTabs a[href="' + activeTab + '"]').tab("show");
    }
    // Escuchar el evento de cambio de pestaña y actualizar la cookie
    $("#myTabs a").on("shown.bs.tab", function (e) {
        var selectedTab = $(e.target).attr("href");
        setCookie("activeTab", selectedTab, 1);
    });
});

var tab1 = document.getElementById("tab1-tab");
var tab2 = document.getElementById("tab2-tab");

window.addEventListener("load", function () {
    document.getElementById("fehaNacimiento").type = "text";

    document
        .getElementById("fehaNacimiento")
        .addEventListener("blur", function () {
            document.getElementById("fehaNacimiento").type = "text";
        });

    document
        .getElementById("fehaNacimiento")
        .addEventListener("focus", function () {
            document.getElementById("fehaNacimiento").type = "date";
        });
});

function habilitarElementos() {
    // Obtén todos los elementos <input>, <select> y <div> con la clase "input-group" en la página
    var elementos = document.querySelectorAll("input, select");
    var input = document.getElementById("ocultar");
    var display1 = document.getElementById("passwordDisplay1");
    var display2 = document.getElementById("passwordDisplay2");
    var button1 = document.getElementById("actualizarDatos");
    var button2 = document.getElementById("habilitarDatos");
    // Recorre todos los elementos
    elementos.forEach(function (elemento, index) {
        elemento.disabled = index == 0;
    });
    input.style.display = "none";
    display1.style.display = "block";
    display2.style.display = "block";
    button2.style.display = "none";
    button1.style.display = "block";
}

function getUser() {
    return new Promise(async (resolve, reject) => {
        try {
            const response = await axios.get("/perfil/user");
            resolve(response.data);
        } catch (error) {
            handleErrors(error);
            reject(error);
        }
    });
}

function setUserDataFields(details) {
    $("#email").val(details.data.email);
    $("#pais").val(details.data.pais_id);
    $("#paisTelefono").val(details.data.pais_telefono_id);
    $("#telefono").val(details.data.telefono);
    $("#fehaNacimiento").val(details.data.fecha_nacimiento);
    $("#inputPassword1").val("*********");

    var redes = details.data.user_redes;
    if (redes && redes.length) {
        for (let index = 0; index < redes.length; index++) {
            $("#redes" + (index + 1)).val(redes[index]["redes_id"]);
            $("#nombreUsuario" + (index + 1)).val(redes[index]["nombre"]);
        }
    }
}

function updateUser() {
    if ($("#formActualizarInfo").valid()) {
        formData.formActualizarInfo = {
            email: $("#email").val(),
            pais: $("#pais").val(),
            paisTelefono: $("#paisTelefono").val(),
            telefono: $("#telefono").val(),
            fehaNacimiento: $("#fehaNacimiento").val(),
            inputPassword1: $("#inputPassword1").val(),
            inputPassword2: $("#inputPassword2").val(),
            redes1: $("#redes1").val(),
            nombreUsuario1: $("#nombreUsuario1").val(),
            redes2: $("#redes2").val(),
            nombreUsuario2: $("#nombreUsuario2").val(),
        };

        var formDataToken = {
            token: generateRandomToken(),
        };

        Swal.fire({
            title: "Cargando...",
            allowOutsideClick: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading();
            },
        });

        axios
            .post("/perfil/token", formDataToken)
            .then((response) => {
                Swal.close();
                const responseData = response.data.data;
                validarToken(responseData);
            })
            .catch((error) => {
                Swal.close();
                handleErrors(error);
            });
    }
}

function validarToken(responseData) {
    Swal.fire({
        title: 'Ingresa el token <br> <span style="font-size: 50%; font-weight: bold;">enviado a tu correo electrónico</span>',
        input: "text",
        inputAttributes: {
            autocapitalize: "off",
        },
        showCancelButton: true,
        confirmButtonText: "Validar",
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        preConfirm: (token) => {
            if (token !== responseData.token) {
                Swal.showValidationMessage("Token incorrecto");
                return;
            }
            if (hasExpired(responseData.expires_at)) {
                Swal.showValidationMessage("El token ha expirado");
                return;
            }
        },
        allowOutsideClick: () => !Swal.isLoading(),
    }).then((result) => {
        if (result.isConfirmed) {
            axios
                .post("/perfil/user/update", formData)
                .then((actualizarResponse) => {
                    showSuccess("Información actualizada correctamente!");
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                })
                .catch((actualizarError) => {
                    handleErrors(actualizarError);
                });
        }
    });
}

function hasExpired(expiresAt) {
    var expiresDate = new Date(expiresAt);
    return new Date() > expiresDate;
}

/** verificacion de usuario */
function setVerificationDataFields(details) {
    $("#documento").val(details.data.documento);
    if (details.data.path_selfie) {
        loadImageFromURL(details.data.path_selfie, "#inputGroupFile01");
    }
    if (details.data.path_documento) {
        loadImageFromURL(details.data.path_documento, "#inputGroupFile02");
    }
}

function updateButtonAndBindClick(buttonId, imagePath) {
    const buttonSelector = `#${buttonId}`;
    const iconSelector = `${buttonSelector} i`;

    if (imagePath) {
        $(iconSelector).attr("class", "fas fa-eye");
    }

    $(buttonSelector).click(function () {
        if (imagePath) {
            showImageAlert(imagePath);
        }
    });
}

function updateVerification() {
    if ($("#formVerificacion").valid()) {
        formData.formVerificacion = {
            documento: $("#documento").val(),
            tipoDocumento: $("#tipoDocumento").val(),
            inputGroupFile01: $("#inputGroupFile01")[0].files[0],
            inputGroupFile02: $("#inputGroupFile02")[0].files[0],
        };

        axios
            .post("/perfil/verification/update", formData, {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            })
            .then((response) => {
                showSuccess("Información actualizada correctamente!");
                location.reload();
            })
            .catch((error) => {
                handleErrors(error);
            });
    }
}
