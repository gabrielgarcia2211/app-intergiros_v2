<template>
    <div class="col-md-12 mt-5" style="text-align: center">
        <Dropdown
            id="inputGroupServiciosReclamo"
            :options="optionsServices"
            v-model="selectedService"
            :placeholder="'Selecciona Formulario Busqueda'"
            optionLabel="descripcion"
            optionValue="id"
            class="w-full md:w-14rem"
            style="width: 100%"
            v-show="servicioDepositanteVisible"
            @change="onServiceChange"
        ></Dropdown>
    </div>
    <!-- depositante -->
    <div class="col-md-12 mt-5" style="text-align: center" v-if="selectVisible">
        <Dropdown
            id="selectedDepositanteReclamo"
            v-model="selectedDepositante"
            :options="depositantes"
            optionLabel="nombre"
            optionValue="id"
            :placeholder="'Depostantes afiliados'"
            class="w-full md:w-14rem input-registro"
            style="width: 80%; text-align: left"
            @change="handleSelect"
        ></Dropdown>
        <div class="text-center">
            <p
                @click="initDepositante()"
                style="
                    color: #0035aa;
                    cursor: pointer;
                    text-decoration: underline;
                    font-size: 18px;
                "
            >
                <i class="fas fa-plus"></i>
                Afiliar nuevo depositante
            </p>
        </div>
        <form id="form" v-if="formDepositanteVisible">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <InputText
                            v-model="depositanteForm.aliasDepositante"
                            placeholder="Alias"
                            class="w-full md:w-14rem input-registro"
                            style="width: 100%"
                            :class="{
                                'p-invalid': errors.aliasDepositante,
                                'input-readonly': isEdit,
                            }"
                            :readOnly="isEdit"
                        />
                        <small
                            v-if="errors.aliasDepositante"
                            style="display: block"
                            class="p-error"
                            >{{ errors.aliasDepositante }}</small
                        >
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <InputText
                            v-model="depositanteForm.nombreDepositante"
                            placeholder="Nombres y apellidos"
                            class="w-full md:w-14rem input-registro"
                            style="width: 100%"
                            :class="{
                                'p-invalid': errors.nombreDepositante,
                                'input-readonly': isEdit,
                            }"
                            :readOnly="isEdit"
                        />
                        <small
                            v-if="errors.nombreDepositante"
                            style="display: block"
                            class="p-error"
                            >{{ errors.nombreDepositante }}</small
                        >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div
                        class="form-group"
                        style="width: 100%; display: inline-block"
                    >
                        <InputGroup>
                            <Dropdown
                                id="tipoDocumentoReclamo"
                                v-model="
                                    depositanteForm.tipoDocumentoDepositante
                                "
                                :options="optionsDocument"
                                placeholder="TD"
                                :optionLabel="optionLabelFunction"
                                optionValue="id"
                                style="width: 30%"
                                class="input-indicativo"
                                :class="{
                                    'p-invalid':
                                        errors.tipoDocumentoDepositante,
                                    'input-readonly': isEdit,
                                }"
                                :disabled="isEdit"
                                filter
                            ></Dropdown>
                            <InputNumber
                                id=""
                                v-model="depositanteForm.documentoDepositante"
                                placeholder="Número documento"
                                class="w-full md:w-14rem input-telefono"
                                style="width: 80%"
                                :class="{
                                    'p-invalid': errors.documentoDepositante,
                                }"
                                :disabled="isEdit"
                            />
                        </InputGroup>
                        <small
                            v-if="errors.documentoDepositante"
                            style="display: block"
                            class="p-error"
                            >{{ errors.documentoDepositante }}</small
                        >
                    </div>
                </div>
                <div
                    class="col-6"
                    v-if="
                        currentService == 'TP-04' || currentService == 'TP-05'
                    "
                >
                    <div class="form-group">
                        <Dropdown
                            id="selectBanco"
                            v-model="depositanteForm.bancoDepositante"
                            :options="optionsBancosPeru"
                            placeholder="Bancos"
                            optionLabel="name"
                            optionValue="id"
                            class="w-full md:w-14rem input-registro"
                            style="width: 100%; text-align: left"
                            :class="{
                                'p-invalid': errors.bancoDepositante,
                                'input-readonly': isEdit,
                            }"
                            :disabled="isEdit"
                        />
                        <small
                            v-if="errors.bancoDepositante"
                            style="display: block"
                            class="p-error"
                            >{{ errors.bancoDepositante }}</small
                        >
                    </div>
                </div>
                <div class="col-6" v-else>
                    <div class="form-group">
                        <InputText
                            v-model="depositanteForm.correoDepositante"
                            placeholder="Correo Electronico"
                            class="w-full md:w-14rem input-registro"
                            style="width: 100%"
                            :class="{
                                'p-invalid': errors.correoDepositante,
                                'input-readonly': isEdit,
                            }"
                            :readOnly="isEdit"
                        />
                        <small
                            v-if="errors.correoDepositante"
                            style="display: block"
                            class="p-error"
                            >{{ errors.correoDepositante }}</small
                        >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div
                        class="form-group"
                        style="width: 100%; display: inline-block"
                    >
                        <InputGroup>
                            <Dropdown
                                id="codigoIReclamo"
                                v-model="depositanteForm.codigoIDepositante"
                                :options="optionsCodigoI"
                                placeholder="CI"
                                :optionLabel="optionLabelFunction"
                                optionValue="id"
                                style="width: 30%"
                                class="input-indicativo"
                                :class="{
                                    'p-invalid': errors.codigoIDepositante,
                                    'input-readonly': isEdit,
                                }"
                                :disabled="isEdit"
                                filter
                            ></Dropdown>
                            <InputNumber
                                id=""
                                v-model="depositanteForm.celularDepositante"
                                placeholder="Número celular"
                                class="w-full md:w-14rem input-telefono"
                                style="width: 80%"
                                :class="{
                                    'p-invalid': errors.celularDepositante,
                                }"
                                :disabled="isEdit"
                            />
                        </InputGroup>
                        <small
                            v-if="errors.celularDepositante"
                            style="display: block"
                            class="p-error"
                            >{{ errors.celularDepositante }}</small
                        >
                    </div>
                </div>
                <div
                    class="col-6"
                    v-if="
                        currentService == 'TP-04' || currentService == 'TP-05'
                    "
                >
                    <div
                        class="form-group"
                        style="width: 100%; display: inline-block"
                    >
                        <InputGroup>
                            <Dropdown
                                id="tipoCuentaDepositante"
                                v-model="depositanteForm.tipoCuentaDepositante"
                                :options="optionsTipoCuenta"
                                placeholder="Cuenta"
                                optionLabel="name"
                                optionValue="id"
                                style="width: 30%"
                                class="input-indicativo"
                                :class="{
                                    'p-invalid': errors.tipoCuentaDepositante,
                                    'input-readonly': isEdit,
                                }"
                                :disabled="isEdit"
                            ></Dropdown>
                            <InputNumber
                                v-model="depositanteForm.cuentaDepositante"
                                :placeholder="placeholderPeru"
                                style="width: 80%"
                                class="w-full md:w-14rem input-telefono"
                                :class="{
                                    'p-invalid': errors.cuentaDepositante,
                                }"
                                :disabled="isEdit"
                            />
                        </InputGroup>
                        <small
                            v-if="errors.cuentaDepositante"
                            style="display: block"
                            class="p-error"
                            >{{ errors.cuentaDepositante }}</small
                        >
                    </div>
                </div>
                <div class="col-6" v-else>
                    <div class="form-group">
                        <Dropdown
                            id="selectPaisReclamo"
                            v-model="depositanteForm.paisDepositante"
                            :options="optionsPais"
                            placeholder="Pais"
                            optionLabel="name"
                            optionValue="id"
                            class="w-full md:w-14rem input-registro"
                            style="width: 100%; text-align: left"
                            :class="{
                                'p-invalid': errors.paisDepositante,
                                'input-readonly': isEdit,
                            }"
                            :disabled="isEdit"
                        />
                        <small
                            v-if="errors.paisDepositante"
                            style="display: block"
                            class="p-error"
                            >{{ errors.paisDepositante }}</small
                        >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div
                        class="form-group"
                        style="width: 100%; display: inline-block"
                        v-if="isEditImage"
                    >
                        <FileUpload
                            id="adjuntarDocumento"
                            ref="fileUpload"
                            accept="image/*"
                            :multiple="false"
                            :fileLimit="1"
                            :class="{
                                'p-invalid': errors.adjuntarDocumento,
                                'input-readonly': isEdit,
                            }"
                            @change="onFileUpload"
                            :disabled="isEdit"
                        >
                            <template #empty>
                                <p>Adjuntar foto del documento.</p>
                            </template>
                        </FileUpload>
                        <small
                            v-if="errors.adjuntarDocumento"
                            style="display: block"
                            class="p-error"
                            >{{ errors.adjuntarDocumento }}</small
                        >
                    </div>
                    <div style="width: 80%; display: inline-block" v-else>
                        <button
                            @click.prevent="
                                previewImagen(
                                    depositanteForm.adjuntarDocumento,
                                    true,
                                    true,
                                    depositanteForm.id
                                )
                            "
                            :disabled="isEdit"
                            class="preview p-voucher"
                            :class="{
                                'button-readonly': isEdit,
                            }"
                        >
                            <i class="pi pi-eye"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5" v-if="createOrUpdate == 'create'">
                <div
                    class="text-center"
                    style="display: flex; justify-content: center"
                >
                    <Button
                        class="btn-primary"
                        @click.prevent="add"
                        style="
                            background-color: transparent;
                            border: none;
                            color: #fff !important;
                            font-size: 18px;
                        "
                        >Guardar</Button
                    >
                </div>
            </div>
            <div class="text-center mt-5" v-if="createOrUpdate == 'edit'">
                <div
                    class="text-center"
                    style="display: flex; justify-content: center"
                >
                    <Button
                        class="btn-primary"
                        @click="habilitarEdicion()"
                        style="
                            background-color: transparent;
                            border: none;
                            color: #fff !important;
                            font-size: 18px;
                        "
                        >Habilitar Edición</Button
                    >
                </div>
            </div>
            <div class="text-center mt-5" v-if="createOrUpdate == 'update'">
                <div
                    class="text-center"
                    style="display: flex; justify-content: center"
                >
                    <Button
                        class="btn-primary"
                        @click.prevent="update"
                        style="
                            background-color: transparent;
                            border: none;
                            color: #fff !important;
                            font-size: 18px;
                        "
                        >Actualizar</Button
                    >
                </div>
            </div>
        </form>
    </div>
