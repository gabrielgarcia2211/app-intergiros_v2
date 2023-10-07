// FIELDS
function setTextBox(element = "", config = {}, validations = []) {
    return $(element).dxTextBox(config).dxValidator({
        validationRules: validations,
    });
}

function setTagBox(element = "", config = {}, validations = []) {
    return $(element).dxTagBox(config).dxValidator({
        validationRules: validations,
    });
}

function setSelectBox(element = "", config = {}, validations = []) {
    return $(element).dxSelectBox(config).dxValidator({
        validationRules: validations,
    });
}

function setCheckBox(element = "", value = true, text = "", callback) {
    return $(element).dxCheckBox({
        value,
        text,
        onValueChanged(data) {
            callback(data);
        },
    });
}

function setTextArea(element = "", config = {}, validations = []) {
    return $(element).dxTextArea(config).dxValidator({
        validationRules: validations,
    });
}

function setNumberBox(element = "", config = {}, validations = []) {
    return $(element).dxNumberBox(config).dxValidator({
        validationRules: validations,
    });
}

function setDateBox(element = "", config = {}, validations = []) {
    return $(element).dxDateBox(config).dxValidator({
        validationRules: validations,
    });
}
// END FIELDS

// BUTTONS
function setButton(element = "", config = {}) {
    return $(element).dxButton(config);
}
// END BUTTONS

// CONTROL DE ERRORES
function handleErrorsLogin(error) {
    switch (error.response.status) {
        case 401:
            window.location.replace("/");
            break;
        case 403:
            showMessageText(
                "No tiene permiso para realizar la accion.",
                "warning"
            );
            break;
        case 422:
            const errors = error.response.data.errors;
            const messages = Object.values(errors)
                .map((errorList) => `<li>${errorList[0]}</li>`)
                .join("");

            $("#popupDataLogin").html(`<ul>${messages}</ul>`);

            popupLogin.show();
            break;
        default:
            showMessageText(
                "Ocurrió un error inesperado, por favor vuelva a intentarlo.",
                "error"
            );
            break;
    }
}

function handleErrors(error) {
    switch (error.response.status) {
        case 401:
            window.location.replace("/");
            break;
        case 403:
            showMessageText(
                "No tiene permiso para realizar la accion.",
                "warning"
            );
            break;
        case 422:
            const errors = error.response.data.errors;
            const messages = Object.values(errors)
                .map((errorList) => `<li>${errorList[0]}</li>`)
                .join("");
            showMessageHtml(`<ul>${messages}</ul>`, "error");
            break;
        default:
            showMessageText(
                "Ocurrió un error inesperado, por favor vuelva a intentarlo.",
                "error"
            );
            break;
    }
}
// END CONTROL DE ERRORES

// MENSAJES
function showMessageText(
    message = "",
    type = "success",
    time = 3000,
    width = 330,
    position = {
        my: "top",
        at: "top",
        of: "#container",
    }
) {
    DevExpress.ui.notify(
        {
            message,
            width,
            position,
        },
        type,
        time
    );
}

function showMessageHtml(
    html = "",
    type = "success",
    time = 3000,
    width = "80%",
    position = {
        my: "top",
        at: "top+20",
        of: "#container",
    }
) {
    DevExpress.ui.notify(
        {
            position,
            width,
            contentTemplate: (element) => {
                element.append(html);
            },
        },
        type,
        time
    );
}
// END MENSAJES
