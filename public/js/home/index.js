$(document).ready(function () {
    var payOptions = {
        pay_ven: $("#pay_ven"),
        pay_peru: $("#pay_peru"),
        usd_ven: $("#usd_ven"),
        peru_ven: $("#peru_ven"),
        col_ven: $("#col_ven"),
    };

    $("#selectorCambioHome").on("change", function () {
        $.each(payOptions, function (key, value) {
            value.hide();
        });

        var selectedOption = this.value;
        if (
            selectedOption &&
            selectedOption !== "null" &&
            payOptions[selectedOption]
        ) {
            payOptions[selectedOption].show();
        }
    });
});

async function obtenerValor(value) {
    var selectedOption = $("#selectorCambioHome").find("option:selected");
    let calculo = await devFormatoMoneda(selectedOption.data("code"), value);
    $("#monto_recibir_" + selectedOption.val()).val(
        calculo.data.monto_a_recibir
    );
    $("#monto_pagar_" + selectedOption.val()).html(calculo.data.monto_a_pagar);
    $("#monto_recibir_comision_" + selectedOption.val()).html(
        calculo.data.monto_a_recibir
    );
}

document.addEventListener('DOMContentLoaded', function() {
    var selectPaises = document.getElementById('paisesPaypal');
    var imagenPais = document.getElementById('imagenPais');

    selectPaises.addEventListener('change', function() {
        var imagenUrl = selectPaises.options[selectPaises.selectedIndex].getAttribute('data-image');
        imagenPais.innerHTML = '<img src="' + imagenUrl + '" alt="Bandera" style="margin-top: 8px;margin-left: 10px;">';
    });
});