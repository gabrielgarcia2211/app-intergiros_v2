$(document).ready(async function () {
    await setLoadInputs();
    const rpForms = await getForms();
    const rpMonedas = await getMonedas();
    setLoadSelectsForms(rpForms);
    setLoadSelectsMonedas(rpMonedas);
    modalReclamos();

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
                    "/administracion/formularios/" + principal
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
                const response = await axios.get("/administracion/monedas");
                resolve(response.data);
            } catch (error) {
                handleErrors(error);
                reject(error);
            }
        });
    }

    async function modalReclamos() {
        const comboNames = ["modal_reclamo"];

        const response = await getComboRelations(comboNames);
        const { modal_reclamo: responseReclamo } = response;

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
});
