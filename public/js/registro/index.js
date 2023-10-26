var formData = {
    formInfoGeneral: {},
    formPassword: {},
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
            telefono1: {
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
            telefono1: {
                required: "El campo de telefono es obligatorio",
            },
            fehaNacimiento: {
                required: "El campo de fecha nacimiento es obligatorio",
            },
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
    });
    $("#formPassword").validate({
        rules: {
            inputEmail: {
                required: true,
                email: true,
            },
            inputPassword1: {
                required: true,
            },
            inputPassword2: {
                required: true,
            },
        },
        messages: {
            inputEmail: {
                required: "El campo de correo electrónico es obligatorio",
                email: "Ingresa una dirección de correo electrónico válida",
            },
            inputPassword1: {
                required: "El campo de contraseña es obligatorio",
            },
            inputPassword2: {
                required: "El campo confirmacion de contraseña es obligatorio",
            },
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
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
            paisTelefono1: $("#paisTelefono1").val(),
            telefono1: $("#telefono1").val(),
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
            nombre: $("#inputEmail").val(),
            email: $("#inputPassword1").val(),
            pais: $("#inputPassword2").val(),
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
    console.log(formData)
    /* document.getElementById("div3").style.display = "none";
    document.getElementById("div4").style.display = "block"; */
}

function mostrarDiv5() {
    document.getElementById("div4").style.display = "none";
    document.getElementById("div5").style.display = "block";
}

function agregar() {
    document.getElementById("agregar").style.display = "none";
    document.getElementById("otroP").style.display = "block";
    document.getElementById("otroN").style.display = "block";
}
