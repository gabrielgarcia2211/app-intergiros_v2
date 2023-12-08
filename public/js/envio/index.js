/* PayPal */
var beneficiario = document.getElementById('beneficiario')
var depositante = document.getElementById('depositante')

var elementos1 = document.getElementsByClassName('miInput1');
var selects1 = document.getElementsByClassName('miSelect1');
var elementos2 = document.getElementsByClassName('miInput2');
var selects2 = document.getElementsByClassName('miSelect2');

var miSelect1 = document.getElementById('selectBeneficiario');
var miSelect2 = document.getElementById('selectDepositante');

var cuentaNueva1 = document.getElementById('cuentaNueva1');
var cuentaExistente1 = document.getElementById('cuentaExistente1');
var cuentaNueva2 = document.getElementById('cuentaNueva2');
var cuentaExistente2 = document.getElementById('cuentaExistente2');
var adjuntarFoto = document.getElementById('adjuntarFoto');

function activarBeneficiario() {
    for (var i = 0; i < elementos1.length; i++) {
        elementos1[i].removeAttribute('disabled');
        elementos1[i].value = '';
    }
    for (var j = 0; j < selects1.length; j++) {
        selects1[j].removeAttribute('disabled');
    }
    miSelect1.value = '0'
    cuentaExistente1.style.display = "none"
    cuentaNueva1.style.display = "block"
    beneficiario.style.display = "block"
}

function activarDepositante() {
    for (var i = 0; i < elementos2.length; i++) {
        elementos2[i].removeAttribute('disabled');
        elementos2[i].value = '';
    }
    for (var j = 0; j < selects2.length; j++) {
        selects2[j].removeAttribute('disabled');
    }
    miSelect2.value = '0'
    cuentaExistente2.style.display = "none"
    adjuntarFoto.style.display = "block"
    cuentaNueva2.style.display = "block"
    depositante.style.display = "block"
}

for (var i = 0; i < elementos1.length; i++) {
    elementos1[i].addEventListener('input', verificarInputs);
}

function verificarInputs() {
    // Obtén todos los inputs y el select con la clase 'miInput'

    // Obtén el botón
    var miBoton = document.getElementById('realizarPago');

    // Establece una bandera para verificar si todos los elementos están llenos
    var todosLlenos = true;

    // Recorre los elementos y verifica si alguno está vacío (o es el valor por defecto en el caso del select)
    for (var i = 0; i < elementos1.length; i++) {
        if (elementos1[i].type === 'select-one') {
            // Para el select, verifica si no es el valor por defecto
            if (elementos1[i].value === '' || elementos1[i].value === null) {
                todosLlenos = false;
                break;
            }
        } else {
            // Para otros elementos, verifica si el valor está vacío
            if (elementos1[i].value.trim() === '') {
                todosLlenos = false;
                break;
            }
        }
    }

    for (var j = 0; j < elementos2.length; j++) {
        if (elementos2[j].type === 'select-one') {
            // Para el select, verifica si no es el valor por defecto
            if (elementos2[j].value === '' || elementos2[j].value === null) {
                todosLlenos = false;
                break;
            }
        } else {
            // Para otros elementos, verifica si el valor está vacío
            if (elementos2[j].value.trim() === '') {
                todosLlenos = false;
                break;
            }
        }
    }

    for (var k = 0; k < selects1.length; k++) {
        if (selects1[k].type === 'select-one') {
            // Para el select, verifica si no es el valor por defecto
            if (selects1[k].value === '' || selects1[k].value === null) {
                todosLlenos = false;
                break;
            }
        } else {
            // Para otros elementos, verifica si el valor está vacío
            if (selects1[k].value.trim() === '') {
                todosLlenos = false;
                break;
            }
        }
    }

    for (var l = 0; l < selects2.length; l++) {
        if (selects2[l].type === 'select-one') {
            // Para el select, verifica si no es el valor por defecto
            if (selects2[l].value === '' || selects2[l].value === null) {
                todosLlenos = false;
                break;
            }
        } else {
            // Para otros elementos, verifica si el valor está vacío
            if (selects2[l].value.trim() === '') {
                todosLlenos = false;
                break;
            }
        }
    }
    console.log(todosLlenos)
    // Habilita o deshabilita el botón según si todos los elementos están llenos o no
    if (todosLlenos) {
        miBoton.removeAttribute('disabled');
    } else {
        miBoton.setAttribute('disabled', 'disabled');
    }
}

