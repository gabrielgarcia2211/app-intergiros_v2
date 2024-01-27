$(document).ready(function(){
    $('[data-toggle="collapse"]').on('click', function(){
        // Obtén el ID del icono
        var iconoId = $(this).find('i').attr('id');

        // Cambia la clase del icono específico
        $('#' + iconoId).toggleClass('fa-chevron-down fa-chevron-up');
    });
});



/* Modal Comprobate*/
// Obtén el modal
var modal = document.getElementById("myModal");

// Obtén el botón que abre el modal
var btn = document.getElementById("openModal");

// Obtén el elemento <span> que cierra el modal
var span = document.getElementsByClassName("close")[0];

// Cuando el usuario haga clic en el botón, abre el modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// Cuando el usuario haga clic en <span> (x), cierra el modal
span.onclick = function() {
    modal.style.display = "none";
}

// Cuando el usuario haga clic en cualquier lugar fuera del modal, cierra el modal
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

/* Modal Contacto */
// Obtén el modal
var modal = document.getElementById("myContacto");

// Obtén el botón que abre el modal
var btn = document.getElementById("openContacto");

// Obtén el elemento <span> que cierra el modal
var span = document.getElementsByClassName("closeContacto")[0];

// Cuando el usuario haga clic en el botón, abre el modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// Cuando el usuario haga clic en <span> (x), cierra el modal
span.onclick = function() {
    modal.style.display = "none";
}

// Cuando el usuario haga clic en cualquier lugar fuera del modal, cierra el modal
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

/* Modal Reclamo */
// Obtén el modal
var modal = document.getElementById("myReclamo");

// Obtén el botón que abre el modal
var btn = document.getElementById("openReclamo");

// Obtén el elemento <span> que cierra el modal
var span = document.getElementsByClassName("closeReclamo")[0];

// Cuando el usuario haga clic en el botón, abre el modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// Cuando el usuario haga clic en <span> (x), cierra el modal
span.onclick = function() {
    modal.style.display = "none";
}

// Cuando el usuario haga clic en cualquier lugar fuera del modal, cierra el modal
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}