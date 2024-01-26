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

        let cantidadRevisiones = Math.max(1, details.data.revisiones);
        let costoTotal = cantidadRevisiones * 1; // costoPorRevision
        var headersTable = ["Cantidad", "Nombre", "Costo", "Total"];

        var dataTable = [
            {
                cantidad: 1,
                nombre: details.data.producto.nombre,
                costo: details.data.producto.rango_min,
                total: details.data.producto.rango_min,
            },
            {
                cantidad: cantidadRevisiones,
                nombre: "Revision",
                costo: 1,
                total: costoTotal,
            },
        ];

        llenarTabla("#tablaProductos", headersTable, dataTable);
    }
});

function llenarTabla(selector, cabeceras, datos) {
    var $tabla = $(selector);

    // Limpia la tabla existente
    $tabla.empty();

    // Construye y agrega el encabezado de la tabla
    var $thead = $(
        '<thead style="background-color: #e99700; color: white;"></thead>'
    );
    var $trHead = $("<tr></tr>");
    cabeceras.forEach(function (cabecera) {
        $trHead.append("<th><strong>" + cabecera + "</strong></th>");
    });
    $thead.append($trHead);
    $tabla.append($thead);

    // Construye y agrega el cuerpo de la tabla
    var $tbody = $("<tbody></tbody>");
    datos.forEach(function (item) {
        var $fila = $("<tr></tr>");
        cabeceras.forEach(function (_, index) {
            // Obtiene la clave correspondiente a la posición actual
            var clave = Object.keys(item)[index];
            var valor = item[clave];
            var textoCelda;

            // Si es una de las dos últimas columnas, formatea el valor
            if (
                index === cabeceras.length - 1 ||
                index === cabeceras.length - 2
            ) {
                textoCelda = "$ " + valor + " USD";
            } else {
                textoCelda =
                    valor !== undefined && valor !== null ? valor : "n/a";
            }

            $fila.append("<td>" + textoCelda + "</td>");
        });

        $tbody.append($fila);
    });
    $tabla.append($tbody);
}

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
