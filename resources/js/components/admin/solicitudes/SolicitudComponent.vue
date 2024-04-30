<template>
    <div class="card" style="width: 100%">
        <div class="card-header">Control de Solicitudes</div>
        <div class="card-body">
            <edit-estado-modal
                :visible-modal="visibleModal"
                :manage-solicitud="manageSolicitud"
                @update="handleUpdatedSolicitud"
                @hidden="hiddenModal"
            ></edit-estado-modal>

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
                    field="voucher_referencia_cliente"
                    header="Voucher Referencia Cliente"
                    sortable
                    :showClearButton="false"
                    style="min-width: 150px"
                >
                    <template #body="{ data }">
                        <button
                            @click="mostrarImagen(data.voucher_referencia_cliente)"
                            class="preview"
                        >
                            <i class="pi pi-eye"></i>
                        </button>
                    </template>
                </Column>

                <Column
                    field="voucher_referencia"
                    header="Voucher Referencia Admin"
                    sortable
                    :showClearButton="false"
                    style="min-width: 150px"
                >
                    <template #body="{ data }">
                        <button
                            v-if="!data.voucher_referencia"
                            @click="previewUploadComprobante(data.id)"
                            class="preview p-voucher"
                        >
                            <i class="fa fa-upload"></i>
                        </button>
                        <button
                            v-else
                            @click="
                                mostrarImagen(
                                    data.voucher_referencia,
                                    true,
                                    true,
                                    data.id
                                )
                            "
                            class="preview p-voucher"
                        >
                            <i class="pi pi-eye"></i>
                        </button>
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
                    header="Documento Usuario (Archivo)"
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
                        >
                            {{ getEstadoVerificado(data.verificado) }}
                        </span>
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            class="p-column-filter"
                            placeholder="Verificado"
                        />
                    </template>
                </Column>

                <Column
                    field="monto_a_pagar"
                    header="Monto a Pagar"
                    sortable
                    :showClearButton="false"
                    style="min-width: 150px"
                >
                    <template #body="{ data }">
                        {{ data.monto_a_pagar }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            class="p-column-filter"
                            placeholder="Buscar por monto a pagar"
                        />
                    </template>
                </Column>

                <Column
                    field="monto_a_recibir"
                    header="Monto a Recibir"
                    sortable
                    :showClearButton="false"
                    style="min-width: 150px"
                >
                    <template #body="{ data }">
                        {{ data.monto_a_recibir }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            class="p-column-filter"
                            placeholder="Buscar por monto a recibir"
                        />
                    </template>
                </Column>

                <Column
                    field="revisiones"
                    header="Revisiones"
                    sortable
                    :showClearButton="false"
                    style="min-width: 100px"
                >
                    <template #body="{ data }">
                        {{ data.revisiones }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            class="p-column-filter"
                            placeholder="Buscar por revisiones"
                        />
                    </template>
                </Column>

                <Column
                    field="tipo_formulario"
                    header="Tipo Formulario"
                    sortable
                    :showClearButton="false"
                    style="min-width: 120px"
                >
                    <template #body="{ data }">
                        {{ data.tipo_formulario }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            class="p-column-filter"
                            placeholder="Buscar por tipo formulario"
                        />
                    </template>
                </Column>

                <Column
                    field="tipo_moneda"
                    header="Tipo Moneda"
                    sortable
                    :showClearButton="false"
                    style="min-width: 120px"
                >
                    <template #body="{ data }">
                        {{ data.tipo_moneda }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            class="p-column-filter"
                            placeholder="Buscar por tipo moneda"
                        />
                    </template>
                </Column>

                <Column
                    field="descripcion_moneda"
                    header="Descripción Moneda"
                    sortable
                    :showClearButton="false"
                    style="min-width: 200px"
                >
                    <template #body="{ data }">
                        {{ data.descripcion_moneda }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            class="p-column-filter"
                            placeholder="Buscar por descripción moneda"
                        />
                    </template>
                </Column>

                <Column
                    field="nombre_depositante"
                    header="Nombre Depositante"
                    sortable
                    :showClearButton="false"
                    style="min-width: 150px"
                >
                    <template #body="{ data }">
                        {{ data.nombre_depositante }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            class="p-column-filter"
                            placeholder="Buscar por nombre depositante"
                        />
                    </template>
                </Column>

                <Column
                    field="documento_depositante"
                    header="Documento Depositante"
                    sortable
                    :showClearButton="false"
                    style="min-width: 170px"
                >
                    <template #body="{ data }">
                        {{ data.documento_depositante }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            class="p-column-filter"
                            placeholder="Buscar por documento depositante"
                        />
                    </template>
                </Column>

                <Column
                    field="banco_depositante"
                    header="Banco Depositante"
                    sortable
                    :showClearButton="false"
                    style="min-width: 150px"
                >
                    <template #body="{ data }">
                        {{ data.banco_depositante }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            class="p-column-filter"
                            placeholder="Buscar por banco depositante"
                        />
                    </template>
                </Column>

                <Column
                    field="cuenta_depositante"
                    header="Cuenta Depositante"
                    sortable
                    :showClearButton="false"
                    style="min-width: 170px"
                >
                    <template #body="{ data }">
                        {{ data.cuenta_depositante }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            class="p-column-filter"
                            placeholder="Buscar por cuenta depositante"
                        />
                    </template>
                </Column>

                <Column
                    field="pago_movil_depositante"
                    header="Pago Móvil Depositante"
                    sortable
                    :showClearButton="false"
                    style="min-width: 200px"
                >
                    <template #body="{ data }">
                        {{ data.pago_movil_depositante }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            class="p-column-filter"
                            placeholder="Buscar por pago móvil depositante"
                        />
                    </template>
                </Column>

                <Column
                    field="correo_depositante"
                    header="Correo Depositante"
                    sortable
                    :showClearButton="false"
                    style="min-width: 150px"
                >
                    <template #body="{ data }">
                        {{ data.correo_depositante }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            class="p-column-filter"
                            placeholder="Buscar por correo depositante"
                        />
                    </template>
                </Column>

                <Column
                    field="celular_depositante"
                    header="Celular Depositante"
                    sortable
                    :showClearButton="false"
                    style="min-width: 170px"
                >
                    <template #body="{ data }">
                        {{ data.celular_depositante }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            class="p-column-filter"
                            placeholder="Buscar por celular depositante"
                        />
                    </template>
                </Column>

                <Column
                    field="path_documento_depositante"
                    header="Documento Depositante (Archivo)"
                    sortable
                    :showClearButton="false"
                    style="min-width: 200px"
                >
                    <template #body="{ data }">
                        <button
                            @click="
                                mostrarImagen(data.path_documento_depositante)
                            "
                            class="preview"
                        >
                            <i class="pi pi-eye"></i>
                        </button>
                    </template>
                </Column>

                <Column
                    field="nombre_beneficiario"
                    header="Nombre Beneficiario"
                    sortable
                    :showClearButton="false"
                    style="min-width: 150px"
                >
                    <template #body="{ data }">
                        {{ data.nombre_beneficiario }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            class="p-column-filter"
                            placeholder="Buscar por nombre beneficiario"
                        />
                    </template>
                </Column>

                <Column
                    field="documento_beneficiario"
                    header="Documento Beneficiario"
                    sortable
                    :showClearButton="false"
                    style="min-width: 170px"
                >
                    <template #body="{ data }">
                        {{ data.documento_beneficiario }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            class="p-column-filter"
                            placeholder="Buscar por documento beneficiario"
                        />
                    </template>
                </Column>
                <Column
                    field="banco_beneficiario"
                    header="Banco Beneficiario"
                    sortable
                    :showClearButton="false"
                    style="min-width: 150px"
                >
                    <template #body="{ data }">
                        {{ data.banco_beneficiario }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            class="p-column-filter"
                            placeholder="Buscar por banco beneficiario"
                        />
                    </template>
                </Column>
                <Column
                    field="tipo_cuenta"
                    header="Tipo Cuenta"
                    sortable
                    :showClearButton="false"
                    style="min-width: 150px"
                >
                    <template #body="{ data }">
                        {{ data.tipo_cuenta }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            class="p-column-filter"
                            placeholder="Buscar por tipo cuenta"
                        />
                    </template>
                </Column>
                <Column
                    field="cuenta_beneficiario"
                    header="Cuenta Beneficiario"
                    sortable
                    :showClearButton="false"
                    style="min-width: 170px"
                >
                    <template #body="{ data }">
                        {{ data.cuenta_beneficiario }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            class="p-column-filter"
                            placeholder="Buscar por cuenta beneficiario"
                        />
                    </template>
                </Column>

                <Column
                    field="pago_movil_beneficiario"
                    header="Pago Móvil Beneficiario"
                    sortable
                    :showClearButton="false"
                    style="min-width: 200px"
                >
                    <template #body="{ data }">
                        {{ data.pago_movil_beneficiario }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            class="p-column-filter"
                            placeholder="Buscar por pago móvil beneficiario"
                        />
                    </template>
                </Column>

                <Column
                    field="correo_beneficiario"
                    header="Correo Beneficiario"
                    sortable
                    :showClearButton="false"
                    style="min-width: 150px"
                >
                    <template #body="{ data }">
                        {{ data.correo_beneficiario }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            class="p-column-filter"
                            placeholder="Buscar por correo beneficiario"
                        />
                    </template>
                </Column>

                <Column
                    field="celular_beneficiario"
                    header="Celular Beneficiario"
                    sortable
                    :showClearButton="false"
                    style="min-width: 170px"
                >
                    <template #body="{ data }">
                        {{ data.celular_beneficiario }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            class="p-column-filter"
                            placeholder="Buscar por celular beneficiario"
                        />
                    </template>
                </Column>

                <Column
                    field="path_documento_beneficiario"
                    header="Documento Beneficiario (Archivo)"
                    sortable
                    :showClearButton="false"
                    style="min-width: 200px"
                >
                    <template #body="{ data }">
                        {{ data.path_documento_beneficiario }}
                    </template>
                </Column>

                <Column
                    field="nombre_producto"
                    header="Nombre Producto"
                    sortable
                    :showClearButton="false"
                    style="min-width: 150px"
                >
                    <template #body="{ data }">
                        {{ data.nombre_producto }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            class="p-column-filter"
                            placeholder="Buscar por nombre producto"
                        />
                    </template>
                </Column>

                <Column
                    field="costo_base_producto"
                    header="Costo Base Producto"
                    sortable
                    :showClearButton="false"
                    style="min-width: 200px"
                >
                    <template #body="{ data }">
                        {{ data.costo_base_producto }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            class="p-column-filter"
                            placeholder="Buscar por costo base producto"
                        />
                    </template>
                </Column>

                <Column
                    field="rango_min_producto"
                    header="Rango Mínimo Producto"
                    sortable
                    :showClearButton="false"
                    style="min-width: 200px"
                >
                    <template #body="{ data }">
                        {{ data.rango_min_producto }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            class="p-column-filter"
                            placeholder="Buscar por rango mínimo producto"
                        />
                    </template>
                </Column>

                <Column
                    field="rango_max_producto"
                    header="Rango Máximo Producto"
                    sortable
                    :showClearButton="false"
                    style="min-width: 200px"
                >
                    <template #body="{ data }">
                        {{ data.rango_max_producto }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            class="p-column-filter"
                            placeholder="Buscar por rango máximo producto"
                        />
                    </template>
                </Column>

                <Column
                    field="estado_actual"
                    header="Estado Actual"
                    sortable
                    :showClearButton="false"
                    style="min-width: 150px"
                >
                    <template #body="{ data }">
                        <span
                            :style="
                                getEstadoBackgroundSolicitud(data.estado_actual)
                            "
                            style="
                                cursor: pointer;
                                display: block;
                                padding: 5px;
                                text-align: center;
                                border-radius: 10px;
                            "
                            @click="onRowAction(data)"
                        >
                            {{ data.estado_actual }}
                        </span>
                    </template>
                </Column>

                <Column
                    field="historial_id"
                    header="Reclamos"
                    sortable
                    :showClearButton="false"
                    style="min-width: 60px"
                >
                    <template #body="{ data }">
                        <span
                            :style="getReclamoBackground(data.historial_id)"
                            style="
                                cursor: pointer;
                                display: block;
                                padding: 1px;
                                text-align: center;
                                border-radius: 10px;
                            "
                            @click="onRowActionReclamo(data.historial_id)"
                        >
                            {{ data.historial_id }}
                            {{ getReclamoSolicitud(data.historial_id) }}
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
import EditEstadoModal from "./acciones/EditEstadoModal.vue";

export default {
    data() {
        return {
            solicitudes: [],
            perPage: 10,
            totalRecords: 0,
            page: 1,
            sortField: "",
            sortOrder: null,
            filters: null,
            filtroInfo: [],
            loading: true,
            manageSolicitud: null,
            dataForm: {},
            rpTipoModista: null,
            visibleModal: false,
        };
    },
    components: {
        FilterMatchMode,
        FilterOperator,
        EditEstadoModal,
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
                tipo_formulario: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
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
                voucher_referencia_cliente: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                voucher_referencia: {
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
                monto_a_pagar: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                monto_a_recibir: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                revisiones: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                tipo_moneda: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                descripcion_moneda: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                nombre_depositante: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                documento_depositante: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                banco_depositante: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                cuenta_depositante: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                pago_movil_depositante: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                correo_depositante: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                celular_depositante: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                path_documento_depositante: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                nombre_beneficiario: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                documento_beneficiario: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                banco_beneficiario: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                tipo_cuenta: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                cuenta_beneficiario: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                pago_movil_beneficiario: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                correo_beneficiario: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                celular_beneficiario: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                path_documento_beneficiario: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                nombre_producto: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                costo_base_producto: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                rango_min_producto: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                rango_max_producto: {
                    clear: false,
                    constraints: [
                        { value: null, matchMode: FilterMatchMode.STARTS_WITH },
                    ],
                },
                estado_actual: {
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
        onRowAction(data) {
            this.showModal(data);
        },
        showModal(type) {
            this.manageSolicitud = type;
            this.hiddenModal(true);
        },
        hiddenModal(status) {
            this.visibleModal = status;
        },
        handleUpdatedSolicitud(newRecord) {
            this.$axios
                .post("/solicitudes/update/estado/" + newRecord.solicitud_id, {
                    estado_id: newRecord.estado_id,
                })
                .then((response) => {
                    this.fetchSolicitudes();
                    this.hiddenModal(false);
                })
                .catch((error) => {
                    this.$readStatusHttp(error);
                });
        },
        mostrarImagen(path, flagReal = true, isDelete = false, solicitud_id) {
            if (flagReal) {
                axios
                    .post("/admin/solicitudes/path/img", {
                        path: path,
                    })
                    .then((response) => {
                        this.$viewModalImagen(
                            response.data,
                            "Imagen",
                            isDelete,
                            solicitud_id
                        );
                    })
                    .catch((error) => {
                        console.error(
                            "Error al obtener la ruta de la imagen:",
                            error
                        );
                    });
            } else {
                this.$swal.fire({
                    imageUrl: path,
                    imageAlt: "Selfie del usuario",
                    showCloseButton: true,
                    focusConfirm: false,
                });
            }
        },
        previewUploadComprobante(solicitud_id) {
            Swal.fire({
                title: "Cargar comprobante",
                html: `
          <h3 style="margin-bottom: 10px;">Vista previa:</h3>
          <img id="preview" style="max-width: 300px; max-height: 300px; margin-bottom: 10px;" src="" />
          <input type="file" id="comprobante" class="swal2-input" onchange="previewImage()">
        `,
                focusConfirm: false,
                confirmButtonText: "Guardar",
                preConfirm: () => {
                    return new Promise((resolve) => {
                        const comprobante =
                            Swal.getPopup().querySelector("#comprobante")
                                .files[0];
                        if (!comprobante) {
                            Swal.showValidationMessage(
                                `Por favor seleccione un archivo`
                            );
                        } else {
                            resolve(
                                this.uploadComprobante(
                                    comprobante,
                                    "CREATE",
                                    solicitud_id
                                )
                            );
                        }
                    });
                },
            });
        },
        uploadComprobante(path, action, solicitud_id) {
            let formData = {
                path: path,
                action: action,
                solicitud_id: solicitud_id,
            };
            this.$axios
                .post("/admin/solicitudes/up/voucher", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((response) => {
                    this.$alertSuccess("Proceso completo");
                    this.fetchSolicitudes();
                })
                .catch((error) => {
                    this.$readStatusHttp(error);
                });
        },
        getEstadoBackgroundSolicitud(estado) {
            switch (estado) {
                case "INICIADO":
                    return { backgroundColor: "blue", color: "white" };
                case "PENDIENTE":
                    return { backgroundColor: "orange", color: "white" };
                case "EN PROCESO":
                    return { backgroundColor: "green", color: "white" };
                case "ENTREGADO":
                    return { backgroundColor: "purple", color: "white" };
                case "CANCELADO":
                    return { backgroundColor: "red", color: "white" };
                case "REEMBOLSADO":
                    return { backgroundColor: "orange", color: "white" };
                default:
                    return {};
            }
        },
        getReclamoBackground(reclamo) {
            if (reclamo == undefined || reclamo == null) {
                return { backgroundColor: "#7a7d7d", color: "white" };
            } else {
                return { backgroundColor: "#ca3c25", color: "white" };
            }
        },
        getReclamoSolicitud(reclamo) {
            if (reclamo == undefined || reclamo == null) {
                return "N/A";
            } else {
                return "VER";
            }
        },
        onRowActionReclamo(historial_id) {
            if (historial_id == undefined || historial_id == null) {
                return;
            }
            this.$axios
                .get("/admin/solicitudes/historial/" + historial_id)
                .then((response) => {
                    console.log(response.data);
                })
                .catch((error) => {
                    this.$readStatusHttp(error);
                });
        },
        getEstadoBackground(estado) {
            switch (estado) {
                case 0:
                    return { backgroundColor: "#ECE731", color: "black" };
                case 1:
                    return { backgroundColor: "green", color: "white" };
                case 2:
                    return { backgroundColor: "red", color: "white" };
                default:
                    return {};
            }
        },
        getEstadoVerificado(estado) {
            switch (estado) {
                case 0:
                    return "SIN VERIFICAR";
                case 1:
                    return "VERIFICADO";
                case 2:
                    return "RECHAZADO";
                default:
                    return {};
            }
        },
    },
};

window.previewImage = function () {
    const fileInput = document.getElementById("comprobante");
    const preview = document.getElementById("preview");
    const file = fileInput.files[0];
    const reader = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
    };

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = "";
    }
};
</script>

<style>
.preview {
    border: 1px;
    border-radius: 10px;
    background-color: rgb(4, 155, 4);
    color: white;
}

.p-voucher {
    border: 1px;
    border-radius: 10px;
    background-color: rgb(4, 92, 155);
    color: white;
}
</style>
