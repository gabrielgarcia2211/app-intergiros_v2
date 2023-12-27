var solicitudId;

$(document).ready(async function () {
    solicitudId = obtenerParametroGET("solicitud");
    var details = await getSolicitudIniciada(solicitudId);
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
        $("#monto_comision").html(
            parseFloat(details.data.monto_a_pagar) + parseFloat(0.89)
        );
        $("#monto_total").html(
            parseFloat($("#monto_a_pagar").text()) +
                parseFloat($("#monto_comision").text())
        );
    }

    var headersTable = ["Cantidad", "Servicio", "Costo", "Total"];
    var dataTable = [details.data.producto];

    llenarTabla("#tablaProductos", headersTable, dataTable);
});

function sendPaytoPaypal() {
    var formData = new FormData();
    formData.append("solicitud_id", solicitudId);
    Swal.fire({
        title: "Cargando...",
        allowOutsideClick: false,
        showConfirmButton: false,
        willOpen: () => {
            Swal.showLoading();
        },
    });

    axios
        .post("/paypal/pay", formData)
        .then((response) => {
            let info = response.data;
            Swal.close();
            if (info.success) {
                window.location.href = info.data.approval_url;
            } else {
                window.location.href = info.data.denied_url;
            }
        })
        .catch((error) => {
            Swal.close();
            handleErrors(error);
        });
}
