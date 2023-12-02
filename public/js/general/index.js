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

// Función para mostrar imagenes en sweetAlert
function showImageAlert(imageSrc) {
    Swal.fire({
        imageUrl: imageSrc,
        imageAlt: "Imagen",
        confirmButtonText: "Aceptar",
    });
}

// generar tokens
function generateRandomToken() {
    const characters =
        "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    let token = "";

    for (let i = 0; i < 7; i++) {
        const randomIndex = Math.floor(Math.random() * characters.length);
        token += characters.charAt(randomIndex);
    }

    return token;
}

// Funcion para cargar imagenes en inputs type file
async function loadImageFromURL(url, id) {
    try {
        const response = await fetch(url);
        const blob = await response.blob();
        const fileName = getFileNameFromUrl(url);

        // Crear un objeto FileList con el blob
        const dataTransfer = new DataTransfer();
        const file = new File([blob], fileName, { type: blob.type, lastModified: new Date() });
        dataTransfer.items.add(file);
        $(id).prop('files', dataTransfer.files);

        // Ayudar a Safari
        if ($(id)[0].webkitEntries.length) {
            $(id).data('file', fileName);
        }
    } catch (error) {
        console.error('Error al cargar la imagen desde la URL:', error);
    }
}

// Función para obtener el nombre del archivo desde la URL
function getFileNameFromUrl(url) {
    const urlParts = url.split('/');
    return urlParts[urlParts.length - 1];
}

// Función para establecer una cookie
function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}

// Función para obtener el valor de una cookie
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(";");
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == " ") c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0)
            return c.substring(nameEQ.length, c.length);
    }
    return null;
}

