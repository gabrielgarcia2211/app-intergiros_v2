<template>
    <div class="card" style="width: 100%">
        <div class="card-header">
            Control de Solicitudes
        </div>
        <div class="card-body">
            <DataTable
                v-model:filters="filters"
                :loading="loading"
                :value="solicitudes"
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
                    field="id"
                    header="IDS"
                    sortable
                    :showClearButton="false"
                    style="min-width: 100px"
                >
                    <template #body="{ data }"> {{ data.id }} </template
                    ><template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            class="p-column-filter"
                            placeholder="Buscar por id" /></template
                ></Column>
            </DataTable>
        </div>
    </div>
</template>

<script>

// Importar Librerias o Modulos
import { FilterMatchMode, FilterOperator } from "primevue/api";

export default {
    data() {
        return {
            solicitudes: [],
            perPage: 1,
            totalRecords: 0,
            page: 1,
            sortField: "",
            sortOrder: null,
            filters: null,
            filtroInfo: [],
            loading: true,
            manageModista: true,
            dataForm: {},
            rpTipoModista: null,
            visibleModal: false,
        };
    },
    components: {
        FilterMatchMode,
        FilterOperator
    },
    created() {
        this.initFilters();
    },
    mounted() {
        this.fetchSolicitudes();
    },
    methods: {
        initFilters() {
            this.filters = {
                id: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
            };
        },
        fetchSolicitudes() {
            this.$axios
                .get("/admin/solicitudes/list", {
                    params: {
                        page: this.page,
                        perPage: this.perPage,
                        sort: [this.sortField, this.sortOrder],
                        filters: this.filtroInfo,
                    },
                })
                .then((response) => {
                    this.solicitudes = response.data.data;
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
            this.fetchSolicitudes();
        },
        onSort(event) {
            this.page = 1;
            this.sortField = event.sortField;
            this.sortOrder = event.sortOrder;
            this.fetchSolicitudes();
        },
        onFilters(event) {
            this.page = 1;
            this.filtroInfo = [];
            for (const [key, filter] of Object.entries(event.filters)) {
                if (filter.constraints) {
                    for (const constraint of filter.constraints) {
                        if (constraint.value) {
                            this.filtroInfo.push([
                                this.$relationTableSolicitudes(key),
                                constraint.matchMode,
                                constraint.value,
                            ]);
                        }
                    }
                }
            }
            this.fetchSolicitudes();
        },
    },
};
</script>
