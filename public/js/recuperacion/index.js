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
