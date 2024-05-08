$(document).ready(function () {
    var payOptions = {
        pay_ven: $("#pay_ven"),
        zinli_ven: $("#zinli_ven"),
        usd_ven: $("#usd_ven"),
        peru_ven: $("#peru_ven"),
        col_ven: $("#col_ven"),
        ven_col: $("#ven_col"),
        zinli: $("#zinli"),
        paypal: $("#paypal"),
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
    var selectMain = document.getElementById("selectorCambioHome");
    var valorSeleccionado = selectMain.value;
    var selectedOption = $("#selectorCambioHome").find("option:selected");
    const code = mapTipoMoneda(selectedOption.data("code"));
    let calculo = await devFormatoMoneda(
        code[0] + "-" + code[1],
        code[0],
        code[1],
        value
    );
    switch (valorSeleccionado) {
        case "pay_ven":
            $("#monto_recibir_pay_ven").val(calculo.data.recibir);
            $("#monto_pagar_pay_ven").html(calculo.data.pagar);
            $("#monto_recibir_comision_pay_ven").html(
                calculo.data.pagar_con_comision ?? "0.00"
            );
            tasa = "$1 dólar = " + calculo.data.tasa.valor;
            $("#tipo_cambio_paypal").html(tasa);
            break;
        case "usd_ven":
            $("#monto_recibir_usdt_ven").val(calculo.data.recibir);
            $("#monto_pagar_usd_ven").html(calculo.data.pagar);
            $("#monto_recibir_comision_usd_ven").html(
                calculo.data.pagar_con_comision ?? "0.00"
            );
            tasa = "$1 dólar = " + calculo.data.tasa.valor;
            $("#tipo_cambio_usdt").html(tasa);
            break;
        case "zinli_ven":
            $("#monto_recibir_zinli_ven").val(calculo.data.recibir);
            $("#monto_pagar_zinli_ven").html(calculo.data.pagar);
            $("#monto_recibir_comision_zinli_ven").html(
                calculo.data.pagar_con_comision ?? "0.00"
            );
            tasa = "$1 dólar = " + calculo.data.tasa.valor;
            $("#tipo_cambio_zinli").html(tasa);
            break;
        case "peru_ven":
            $("#monto_recibir_peru_ven").val(calculo.data.recibir);
            $("#monto_pagar_peru_ven").html(calculo.data.pagar);
            $("#monto_recibir_comision_peru_ven").html(
                calculo.data.pagar_con_comision ?? "0.00"
            );
            if (code == "TP-04") {
                tasa = "$1 sol = " + calculo.data.tasa.valor;
            } else {
                tasa = "$1 dólar = " + calculo.data.tasa.valor;
            }
            $("#tipo_cambio_peru").html(tasa);
            break;
        default:
            console.log("Selección no reconocida");
    }
}

function mapTipoMoneda(code) {
    switch (code) {
        case "TP-01":
            var recibir = $("#paisesPaypal")
                .find("option:selected")
                .data("code");
            return [code, recibir];
        case "TP-02":
            var recibir = $("#paisesUsdt").find("option:selected").data("code");
            return [code, recibir];
        case "TP-03":
            var recibir = $("#paisesZinli")
                .find("option:selected")
                .data("code");
            return [code, recibir];
        case "TP-04-05":
            var enviar = $("#montoPeru").find("option:selected").data("code");
            var recibir = $("#paisesPeru").find("option:selected").data("code");
            code = enviar == "PEN" ? "TP-04" : "TP-05";
            return [code, recibir];
        /*  case "TP-05":
            var enviar = document.getElementById("montoColombia");
            var recibir = document.getElementById("paisesColombia");
            var codigo = code + "-" + enviar.value + "-" + recibir.value;
            return codigo;
        case "TP-06":
            var enviar = document.getElementById("montoVenezuela");
            var recibir = document.getElementById("paisesVenezuela");
            var codigo = code + "-" + enviar.value + "-" + recibir.value;
            return codigo;
        case "TP-07":
            var enviar = document.getElementById("paisesRecargaZinli");
            var recibir = document.getElementById("montoRecargaZinli");
            var codigo = code + "-" + enviar.value + "-" + recibir.value;
            return codigo;
        case "TP-08":
            var enviar = document.getElementById("paisesRecargaPaypal");
            var recibir = document.getElementById("montoRecargaPaypal");
            var codigo = code + "-" + enviar.value + "-" + recibir.value;
            return codigo; */
        default:
            return "N/A";
    }
}

/* Paypal */
document.addEventListener("DOMContentLoaded", function () {
    var selectPaises = document.getElementById("paisesPaypal");
    var imagenPais = document.getElementById("imagenPais");
    var envia = document.getElementById("monto_cambiar_pay_ven");
    var recibe = document.getElementById("monto_recibir_pay_ven");

    selectPaises.addEventListener("change", function () {
        var imagenUrl =
            selectPaises.options[selectPaises.selectedIndex].getAttribute(
                "data-image"
            );
        imagenPais.innerHTML =
            '<img src="' +
            imagenUrl +
            '" alt="Bandera" style="margin-top: 8px;margin-left: 10px; width: 50px;">';
        envia.value = "";
        recibe.value = "";
    });
});

document.addEventListener("DOMContentLoaded", (event) => {
    const miSelect = document.getElementById("paisesPaypal");
    const tipoCambio = document.getElementById("tipo_cambio_paypal");
    const bancos = document.getElementById("bancos_paypal");
    const monto = document.getElementById("monto_minimo_paypal");
    const tiempo = document.getElementById("tiempo_transferencia_paypal");

    miSelect.addEventListener("change", (event) => {
        const valor = event.target.value;

        switch (valor) {
            case "venezuela":
                tipoCambio.textContent = "";
                bancos.textContent = "BSBDV, pago móvil";
                monto.textContent = "$5 USD + comisión PayPal";
                tiempo.textContent = "8h laborales";
                break;
            case "peru":
                tipoCambio.textContent = "";
                bancos.textContent =
                    "BCP, Interbank, BBVA Continental, Scotiabank";
                monto.textContent = "$5 USD";
                tiempo.textContent = "24h no laborales";
                break;
            case "peru-dolar":
                tipoCambio.textContent = "";
                bancos.textContent =
                    "BCP, Interbank, BBVA Continental, Scotiabank";
                monto.textContent = "$5 USD";
                tiempo.textContent = "24h no laborales";
                break;
            case "colombia":
                tipoCambio.textContent = "";
                bancos.textContent = "Banco de Bogotá, Bancolombia y Nequi";
                monto.textContent = "$5 USD";
                tiempo.textContent = "24h no laborales";
                break;
            default:
                tipoCambio.textContent = "Ninguno";
                bancos.textContent = "Ninguno";
        }
    });
});

/* Zinlin */
document.addEventListener("DOMContentLoaded", function () {
    var selectPaises = document.getElementById("paisesZinli");
    var imagenPais = document.getElementById("imagenPaisZinli");

    selectPaises.addEventListener("change", function () {
        var imagenUrl =
            selectPaises.options[selectPaises.selectedIndex].getAttribute(
                "data-image"
            );
        imagenPais.innerHTML =
            '<img src="' +
            imagenUrl +
            '" alt="Bandera" style="margin-top: 8px;margin-left: 10px; width: 50px;">';
    });
});

/* USDT */
document.addEventListener("DOMContentLoaded", function () {
    var selectPaises = document.getElementById("paisesUsdt");
    var imagenPais = document.getElementById("imagenPaisUsdt");
    var envia = document.getElementById("monto_cambiar_usdt_ven");
    var recibe = document.getElementById("monto_recibir_usdt_ven");

    selectPaises.addEventListener("change", function () {
        var imagenUrl =
            selectPaises.options[selectPaises.selectedIndex].getAttribute(
                "data-image"
            );
        imagenPais.innerHTML =
            '<img src="' +
            imagenUrl +
            '" alt="Bandera" style="margin-top: 8px;margin-left: 10px; width: 50px;">';
        envia.value = "";
        recibe.value = "";
    });
});

document.addEventListener("DOMContentLoaded", (event) => {
    const miSelect = document.getElementById("paisesUsdt");
    const tipoCambio = document.getElementById("tipo_cambio_usdt");
    const bancos = document.getElementById("bancos_usdt");

    miSelect.addEventListener("change", (event) => {
        const valor = event.target.value;

        switch (valor) {
            case "venezuela":
                tipoCambio.textContent = "";
                bancos.textContent = "BDV, pago móvil";
                break;
            case "peru":
                tipoCambio.textContent = "";
                bancos.textContent =
                    "BCP, Interbank, BBVA Continental, Scotiabank";
                break;
            case "peru-dolar":
                tipoCambio.textContent = "";
                bancos.textContent =
                    "BCP, Interbank, BBVA Continental, Scotiabank";
                break;
            case "colombia":
                tipoCambio.textContent = "";
                bancos.textContent = "Banco de Bogotá, Bancolombia y Nequi";
                break;
            default:
                tipoCambio.textContent = "Ninguno";
                bancos.textContent = "Ninguno";
        }
    });
});

/* Peru */
document.addEventListener("DOMContentLoaded", function () {
    var selectPaises = document.getElementById("paisesPeru");
    var imagenPais = document.getElementById("imagenPaisPeru");
    var envia = document.getElementById("monto_cambiar_peru_ven");
    var recibe = document.getElementById("monto_recibir_peru_ven");

    selectPaises.addEventListener("change", function () {
        var imagenUrl =
            selectPaises.options[selectPaises.selectedIndex].getAttribute(
                "data-image"
            );
        imagenPais.innerHTML =
            '<img src="' +
            imagenUrl +
            '" alt="Bandera" style="margin-top: 8px;margin-left: 10px; width: 50px;">';
        envia.value = "";
        recibe.value = "";
    });
});

document.addEventListener("DOMContentLoaded", function () {
    var selectPaises = document.getElementById("montoPeru");
    var imagenPais = document.getElementById("imagenMontoPeru");
    var envia = document.getElementById("monto_cambiar_peru_ven");
    var recibe = document.getElementById("monto_recibir_peru_ven");

    selectPaises.addEventListener("change", function () {
        var imagenUrl =
            selectPaises.options[selectPaises.selectedIndex].getAttribute(
                "data-image"
            );
        imagenPais.innerHTML =
            '<img src="' +
            imagenUrl +
            '" alt="Bandera" style="margin-top: 8px;margin-left: 10px; width: 50px;">';
        envia.value = "";
        recibe.value = "";
    });
});

document.addEventListener("DOMContentLoaded", (event) => {
    const miSelect = document.getElementById("paisesPeru");
    const tipoCambio = document.getElementById("tipo_cambio_peru");
    const bancos = document.getElementById("bancos_peru");

    miSelect.addEventListener("change", (event) => {
        const valor = event.target.value;

        switch (valor) {
            case "venezuela":
                bancos.textContent = "BDV, pago móvil";
                tiempo.textContent = "8h laborales";
                break;
            case "colombia":
                bancos.textContent = "Banco de Bogotá, Bancolombia y Nequi";
                tiempo.textContent = "8h laborales";
                break;
            default:
                tipoCambio.textContent = "Ninguno";
                bancos.textContent = "Ninguno";
        }
    });
});

document.addEventListener("DOMContentLoaded", (event) => {
    const miSelect = document.getElementById("montoPeru");
    const moneda = document.getElementById("tipo_moneda_peru");
    const monto = document.getElementById("monto_minimo_peru");

    miSelect.addEventListener("change", (event) => {
        const valor = event.target.value;

        switch (valor) {
            case "peru":
                monto.textContent = "20 Soles";
                break;
            case "peru-dolar":
                monto.textContent = "$10 USD";
                break;
            default:
                moneda.textContent = "Ninguno";
        }
    });
});

/* Colombia */
document.addEventListener("DOMContentLoaded", function () {
    var selectPaises = document.getElementById("paisesColombia");
    var imagenPais = document.getElementById("imagenPaisColombia");
    var envia = document.getElementById("monto_cambiar_col_ven");
    var recibe = document.getElementById("monto_recibir_col_ven");

    selectPaises.addEventListener("change", function () {
        var imagenUrl =
            selectPaises.options[selectPaises.selectedIndex].getAttribute(
                "data-image"
            );
        imagenPais.innerHTML =
            '<img src="' +
            imagenUrl +
            '" alt="Bandera" style="margin-top: 8px;margin-left: 10px; width: 50px;">';
        envia.value = "";
        recibe.value = "";
    });
});

document.addEventListener("DOMContentLoaded", (event) => {
    const miSelect = document.getElementById("paisesColombia");
    const tipoCambio = document.getElementById("tipo_cambio_colombia");
    const bancos = document.getElementById("bancos_colombia");

    miSelect.addEventListener("change", (event) => {
        const valor = event.target.value;

        switch (valor) {
            case "venezuela":
                tipoCambio.textContent = "BS";
                bancos.textContent = "BDV, pago móvil";
                break;
            case "peru":
                tipoCambio.textContent = "PEN";
                bancos.textContent =
                    "BCP, Interbank, BBVA Continental, Scotiabank";
                break;
            case "peru-dolar":
                tipoCambio.textContent = "PEN";
                bancos.textContent =
                    "BCP, Interbank, BBVA Continental, Scotiabank";
                break;
            default:
                tipoCambio.textContent = "Ninguno";
                bancos.textContent = "Ninguno";
        }
    });
});

/* Venezuela */
document.addEventListener("DOMContentLoaded", function () {
    var selectPaises = document.getElementById("paisesVenezuela");
    var imagenPais = document.getElementById("imagenPaisVenezuela");
    var envia = document.getElementById("monto_cambiar_ven_col");
    var recibe = document.getElementById("monto_recibir_ven_col");

    selectPaises.addEventListener("change", function () {
        var imagenUrl =
            selectPaises.options[selectPaises.selectedIndex].getAttribute(
                "data-image"
            );
        imagenPais.innerHTML =
            '<img src="' +
            imagenUrl +
            '" alt="Bandera" style="margin-top: 8px;margin-left: 10px; width: 50px;">';
        envia.value = "";
        recibe.value = "";
    });
});

document.addEventListener("DOMContentLoaded", (event) => {
    const miSelect = document.getElementById("paisesVenezuela");
    const tipoCambio = document.getElementById("tipo_cambio_venezuela");
    const bancos = document.getElementById("bancos_venezuela");

    miSelect.addEventListener("change", (event) => {
        const valor = event.target.value;

        switch (valor) {
            case "colombia":
                tipoCambio.textContent = "COP";
                bancos.textContent = "Banco de Bogotá, Bancolombia y Nequi";
                break;
            case "peru":
                tipoCambio.textContent = "PEN";
                bancos.textContent =
                    "BCP, Interbank, BBVA Continental, Scotiabank";
                break;
            case "peru-dolar":
                tipoCambio.textContent = "PEN";
                bancos.textContent =
                    "BCP, Interbank, BBVA Continental, Scotiabank";
                break;
            default:
                tipoCambio.textContent = "Ninguno";
                bancos.textContent = "Ninguno";
        }
    });
});

/* zinli */
document.addEventListener("DOMContentLoaded", function () {
    var selectPaises = document.getElementById("paisesRecargaZinli");
    var imagenPais = document.getElementById("imagenRecargaZinli");
    var envia = document.getElementById("monto_cambiar_recarga_zinli");
    var recibe = document.getElementById("monto_recibir_recarga_zinli");

    selectPaises.addEventListener("change", function () {
        var imagenUrl =
            selectPaises.options[selectPaises.selectedIndex].getAttribute(
                "data-image"
            );
        imagenPais.innerHTML =
            '<img src="' +
            imagenUrl +
            '" alt="Bandera" style="margin-top: 8px;margin-left: 10px; width: 50px;">';
        envia.value = "";
        recibe.value = "";
    });
});

document.addEventListener("DOMContentLoaded", (event) => {
    const miSelect = document.getElementById("paisesRecargaZinli");
    const tipoCambio = document.getElementById("tipo_cambio_zinli");
    const recibe = document.getElementById("recibe_zinli");

    miSelect.addEventListener("change", (event) => {
        const valor = event.target.value;

        switch (valor) {
            case "venezuela":
                tipoCambio.textContent = "BS";
                recibe.textContent = "BDV, pago móvil";
                break;
            case "colombia":
                tipoCambio.textContent = "COP";
                recibe.textContent = "Banco de Bogotá, Bancolombia y Nequi";
                break;
            case "peru":
                tipoCambio.textContent = "PEN";
                recibe.textContent =
                    "BCP, Interbank, BBVA Continental, Scotiabank";
                break;
            case "peru-dolar":
                tipoCambio.textContent = "PEN";
                recibe.textContent =
                    "BCP, Interbank, BBVA Continental, Scotiabank";
                break;
            default:
                tipoCambio.textContent = "Ninguno";
                recibe.textContent = "Ninguno";
        }
    });
});

/* Paypal */
document.addEventListener("DOMContentLoaded", function () {
    var selectPaises = document.getElementById("paisesRecargaPaypal");
    var imagenPais = document.getElementById("imagenRecargaPaypal");
    var envia = document.getElementById("monto_cambiar_recarga_paypal");
    var recibe = document.getElementById("monto_recibir_recarga_paypal");

    selectPaises.addEventListener("change", function () {
        var imagenUrl =
            selectPaises.options[selectPaises.selectedIndex].getAttribute(
                "data-image"
            );
        imagenPais.innerHTML =
            '<img src="' +
            imagenUrl +
            '" alt="Bandera" style="margin-top: 8px;margin-left: 10px; width: 50px;">';
        envia.value = "";
        recibe.value = "";
    });
});

document.addEventListener("DOMContentLoaded", (event) => {
    const miSelect = document.getElementById("paisesRecargaPaypal");
    const tipoCambio = document.getElementById("tipo_cambio_paypal_recarga");
    const recibe = document.getElementById("recibe_paypal");

    miSelect.addEventListener("change", (event) => {
        const valor = event.target.value;

        switch (valor) {
            case "venezuela":
                tipoCambio.textContent = "BS";
                recibe.textContent = "BDV, pago móvil";
                break;
            case "colombia":
                tipoCambio.textContent = "COP";
                recibe.textContent = "Banco de Bogotá, Bancolombia y Nequi";
                break;
            case "peru":
                tipoCambio.textContent = "PEN";
                recibe.textContent =
                    "BCP, Interbank, BBVA Continental, Scotiabank";
                break;
            case "peru-dolar":
                tipoCambio.textContent = "PEN";
                recibe.textContent =
                    "BCP, Interbank, BBVA Continental, Scotiabank";
                break;
            default:
                tipoCambio.textContent = "Ninguno";
                recibe.textContent = "Ninguno";
        }
    });
});
