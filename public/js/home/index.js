var pay_ven = document.getElementById("TP-01");
var pay_peru = document.getElementById("TP-01");
var usd_ven = document.getElementById("TP-09");
var peru_ven = document.getElementById("TP-05");
var col_ven = document.getElementById("TP-07");

var select = document.getElementById("selectorCambioHome");

$(document).ready(function () {});

select.addEventListener("change", function () {
    $("#montoCambiarHome").val("");
    $("#montoRecibirHome").val("");
    $("#monto_a_pagar_home").html("0.00");
    $("#monto_a_recibir_comision").html("0.00");

    var selectedOption = select.options[select.selectedIndex];

    if (selectedOption) {
        if (selectedOption.value === "null") {
            pay_ven.style.display = "none";
            pay_peru.style.display = "none";
            usd_ven.style.display = "none";
            peru_ven.style.display = "none";
            col_ven.style.display = "none";
        } else if (selectedOption.value === "TP-01") {
            pay_peru.style.display = "none";
            usd_ven.style.display = "none";
            peru_ven.style.display = "none";
            col_ven.style.display = "none";
            pay_ven.style.display = "block";
        } else if (selectedOption.value === "TP-01") {
            pay_ven.style.display = "none";
            usd_ven.style.display = "none";
            peru_ven.style.display = "none";
            col_ven.style.display = "none";
            pay_peru.style.display = "block";
        } else if (selectedOption.value === "TP-09") {
            pay_ven.style.display = "none";
            pay_peru.style.display = "none";
            peru_ven.style.display = "none";
            col_ven.style.display = "none";
            usd_ven.style.display = "block";
        } else if (selectedOption.value === "TP-05") {
            pay_ven.style.display = "none";
            pay_peru.style.display = "none";
            usd_ven.style.display = "none";
            col_ven.style.display = "none";
            peru_ven.style.display = "block";
        } else if (selectedOption.value === "TP-07") {
            pay_ven.style.display = "none";
            pay_peru.style.display = "none";
            usd_ven.style.display = "none";
            peru_ven.style.display = "none";
            col_ven.style.display = "block";
        }
    }
});

async function obtenerValor(value) {
    let calculo = await devFormatoMoneda($("#selectorCambioHome").val(), value);
    $("#montoRecibirHome").val(calculo.data.monto_a_recibir);
    $("#monto_a_pagar_home").html(calculo.data.monto_a_pagar);
    $("#monto_a_recibir_comision").html(calculo.data.monto_a_recibir);
}
