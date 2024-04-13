<template>
    <Dialog
        v-model:visible="visible"
        :style="{ width: '450px' }"
        :header="'Editar Estado'"
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
                        v-model="form.estado_id"
                        :options="rpTipoEstado"
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
    props: ["visibleModal", "manageSolicitud"],
    watch: {
        visibleModal(value) {
            this.visible = value;
        },
        manageSolicitud(value) {
            this.form.solicitud_id = value.id;
            this.form.estado_id = value.estado_actual_id;
        },
    },
    data() {
        return {
            visible: false,
            rpTipoEstado: {},
            form: {
                solicitud_id: null,
                estado_id: null,
            },
        };
    },
    components: {},
    mounted() {},
    created() {
        this.getEnums();
    },
    methods: {
        async handleSubmit() {
            this.$emit("update", this.form);
        },
        async getEnums() {
            const enumsCode = ["estados_solicitud"];
            const response = await this.$getEnumsRelations(enumsCode);
            const { estados_solicitud } = response;
            this.rpTipoEstado = estados_solicitud;
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
