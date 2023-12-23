$(document).ready(async function () {
    await setLoadInputs();

    async function setLoadInputs() {
        const comboNames = ["pais_telefono", "pais", "tipo_documento"];
        const response = await getComboRelations(comboNames);
        const {
            pais_telefono: responsePaisTelefono,
            pais: responsePais,
            tipo_documento: responseTipoDocumento,
        } = response;

        $.each(responseTipoDocumento, function (key, value) {
            $("#tipoDocumentoPago").append(
                $("<option>", { value: value.id }).text(value.name)
            );
        });

        $.each(responsePaisTelefono, function (key, value) {
            $("#paisTelefonoPago").append(
                $("<option>", { value: value.id }).text(value.name)
            );
        });

        $.each(responsePais, function (key, value) {
            $("#paisPago").append(
                $("<option>", { value: value.id }).text(value.name)
            );
        });
    }
});