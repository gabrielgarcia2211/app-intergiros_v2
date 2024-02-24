$(document).ready(async function () {
    init();

    async function init() {
        var notificaciones = await getNotificaciones();
        var noticias = await getNoticias();
        mostrarNotificaciones(notificaciones);
        mostrarNoticias(noticias);
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

    function getNoticias() {
        return new Promise((resolve, reject) => {
            axios
                .get(`/noticias/list`)
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

    function mostrarNoticias(details) {
        if (details.data.nuevas.length > 0) {
            $(".sinMsjNoticias").hide();
            $("#nuevasNoticias").show();
            $("#pointNoticias").show();
        }
        if (details.data.anteriores.length > 0) {
            $(".sinMsjNoticias").hide();
            $("#anterioresNoticias").show();
        }
        details.data.nuevas.forEach(function (notificacion) {
            $("#nuevasNoticias").append(
                crearElementoNoticia(notificacion, true)
            );
        });
        details.data.anteriores.forEach(function (notificacion) {
            $("#anterioresNoticias").append(
                crearElementoNoticia(notificacion, false)
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

    function crearElementoNoticia(noticia, is_new) {
        // Estilo para ocultar el ícono si no es nuevo
        const iconStyle = is_new ? "" : "style='display: none;'";

        return `<div>
                    <div class="text-right">
                        ${noticia.created_at} 
                        <a href="#" onclick="hiddenNoticia(${noticia.user_noticia_id}); return false;"><i class="fas fa-trash-alt" ${iconStyle}></i></a>
                    </div>
                    <h5><strong>${noticia.titulo}</strong></h5>
                    <h5><strong># ID: </strong>${noticia.id}</h5>
                    <h5>${noticia.referencia}</h5>
                    <h6>${noticia.descripcion}</h6>
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

function hiddenNoticia(id) {
    axios
        .post("/noticias/update/" + id)
        .then((response) => {
            showSuccess("Información actualizada correctamente!");
            location.reload();
        })
        .catch((actualizarError) => {
            handleErrors(actualizarError);
        });
}

