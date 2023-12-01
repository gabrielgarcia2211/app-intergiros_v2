function handleErrors(error) {
    switch (error.response.status) {
        case 401:
            window.location.replace("/");
            break;
        case 403:
            showError("No tiene permiso para realizar la acción.", "warning");
            break;
        case 422:
            const errors = error.response.data.errors;
            if (errors) {
                const messages = Object.values(errors)
                    .map((errorList) => errorList[0])
                    .join("<br>");
                showError(messages, "error");
            } else {
                if (error.response.data.message) {
                    showError(error.response.data.message, "error");
                } else {
                    showError("Error de validación desconocido", "error");
                }
            }
            break;
        default:
            showError(
                "Ocurrió un error inesperado, por favor vuelva a intentarlo.",
                "error"
            );
            break;
    }
}

// Función para mostrar un mensaje de error
function showError(message, type = "error") {
    Swal.fire({
        icon: type,
        title: "Error",
        html: message,
        position: "top",
    });
}

// Función para mostrar un mensaje de éxito
function showSuccess(message, type = "success") {
    Swal.fire({
        icon: type,
        title: "Éxito",
        text: message,
        position: "top",
    });
}

// generar tokens
function generateRandomToken() {
    const characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    let token = '';

    for (let i = 0; i < 7; i++) {
        const randomIndex = Math.floor(Math.random() * characters.length);
        token += characters.charAt(randomIndex);
    }

    return token;
}
