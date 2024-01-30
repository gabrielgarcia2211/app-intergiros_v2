$(document).ready(async function () {
    $.validator.addMethod(
        "filesize",
        function (value, element, param) {
            // Check if file is selected
            if (element.files && element.files.length) {
                // Check file size
                return this.optional(element) || element.files[0].size <= param;
            }
            return true; // If no file is selected, validation passes by default
        },
        "El tamaño del archivo debe ser menor a {0} bytes"
    );
});

var FILE_MAX_SIZE = 10097152;
var URL_SITE = "http://127.0.0.1:80";

// funcion para controlar errores
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

// función para mostrar un mensaje de error
function showError(message, type = "error") {
    Swal.fire({
        icon: type,
        title: "Error",
        html: message,
        position: "top",
    });
}

// función para mostrar un mensaje de éxito
function showSuccess(message, type = "success") {
    Swal.fire({
        icon: type,
        title: "Éxito",
        text: message,
        position: "top",
    });
}

// función para mostrar imagenes en sweetAlert
function showImageAlert(imageSrc, header = null) {
    if (header != null) {
        Swal.fire({
            title: `<strong>ID #${header.id}</strong>`,
            html: `
                <h6>Enviado: ${header.correo}</h6>
                <h6>Fecha: ${header.fecha}</h6>
            `,
            imageUrl: imageSrc,
            imageAlt: "Imagen",
            confirmButtonText: "Aceptar",
            showCancelButton: true,
            cancelButtonText: `<i class="fa fa-download"></i>`,
            cancelButtonColor: "#008CBA",
            cancelButtonAriaLabel: "Descargar Imagen",
            reverseButtons: true,
        }).then((result) => {
            if (result.dismiss === Swal.DismissReason.cancel) {
                downloadImage(
                    imageSrc,
                    `voucher_${new Date().toLocaleDateString()}.jpg`
                );
            }
        });
    } else {
        Swal.fire({
            imageUrl: imageSrc,
            imageAlt: "Imagen",
            confirmButtonText: "Aceptar",
        });
    }
}

// descargar imagen
function downloadImage(url, filename) {
    const a = document.createElement("a");
    a.href = url;
    a.download = filename;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
}


// get combos
function getComboRelations(gestor) {
    return new Promise((resolve, reject) => {
        axios
            .get(`/configuration/gestor/${gestor.join(",")}`)
            .then(function (response) {
                resolve(response.data);
            })
            .catch(function (error) {
                handleErrors(error);
                reject(error);
            });
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
        const file = new File([blob], fileName, {
            type: blob.type,
            lastModified: new Date(),
        });
        dataTransfer.items.add(file);
        $(id).prop("files", dataTransfer.files);

        // Ayudar a Safari
        if ($(id)[0].webkitEntries.length) {
            $(id).data("file", fileName);
        }
    } catch (error) {
        console.error("Error al cargar la imagen desde la URL:", error);
    }
}

// Función para obtener el nombre del archivo desde la URL
function getFileNameFromUrl(url) {
    const urlParts = url.split("/");
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
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

// funcion para activar boton de visualizacion de imagenes
function updateButtonAndBindClick(buttonId, imagePath) {
    const buttonSelector = `#${buttonId}`;
    const iconSelector = `${buttonSelector} i`;

    if (imagePath) {
        $(iconSelector).attr("class", "fas fa-eye");
    }

    $(buttonSelector).click(function () {
        if (imagePath) {
            showImageAlert(imagePath);
        }
    });
}

// funcion de conversion de monedas
function devFormatoMoneda(key, value) {
    return new Promise((resolve, reject) => {
        var formData = new FormData();
        formData.append("tasa", key);
        formData.append("monto", value);

        axios
            .post("/convertidor/tasa", formData)
            .then((response) => {
                resolve(response.data);
            })
            .catch((error) => {
                handleErrors(error);
                reject(error);
            });
    });
}

// funcion para obtener parametro de ruta get
function obtenerParametroGET(parametro) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(parametro);
}
