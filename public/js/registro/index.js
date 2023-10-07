var listPais = [
    { value: 1, text: "Colombia" },
    { value: 2, text: "Venezuela" },
    { value: 3, text: "Perú" },
];

var listTelefono = [
    { value: "+57", text: "+57" },
    { value: "+58", text: "+58" },
    { value: "+51", text: "+51" },
];

var selectBoxData = [
    { value: 1, text: "Facebook" },
    { value: 2, text: "Instagram" },
];

var selectBoxData = [
    { value: "T", text: "T" },
    { value: "CC", text: "CC" },
    { value: "A", text: "A" },
];

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

$(document).ready(function () {
    /* Registro */
    initForm();

    function initForm() {
        const inputEmailRegistro = setTextBox(
            "#inputEmailRegistro",
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

        inputEmailRegistro.option({
            validationStatus: "valid",
        });

        const inputNombresRegistro = setTextBox(
            "#inputNombresRegistro",
            {
                placeholder: "Nombres",
                mode: "text",
                elementAttr: {
                    class: "form-control input-registro",
                },
            },
            [
                {
                    type: "required",
                    message: "El campo de nombres es obligatorio",
                },
            ]
        ).dxTextBox("instance");

        inputNombresRegistro.option({
            validationStatus: "valid",
        });

        const inputApellidosRegistro = setTextBox(
            "#inputApellidosRegistro",
            {
                placeholder: "Apellidos",
                mode: "text",
                elementAttr: {
                    class: "form-control input-registro",
                },
            },
            [
                {
                    type: "required",
                    message: "El campo de apellidos es obligatorio",
                },
            ]
        ).dxTextBox("instance");

        inputApellidosRegistro.option({
            validationStatus: "valid",
        });

        const inputPaisRegistro = setSelectBox(
            "#inputPaisRegistro",
            {
                dataSource: new DevExpress.data.ArrayStore({
                    data: listPais,
                    key: "value",
                }),
                displayExpr: "text",
                valueExpr: "value",
                placeholder: "País",
                name: "pais",
                searchEnabled: true,
                minSearchLength: 0,
                elementAttr: {
                    class: "form-control input-registro",
                },
            },
            [
                {
                    type: "required",
                    message: "Por favor, selecciona un país",
                },
            ]
        ).dxSelectBox("instance");

        inputPaisRegistro.option({
            validationStatus: "valid",
        });

        const inputIndicativoRegistro = setSelectBox(
            "#inputIndicativoRegistro",
            {
                dataSource: new DevExpress.data.ArrayStore({
                    data: listTelefono,
                    key: "value",
                }),
                placeholder: "",
                displayExpr: "text",
                valueExpr: "value",
                searchEnabled: true,
                minSearchLength: 0,
                width: 100,
                elementAttr: {
                    class: "form-control input-indicativo",
                },
            },
            [
                {
                    type: "required",
                    message: "Por favor, selecciona un país",
                },
            ]
        ).dxSelectBox("instance");

        inputIndicativoRegistro.option({
            validationStatus: "valid",
        });

        const inputTelefonoRegistro = setTextBox(
            "#inputTelefonoRegistro",
            {
                placeholder: "Número celular",
                name: "numero_celular",
                mode: "number",
                elementAttr: {
                    class: "form-control input-telefono",
                },
            },
            [
                {
                    type: "required",
                    message: "El campo de numero celular es obligatorio",
                },
            ]
        ).dxTextBox("instance");

        inputTelefonoRegistro.option({
            validationStatus: "valid",
        });

        const inputNacimientoRegistro = setDateBox(
            "#inputNacimientoRegistro",
            {
                placeholder: "Fecha de nacimiento",
                type: "date",
                elementAttr: {
                    class: "form-control input-registro",
                    id: "fechaNacimiento",
                },
                displayFormat: "dd/MM/yyyy",
            },
            [
                {
                    type: "required",
                    message: "Por favor, ingresa tu fecha de nacimiento",
                },
            ]
        ).dxDateBox("instance");

        inputNacimientoRegistro.option({
            validationStatus: "valid",
        });

        setButton("#btn_infoGeneral", {
            text: "Continuar",
            type: "submit",
            elementAttr: {
                class: "button-login",
            },
            useSubmitBehavior: true,
        });

        sendinfoGeneral();
    }

    function sendinfoGeneral() {
        $("#formInfoGeneral").off("submit");
        $("#formInfoGeneral").on("submit", function (e) {
            e.preventDefault();
            var formulario = $("#formInfoGeneral")[0];
            var formData = new FormData(formulario); // almacenamos la info del primer formulario, para continuar

            document.getElementById("div1").style.display = "none";
            document.getElementById("div2").style.display = "block";

            initFormPass();
        });
    }

    function initFormPass() {
        const inputContraseñaRegistro = setTextBox(
            "#inputContraseñaRegistro",
            {
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
            },
            [
                {
                    type: "required",
                    message: "El campo de contraseña es obligatorio",
                },
            ]
        ).dxTextBox("instance");

        inputContraseñaRegistro.option({
            validationStatus: "valid",
        });

        const inputConfirmaRegistro = setTextBox(
            "#inputConfirmaRegistro",
            {
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
            },
            [
                {
                    type: "required",
                    message:
                        "El campo de confirma la contraseña es obligatorio",
                },
            ]
        ).dxTextBox("instance");

        inputConfirmaRegistro.option({
            validationStatus: "valid",
        });

        setButton("#btn_infoPassword", {
            text: "Continuar",
            type: "submit",
            elementAttr: {
                class: "button-login",
            },
            useSubmitBehavior: true,
        });

        sendInfoPassword();
    }

    function sendInfoPassword() {
        $("#formInfoPassword").off("submit");
        $("#formInfoPassword").on("submit", function (e) {
            e.preventDefault();
            var formulario = $("#formInfoPassword")[0];
            var formData = new FormData(formulario); // almacenamos la info del primer formulario, para continuar

            document.getElementById("div2").style.display = "none";
            document.getElementById("div3").style.display = "block";

            initFormPass();
        });
    }
});

/** Control de paginas */
function atrasDiv1() {
    document.getElementById("div1").style.display = "block";
    document.getElementById("div2").style.display = "none";
}

function atrasDiv2() {
    document.getElementById("div3").style.display = "none";
    document.getElementById("div2").style.display = "block";
}

function atrasDiv3() {
    document.getElementById("div4").style.display = "none";
    document.getElementById("div3").style.display = "block";
}
