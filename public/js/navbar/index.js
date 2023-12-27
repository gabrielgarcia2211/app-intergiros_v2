$(document).ready(async function () {
    var details = await getNotificaciones();
    mostrarNotificaciones(details);

    function getNotificaciones() {
        return new Promise((resolve, reject) => {
            axios
                .get(`/notificaciones/status`)
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
        if (details.data.nuevas) {
            $("#pointPadre").show();
        }
    }
});
