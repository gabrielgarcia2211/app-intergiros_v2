$(document).ready(function () {

});

function atrasDiv1() {
    document.getElementById('div1').style.display = 'block';
    document.getElementById('div2').style.display = 'none';
}

function mostrarDiv2() {
    document.getElementById('div1').style.display = 'none';
    document.getElementById('div2').style.display = 'block';
}

function atrasDiv2() {
    document.getElementById('div3').style.display = 'none';
    document.getElementById('div2').style.display = 'block';
}

function mostrarDiv3() {
    document.getElementById('div2').style.display = 'none';
    document.getElementById('div3').style.display = 'block';
}

function atrasDiv3() {
    document.getElementById('div4').style.display = 'none';
    document.getElementById('div3').style.display = 'block';
}

function mostrarDiv4() {
    document.getElementById('div3').style.display = 'none';
    document.getElementById('div4').style.display = 'block';
}

function mostrarDiv5() {
    document.getElementById('div4').style.display = 'none';
    document.getElementById('div5').style.display = 'block';
}

function agregar() {
    document.getElementById('agregar').style.display = 'none';
    document.getElementById('otroP').style.display = 'block';
    document.getElementById('otroN').style.display = 'block';
}
