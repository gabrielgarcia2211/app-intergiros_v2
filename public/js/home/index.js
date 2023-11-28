var pay_ven = document.getElementById("pay-ven");
var pay_peru = document.getElementById("pay-peru");
var usd_ven = document.getElementById("usd-ven");
var peru_ven = document.getElementById("peru-ven");
var col_ven = document.getElementById("col-ven");


var select = document.getElementById("selector");

select.addEventListener("change", function () {
    var selectedOption = select.options[select.selectedIndex];

    if (selectedOption) {
        if (selectedOption.value === "null") {
            pay_ven.style.display = "none";
            pay_peru.style.display = "none";
            usd_ven.style.display = "none";
            peru_ven.style.display = "none";
            col_ven.style.display = "none";
        } else
        if (selectedOption.value === "pay-ven") {
            pay_peru.style.display = "none";
            usd_ven.style.display = "none";
            peru_ven.style.display = "none";
            col_ven.style.display = "none";
            pay_ven.style.display = "block";
        } else 
        if (selectedOption.value === "pay-peru") {
            pay_ven.style.display = "none";
            usd_ven.style.display = "none";
            peru_ven.style.display = "none";
            col_ven.style.display = "none";
            pay_peru.style.display = "block";
        } else 
        if (selectedOption.value === "usd-ven") {
            pay_ven.style.display = "none";
            pay_peru.style.display = "none";
            peru_ven.style.display = "none";
            col_ven.style.display = "none";
            usd_ven.style.display = "block";
        } else 
        if (selectedOption.value === "peru-ven") {
            pay_ven.style.display = "none";
            pay_peru.style.display = "none";
            usd_ven.style.display = "none";
            col_ven.style.display = "none";
            peru_ven.style.display = "block";
        }else 
        if (selectedOption.value === "col-ven") {
            pay_ven.style.display = "none";
            pay_peru.style.display = "none";
            usd_ven.style.display = "none";
            peru_ven.style.display = "none";
            col_ven.style.display = "block";
        }
    }
});

const input1 = document.getElementById("monto_enviar");
const input2 = document.getElementById("monto_recibir");

// Añadimos un evento de escucha al primer input
input1.addEventListener("input", function() {
    // Cuando el usuario escribe algo en el primer input, copiamos ese valor en el segundo input
    input2.value = input1.value*30.00;
});