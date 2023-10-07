
var popupLogin = "";
$(() => {
    $(document).on("click", ".toggle-password", function () {
        var $passwordInput = $(this)
            .closest(".input-group")
            .find("#inputPassword");
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

    /* Login */

    initForm();

    function initForm() {
        $("#inputEmail").dxTextBox({
            placeholder: "Email",
            mode: "email",
            elementAttr: {
                class: "form-control input-login",
            },
        });

        $("#inputEmail").dxValidator({
            validationRules: [{
                type: "required",
                message: "El campo de email es obligatorio"
            }, {
                type: "email",
                message: "Ingrese una dirección de email válida"
            }]
        });

        $("#inputPassword").dxTextBox({
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
        });

        $("#inputPassword").dxValidator({
            validationRules: [{
                type: "required",
                message: "El campo de contraseña es obligatorio"
            }]
        });

        $("#loginButton").dxButton({
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

    /* Recuperacion */

    $("#codigoRecuperacion").dxTextBox({
        placeholder: "CÓDIGO",
        mode: "text",
        elementAttr: {
            class: "input-codigo",
        },
    });

    $("#reenviarButton").dxButton({
        text: "Reenviar",
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
            alert("Botón 'Enviar' presionado");
        },
    });

    $("#inputPasswordNuevo").dxTextBox({
        placeholder: "Contraseña nueva",
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
    });

    $("#inputPasswordConfirma").dxTextBox({
        placeholder: "Confirma la contraseña",
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
    });

});

/* Registro */

$(() => {

    $(document).on("click", ".toggle-password1", function () {
        event.stopPropagation();
        var $passwordInput = $(this)
            .closest(".input-group")
            .find("#inputContraseñaRegistro");
        var isPasswordVisible =
            $passwordInput.dxTextBox("option", "mode") === "text";

        $passwordInput.dxTextBox(
            "option",
            "mode",
            isPasswordVisible ? "password" : "text"
        );
        $(this).toggleClass("fa-eye fa-eye-slash");
    });

    $(document).on("click", ".toggle-password2", function () {
        event.stopPropagation();
        var $passwordInput = $(this)
            .closest(".input-group")
            .find("#inputConfirmaRegistro");
        var isPasswordVisible =
            $passwordInput.dxTextBox("option", "mode") === "text";

        $passwordInput.dxTextBox(
            "option",
            "mode",
            isPasswordVisible ? "password" : "text"
        );
        $(this).toggleClass("fa-eye fa-eye-slash");
    });

    $("#inputEmailRegistro").dxTextBox({
        placeholder: "Email",
        mode: "email",
        elementAttr: {
            class: "form-control input-registro",
        },
    });

    $("#inputEmailRegistro").dxValidator({
        validationRules: [{
            type: "required",
            message: "El campo de email es obligatorio"
        }, {
            type: "email",
            message: "Ingrese una dirección de email válida"
        }]
    });

    $("#inputNombresRegistro").dxTextBox({
        placeholder: "Nombres",
        mode: "text",
        elementAttr: {
            class: "form-control input-registro",
        },
    });

    $("#inputNombresRegistro").dxValidator({
        validationRules: [{
            type: "required",
            message: "El campo de nombres es obligatorio"
        }]
    });

    $("#inputApellidosRegistro").dxTextBox({
        placeholder: "Apellidos",
        mode: "text",
        elementAttr: {
            class: "form-control input-registro",
        },
    });

    $("#inputApellidosRegistro").dxValidator({
        validationRules: [{
            type: "required",
            message: "El campo de apellidos es obligatorio"
        }]
    });

    var selectBoxData = [
        { value: 1, text: "Colombia" },
        { value: 2, text: "Venezuela" },
        { value: 3, text: "Perú" },
        // Agrega más opciones aquí
    ];

    $("#inputPaisRegistro").dxSelectBox({
        dataSource: selectBoxData,
        valueExpr: "value",
        displayExpr: "text",
        placeholder: "País",
        elementAttr: {
            class: "form-control input-registro",
        },
        searchEnabled: true,
        minSearchLength: 0,
        searchExpr: "text"
    });

    $('#inputPaisRegistro').dxValidator({
        validationRules: [
            {
                type: "required",
                message: "Por favor, selecciona un país"
            }
        ]
    });

    var selectBoxData = [
        { value: "+57", text: "+57" },
        { value: "+58", text: "+58" },
        { value: "+51", text: "+51" },
        // Agrega más opciones aquí
    ];

    $("#inputIndicativoRegistro").dxSelectBox({
        dataSource: selectBoxData,
        valueExpr: "value",
        displayExpr: "text",
        placeholder: "+57",
        elementAttr: {
            class: "form-control input-indicativo",
        },
        width: 100
    });

    $("#inputTelefonoRegistro").dxNumberBox({
        placeholder: "Número celular",
        mode: "number",
        elementAttr: {
            class: "form-control input-telefono",
        },
        value: null
    });

    $('#inputTelefonoRegistro').dxValidator({
        validationRules: [{
            type: "required",
            message: "El campo de numero celular es obligatorio"
        }]
    });

    $("#inputNacimientoRegistro").dxDateBox({
        placeholder: "Fecha de nacimiento",
        type: 'date',
        elementAttr: {
            class: "form-control input-registro",
            id: "fechaNacimiento"
        },
        displayFormat: "dd/MM/yyyy"
    });

    $('#inputNacimientoRegistro').dxValidator({
        validationRules: [{
            type: "required",
            message: "Por favor, ingresa tu fecha de nacimiento"
        }]
    });

    $("#inputContraseñaRegistro").dxTextBox({
        placeholder: "Contraseña",
        mode: "password",
        elementAttr: {
            class: "form-control input-registro contraseña",
        },
        onContentReady: function (e) {
            var $inputPassword = e.element.find(".dx-texteditor-input");
            $inputPassword.after(
                '<i class="fa fa-eye toggle-password1" toggle="#inputContraseñaRegistro"></i>'
            );
        },
    });

    $("#inputContraseñaRegistro").dxValidator({
        validationRules: [{
            type: "required",
            message: "El campo de contraseña es obligatorio"
        }]
    });

    $("#inputConfirmaRegistro").dxTextBox({
        placeholder: "Confirma la contraseña",
        mode: "password",
        elementAttr: {
            class: "form-control input-registro contraseña",
        },
        onContentReady: function (e) {
            var $inputPassword = e.element.find(".dx-texteditor-input");
            $inputPassword.after(
                '<i class="fa fa-eye toggle-password2" toggle="#inputConfirmaRegistro"></i>'
            );
        },
    });

    $("#inputConfirmaRegistro").dxValidator({
        validationRules: [{
            type: "required",
            message: "El campo de confirma la contraseña es obligatorio"
        }
        ]
    });

    var selectBoxData = [
        { value: 1, text: "Facebook" },
        { value: 2, text: "Instagram" }
        // Agrega más opciones aquí
    ];

    $("#inputPlataforma1Registro").dxSelectBox({
        dataSource: selectBoxData,
        valueExpr: "value",
        displayExpr: "text",
        placeholder: "Plataforma",
        elementAttr: {
            class: "form-control input-registro",
        },
        searchEnabled: true,
        minSearchLength: 0,
        searchExpr: "text"
    });

    $('#inputPlataforma1Registro').dxValidator({
        validationRules: [
            {
                type: "required",
                message: "Por favor, selecciona una plataforma"
            }
        ]
    });

    $("#inputPlataforma2Registro").dxSelectBox({
        dataSource: selectBoxData,
        valueExpr: "value",
        displayExpr: "text",
        placeholder: "Plataforma",
        elementAttr: {
            class: "form-control input-registro",
        },
        searchEnabled: true,
        minSearchLength: 0,
        searchExpr: "text"
    });

    $("#inputRed1Registro").dxTextBox({
        placeholder: "Nombre de usuario",
        mode: "text",
        elementAttr: {
            class: "form-control input-registro",
        },
    });

    $('#inputRed1Registro').dxValidator({
        validationRules: [
            {
                type: "required",
                message: "El campo de nombre de usuario es obligatorio"
            }
        ]
    });

    $("#inputRed2Registro").dxTextBox({
        placeholder: "Nombre de usuario",
        mode: "text",
        elementAttr: {
            class: "form-control input-registro",
        },
    });

    var selectBoxData = [
        { value: "T", text: "T" },
        { value: "CC", text: "CC" },
        { value: "A", text: "A" },
        // Agrega más opciones aquí
    ];

    $("#inputTipoDocRegistro").dxSelectBox({
        dataSource: selectBoxData,
        valueExpr: "value",
        displayExpr: "text",
        placeholder: "T",
        elementAttr: {
            class: "form-control input-indicativo",
        },
        width: 100
    });

    $("#inputDocumentoRegistro").dxNumberBox({
        placeholder: "Número documento",
        mode: "number",
        elementAttr: {
            class: "form-control input-telefono",
        },
        value: null
    });

    $("#fileSelfieRegistro").dxFileUploader({
        selectButtonText: "Toma/adjunta selfie",
        labelText: "",
        accept: 'image/*',
        uploadMode: "useForm",
        onValueChanged: function (e) {
            console.log("Archivo seleccionado: " + e.value[0].name);
        },
    });

    $("#fileDocumentoRegistro").dxFileUploader({
        selectButtonText: "Adjunta el documento",
        labelText: "",
        accept: 'image/*',
        uploadMode: "useForm",
        onValueChanged: function (e) {
            console.log("Archivo seleccionado: " + e.value[0].name);
        },
    });

});

/* Metodos externos */

function atrasDiv1() {
    document.getElementById('div1').style.display = 'block';
    document.getElementById('div2').style.display = 'none';
}

function mostrarDiv2() {
    var nombreValidator = $("#inputNombresRegistro").dxValidator("instance");
    var apellidoValidator = $("#inputApellidosRegistro").dxValidator("instance");
    var emailValidator = $("#inputEmailRegistro").dxValidator("instance");
    var paisValidator = $("#inputPaisRegistro").dxValidator("instance");
    var telefonoValidator = $("#inputTelefonoRegistro").dxValidator("instance");
    var nacimientoValidator = $("#inputNacimientoRegistro").dxValidator("instance");

    var isValid1 = nombreValidator.validate().isValid;
    var isValid2 = apellidoValidator.validate().isValid;
    var isValid3 = emailValidator.validate().isValid;
    var isValid4 = telefonoValidator.validate().isValid;
    var isValid5 = paisValidator.validate().isValid;
    var isValid6 = nacimientoValidator.validate().isValid;

    if (isValid1 && isValid2 && isValid3 && isValid4 && isValid5 && isValid6) {
        document.getElementById('div1').style.display = 'none';
        document.getElementById('div2').style.display = 'block';
    }
}

function atrasDiv2() {
    document.getElementById('div3').style.display = 'none';
    document.getElementById('div2').style.display = 'block';
}

function mostrarDiv3() {

    var passwordInput = $("#inputContraseñaRegistro").dxValidator("instance");
    var confirmPasswordInput = $("#inputConfirmaRegistro").dxValidator("instance");

    var isValidPassword = passwordInput.validate().isValid;
    var isValidConfirmPassword = confirmPasswordInput.validate().isValid;
    

    if (isValidPassword && isValidConfirmPassword) {
        document.getElementById('div2').style.display = 'none';
        document.getElementById('div3').style.display = 'block';
    }
}

function atrasDiv3() {
    document.getElementById('div4').style.display = 'none';
    document.getElementById('div3').style.display = 'block';
}

function mostrarDiv4() {

    var plataforma = $("#inputPlataforma1Registro").dxValidator("instance");
    var nombreUsuario = $("#inputRed1Registro").dxValidator("instance");

    var isValidPlataforma = plataforma.validate().isValid;
    var isValidUsuario = nombreUsuario.validate().isValid;

    if(isValidPlataforma && isValidUsuario){
        document.getElementById('div3').style.display = 'none';
        document.getElementById('div4').style.display = 'block';
    }
}

function agregar() {
    document.getElementById('agregar').style.display = 'none';
    document.getElementById('otroP').style.display = 'block';
    document.getElementById('otroN').style.display = 'block';
}
