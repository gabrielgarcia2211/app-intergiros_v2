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
                /* required: true, */
            },
            redes1: {
                required: true,
            },
            nombreUsuario2: {
                /* required: true, */
            },
            redes2: {
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
                required: "El campo de nombre de usuario es obligatorio",
            },
            redes1: {
                required: "El campo redes 1 es obligatorio",
            },
            nombreUsuario2: {
                required: "El campo de nombre de usuario es obligatorio",
            },
            redes1: {
                required: "El campo redes 2 es obligatorio",
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

    if (user_verificado == 3 || user_verificado == 1) {
        $("#documento").prop("disabled", true);
        $("#tipoDocumento").prop("disabled", true);
        $("#inputGroupFile01").prop("disabled", true);
        $("#inputGroupFile02").prop("disabled", true);
    }
});

var tab1 = document.getElementById("tab1-tab");
var tab2 = document.getElementById("tab2-tab");

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

function deshabilitarElementos() {
    // Obtén todos los elementos <input>, <select> y <div> con la clase "input-group" en la página
    var elementos = document.querySelectorAll("input, select");
    var input = document.getElementById("ocultar");
    var display1 = document.getElementById("passwordDisplay1");
    var display2 = document.getElementById("passwordDisplay2");
    var button1 = document.getElementById("actualizarDatos");
    var button2 = document.getElementById("habilitarDatos");
    // Recorre todos los elementos
    elementos.forEach(function (elemento, index) {
        elemento.disabled = index != 0;
    });
    input.style.display = "block";
    display1.style.display = "none";
    display2.style.display = "none";
    button2.style.display = "block";
    button1.style.display = "none";
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
            if (redes[index]["redes_id"]) {
                $("#redes" + (index + 1)).show();
                $("#nombreUsuario" + (index + 1)).show();
            }
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
            .catch(async (error) => {
                Swal.close();
                handleErrors(error);
                var details = await getUser();
                setUserDataFields(details);
                deshabilitarElementos();
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
    $("#tipoDocumento").val(details.data.tipo_documento_id);
    if (details.data.path_selfie) {
        loadImageFromURL(details.data.path_selfie, "#inputGroupFile01");
    }
    if (details.data.path_documento) {
        loadImageFromURL(details.data.path_documento, "#inputGroupFile02");
    }
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

function togglePasswordVisibility() {
    var passwordField = document.getElementById("inputPassword2");
    var toggleIcon = document.querySelector(".toggle-password");

    if (passwordField.type === "password") {
        passwordField.type = "text";
        toggleIcon.classList.remove("fa-eye");
        toggleIcon.classList.add("fa-eye-slash");
    } else {
        passwordField.type = "password";
        toggleIcon.classList.remove("fa-eye-slash");
        toggleIcon.classList.add("fa-eye");
    }
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

function updateFoto(input, is_delete) {
    if ((input && input.files && input.files[0]) || is_delete == "DELETE") {
        var formData = new FormData();
        if (input && input.files) {
            formData.append("foto", input.files[0]);
        }
        formData.append("is_delete", is_delete);
        axios
            .post("/perfil/foto", formData, {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            })
            .then((response) => {
                location.reload();
            })
            .catch((error) => {
                handleErrors(error);
            });
    }
}
