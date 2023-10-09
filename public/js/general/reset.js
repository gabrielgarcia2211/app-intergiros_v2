function resetForm() {
    if (flagFormInfoGeneral) {
        $("#inputEmailRegistro").dxTextBox("dispose");
        $("#inputNombresRegistro").dxTextBox("dispose");
        $("#inputApellidosRegistro").dxTextBox("dispose");
        $("#inputPaisRegistro").dxSelectBox("dispose");
        $("#inputIndicativoRegistro").dxSelectBox("dispose");
        $("#inputTelefonoRegistro").dxTextBox("dispose");
        $("#inputNacimientoRegistro").dxDateBox("dispose");
    }

    if (flagFormInfoPassword) {
        $("#inputContraseñaRegistro").dxTextBox("dispose");
        $("#inputConfirmaRegistro").dxTextBox("dispose");
    }

    if (flagFormInfoRedes) {
        $("#inputPlataforma1Registro").dxSelectBox("dispose");
        $("#inputPlataforma2Registro").dxSelectBox("dispose");
        $("#inputRed1Registro").dxTextBox("dispose");
        $("#inputRed2Registro").dxTextBox("dispose");
    }

    if (flagFormInfoValidacion) {
        $("#inputTipoDocRegistro").dxSelectBox("dispose");
        $("#inputDocumentoRegistro").dxTextBox("dispose");
        $("#fileSelfieRegistro").dxFileUploader("dispose");
        $("#fileDocumentoRegistro").dxFileUploader("dispose");
    }
}
