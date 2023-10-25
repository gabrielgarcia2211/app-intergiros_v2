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
            _token: $('input[name="_token"]').val(),
        };

        axios
            .post("/login", formData)
            .then((response) => {
                console.log(response.data);
            })
            .catch((error) => {
                if (error.response.data.message) {
                    Swal.fire({
                        title: "Error",
                        text: error.response.data.message,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Recuperar Contraseña",
                        cancelButtonText: "Cerrar",
                        position: "top",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "/routes/password/reset";
                        }
                    });
                } else {
                    handleErrors(error);
                }
            });
    }
}
