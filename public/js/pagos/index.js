$(document).ready(async function () {
    /* setInterval(function () {
        window.opener.postMessage(
            { status: "completed" },
            "http://127.0.0.1:8000"
        );
    }, 10000); */

    var id = obtenerParametroGET("solicitud");
    var details = await getSolicitudIniciada(id);
    setFieldsDepositante(details);

    function getSolicitudIniciada(id) {
        return new Promise((resolve, reject) => {
            axios
                .get(`/solicitudes/${id}`)
                .then(function (response) {
                    resolve(response.data);
                })
                .catch(function (error) {
                    handleErrors(error);
                    reject(error);
                });
        });
    }

    function setFieldsDepositante(details) {
        $("#nombre").val(details.data.depositante.nombre);
        $("#paisTelefonoPago").val(details.data.depositante.pais_telefono_id);
        $("#telefono").val(details.data.depositante.celular);
        $("#numeroDocumento").val(details.data.depositante.documento);
        $("#tipoDocumentoPago").val(details.data.depositante.tipo_documento_id);
        $("#email").val(details.data.depositante.correo);
        $("#paisPago").val(details.data.depositante.pais_id);
        $("#monto_a_pagar").html(details.data.monto_a_pagar);
        $("#monto_comision").html($("#monto_a_pagar").text() + 0.89);
        $("#monto_total").html(
            parseFloat($("#monto_a_pagar").text()) + parseFloat($("#monto_comision").text())
        );
    }

    var headersTable = ["Cantidad", "Servicio", "Costo", "Total"];
    var dataTable = [details.data.producto];

    llenarTabla("#tablaProductos", headersTable, dataTable);
});
