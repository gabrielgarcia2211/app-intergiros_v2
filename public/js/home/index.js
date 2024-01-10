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






document.addEventListener('DOMContentLoaded', function () {
    var selectPaises = document.getElementById('paisesPaypal');
    var imagenPais = document.getElementById('imagenPais');

    selectPaises.addEventListener('change', function () {
        var imagenUrl = selectPaises.options[selectPaises.selectedIndex].getAttribute('data-image');
        imagenPais.innerHTML = '<img src="' + imagenUrl + '" alt="Bandera" style="margin-top: 8px;margin-left: 10px; width: 50px;">';
    });
});

document.addEventListener('DOMContentLoaded', (event) => {
    const miSelect = document.getElementById('paisesPaypal');
    const tipoCambio = document.getElementById('tipo_cambio_paypal');
    const bancos = document.getElementById('bancos_paypal');
    const monto = document.getElementById('monto_minimo_paypal');
    const tiempo = document.getElementById('tiempo_transferencia_paypal');

    miSelect.addEventListener('change', (event) => {
        const valor = event.target.value;

        switch (valor) {
            case 'venezuela':
                tipoCambio.textContent = 'BS';
                bancos.textContent = 'BSBDV, pago móvil';
                monto.textContent = '$5 USD + comisión PayPal';
                tiempo.textContent = '8h laborales';
                break;
            case 'peru':
                tipoCambio.textContent = 'PEN';
                bancos.textContent = 'BCP, Interbank, BBVA Continental, Scotiabank';
                monto.textContent = '$5 USD + comisión PayPal';
                tiempo.textContent = '24h no laborales';
                break;
            case 'peru-dolar':
                tipoCambio.textContent = 'PEN';
                bancos.textContent = 'BCP, Interbank, BBVA Continental, Scotiabank';
                monto.textContent = '$5 USD + comisión PayPal';
                tiempo.textContent = '24h no laborales';
                break;
            case 'colombia':
                tipoCambio.textContent = 'COP';
                bancos.textContent = 'Banco de Bogotá, Bancolombia y Nequi';
                monto.textContent = '$5 USD + comisión PayPal';
                tiempo.textContent = '24h no laborales';
                break;
            default:
                tipoCambio.textContent = 'Ninguno';
                bancos.textContent = 'Ninguno';
        }
    });
});