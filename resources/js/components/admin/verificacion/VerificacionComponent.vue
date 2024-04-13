<template>
    <div class="card" style="width: 100%">
        <div class="card-header">Control de usuarios verificados</div>
        <div class="card-body">
            <edit-verificado-modal
                :visible-modal="visibleModal"
                :manage-estado="manageEstado"
                @update="handleUpdatedVerificado"
                @hidden="hiddenModal"
            ></edit-verificado-modal>

            <DataTable
                v-model:filters="filters"
                :loading="loading"
                :value="usuarios"
                :paginator="true"
                :rows="perPage"
                :sortField="sortField"
                :sortOrder="sortOrder"
                :totalRecords="totalRecords"
                :lazy="true"
                @page="onPage"
                @sort="onSort"
                @filter="onFilters"
                filterDisplay="menu"
                removableSort
                stripedRows
                scrollable
            >
                <Column
                    field="user"
                    header="Usuario"
                    sortable
                    :showClearButton="false"
                    style="min-width: 120px"
                >
                    <template #body="{ data }"> {{ data.user }} </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            class="p-column-filter"
                            placeholder="Buscar por usuario"
                        />
                    </template>
                </Column>

                <Column
                    field="apellidos_user"
                    header="Apellidos"
                    sortable
                    :showClearButton="false"
                    style="min-width: 150px"
                >
                    <template #body="{ data }">
                        {{ data.apellidos_user }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            class="p-column-filter"
                            placeholder="Buscar por apellidos"
                        />
                    </template>
                </Column>

                <Column
                    field="email_user"
                    header="Email"
                    sortable
                    :showClearButton="false"
                    style="min-width: 200px"
                >
                    <template #body="{ data }">
                        {{ data.email_user }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="email"
                            class="p-column-filter"
                            placeholder="Buscar por email"
                        />
                    </template>
                </Column>

                <Column
                    field="documento_user"
                    header="Documento"
                    sortable
                    :showClearButton="false"
                    style="min-width: 150px"
                >
                    <template #body="{ data }">
                        {{ data.documento_user }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            class="p-column-filter"
                            placeholder="Buscar por documento"
                        />
                    </template>
                </Column>

                <Column
                    field="telefono_user"
                    header="Teléfono"
                    sortable
                    :showClearButton="false"
                    style="min-width: 150px"
                >
                    <template #body="{ data }">
                        {{ data.telefono_user }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            class="p-column-filter"
                            placeholder="Buscar por teléfono"
                        />
                    </template>
                </Column>

                <Column
                    field="path_selfie_user"
                    header="Selfie"
                    sortable
                    :showClearButton="false"
                    style="min-width: 150px"
                >
                    <template #body="{ data }">
                        <button
                            @click="mostrarImagen(data.path_selfie_user)"
                            class="preview"
                        >
                            <i class="pi pi-eye"></i>
                        </button>
                    </template>
                </Column>

                <Column
                    field="path_documento_user"
                    header="Documento Usuario"
                    sortable
                    :showClearButton="false"
                    style="min-width: 200px"
                >
                    <template #body="{ data }">
                        <button
                            @click="mostrarImagen(data.path_documento_user)"
                            class="preview"
                        >
                            <i class="pi pi-eye"></i>
                        </button>
                    </template>
                </Column>

                <Column
                    field="verificado"
                    header="Verificado"
                    sortable
                    :showClearButton="false"
                    style="min-width: 100px"
                >
                    <template #body="{ data }">
                        <span
                            :style="getEstadoBackground(data.verificado)"
                            style="
                                cursor: pointer;
                                display: block;
                                padding: 5px;
                                text-align: center;
                                border-radius: 10px;
                            "
                            @click="onRowAction(data)"
                        >
                            {{ getEstadoVerificado(data.verificado) }}
                        </span>
                    </template>
                </Column>
            </DataTable>
        </div>
    </div>
</template>

<script>
// Importar Librerias o Modulos
import { FilterMatchMode, FilterOperator } from "primevue/api";
import EditVerificadoModal from "./acciones/EditVerificadoModal.vue";

export default {
    data() {
        return {
            usuarios: [],
            perPage: 10,
            totalRecords: 0,
            page: 1,
            sortField: "",
            sortOrder: null,
            filters: null,
            filtroInfo: [],
            loading: true,
            manageEstado: true,
            visibleModal: false,
        };
    },
    components: {
        FilterMatchMode,
        FilterOperator,
        EditVerificadoModal
    },
    created() {
        this.initFilters();
    },
    mounted() {
        this.fetchUsuariosVerificados();
    },
    methods: {
        initFilters() {
            this.filters = {
                user: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                apellidos_user: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                email_user: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                documento_user: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                telefono_user: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                path_selfie_user: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                path_documento_user: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                verificado: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
            };
        },
        fetchUsuariosVerificados() {
            this.$axios
                .get("/admin/users/list", {
                    params: {
                        page: this.page,
                        perPage: this.perPage,
                        sort: [this.sortField, this.sortOrder],
                        filters: this.filtroInfo,
                    },
                })
                .then((response) => {
                    this.usuarios = response.data.data;
                    this.totalRecords = response.data.total;
                    this.loading = false;
                })
                .catch((error) => {
                    this.$readStatusHttp(error);
                    this.loading = false;
                });
        },
        onPage(event) {
            this.page = event.page + 1;
            this.perPage = event.rows;
            this.fetchUsuariosVerificados();
        },
        onSort(event) {
            this.page = 1;
            this.sortField = event.sortField;
            this.sortOrder = event.sortOrder;
            this.fetchUsuariosVerificados();
        },
        onFilters(event) {
            this.page = 1;
            this.filtroInfo = [];
            for (const [key, filter] of Object.entries(event.filters)) {
                if (filter.constraints) {
                    for (const constraint of filter.constraints) {
                        if (constraint.value) {
                            this.filtroInfo.push([
                                this.$relationTableUsuariosVerificados(key),
                                constraint.matchMode,
                                constraint.value,
                            ]);
                        }
                    }
                }
            }
            this.fetchUsuariosVerificados();
        },
        onRowAction(data) {
            this.showModal(data);
        },
        showModal(type) {
            this.manageEstado = type;
            this.hiddenModal(true);
        },
        hiddenModal(status) {
            this.visibleModal = status;
        },
        handleUpdatedVerificado(newRecord) {
            this.$axios
                .post("/admin/users/update/" + newRecord.user_id, {
                    estado_id: newRecord.estado_id,
                })
                .then((response) => {
                    this.fetchUsuariosVerificados();
                    this.hiddenModal(false);
                })
                .catch((error) => {
                    this.$readStatusHttp(error);
                });
        },
        mostrarImagen(path) {
            axios
                .post("/admin/solicitudes/path/img", {
                    path: path,
                })
                .then((response) => {
                    this.$viewModalImagen(response.data, "Imagen", false, null);
                })
                .catch((error) => {
                    console.error(
                        "Error al obtener la ruta de la imagen:",
                        error
                    );
                });
        },
        getEstadoBackground(estado) {
            switch (estado) {
                case 0:
                    return { backgroundColor: "red", color: "white" };
                case 1:
                    return { backgroundColor: "green", color: "white" };
                default:
                    return {};
            }
        },
        getEstadoVerificado(estado) {
            switch (estado) {
                case 0:
                    return "SIN VERIFICAR";
                case 1:
                    return "VERIFICAR";
                default:
                    return {};
            }
        },
    },
};
</script>

<style></style>
