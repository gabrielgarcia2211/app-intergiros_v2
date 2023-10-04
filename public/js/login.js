/* INPUTS */
$(() => {

    $(document).on("click", '.toggle-password', function () {
        var $passwordInput = $(this).closest('.input-group').find('#inputPassword');
        var isPasswordVisible = $passwordInput.dxTextBox("option", "mode") === "text";

        $passwordInput.dxTextBox("option", "mode", isPasswordVisible ? "password" : "text");
        $(this).toggleClass("fa-eye fa-eye-slash");
    });

    $("#inputEmail").dxTextBox({
        placeholder: "Email",
        mode: "email",
        elementAttr: {
            class: "form-control input-login"
        },
    });

    $("#inputEmail").dxTextBox({
        placeholder: "CÓDIGO",
        mode: "text",
        elementAttr: {
            class: "input-codigo"
        },
    });

    $("#inputPassword").dxTextBox({
        placeholder: "Contraseña",
        mode: "password",
        elementAttr: {
            class: "form-control input-login"
        },
        onContentReady: function(e) {
            var $inputPassword = e.element.find(".dx-texteditor-input");
            $inputPassword.after('<i class="fa fa-eye toggle-password" toggle="#' + $inputPassword.attr("id") + '"></i>');
            
        }
        
    });

    $("#inputPasswordNuevo").dxTextBox({
        placeholder: "Contraseña nueva",
        mode: "password",
        elementAttr: {
            class: "form-control input-login"
        },
        onContentReady: function(e) {
            var $inputPassword = e.element.find(".dx-texteditor-input");
            $inputPassword.after('<i class="fa fa-eye toggle-password" toggle="#' + $inputPassword.attr("id") + '"></i>');
            
        }
        
    });

    $("#inputPasswordConfirma").dxTextBox({
        placeholder: "Confirma la contraseña",
        mode: "password",
        elementAttr: {
            class: "form-control input-login"
        },
        onContentReady: function(e) {
            var $inputPassword = e.element.find(".dx-texteditor-input");
            $inputPassword.after('<i class="fa fa-eye toggle-password" toggle="#' + $inputPassword.attr("id") + '"></i>');
            
        }
        
    });

    $("#loginButton").dxButton({
        text: "Iniciar Sesión",
        type: "submit",
        elementAttr: {
            class: "button-login"
        },
        onClick: function () {
            
            alert("Botón 'Iniciar Sesión' presionado");
        }
    });

    $("#reenviarButton").dxButton({
        text: "Reenviar",
        type: "submit",
        elementAttr: {
            class: "button-codigo"
        },
        onClick: function () {
            
            alert("Reenviar' presionado");
        }
    });

    $("#enviarButton").dxButton({
        text: "Enviar",
        type: "submit",
        elementAttr: {
            class: "button-codigo"
        },
        onClick: function () {
            
            alert("Botón 'Enviar' presionado");
        }
    });

});




