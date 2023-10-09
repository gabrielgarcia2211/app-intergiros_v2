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

var listRedSocial = [
    { value: 1, text: "Facebook" },
    { value: 2, text: "Instagram" },
];

var listTipoDoc = [
    { value: "T", text: "T" },
    { value: "CC", text: "CC" },
    { value: "A", text: "A" },
];

var flagFormInfoGeneral = false;
var flagFormInfoPassword = false;
var flagFormInfoRedes = false;
var flagFormInfoValidacion = false;

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
        resetForm();

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
                    message: "Por favor, selecciona un indicativo",
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

        setDateBox(
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

        /** Control de campos */
        flagFormInfoGeneral = true;
        flagFormInfoPassword = false;
        flagFormInfoRedes = false;
        flagFormInfoValidacion = false;

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
        resetForm();

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

        flagFormInfoGeneral = false;
        flagFormInfoPassword = true;
        flagFormInfoRedes = false;
        flagFormInfoValidacion = false;

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

            initFormRedes();
        });
    }

    function initFormRedes() {
        resetForm();

        const inputPlataforma1Registro = setSelectBox(
            "#inputPlataforma1Registro",
            {
                dataSource: new DevExpress.data.ArrayStore({
                    data: listRedSocial,
                    key: "value",
                }),
                displayExpr: "text",
                valueExpr: "value",
                placeholder: "Plataforma",
                name: "plataforma1",
                searchEnabled: true,
                minSearchLength: 0,
                elementAttr: {
                    class: "form-control input-registro",
                },
            },
            [
                {
                    type: "required",
                    message: "Por favor, selecciona una plataforma",
                },
            ]
        ).dxSelectBox("instance");

        inputPlataforma1Registro.option({
            validationStatus: "valid",
        });

        const inputPlataforma2Registro = setSelectBox(
            "#inputPlataforma2Registro",
            {
                dataSource: new DevExpress.data.ArrayStore({
                    data: listRedSocial,
                    key: "value",
                }),
                displayExpr: "text",
                valueExpr: "value",
                placeholder: "Plataforma",
                name: "plataforma2",
                searchEnabled: true,
                minSearchLength: 0,
                elementAttr: {
                    class: "form-control input-registro",
                },
            }
        ).dxSelectBox("instance");

        const inputRed1Registro = setTextBox(
            "#inputRed1Registro",
            {
                placeholder: "Nombre de usuario",
                mode: "text",
                elementAttr: {
                    class: "form-control input-registro",
                },
            },
            [
                {
                    type: "required",
                    message: "El campo de nombre de usuario es obligatorio",
                },
            ]
        ).dxTextBox("instance");

        inputRed1Registro.option({
            validationStatus: "valid",
        });

        const inputRed2Registro = setTextBox("#inputRed2Registro", {
            placeholder: "Nombre de usuario",
            mode: "text",
            elementAttr: {
                class: "form-control input-registro",
            },
        }).dxTextBox("instance");

        flagFormInfoGeneral = false;
        flagFormInfoPassword = false;
        flagFormInfoRedes = true;
        flagFormInfoValidacion = false;

        setButton("#btn_infoRedes", {
            text: "Continuar",
            type: "submit",
            elementAttr: {
                class: "button-login",
            },
            useSubmitBehavior: true,
        });

        sendInfoRedes();
    }

    function sendInfoRedes() {
        $("#formInfoRedes").off("submit");
        $("#formInfoRedes").on("submit", function (e) {
            e.preventDefault();
            var formulario = $("#formInfoRedes")[0];
            var formData = new FormData(formulario); // almacenamos la info del primer formulario, para continuar

            document.getElementById("div3").style.display = "none";
            document.getElementById("div4").style.display = "block";

            initFormValidacion();
        });
    }

    function initFormValidacion() {
        resetForm();

        const inputTipoDocRegistro = setSelectBox(
            "#inputTipoDocRegistro",
            {
                dataSource: new DevExpress.data.ArrayStore({
                    data: listTipoDoc,
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
                    message: "Por favor, selecciona un tipo de documento",
                },
            ]
        ).dxSelectBox("instance");

        inputTipoDocRegistro.option({
            validationStatus: "valid",
        });

        const inputDocumentoRegistro = setTextBox(
            "#inputDocumentoRegistro",
            {
                placeholder: "Número documento",
                name: "numero_documento",
                mode: "number",
                elementAttr: {
                    class: "form-control input-telefono",
                },
            },
            [
                {
                    type: "required",
                    message: "El campo de numero de documento es obligatorio",
                },
            ]
        ).dxTextBox("instance");

        inputDocumentoRegistro.option({
            validationStatus: "valid",
        });

        $("#fileSelfieRegistro").dxFileUploader({
            selectButtonText: "Toma/adjunta selfie",
            labelText: "",
            accept: "image/*",
            uploadMode: "useForm",
            onValueChanged: function (e) {
                console.log("Archivo seleccionado: " + e.value[0].name);
            },
        });

        $("#fileSelfieRegistro").dxValidator({
            validationRules: [
                {
                    type: "required",
                    message: "Debe agregar una selfie con el documento en mano",
                },
            ],
        });

        $("#fileDocumentoRegistro").dxFileUploader({
            selectButtonText: "Adjunta el documento",
            labelText: "",
            accept: "image/*",
            uploadMode: "useForm",
            onValueChanged: function (e) {
                console.log("Archivo seleccionado: " + e.value[0].name);
            },
        });

        $("#fileDocumentoRegistro").dxValidator({
            validationRules: [
                {
                    type: "required",
                    message: "Debe agregar una foto de su documento",
                },
            ],
        });

        flagFormInfoGeneral = false;
        flagFormInfoPassword = false;
        flagFormInfoRedes = false;
        flagFormInfoValidacion = true;

        setButton("#btn_infoValidacion", {
            text: "Continuar",
            type: "submit",
            elementAttr: {
                class: "button-login",
            },
            useSubmitBehavior: true,
        });

        setButton("#btn_omitirValidacion", {
            text: "Omitir y continuar",
            type: "submit",
            elementAttr: {
                class: "button-codigo",
            },
            useSubmitBehavior: true,
            onClick: function () {
                $("#myModal").modal("hide");
                document.getElementById("div4").style.display = "none";
                document.getElementById("div5").style.display = "block";
            },
        });

        sendInfoValidacion();
    }

    function sendInfoValidacion() {
        $("#formInfoValidacion").off("submit");
        $("#formInfoValidacion").on("submit", function (e) {
            e.preventDefault();
            var formulario = $("#formInfoValidacion")[0];
            var formData = new FormData(formulario); // almacenamos la info del primer formulario, para continuar

            document.getElementById("div4").style.display = "none";
            document.getElementById("div5").style.display = "block";
        });
    }

    setButton("#atrasDiv1", {
        text: "Atrás",
        onClick: function () {
            document.getElementById("div1").style.display = "block";
            document.getElementById("div2").style.display = "none";
            initForm();
        },
    });

    setButton("#atrasDiv2", {
        text: "Atrás",
        onClick: function () {
            document.getElementById("div2").style.display = "block";
            document.getElementById("div3").style.display = "none";
            initFormPass();
        },
    });

    setButton("#atrasDiv3", {
        text: "Atrás",
        onClick: function () {
            document.getElementById("div3").style.display = "block";
            document.getElementById("div4").style.display = "none";
            initFormRedes();
        },
    });

    
});


function agregar() {
    document.getElementById("agregar").style.display = "none";
    document.getElementById("otroP").style.display = "block";
    document.getElementById("otroN").style.display = "block";
}
