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
                        id="selectEstado"
                        v-model="form.estado_id"
                        :options="rpTipoEstado"
                        optionLabel="name"
                        optionValue="id"
                        placeholder="Seleccione un tipo"
                        class="p-dropdown p-component"
                        @change="handleEstado"
                        showClear
                        filter
                    />
                </div>
            </div>
            <div class="radio-button-row mt-5" v-if="isVisiblePendiente">
                <div
                    v-for="(item, index) in listPendientes"
                    :key="item.id"
                    class="radio-button-column"
                >
                    <input
                        type="radio"
                        :id="item.code"
                        v-model="selectedOptionPendiente"
                        :value="item.id"
                    />
                    <label :for="item.code">{{ item.name }}</label>
                </div>
            </div>
            <Button
                label="Guardar"
                type="submit"
                class="p-button p-button-primary custom-button-primary"
                style="width: 100%; margin-top: 20px"
                :disabled="!isSendStatus"
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
            this.selectedOptionPendiente = null;
            this.isVisiblePendiente = false;
            const item = this.listPendientes.find(
                (data) => data.id == this.form.estado_id
            );
            if (item && item.code.startsWith("pendiente")) {
                this.form.estado_id = -1;
                this.form.sub_estado_id = value.estado_actual_id;
                this.selectedOptionPendiente = value.estado_actual_id;
                this.isVisiblePendiente = true;
                this.isSendStatus = true;
            }
        },
        selectedOptionPendiente(value) {
            if (value) {
                const item = this.listPendientes.find(
                    (data) => data.id == value
                );
                this.form.sub_estado_id = item.id ?? null;
                this.isSendStatus = true;
            }
        },
    },
    data() {
        return {
            visible: false,
            rpTipoEstado: {},
            form: {
                solicitud_id: null,
                estado_id: null,
                sub_estado_id: null,
            },
            selectedOptionPendiente: null,
            isVisiblePendiente: false,
            listPendientes: [],
            isSendStatus: true,
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
            this.selectedOptionPendiente = null;
            const enumsCode = ["estados_solicitud"];
            const response = await this.$getEnumsRelations(enumsCode);
            const { estados_solicitud } = response;
            this.listPendientes = estados_solicitud.filter((item) =>
                item.code.startsWith("pendiente")
            );
            const filteredData = estados_solicitud.filter(
                (item) => !item.code.startsWith("pendiente")
            );
            const pendienteItem = {
                id: -1,
                parent_id: null,
                code: "pendiente",
                name: "PENDIENTE",
                description: null,
                valor1: null,
                valor2: null,
                valor3: null,
                is_father: 0,
                status: 1,
                orden: null,
                deleted_at: null,
                created_at: null,
                updated_at: null,
            };
            filteredData.push(pendienteItem);
            this.rpTipoEstado = filteredData;
        },
        handleDialogClose() {
            this.visible = false;
            this.$emit("hidden", this.visible);
        },
        handleEstado(event) {
            this.selectedOptionPendiente = null;
            const item = this.rpTipoEstado.find(
                (data) => data.id == event.value
            );
            if (item?.name == "PENDIENTE") {
                this.isVisiblePendiente = true;
                this.isSendStatus = false;
            } else {
                this.isVisiblePendiente = false;
                this.isSendStatus = true;
            }
        },
    },
};
</script>
<style>
.text-invalid {
    color: red;
}

.radio-button-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.radio-button-column {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 0 10px;
    text-align: center;
}
</style>
