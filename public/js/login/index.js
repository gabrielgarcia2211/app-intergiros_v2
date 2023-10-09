$(document).on("click", ".toggle-password", function () {
    var $passwordInput = $(this).closest(".input-group").find("#inputPassword");
    var isPasswordVisible =
        $passwordInput.dxTextBox("option", "mode") === "text";

    $passwordInput.dxTextBox(
        "option",
        "mode",
        isPasswordVisible ? "password" : "text"
    );
    $(this).toggleClass("fa-eye fa-eye-slash");
});

popupLogin = new bootstrap.Modal(
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

        const inputPassword = setTextBox(
            "#inputPassword",
            {
                placeholder: "Contraseña",
                mode: "password",
                elementAttr: {
                    class: "form-control input-login",
                },
                onContentReady: function (e) {
                    var $inputPassword = e.element.find(".dx-texteditor-input");
                    $inputPassword.after(
                        '<i class="fa fa-eye toggle-password" toggle="#' +
                            $inputPassword.attr("id") +
                            '"></i>'
                    );
                },
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
