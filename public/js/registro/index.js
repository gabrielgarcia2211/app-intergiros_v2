var formData = {
    formInfoGeneral: {},
    formPassword: {},
    formRedes: {},
    formVerificacion: {},
};

$(document).ready(function () {
    $("#formInfoGeneral").validate({
        rules: {
            nombre: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            pais: {
                required: true,
            },
            apellidos: {
                required: true,
            },
            telefono: {
                required: true,
            },
            fehaNacimiento: {
                required: true,
            },
        },
        messages: {
            email: {
                required: "El campo de correo electrónico es obligatorio",
                email: "Ingresa una dirección de correo electrónico válida",
            },
            nombre: {
                required: "El campo de nombre es obligatorio",
            },
            pais: {
                required: "El campo de pais es obligatorio",
            },
            apellidos: {
                required: "El campo de apellidos es obligatorio",
            },
            telefono: {
                required: "El campo de telefono es obligatorio",
            },
            fehaNacimiento: {
                required: "El campo de fecha nacimiento es obligatorio",
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
    $("#formPassword").validate({
        rules: {
            inputPassword1: {
                required: true,
                minlength: 6,
            },
            inputPassword2: {
                required: true,
                equalTo: "#inputPassword1",
            },
        },
        messages: {
            inputPassword1: {
                required: "Por favor, ingresa una contraseña.",
                minlength: "La contraseña debe tener al menos 6 caracteres.",
            },
            inputPassword2: {
                required: "Por favor, confirma la contraseña.",
                equalTo: "Las contraseñas no coinciden.",
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
    $("#formRedes").validate({
        rules: {
            nombreUsuario1: {
                required: true,
            },
            redes1: {
                required: true,
            },
        },
        messages: {
            nombreUsuario1: {
                required: "El campo de nombre de usuario 1 es obligatorio",
            },
            redes1: {
                required: "El campo redes 1 es obligatorio",
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
    $("#formVerificacion").validate({
        rules: {
            tipoDocumento: {
                required: true,
            },
            documento: {
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
            tipoDocumento: {
                required: "El campo tipo de documento es obligatorio",
            },
            documento: {
                required: "El campo documento es obligatorio",
            },
            inputGroupFile01: {
                required: "La selfie es obligatoria",
            },
            inputGroupFile02: {
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
});

function atrasDiv1() {
    document.getElementById("div1").style.display = "block";
    document.getElementById("div2").style.display = "none";
}

function mostrarDiv2() {
    if ($("#formInfoGeneral").valid()) {
        formData.formInfoGeneral = {
            nombre: $("#nombre").val(),
            email: $("#email").val(),
            pais: $("#pais").val(),
            apellidos: $("#apellidos").val(),
            paisTelefono: $("#paisTelefono").val(),
            telefono: $("#telefono").val(),
            fehaNacimiento: $("#fehaNacimiento").val(),
        };
        document.getElementById("div1").style.display = "none";
        document.getElementById("div2").style.display = "block";
    }
}

function atrasDiv2() {
    document.getElementById("div3").style.display = "none";
    document.getElementById("div2").style.display = "block";
}

function mostrarDiv3() {
    if ($("#formPassword").valid()) {
        formData.formPassword = {
            inputPassword1: $("#inputPassword1").val(),
            inputPassword2: $("#inputPassword2").val(),
        };
        document.getElementById("div2").style.display = "none";
        document.getElementById("div3").style.display = "block";
    }
}

function atrasDiv3() {
    document.getElementById("div4").style.display = "none";
    document.getElementById("div3").style.display = "block";
}

function mostrarDiv4() {
    if ($("#formRedes").valid()) {
        formData.formRedes = {
            nombreUsuario1: $("#nombreUsuario1").val(),
            redes1: $("#redes1").val(),
            nombreUsuario2: $("#nombreUsuario2").val(),
            redes2: $("#redes2").val(),
        };
        document.getElementById("div3").style.display = "none";
        document.getElementById("div4").style.display = "block";
    }
}

function mostrarDiv5() {
    if ($("#formVerificacion").valid()) {
        formData.formVerificacion = {
            tipoDocumento: $("#tipoDocumento").val(),
            documento: $("#documento").val(),
            inputGroupFile01: $("#inputGroupFile01")[0].files[0],
            inputGroupFile02: $("#inputGroupFile02")[0].files[0],
        };

        axios
            .post("/registro", formData, {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            })
            .then((response) => {
                document.getElementById("div4").style.display = "none";
                document.getElementById("div5").style.display = "block";
            })
            .catch((error) => {
                handleErrors(error);
            });
    }
    // Obtener el valor del input
    var valorInput = document.getElementById("nombre").value;

    // Asignar el valor al strong dentro del h2
    document.querySelector("#miH2 strong").textContent = valorInput;
}

function agregar() {
    document.getElementById("agregar").style.display = "none";
    document.getElementById("otroP").style.display = "block";
    document.getElementById("otroN").style.display = "block";
}

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

function togglePasswordVisibility1() {
    var passwordField = document.getElementById("inputPassword1");
    var toggleIcon = document.querySelector(".toggle-password1");

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

function togglePasswordVisibility2() {
    var passwordField = document.getElementById("inputPassword2");
    var toggleIcon = document.querySelector(".toggle-password2");

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

var inputs = document.querySelectorAll('input[type="text"], input[type="email"]');

// Función para convertir texto a mayúsculas
function toUpperCaseInput() {
    this.value = this.value.toUpperCase();
}

// Aplica el event listener a cada input
inputs.forEach(function (input) {
    input.addEventListener('input', toUpperCaseInput);
});