</template>

<script>
// Importar Librerias o Modulos
import * as Yup from "yup";

export default {
    emits: ["formId"],
    data() {
        return {
            optionsServices: [],
            optionsTipoCuenta: [],
            optionsDocument: [],
            optionsBancosPeru: [],
            selectedService: null,
            servicioDepositanteVisible: false,
            depositantes: [],
            selectedDepositante: null,
            selectVisible: false,
            isEdit: true,
            createOrUpdate: null,
            isEditImage: true,
            depositanteForm: {
                id: null,
                aliasDepositante: "",
                nombreDepositante: "",
                tipoDocumentoDepositante: null,
                documentoDepositante: null,
                correoDepositante: null,
                codigoIDepositante: null,
                celularDepositante: null,
                paisDepositante: null,
                bancoDepositante: null,
                adjuntarDocumento: null,
                tipoCuentaDepositante: null,
                cuentaDepositante: null,
                servicio: null,
                code: null,
            },
            errors: {},
            currentService: null,
            placeholderPeru: null,
            dynamicRules: {},
        };
    },
    components: {},
    watch: {
        selectedService: async function (value) {
            this.resetForm();
            this.selectVisible = value ? true : false;
            if (value) {
                this.list();
            }
        },
    },
    created() {},
    mounted() {},
    methods: {
        async validateForm() {
            let initialRules = {
                aliasDepositante: Yup.string().required(
                    "El alias es obligatorio"
                ),
                nombreDepositante: Yup.string().required(
                    "El nombre es obligatorio"
                ),
                tipoDocumentoDepositante: Yup.string().required(
                    "El tipo documento es obligatorio"
                ),
                documentoDepositante: Yup.string().required(
                    "El documento es obligatorio"
                ),
                codigoIDepositante: Yup.string().required(
                    "La cuenta es obligatoria"
                ),
                celularDepositante: Yup.string().required(
                    "El pago movil es obligatorio"
                ),
                adjuntarDocumento: Yup.string().required(
                    "La foto es obligatoria"
                ),
            };
            if (
                this.currentService == "TP-04" ||
                this.currentService == "TP-05"
            ) {
                this.dynamicRules.tipoCuentaDepositante = Yup.string().required(
                    "El tipo cuenta es obligatorio"
                );
                this.dynamicRules.bancoDepositante = Yup.string().required(
                    "El banco es obligatorio"
                );
                this.dynamicRules.cuentaDepositante = Yup.string().required(
                    "La cuenta es obligatoria"
                );
            } else {
                this.dynamicRules.paisDepositante = Yup.string().required(
                    "El pais es obligatorio"
                );
                this.dynamicRules.correoDepositante = Yup.string()
                    .email("El formato del correo electrónico no es válido")
                    .required("El beneficiario es obligatorio");
            }
            const schema = Yup.object().shape({
                ...initialRules,
                ...this.dynamicRules,
            });
            this.errors = {};
            try {
                await schema.validate(this.depositanteForm, {
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
        initDepositante() {
            this.createOrUpdate = "create";
            this.formDepositanteVisible = true;
            this.isEdit = false;
            this.isEditImage = true;
            this.resetForm();
            this.depositanteForm.servicio = this.getService(
                this.selectedService
            ).codigo;
            this.depositanteForm.code = "TD";
        },
        async list() {
            this.depositantes = await this.getTerceros(
                "TD",
                this.getService(this.selectedService).codigo
            );
            if (this.depositantes) {
                const comboNames = [
                    "tipo_documento",
                    "pais_telefono",
                    "pais",
                    "tipo_cuenta",
                ];
                const response = await this.$getComboRelations(comboNames);
                const {
                    tipo_documento: responseTipoDocumento,
                    pais_telefono: responsePaisTelefono,
                    pais: responsePais,
                    tipo_cuenta: responseTipoCuenta,
                } = response;

                this.optionsDocument = responseTipoDocumento;
                this.optionsCodigoI = responsePaisTelefono;
                this.optionsPais = responsePais;
                this.optionsTipoCuenta = responseTipoCuenta;

                this.optionsBancosPeru = await this.$getBancoByMoneda(3);
            }
        },
        async handleSelect(event) {
            this.errors = {};
            const code = "TD";
            const servicio = this.getService(this.selectedService).codigo;
            this.createOrUpdate = "edit";
            this.formDepositanteVisible = true;
            let tmpAfiliado = await this.showTercero(
                event.value,
                code,
                servicio
            );
            this.isEdit = true;
            this.setForm(tmpAfiliado.data);
            this.depositanteForm.servicio = servicio;
            this.depositanteForm.code = code;
            this.$emit("formId", this.depositanteForm.id);
        },
        async add() {
            const isValid = await this.validateForm();
            if (isValid) {
                this.$axios
                    .post("/terceros/store", this.depositanteForm, {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    })
                    .then(async (response) => {
                        this.selectedDepositante = null;
                        this.$alertSuccess("Añadido");
                        this.list();
                        this.resetForm();
                        this.isEditImage = true;
                        this.$refs.fileUpload.clear();
                    })
                    .catch((error) => {
                        this.$readStatusHttp(error);
                    });
            }
        },
        async update() {
            const isValid = await this.validateForm();
            if (isValid) {
                this.$axios
                    .post(
                        "/terceros/update/" + this.depositanteForm.id,
                        this.depositanteForm,
                        {
                            headers: {
                                "Content-Type": "multipart/form-data",
                            },
                        }
                    )
                    .then((response) => {
                        this.$alertSuccess("Actualizado");
                        this.createOrUpdate = "edit";
                        this.isEdit = true;
                        this.isEditImage = false;
                        this.depositanteForm.adjuntarDocumento =
                            response.data.data.adjuntar_documento;
                    })
                    .catch((error) => {
                        this.$readStatusHttp(error);
                    });
            }
        },
        async getFormsServices(principal = 1) {
            return new Promise(async (resolve, reject) => {
                try {
                    const response = await axios.get(
                        "/gestion/formularios/" + principal
                    );
                    resolve(response.data);
                } catch (error) {
                    this.$readStatusHttp(error);
                    reject(error);
                }
            });
        },
        setForm(depositante) {
            this.depositanteForm.id = depositante.id;
            this.depositanteForm.aliasDepositante = depositante.alias;
            this.depositanteForm.nombreDepositante = depositante.nombre;
            this.depositanteForm.tipoDocumentoDepositante =
                depositante.tipo_documento_id;
            this.depositanteForm.documentoDepositante = depositante.documento;
            this.depositanteForm.correoDepositante = depositante.correo;
            this.depositanteForm.codigoIDepositante =
                depositante.pais_telefono_id;
            this.depositanteForm.adjuntarDocumento = depositante.path_documento;
            this.depositanteForm.celularDepositante = parseInt(
                depositante.celular
            );
            this.depositanteForm.paisDepositante = depositante.pais_id;
            this.depositanteForm.tipoCuentaDepositante = parseInt(
                depositante.tipo_cuenta_id
            );
            this.depositanteForm.cuentaDepositante = parseInt(
                depositante.cuenta
            );
            this.depositanteForm.bancoDepositante = parseInt(
                depositante.banco_id
            );
            this.isEditImage = depositante.path_documento ? false : true;
        },
        resetForm() {
            this.depositanteForm.id = null;
            this.depositanteForm.aliasDepositante = null;
            this.depositanteForm.nombreDepositante = null;
            this.depositanteForm.tipoDocumentoDepositante = null;
            this.depositanteForm.documentoDepositante = null;
            this.depositanteForm.correoDepositante = null;
            this.depositanteForm.codigoIDepositante = null;
            this.depositanteForm.celularDepositante = null;
            this.depositanteForm.paisDepositante = null;
            this.depositanteForm.adjuntarDocumento = null;
            this.depositanteForm.tipoCuentaDepositante = null;
            this.depositanteForm.bancoDepositante = null;
            this.depositanteForm.cuentaDepositante = null;
            this.depositanteForm.servicio = null;
            this.depositanteForm.code = null;
        },
        habilitarEdicion() {
            this.errors = {};
            this.createOrUpdate = "update";
            this.isEdit = false;
        },
        async getTerceros(code, servicio) {
            return new Promise(async (resolve, reject) => {
                try {
                    const response = await axios.get(
                        "/terceros/list/" + code + "/" + servicio
                    );
                    resolve(response.data);
                } catch (error) {
                    this.$readStatusHttp(error);
                    reject(error);
                }
            });
        },
        async showTercero(id, code, servicio) {
            return new Promise(async (resolve, reject) => {
                try {
                    const response = await axios.get(
                        "/terceros/show/" + id + "/" + code + "/" + servicio
                    );
                    resolve(response.data);
                } catch (error) {
                    this.$readStatusHttp(error);
                    reject(error);
                }
            });
        },
        onFileUpload() {
            const fileUploadComponent = this.$refs.fileUpload;
            if (fileUploadComponent) {
                const file = fileUploadComponent.files[0];
                if (file) {
                    if (file.type && file.type.startsWith("image/")) {
                        this.depositanteForm.adjuntarDocumento = file;
                    }
                }
            }
        },
        previewImagen(imageUrl, titulo, isDelete, solicitudId) {
            let swalOptions = {
                imageUrl: imageUrl,
                imageAlt: titulo,
                showCloseButton: true,
                showConfirmButton: true,
                confirmButtonText: "Descargar",
                focusConfirm: false,
                customClass: {
                    container: "custom-swal-container",
                    popup: "custom-swal-popup",
                },
            };

            if (isDelete) {
                swalOptions.showCancelButton = true;
                swalOptions.cancelButtonText = "Eliminar";
                swalOptions.cancelButtonColor = "#d33";
                swalOptions.focusCancel = true;
            }

            this.$swal
                .mixin({
                    customClass: {
                        container: "custom-swal-container",
                        popup: "custom-swal-popup",
                    },
                })
                .fire(swalOptions)
                .then((result) => {
                    if (result.isConfirmed) {
                        this.$downloadImagen(imageUrl);
                    } else if (
                        result.dismiss === this.$swal.DismissReason.cancel
                    ) {
                        this.$swal
                            .fire({
                                title: "¿Estás seguro?",
                                text: "Estás a punto de eliminar esta imagen. ¿Estás seguro de que deseas continuar?",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Sí, eliminar",
                                cancelButtonText: "Cancelar",
                                customClass: {
                                    container: "custom-swal-container",
                                    popup: "custom-swal-popup",
                                },
                            })
                            .then((result) => {
                                if (result.isConfirmed) {
                                    this.deleteImagen(imageUrl, solicitudId);
                                }
                            });
                    }
                });
        },
        deleteImagen(path, solicitud_id) {
            let formData = {
                path_document: path,
                id: solicitud_id,
            };
            this.$axios
                .post("/terceros/destroy/path_document", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((response) => {
                    this.$alertSuccess(" Actualizado");
                    this.depositanteForm.adjuntarDocumento = null;
                    this.isEditImage = true;
                })
                .catch((error) => {
                    this.$readStatusHttp(error);
                });
        },
        getService(selectedService) {
            return this.optionsServices.find((item) => {
                return item.id == selectedService;
            });
        },
        async checkValidateProceso(service, others) {
            if (service) {
                this.optionsServices = await this.getFormsServices();
            }
            this.formDepositanteVisible = false;
            this.selectedDepositante = null;
            this.selectedService = null;
            this.servicioDepositanteVisible = others;
            this.resetForm();
        },
        optionLabelFunction(option) {
            return `${option.name} - ${option.valor1}`;
        },
        onServiceChange(event) {
            this.currentService = this.optionsServices.find(
                (item) => item.id == event.value
            ).codigo;
            if (this.currentService == "TP-04") {
                this.placeholderPeru = "Cuenta en soles";
            } else if (this.currentService == "TP-05") {
                this.placeholderPeru = "Cuenta en dolares";
            }
            this.formDepositanteVisible = false;
        },
    },
};
</script>
