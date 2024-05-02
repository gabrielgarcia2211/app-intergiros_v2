<template>
    <Dialog
        v-model:visible="visible"
        :style="{ width: '450px' }"
        :header="'Editar Verificado'"
        :modal="true"
        class="p-fluid p-dialog-top"
        :position="'top'"
        @hide="handleDialogClose"
    >
        <form @submit.prevent="handleSubmit">
            <div class="p-field p-grid my-row-spacing">
                <label for="tipo" class="p-col-fixed" style="width: 100px"
                    >Tipo</label
                >
                <div class="p-col">
                    <Dropdown
                    id="selectVerificado"
                        v-model="form.estado_id"
                        :options="rpEstadoVerificado"
                        optionLabel="name"
                        optionValue="id"
                        placeholder="Seleccione un tipo"
                        class="p-dropdown p-component"
                        showClear
                        filter
                    />
                </div>
            </div>
            <Button
                label="Guardar"
                type="submit"
                class="p-button p-button-primary custom-button-primary"
                style="width: 100%; margin-top: 20px"
            />
        </form>
    </Dialog>
</template>

<script>
export default {
    props: ["visibleModal", "manageEstado"],
    watch: {
        visibleModal(value) {
            this.visible = value;
        },
        manageEstado(value) {
            this.form.user_id = value.id;
            this.form.estado_id = value.verificado;
        },
    },
    data() {
        return {
            rpEstadoVerificado: [
                { id: 0, name: "SIN VERIFICAR" },
                { id: 1, name: "VERIFICAR" },
                { id: 2, name: "RECHAZADO" },
                { id: 3, name: "SOLICITUD VERIFICACION" },
            ],
            visible: false,
            form: {
                estado_id: null,
                user_id: null,
            },
        };
    },
    components: {},
    mounted() {},
    created() {},
    methods: {
        async handleSubmit() {
            this.$emit("update", this.form);
        },
        handleDialogClose() {
            this.visible = false;
            this.$emit("hidden", this.visible);
        },
    },
};
</script>
<style>
.text-invalid {
    color: red;
}
</style>
