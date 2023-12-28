var pay_ven = document.getElementById("pay_ven");
var pay_peru = document.getElementById("pay_peru");
var usd_ven = document.getElementById("usd_ven");
var peru_ven = document.getElementById("peru_ven");
var col_ven = document.getElementById("col_ven");

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
        } else if (selectedOption.value === "pay_ven") {
            pay_peru.style.display = "none";
            usd_ven.style.display = "none";
            peru_ven.style.display = "none";
            col_ven.style.display = "none";
            pay_ven.style.display = "block";
        } else if (selectedOption.value === "pay_peru") {
            pay_ven.style.display = "none";
            usd_ven.style.display = "none";
            peru_ven.style.display = "none";
            col_ven.style.display = "none";
            pay_peru.style.display = "block";
        } else if (selectedOption.value === "usd_ven") {
            pay_ven.style.display = "none";
            pay_peru.style.display = "none";
            peru_ven.style.display = "none";
            col_ven.style.display = "none";
            usd_ven.style.display = "block";
        } else if (selectedOption.value === "peru_ven") {
            pay_ven.style.display = "none";
            pay_peru.style.display = "none";
            usd_ven.style.display = "none";
            col_ven.style.display = "none";
            peru_ven.style.display = "block";
        } else if (selectedOption.value === "col_ven") {
            pay_ven.style.display = "none";
            pay_peru.style.display = "none";
            usd_ven.style.display = "none";
            peru_ven.style.display = "none";
            col_ven.style.display = "block";
        }
    }
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
