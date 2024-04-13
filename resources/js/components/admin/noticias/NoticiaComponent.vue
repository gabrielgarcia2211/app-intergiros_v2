<template>
    <div class="card" style="width: 100%">
        <div class="card-header">Control de noticias</div>
        <div class="card-body">
            <form @submit.prevent="createNoticia">
                <div class="container text-center">
                    <div class="row">
                        <div class="col-6">
                            <label
                                for="titulo"
                                style="display: block; float: left"
                                >Titulo:</label
                            >
                            <InputText
                                id="titulo"
                                v-model="setNoticia.titulo"
                                :class="{ 'p-invalid': errors.titulo }"
                                style="display: block; width: 100%"
                            />
                            <small v-if="errors.titulo" class="p-error">{{
                                errors.titulo
                            }}</small>
                        </div>
                        <div class="col-6">
                            <label
                                for="referencia"
                                style="display: block; float: left"
                                >Referencia:</label
                            >
                            <InputText
                                id="referencia"
                                v-model="setNoticia.referencia"
                                :class="{ 'p-invalid': errors.referencia }"
                                style="display: block; width: 100%"
                            />
                            <small v-if="errors.referencia" class="p-error">{{
                                errors.referencia
                            }}</small>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <label
                                for="descripcion"
                                style="display: block; float: left"
                                >Descripcion:</label
                            >
                            <Textarea
                                v-model="setNoticia.descripcion"
                                autoResize
                                rows="5"
                                cols="30"
                                :class="{ 'p-invalid': errors.descripcion }"
                                style="display: block; width: 100%"
                            />
                            <small v-if="errors.descripcion" class="p-error">{{
                                errors.descripcion
                            }}</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <Button
                                label="Guardar"
                                type="submit"
                                class="p-button p-button-primary custom-button-primary"
                                style="
                                    width: 100%;
                                    margin-top: 20px;
                                    border-radius: 10px;
                                "
                            />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
// Importar Librerias o Modulos
import * as Yup from "yup";

export default {
    data() {
        return {
            setNoticia: {
                titulo: null,
                referencia: null,
                descripcion: null,
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
                titulo: Yup.string().required("El titulo es obligatorio"),
                referencia: Yup.string().required(
                    "La referencia es obligatorio"
                ),
                descripcion: Yup.string().required(
                    "La descripcion es obligatoria"
                ),
            });
            this.errors = {};
            try {
                await schema.validate(this.setNoticia, { abortEarly: false });
                return true;
            } catch (err) {
                err.inner.forEach((error) => {
                    this.errors[error.path] = error.message;
                });
                return false;
            }
        },
        async createNoticia() {
            const isValid = await this.validateForm();
            if (isValid) {
                this.$axios
                    .post("/admin/noticias/create", this.setNoticia)
                    .then((response) => {
                        this.setNoticia.titulo = null;
                        this.setNoticia.referencia = null;
                        this.setNoticia.descripcion = null;
                        this.$alertSuccess("Noticia creada");
                    })
                    .catch((error) => {
                        this.$readStatusHttp(error);
                    });
            }
        },
    },
};
</script>

<style></style>
