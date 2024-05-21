$(document).ready(async function () {
    await setLoadInputs();

    async function setLoadInputs() {
        const comboNames = ["pais_telefono", "pais", "redes", "tipo_documento_registro"];

        const response = await getComboRelations(comboNames);
        const {
            pais_telefono: responsePaisTelefono,
            pais: responsePais,
            redes: responseRedes,
            tipo_documento_registro: responseTipoDocumento,
        } = response;

        $.each(responsePaisTelefono, function (key, value) {
            $("#paisTelefono").append(
                $("<option>", { value: value.id }).text(value.name)
            );
        });

        $.each(responsePais, function (key, value) {
            $("#pais").append(
                $("<option>", { value: value.id }).text(value.name)
            );
        });

        $.each(responseRedes, function (key, value) {
            $("#redes1").append(
                $("<option>", { value: value.id }).text(value.name)
            );
            $("#redes2").append(
                $("<option>", { value: value.id }).text(value.name)
            );
        });

        $.each(responseTipoDocumento, function (key, value) {
            $("#tipoDocumento").append(
                $("<option>", { value: value.id }).text(value.name)
            );
        });
    }
});
