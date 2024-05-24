<template>
    <div class="container login">
        <div class="text-center">
            <h4><strong>¡Nos alegra que estés de vuelta!</strong></h4>
        </div>
        <hr />
        <br />
        <div class="text-center mt-5">
            <h5>Ingresa tus datos de usuario</h5>
        </div>
        <form id="formLogin">
            <div class="form-row mt-5" style="text-align: center">
                <div class="form-group col-md-6">
                    <input
                        v-model="formLogin.email"
                        type="email"
                        class="form-control"
                        placeholder="Correo Electronico"
                        @keyup.enter="submitOnEnter"
                        :class="{
                            'is-invalid': errors.email,
                        }"
                    />
                    <small
                        v-if="errors.email"
                        style="display: block"
                        class="p-error"
                        >{{ errors.email }}</small
                    >
                </div>
                <div class="form-group col-md-6">
                    <div class="input-group">
                        <input
                            id="password"
                            v-model="formLogin.password"
                            type="password"
                            class="form-control"
                            placeholder="Contraseña"
                            @keyup.enter="submitOnEnter"
                            :class="{
                                'is-invalid': errors.password,
                            }"
                        />
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i
                                    class="fa fa-eye toggle-password"
                                    data-toggle="password"
                                    @click="togglePasswordVisibility"
                                ></i>
                            </span>
                        </div>
                    </div>
                    <small
                        v-if="errors.password"
                        style="display: block"
                        class="p-error"
                        >{{ errors.password }}</small
                    >
                </div>
            </div>
            <br />
            <div class="text-center mt-5 button">
                <button
                    type="button"
                    class="btn btn-primary mb-2"
                    ref="loginButton"
                    @click="submitLogin"
                >
                    Iniciar Sesión
                </button>
            </div>
            <div class="text-center mt-3">
                <h5>
                    ¿Eres nuevo?
                    <a href="/registro">¡Únete a la familia intergiros!</a>
                </h5>
            </div>
        </form>
    </div>
</template>

<script>
// Importar Librerias o Modulos
import * as Yup from "yup";

export default {
    data() {
        return {
            formLogin: {
                email: null,
                passowrd: null,
            },
            errors: {},
        };
    },
    components: {},
    created() {},
    mounted() {},
    methods: {
        async validateForm() {
            const schema = Yup.object().shape({
                email: Yup.string()
                    .email("El formato del correo electrónico no es válido")
                    .required("El beneficiario es obligatorio"),
                password: Yup.string().required("La contraseña es obligatoria"),
            });
            this.errors = {};
            try {
                await schema.validate(this.formLogin, {
                    abortEarly: false,
                });
                return true;
            } catch (err) {
                err.inner.forEach((error) => {
                    this.errors[error.path] = error.message;
                });
                return false;
            }
        },
        togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            var toggleIcon = document.querySelector(".toggle-password");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        },
        async submitLogin() {
            const isValid = await this.validateForm();
            if (isValid) {
                this.$axios
                    .post("/login", this.formLogin)
                    .then((response) => {
                        window.location.href = "/perfil";
                    })
                    .catch((error) => {
                        if (error.response.data.message) {
                            this.$swal
                                .fire({
                                    title: "Error",
                                    text: error.response.data.message,
                                    icon: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#3085d6",
                                    cancelButtonColor: "#d33",
                                    confirmButtonText: "Recuperar Contraseña",
                                    cancelButtonText: "Cerrar",
                                    position: "top",
                                })
                                .then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href =
                                            "/routes/password/reset";
                                    }
                                });
                        } else {
                            this.$readStatusHttp(error);
                        }
                    });
            }
        },
        submitOnEnter() {
            this.$refs.loginButton.click();
        },
    },
};
</script>

<style></style>
