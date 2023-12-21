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
        errorElement: "div",
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback text-center'); 
            element.closest(".form-group").append(error); 
        },
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid"); 
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
                window.location.href = "/perfil";
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
