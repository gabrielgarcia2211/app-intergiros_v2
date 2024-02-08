$(document).ready(async function () {
    await setLoadInputs();
    const rpForms = await getForms();
    const rpMonedas = await getMonedas();
    setLoadSelectsForms(rpForms);
    setLoadSelectsMonedas(rpMonedas);
    modalReclamoPorSolucionar();
    modalReclamoEntregado();

    async function setLoadInputs() {
        const comboNames = ["pais_telefono", "pais", "tipo_documento"];

        const response = await getComboRelations(comboNames);
        const {
            pais_telefono: responsePaisTelefono,
            pais: responsePais,
            tipo_documento: responseTipoDocumento,
        } = response;

        $.each(responseTipoDocumento, function (key, value) {
            $("#paypalTipoDocumentoBeneficiario").append(
                $("<option>", { value: value.id }).text(value.name)
            );
            $("#paypalTipoDocumentoDepositante").append(
                $("<option>", { value: value.id }).text(value.name)
            );
            $("#addTipoDocumentoBeneficiario").append(
                $("<option>", { value: value.id }).text(value.name)
            );
        });

        $.each(responsePaisTelefono, function (key, value) {
            $("#paypalIndicativoDepositante").append(
                $("<option>", { value: value.id }).text(value.name)
            );
        });

        $.each(responsePais, function (key, value) {
            $("#paypalPaisDepositante").append(
                $("<option>", { value: value.id }).text(value.name)
            );
        });
    }

    function setLoadSelectsForms(data) {
        $.each(data, function (key, value) {
            $("#inputGroupSelect01").append(
                $("<option>", {
                    value: value.id,
                    "data-code": value.codigo,
                }).text(value.descripcion)
            );
        });

        var savedSelection = localStorage.getItem("selectedService");
        var savedAction = localStorage.getItem("actionService");
        if (savedSelection && savedAction) {
            $("#inputGroupSelect01").val(savedSelection);
            switch (savedSelection) {
                case "1":
                    $("#panel-paypal").show();
                    break;
                case "2":
                    //$("#panel-otro").show();
                    break;
                default:
                    break;
            }
            localStorage.removeItem("selectedService");
            localStorage.removeItem("actionService");
        }
    }

    function setLoadSelectsMonedas(data) {
        $.each(data, function (key, value) {
            $("#inputGroupSelect02").append(
                $("<option>", { value: value.id }).text(
                    value.tipo + ", " + value.codigo
                )
            );
        });
    }

    function getForms(principal = 1) {
        return new Promise(async (resolve, reject) => {
            try {
                const response = await axios.get(
                    "/gestion/formularios/" + principal
                );
                resolve(response.data);
            } catch (error) {
                handleErrors(error);
                reject(error);
            }
        });
    }

    function getMonedas() {
        return new Promise(async (resolve, reject) => {
            try {
                const response = await axios.get("/gestion/monedas");
                resolve(response.data);
            } catch (error) {
                handleErrors(error);
                reject(error);
            }
        });
    }

    async function modalReclamoPorSolucionar() {
        const comboNames = ["m_reclamo_por_solucionar"];

        const response = await getComboRelations(comboNames);
        const { m_reclamo_por_solucionar: responseReclamo } = response;

        $.each(responseReclamo, function (key, value) {
            $("#divChecks").append(
                $("<div>")
                    .addClass("form-check")
                    .append(
                        $("<input>")
                            .addClass("form-check-input opcion-reclamo")
                            .attr("type", "checkbox")
                            .attr("id", "option" + value.id)
                            .val(value.id),
                        $("<label>")
                            .addClass("form-check-label")
                            .attr("for", "option" + value.id)
                            .text(value.valor1)
                    )
            );
        });

        $("#divChecks").on("change", ".opcion-reclamo", function () {
            var algunoSeleccionado = $(".opcion-reclamo:checked").length > 0;
            $("#botonEnviarReclamo").prop("disabled", !algunoSeleccionado);
        });
    }

    async function modalReclamoEntregado() {
        const comboNames = ["m_reclamo_entregado"];

        const response = await getComboRelations(comboNames);
        const { m_reclamo_entregado: responseReclamo } = response;

        $.each(responseReclamo, function (key, value) {
            var checkbox = $("<input>")
                .addClass("form-check-input opcion-reclamo-entregado")
                .attr("type", "checkbox")
                .attr("id", "option" + value.id)
                .attr("data-code", value.code)
                .val(value.id);

            $("#divChecksEntregado").append(
                $("<div>")
                    .addClass("form-check")
                    .append(
                        checkbox,
                        $("<label>")
                            .addClass("form-check-label")
                            .attr("for", "option" + value.id)
                            .text(value.valor1)
                    )
            );
        });

        $("#divChecksEntregado").on(
            "change",
            ".opcion-reclamo-entregado",
            function () {
                var algunoSeleccionado =
                    $(".opcion-reclamo-entregado:checked").length > 0;
                $("#botonEnviarReclamoEntregado").prop(
                    "disabled",
                    !algunoSeleccionado
                );

                if ($(this).attr("data-code") === "reintentar_beneficiario_e") {
                    if ($(this).is(":checked")) {
                        $("#divMensajeBeneficiario").show();
                    } else {
                        $("#divMensajeBeneficiario").hide();
                    }
                }
            }
        );
    }
});
