$(document).ready(async function () {
    initNotificaciones();

    async function initNotificaciones() {
        var details = await getNotificaciones();
        mostrarNotificaciones(details);
    }

    function getNotificaciones() {
        return new Promise((resolve, reject) => {
            axios
                .get(`/notificaciones/list`)
                .then(function (response) {
                    resolve(response.data);
                })
                .catch(function (error) {
                    handleErrors(error);
                    reject(error);
                });
        });
    }

    function mostrarNotificaciones(details) {
        if (details.data.nuevas.length > 0) {
            $(".sinMsjNotificacion").hide();
            $("#nuevasNotificaciones").show();
            $("#pointNotificacion").show();
        }
        if (details.data.anteriores.length > 0) {
            $(".sinMsjNotificacion").hide();
            $("#anterioresNotificaciones").show();
        }
        details.data.nuevas.forEach(function (notificacion) {
            $("#nuevasNotificaciones").append(
                crearElementoNotificacion(notificacion, true)
            );
        });
        details.data.anteriores.forEach(function (notificacion) {
            $("#anterioresNotificaciones").append(
                crearElementoNotificacion(notificacion, false)
            );
        });
    }

    function crearElementoNotificacion(notificacion, is_new) {
        // Estilo para ocultar el ícono si no es nuevo
        const iconStyle = is_new ? "" : "style='display: none;'";

        return `<div>
                    <div class="text-right">
                        ${notificacion.created_at} 
                        <a href="#" onclick="hiddenNotificacion(${notificacion.id}); return false;"><i class="fas fa-trash-alt" ${iconStyle}></i></a>
                    </div>
                    <h5><strong>${notificacion.estado.name}</strong></h5>
                    <h5><strong># ID: </strong>${notificacion.id}</h5>
                    <h5>${notificacion.estado.valor1}</h5>
                    <p>${notificacion.estado.valor2}</p>
                </div>`;
    }
});

function hiddenNotificacion(id) {
    axios
        .post("/notificaciones/update/" + id)
        .then((response) => {
            showSuccess("Información actualizada correctamente!");
            location.reload();
        })
        .catch((actualizarError) => {
            handleErrors(actualizarError);
        });
}
