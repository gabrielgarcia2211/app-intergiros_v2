var popupLogin = new bootstrap.Modal(
    document.getElementById("popupLogin"),
    {
        keyboard: false,
    }
);

$(document).ready(function () {
    /* Login */
    initForm();

    function initForm() {
        const inputEmail = setTextBox(
            "#inputEmail",
            {
                value: "",
                placeholder: "Email",
                name: "email",
                mode: "email",
                elementAttr: {
                    class: "form-control input-login",
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

        const inputPassword = setTextBox(
            "#inputPassword",
            {
                placeholder: "Contraseña",
                mode: "password",
                elementAttr: {
                    class: "form-control input-login",
                },
                buttons: [{
                    name: 'password',
                    location: 'after',
                    options: {
                        icon: 'fa fa-eye',
                        type: 'default',
                        stylingMode: "text",
                        onClick: () => changePasswordMode('#inputPassword'),
                    },
                }],
            },
            [
                {
                    type: "required",
                    message: "El campo de contraseña es obligatorio",
                },
            ]
        ).dxTextBox("instance");

        inputPassword.option({
            validationStatus: "valid",
        });

        setButton("#btn_login", {
            text: "Iniciar Sesión",
            type: "submit",
            elementAttr: {
                class: "button-login",
            },
            useSubmitBehavior: true,
        });

        sendFormLogin();
    }

    function sendFormLogin() {
        $("#formLogin").off("submit");
        $("#formLogin").on("submit", function (e) {
            e.preventDefault();
            var formulario = $("#formLogin")[0];
            var formData = new FormData(formulario);
            axios
                .post("/login", formData)
                .then((response) => {
                    showMessageText(response.data.message);
                })
                .catch((error) => {
                    handleErrorsLogin(error);
                });
        });
    }
});
