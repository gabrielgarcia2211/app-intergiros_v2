var formData = {
    formActualizarInfo: {},
    formVerificacion: {},
};

$(document).ready(function () {
    $("#formActualizarInfo").validate({
        rules: {
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
            inputPassword2: {
                required: true,
                equalTo: "#inputPassword1",
            },
            nombreUsuario1: {
                required: true,
            },
            redes1: {
                required: true,
            },
        },
        messages: {
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
            tipoDocumento: {
                required: true,
            },
            documento: {
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
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
    });
});







    var tab1 = document.getElementById("tab1-tab");
    var tab2 = document.getElementById("tab2-tab");


    window.addEventListener('load', function () {

        document.getElementById('fehaNacimiento').type = 'text';

        document.getElementById('fehaNacimiento').addEventListener('blur', function () {

            document.getElementById('fehaNacimiento').type = 'text';

        });

        document.getElementById('fehaNacimiento').addEventListener('focus', function () {

            document.getElementById('fehaNacimiento').type = 'date';

        });

    });


    function habilitarElementos() {
        // Obtén todos los elementos <input>, <select> y <div> con la clase "input-group" en la página
        var elementos = document.querySelectorAll('input, select');
        var input = document.getElementById('ocultar');
        var display1 = document.getElementById('passwordDisplay1');
        var display2 = document.getElementById('passwordDisplay2');
        var button1 = document.getElementById('actualizarDatos');
        var button2 = document.getElementById('habilitarDatos');
        // Recorre todos los elementos
        elementos.forEach(function (elemento, index) {

            elemento.disabled = index == 0;

        });
        input.style.display = 'none';
        display1.style.display = 'block';
        display2.style.display = 'block';
        button2.style.display = 'none'
        button1.style.display = 'block';
    }
