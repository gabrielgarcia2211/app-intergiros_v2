$(document).ready(function () {
    /* Recuperacion */

    const inputEmail = setTextBox(
        "#inputEmail",
        {
            placeholder: "Email",
            mode: "email",
            elementAttr: {
                class: "form-control input-registro",
            },
        },
        [
            {
                type: "required",
                message: "El campo de email es obligatorio",
            },
            {
                type: "email",
                message: "Ingrese una dirección de email válida",
            },
        ]
    ).dxTextBox("instance");

    inputEmail.option({
        validationStatus: "valid",
    });

    $("#codigoRecuperacion").dxTextBox({
        placeholder: "CÓDIGO",
        mode: "text",
        elementAttr: {
            class: "input-codigo",
        },
    });

    $("#reenviarButton").dxButton({
        text: "Reenviar Código",
        type: "submit",
        elementAttr: {
            class: "button-codigo",
        },
        onClick: function () {
            alert("Reenviar' presionado");
        },
    });

    $("#enviarButton").dxButton({
        text: "Enviar",
        type: "submit",
        elementAttr: {
            class: "button-codigo",
        },
        onClick: function () {
            $("#myModal").modal("hide");
            document.getElementById('newPassword').style.display = "block";
            document.getElementById('repeatPassword').style.display = "block";
        },
    });

    const changePasswordMode = function (name) {
        const editor = $(name).dxTextBox('instance');
        editor.option('mode', editor.option('mode') === 'text' ? 'password' : 'text');

        const passwordButton = editor.getButton('password');

        if (editor.option('mode') === 'text') {
            passwordButton.option('icon', 'fa fa-eye-slash');
        } else {
            passwordButton.option('icon', 'fa fa-eye');
        }
    };

    const inputPasswordNuevo = setTextBox(
        "#inputPasswordNuevo",
        {
            placeholder: "Contraseña nueva",
            mode: "password",
            elementAttr: {
                class: "form-control input-registro contraseña",
            },
            buttons: [{
                name: 'password',
                location: 'after',
                options: {
                    icon: 'fa fa-eye',
                    type: 'default',
                    stylingMode: "text",
                    onClick: () => changePasswordMode('#inputPasswordNuevo'),
                },
            }],
        },
        [
            {
                type: "required",
                message: "El campo de contraseña nueva es obligatorio",
            },
        ]
    ).dxTextBox("instance");

    inputPasswordNuevo.option({
        validationStatus: "valid",
    });

    const inputPasswordConfirma = setTextBox(
        "#inputPasswordConfirma",
        {
            placeholder: "Confirma la contraseña",
            mode: "password",
            elementAttr: {
                class: "form-control input-registro contraseña",
            },
            buttons: [{
                name: 'password',
                location: 'after',
                options: {
                    icon: 'fa fa-eye',
                    type: 'default',
                    stylingMode: "text",
                    onClick: () => changePasswordMode('#inputPasswordConfirma'),
                },
            }],
        },
        [
            {
                type: 'compare',
                comparisonTarget() {
                    const password = $('#inputPasswordNuevo').dxTextBox('instance');
                    if (password) {
                        return password.option('value');
                    }
                    return null;
                },
                message: "Las contraseñas no coinciden",
            },
            {
                type: "required",
                message:
                    "El campo de confirma la contraseña es obligatorio",
            },
        ]
    ).dxTextBox("instance");

    inputPasswordConfirma.option({
        validationStatus: "valid",
    });

});
