<template>
    <div class="card" style="width: 100%">
        <div class="card-header">Control de tasas</div>
        <div class="card-body">
            <form @submit.prevent="updateTasa">
                <div class="container text-center">
                    <div class="row">
                        <div class="col-6">
                            <label
                                for="selectTasa"
                                style="display: block; float: left"
                                >Tipo de Tasa:</label
                            >
                            <Dropdown
                                id="selectTasa"
                                :options="listTasas"
                                v-model="setTasa.tasa_id"
                                style="width: 100%"
                                optionLabel="descripcion"
                                optionValue="tasa_cambio_id"
                                placeholder="Seleccione un tipo"
                                class="p-dropdown p-component"
                                @change="onTipoSolicitudChange"
                                :class="{ 'p-invalid': errors.tasa_id }"
                                showClear
                                filter
                            ></Dropdown>
                            <small v-if="errors.tasa_id" class="p-error">{{
                                errors.tasa_id
                            }}</small>
                        </div>
                        <div class="col-3">
                            <label for="old_value" style="display: block"
                                >Valor Actual:</label
                            >
                            <InputNumber
                                id="old_value"
                                v-model="setTasa.old_value"
                                inputId="locale-us"
                                locale="en-US"
                                :minFractionDigits="2"
                                disabled
                            />
                        </div>
                        <div class="col-3">
                            <label for="new_value" style="display: block"
                                >Nuevo Valor:</label
                            >
                            <InputNumber
                                id="new_value"
                                v-model="setTasa.new_value"
                                inputId="locale-us"
                                locale="en-US"
                                :minFractionDigits="2"
                                :class="{ 'p-invalid': errors.new_value }"
                                style="display: block"
                            />
                            <small v-if="errors.new_value" class="p-error">{{
                                errors.new_value
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
            listTasas: null,
            setTasa: {
                tasa_id: null,
                new_value: null,
                old_value: null,
            },
            errors: {},
        };
    },
    components: {},
    created() {},
    mounted() {
        this.getTasas();
    },
    methods: {
        async validateForm() {
            const schema = Yup.object().shape({
                tasa_id: Yup.string().required(
                    "La Tasa de cambio es obligatoria"
                ),
                new_value: Yup.string().required("Nuevo valor es obligatorio"),
            });
            this.errors = {};
            try {
                await schema.validate(this.setTasa, { abortEarly: false });
                return true;
            } catch (err) {
                err.inner.forEach((error) => {
                    this.errors[error.path] = error.message;
                });
                return false;
            }
        },
        getTasas() {
            this.$axios
                .get("/admin/tasas/list")
                .then((response) => {
                    this.listTasas = response.data;
                })
                .catch((error) => {
                    this.$readStatusHttp(error);
                });
        },
        onTipoSolicitudChange(event) {
            const selectedValue = event.value;
            const selectedObject = this.listTasas.find(
                (item) => item.tasa_cambio_id === selectedValue
            );
            if (selectedObject) {
                this.setTasa.old_value = parseFloat(selectedObject.valor);
            }
        },
        async updateTasa() {
            const isValid = await this.validateForm();
            if (isValid) {
                this.$axios
                    .post("/admin/tasas/update", this.setTasa)
                    .then((response) => {
                        this.setTasa.tasa_id = null;
                        this.setTasa.new_value = null;
                        this.setTasa.old_value = null;
                        this.$alertSuccess("Tasa Actualizada");
                        this.getTasas();
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
