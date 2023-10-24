$(document).ready(function () {
    $("#formLogin").validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
            },
        },
        messages: {
            email: {
                required: "El campo de correo electrónico es obligatorio",
                email: "Ingresa una dirección de correo electrónico válida",
            },
            password: {
                required: "El campo de contraseña es obligatorio",
            },
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
    });
});

function submitLoginForm() {
    if ($("#formLogin").valid()) {
        const email = $("#loginEmail").val();
        const password = $("#loginPassword").val();

        var formData = {
            email: email,
            password: password,
        };

        axios
            .post("/login", formData)
            .then((response) => {
                console.log(response.data);
            })
            .catch((error) => {
                handleErrors(error);
            });
    }
}