function verificarSelect1() {
    if (miSelect1.value !== '') {
        // Muestra el div si la opción no es la por defecto
        for (var i = 0; i < elementos1.length; i++) {
            elementos1[i].setAttribute('disabled', 'disabled');
            elementos1[i].value = '';
        }
        for (var j = 0; j < selects1.length; j++) {
            selects1[j].setAttribute('disabled', 'disabled');
        }
        cuentaNueva1.style.display = 'none';
        cuentaExistente1.style.display = 'block';
        beneficiario.style.display = 'block';
    } else {
        // Oculta el div si la opción es la por defecto
        beneficiario.style.display = 'none';
    }
}

function verificarSelect2() {
    if (miSelect2.value !== '') {
        // Muestra el div si la opción no es la por defecto
        for (var i = 0; i < elementos2.length; i++) {
            elementos2[i].setAttribute('disabled', 'disabled');
            elementos2[i].value = '';
        }
        for (var j = 0; j < selects2.length; j++) {
            selects2[j].setAttribute('disabled', 'disabled');
        }
        cuentaNueva2.style.display = 'none';
        adjuntarFoto.style.display = "none"
        cuentaExistente2.style.display = 'block';
        depositante.style.display = 'block';
    } else {
        // Oculta el div si la opción es la por defecto
        depositante.style.display = 'none';
    }
}

function mostrarOcultarDiv() {
    var select1 = document.getElementById("inputGroupSelect01");
    var miDiv = document.getElementById("panel-envios");

    // Mostrar el div si el valor seleccionado es 1
    miDiv.style.display = (select1.value === "1") ? "block" : "none";
}

// Asociar la función al evento "change" del select1
document.getElementById("inputGroupSelect01").addEventListener("change", mostrarOcultarDiv);
/* Fin PayPal */






/* inputs paypal*/
$(document).ready(function () {
    $(" ").validate({
        rules: {
            paypalAliasBeneficiario: {
                required: true,
            },
            paypalNombreBeneficiario: {
                required: true,
            },
            paypalDocumentoBeneficiario: {
                required: true,
            },
            paypalBancoBeneficiario: {
                required: true,
            },
            paypalCuentaBeneficiario: {
                required: true,
            },
            paypalPagoMovilBeneficiario: {
                required: true,
            },
        },
        messages: {
            email: {
                required: "El campo alias electrónico es obligatorio",
            },
            nombre: {
                required: "El campo de nombre es obligatorio",
            },
            pais: {
                required: "El campo documento es obligatorio",
            },
            apellidos: {
                required: "El campo banco es obligatorio",
            },
            telefono: {
                required: "El campo cuenta es obligatorio",
            },
            fehaNacimiento: {
                required: "El campo pago movil es obligatorio",
            },
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
    });
    $(" ").validate({
        rules: {
            paypalAliasDepositante: {
                required: true,
            },
            paypalNombreDepositante: {
                required: true,
            },
            paypalDocumentoDepositante: {
                required: true,
            },
            paypalCorreoDepositante: {
                required: true,
            },
            paypalCelularDepositante: {
                required: true,
            },
            paypalPaisDepositante: {
                required: true,
            },
        },
        messages: {
            email: {
                required: "El campo alias electrónico es obligatorio",
            },
            nombre: {
                required: "El campo de nombre es obligatorio",
            },
            pais: {
                required: "El campo documento es obligatorio",
            },
            apellidos: {
                required: "El campo correo depositante es obligatorio",
            },
            telefono: {
                required: "El campo celular es obligatorio",
            },
            fehaNacimiento: {
                required: "El campo pais es obligatorio",
            },
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
    });
});
/* fin input paypal */

