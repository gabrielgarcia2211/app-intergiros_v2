<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-5">
                <InputGroup>
                    <Button label="de" class="izquierda" />
                    <Dropdown
                        :options="optionsServices"
                        v-model="selectedService"
                        id="inputGroupServicios"
                        :placeholder="'Selecciona'"
                        optionLabel="descripcion"
                        optionValue="id"
                        class="w-full md:w-14rem"
                        style="width: 100%"
                        @change="handleSelectService"
                    ></Dropdown>
                </InputGroup>
            </div>
            <div
                class="col-md-2 text-center"
                style="color: #0035aa; padding: 0px"
            >
                <i
                    class="fas fa-exchange-alt fa-5x"
                    style="
                        border: 1px solid #0035aa;
                        border-radius: 55px;
                        padding: 10px;
                    "
                ></i>
            </div>
            <div class="col-md-5">
                <InputGroup>
                    <Button label="a" class="derecha" />
                    <Dropdown
                        id="inputGroupMoneda"
                        v-model="selectedMoneda"
                        :options="optionsMonedas"
                        optionLabel="tipo"
                        optionValue="id"
                        :placeholder="'Selecciona'"
                        class="w-full md:w-14rem"
                        style="width: 100%"
                    ></Dropdown>
                </InputGroup>
            </div>
        </div>
    </div>
    <!-- paypal -->
    <div class="panel container mt-5" id="panel-paypal" v-if="checkService">
        <div class="text-center">
            <p
                style="font-size: 18px;"
            >
                <strong>Monto minimo:</strong> $5USD+comisión PayPal($5,60USD)
            </p>
            <p
                style="font-size: 18px;"
            >
                <strong>Tiempo aproximado de espera:</strong> 8 horas laborales
            </p>
        </div>
        <div class="row mt-5">
            <!-- beneficiario -->
            <div class="col-md-6" style="text-align: center">
                <Dropdown
                    id="selectedBeneficiario"
                    v-model="selectedBeneficiario"
                    :options="beneficiarios"
                    optionLabel="nombre"
                    optionValue="id"
                    :placeholder="'Beneficiarios afiliados'"
                    class="w-full md:w-14rem input-registro"
                    style="width: 80%; text-align: left"
                    @change="handleSelectAfiliado"
                ></Dropdown>
                <div class="text-center">
                    <p
                        @click="initBeneficiario()"
                        style="
                            color: #0035aa;
                            cursor: pointer;
                            text-decoration: underline;
                            font-size: 18px;
                        "
                    >
                        <i class="fas fa-plus"></i>
                        Afiliar nuevo beneficiario
                    </p>
                </div>
                <form id="formBeneficiario" v-if="formBeneficiarioVisible">
                    <div class="form-group">
                        <InputText
                            v-model="beneficiarioForm.aliasBeneficiario"
                            placeholder="Alias"
                            class="w-full md:w-14rem input-registro"
                            style="width: 80%"
                            :class="{
                                'p-invalid':
                                    errorsBeneficiario.aliasBeneficiario,
                                'input-readonly': isEditBeneficiario,
                            }"
                            :readOnly="isEditBeneficiario"
                        />
                        <small
                            v-if="errorsBeneficiario.aliasBeneficiario"
                            style="display: block"
                            class="p-error"
                            >{{ errorsBeneficiario.aliasBeneficiario }}</small
                        >
                    </div>
                    <div class="form-group">
                        <InputText
                            v-model="beneficiarioForm.nombreBeneficiario"
                            placeholder="Nombres y apellidos"
                            class="w-full md:w-14rem input-registro"
                            style="width: 80%"
                            :class="{
                                'p-invalid':
                                    errorsBeneficiario.nombreBeneficiario,
                                'input-readonly': isEditBeneficiario,
                            }"
                            :readOnly="isEditBeneficiario"
                        />
                        <small
                            v-if="errorsBeneficiario.nombreBeneficiario"
                            style="display: block"
                            class="p-error"
                            >{{ errorsBeneficiario.nombreBeneficiario }}</small
                        >
                    </div>
                    <div
                        class="form-group"
                        style="width: 80%; display: inline-block"
                    >
                        <InputGroup>
                            <Dropdown
                                id="tipoDocumentoBeneficiario"
                                v-model="
                                    beneficiarioForm.tipoDocumentoBeneficiario
                                "
                                :options="optionsDocument"
                                placeholder="TD"
                                optionLabel="name"
                                optionValue="id"
                                style="width: 30%"
                                class="input-indicativo"
                                :class="{
                                    'p-invalid':
                                        errorsBeneficiario.tipoDocumentoBeneficiario,
                                    'input-readonly': isEditBeneficiario,
                                }"
                                :readOnly="isEditBeneficiario"
                            ></Dropdown>
                            <InputNumber
                                id=""
                                v-model="beneficiarioForm.documentoBeneficiario"
                                placeholder="Número documento"
                                class="w-full md:w-14rem input-telefono"
                                style="width: 80%"
                                :class="{
                                    'p-invalid':
                                        errorsBeneficiario.documentoBeneficiario,
                                }"
                                :disabled="isEditBeneficiario"
                            />
                        </InputGroup>
                        <small
                            v-if="errorsBeneficiario.documentoBeneficiario"
                            style="display: block"
                            class="p-error"
                            >{{
                                errorsBeneficiario.documentoBeneficiario
                            }}</small
                        >
                    </div>
                    <div class="form-group">
                        <Dropdown
                            id="selectBanco"
                            v-model="beneficiarioForm.bancoBeneficiario"
                            :options="optionsBancos"
                            placeholder="Bancos"
                            optionLabel="name"
                            optionValue="id"
                            class="w-full md:w-14rem input-registro"
                            style="width: 80%; text-align: left"
                            :class="{
                                'p-invalid':
                                    errorsBeneficiario.bancoBeneficiario,
                                'input-readonly': isEditBeneficiario,
                            }"
                            :readOnly="isEditBeneficiario"
                        />
                        <small
                            v-if="errorsBeneficiario.bancoBeneficiario"
                            style="display: block"
                            class="p-error"
                            >{{ errorsBeneficiario.bancoBeneficiario }}</small
                        >
                    </div>
                    <div class="form-group">
                        <InputNumber
                            v-model="beneficiarioForm.cuentaBeneficiario"
                            placeholder="Número de cuenta"
                            style="width: 80%"
                            class="w-full md:w-14rem input-registro"
                            :class="{
                                'p-invalid':
                                    errorsBeneficiario.cuentaBeneficiario,
                            }"
                            :disabled="isEditBeneficiario"
                        />
                        <small
                            v-if="errorsBeneficiario.cuentaBeneficiario"
                            style="display: block"
                            class="p-error"
                            >{{ errorsBeneficiario.cuentaBeneficiario }}</small
                        >
                    </div>
                    <div class="form-group">
                        <InputText
                            v-model="beneficiarioForm.pagoMovilBeneficiario"
                            placeholder="Pago móvil"
                            class="w-full md:w-14rem input-registro"
                            style="width: 80%"
                            :class="{
                                'p-invalid':
                                    errorsBeneficiario.pagoMovilBeneficiario,
                                'input-readonly': isEditBeneficiario,
                            }"
                            :readOnly="isEditBeneficiario"
                        />
                        <small
                            v-if="errorsBeneficiario.pagoMovilBeneficiario"
                            style="display: block"
                            class="p-error"
                            >{{
                                errorsBeneficiario.pagoMovilBeneficiario
                            }}</small
                        >
                    </div>
                    <div
                        class="text-center"
                        v-if="createOrUpdateBeneficiario == 'create'"
                    >
                        <div
                            class="text-center"
                            style="display: flex; justify-content: center"
                        >
                            <Button
                                class="btn-primary"
                                @click.prevent="addBeneficiario"
                                style="
                                    background-color: transparent;
                                    border: none;
                                    color: #0035aa;
                                    font-size: 18px;
                                "
                                >Guardar</Button
                            >
                        </div>
                    </div>
                    <div
                        class="text-center"
                        v-if="createOrUpdateBeneficiario == 'edit'"
                    >
                        <div
                            class="text-center"
                            style="display: flex; justify-content: center"
                        >
                            <Button
                                class="btn-primary"
                                @click="habilitarEdicion('TB')"
                                style="
                                    background-color: transparent;
                                    border: none;
                                    color: #0035aa;
                                    font-size: 18px;
                                "
                                >Habilitar Edición</Button
                            >
                            <Button
                                class="btn-primary"
                                @click.prevent="deleteBeneficiario"
                                style="
                                    background-color: transparent;
                                    border: none;
                                    color: #0035aa;
                                    font-size: 18px;
                                "
                                >Eliminar</Button
                            >
                        </div>
                    </div>
                    <div
                        class="text-center"
                        v-if="createOrUpdateBeneficiario == 'update'"
                    >
                        <div
                            class="text-center"
                            style="display: flex; justify-content: center"
                        >
                            <Button
                                class="btn-primary"
                                @click.prevent="updateBeneficiario"
                                style="
                                    background-color: transparent;
                                    border: none;
                                    color: #0035aa;
                                    font-size: 18px;
                                "
                                >Actualizar</Button
                            >
                        </div>
                    </div>
                </form>
            </div>
            <!-- depositante -->
            <div class="col-md-6" style="text-align: center">
                <Dropdown
                    id="selectedDepositante"
                    v-model="selectedDepositante"
                    :options="depositantes"
                    optionLabel="nombre"
                    optionValue="id"
                    :placeholder="'Depositantes afiliados'"
                    class="w-full md:w-14rem input-registro"
                    style="width: 80%; text-align: left"
                    @change="handleSelectDepositante"
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
                <form id="formDepositante" v-if="formDepositanteVisible">
                    <div class="form-group">
                        <InputText
                            v-model="depositanteForm.aliasDepositante"
                            placeholder="Alias"
                            class="w-full md:w-14rem input-registro"
                            style="width: 80%"
                            :class="{
                                'p-invalid': errorsDepositante.aliasDepositante,
                                'input-readonly': isEditDepositante,
                            }"
                            :readOnly="isEditDepositante"
                        />
                        <small
                            v-if="errorsDepositante.aliasDepositante"
                            style="display: block"
                            class="p-error"
                            >{{ errorsDepositante.aliasDepositante }}</small
                        >
                    </div>
                    <div class="form-group">
                        <InputText
                            v-model="depositanteForm.nombreDepositante"
                            placeholder="Nombres y apellidos"
                            class="w-full md:w-14rem input-registro"
                            style="width: 80%"
                            :class="{
                                'p-invalid':
                                    errorsDepositante.nombreDepositante,
                                'input-readonly': isEditDepositante,
                            }"
                            :readOnly="isEditDepositante"
                        />
                        <small
                            v-if="errorsDepositante.nombreDepositante"
                            style="display: block"
                            class="p-error"
                            >{{ errorsDepositante.nombreDepositante }}</small
                        >
                    </div>
                    <div
                        class="form-group"
                        style="width: 80%; display: inline-block"
                    >
                        <InputGroup>
                            <Dropdown
                                id="tipoDocumentoDepositante"
                                v-model="
                                    depositanteForm.tipoDocumentoDepositante
                                "
                                :options="optionsDocument"
                                placeholder="TD"
                                optionLabel="name"
                                optionValue="id"
                                style="width: 30%"
                                class="input-indicativo"
                                :class="{
                                    'p-invalid':
                                        errorsDepositante.tipoDocumentoDepositante,
                                    'input-readonly': isEditDepositante,
                                }"
                                :readOnly="isEditDepositante"
                            ></Dropdown>
                            <InputNumber
                                id=""
                                v-model="depositanteForm.documentoDepositante"
                                placeholder="Número documento"
                                class="w-full md:w-14rem input-telefono"
                                style="width: 80%"
                                :class="{
                                    'p-invalid':
                                        errorsDepositante.documentoDepositante,
                                }"
                                :disabled="isEditDepositante"
                            />
                        </InputGroup>
                        <small
                            v-if="errorsDepositante.documentoDepositante"
                            style="display: block"
                            class="p-error"
                            >{{ errorsDepositante.documentoDepositante }}</small
                        >
                    </div>
                    <div class="form-group">
                        <InputText
                            v-model="depositanteForm.correoDepositante"
                            placeholder="Correo Electronico"
                            class="w-full md:w-14rem input-registro"
                            style="width: 80%"
                            :class="{
                                'p-invalid':
                                    errorsDepositante.correoDepositante,
                                'input-readonly': isEditDepositante,
                            }"
                            :readOnly="isEditDepositante"
                        />
                        <small
                            v-if="errorsDepositante.correoDepositante"
                            style="display: block"
                            class="p-error"
                            >{{ errorsDepositante.correoDepositante }}</small
                        >
                    </div>
                    <div
                        class="form-group"
                        style="width: 80%; display: inline-block"
                    >
                        <InputGroup>
                            <Dropdown
                                id="codigoIDepositante"
                                v-model="depositanteForm.codigoIDepositante"
                                :options="optionsCodigoI"
                                placeholder="CI"
                                optionLabel="name"
                                optionValue="id"
                                style="width: 30%"
                                class="input-indicativo"
                                :class="{
                                    'p-invalid':
                                        errorsDepositante.codigoIDepositante,
                                    'input-readonly': isEditDepositante,
                                }"
                                :readOnly="isEditDepositante"
                            ></Dropdown>
                            <InputNumber
                                id=""
                                v-model="depositanteForm.celularDepositante"
                                placeholder="Número celular"
                                class="w-full md:w-14rem input-telefono"
                                style="width: 80%"
                                :class="{
                                    'p-invalid':
                                        errorsDepositante.celularDepositante,
                                }"
                                :disabled="isEditDepositante"
                            />
                        </InputGroup>
                        <small
                            v-if="errorsDepositante.celularDepositante"
                            style="display: block"
                            class="p-error"
                            >{{ errorsDepositante.celularDepositante }}</small
                        >
                    </div>
                    <div class="form-group">
                        <Dropdown
                            id="selectPais"
                            v-model="depositanteForm.paisDepositante"
                            :options="optionsPais"
                            placeholder="Pais"
                            optionLabel="name"
                            optionValue="id"
                            class="w-full md:w-14rem input-registro"
                            style="width: 80%; text-align: left"
                            :class="{
                                'p-invalid': errorsDepositante.paisDepositante,
                                'input-readonly': isEditDepositante,
                            }"
                            :readOnly="isEditDepositante"
                        />
                        <small
                            v-if="errorsDepositante.paisDepositante"
                            style="display: block"
                            class="p-error"
                            >{{ errorsDepositante.paisDepositante }}</small
                        >
                    </div>
                    <div
                        class="form-group"
                        style="width: 80%; display: inline-block"
                        v-if="isEditImage"
                    >
                        <FileUpload
                            id="adjuntarDocumento"
                            ref="fileUpload"
                            accept="image/*"
                            :multiple="false"
                            :fileLimit="1"
                            :class="{
                                'p-invalid':
                                    errorsDepositante.adjuntarDocumento,
                                'input-readonly': isEditDepositante,
                            }"
                            @change="onFileUpload"
                            :disabled="isEditDepositante"
                        >
                            <template #empty>
                                <p>Adjuntar foto del documento.</p>
                            </template>
                        </FileUpload>
                        <small
                            v-if="errorsDepositante.adjuntarDocumento"
                            style="display: block"
                            class="p-error"
                            >{{ errorsDepositante.adjuntarDocumento }}</small
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
                            :disabled="isEditDepositante"
                            class="preview p-voucher"
                            :class="{
                                'button-readonly': isEditDepositante,
                            }"
                        >
                            <i class="pi pi-eye"></i>
                        </button>
                    </div>
                    <div
                        class="text-center"
                        v-if="createOrUpdateDepositante == 'create'"
                    >
                        <div
                            class="text-center"
                            style="display: flex; justify-content: center"
                        >
                            <Button
                                class="btn-primary"
                                @click.prevent="addDepositante"
                                style="
                                    background-color: transparent;
                                    border: none;
                                    color: #0035aa;
                                    font-size: 18px;
                                "
                                >Guardar</Button
                            >
                        </div>
                    </div>
                    <div
                        class="text-center"
                        v-if="createOrUpdateDepositante == 'edit'"
                    >
                        <div
                            class="text-center"
                            style="display: flex; justify-content: center"
                        >
                            <Button
                                class="btn-primary"
                                @click="habilitarEdicion('TD')"
                                style="
                                    background-color: transparent;
                                    border: none;
                                    color: #0035aa;
                                    font-size: 18px;
                                "
                                >Habilitar Edición</Button
                            >
                            <Button
                                class="btn-primary"
                                @click.prevent="deleteDepositante"
                                style="
                                    background-color: transparent;
                                    border: none;
                                    color: #0035aa;
                                    font-size: 18px;
                                "
                                ><i class="pi pi-trash"></i></Button
                            >
                        </div>
                    </div>
                    <div
                        class="text-center"
                        v-if="createOrUpdateDepositante == 'update'"
                    >
                        <div
                            class="text-center"
                            style="display: flex; justify-content: center"
                        >
                            <Button
                                class="btn-primary"
                                @click.prevent="updateDepositante"
                                style="
                                    background-color: transparent;
                                    border: none;
                                    color: #0035aa;
                                    font-size: 18px;
                                "
                                >Actualizar</Button
                            >
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- paypal -->
</template>
<script>
// Importar Librerias o Modulos
import * as Yup from "yup";

export default {
    data() {
        return {
            beneficiarios: [],
            depositantes: [],
            selectedService: null,
            selectedMoneda: null,
            optionsServices: [],
            optionsMonedas: [],
            optionsBeneficiarios: [],
            optionsDocument: [],
            optionsBancos: [],
            optionsCodigoI: [],
            optionsPais: [],
            checkService: null,
            selectedBeneficiario: null,
            selectedDepositante: null,
            /** Formulario Beneficario*/
            formBeneficiarioVisible: false,
            beneficiarioForm: {
                id: null,
                aliasBeneficiario: "",
                nombreBeneficiario: "",
                tipoDocumentoBeneficiario: null,
                documentoBeneficiario: null,
                bancoBeneficiario: "",
                cuentaBeneficiario: null,
                pagoMovilBeneficiario: "",
                servicio: null,
                code: null,
            },
            createOrUpdateBeneficiario: null,
            isEditBeneficiario: true,
            errorsBeneficiario: {},
            /** Formulario Depositante*/
            formDepositanteVisible: false,
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
                adjuntarDocumento: null,
                servicio: null,
                code: null,
            },
            createOrUpdateDepositante: null,
            isEditDepositante: true,
            errorsDepositante: {},
            /** Control de solicitud */
            mapSolicitud: {
                servicio: null,
                tipo: null,
            },
            isEditImage: true,
        };
    },
    components: {},
    created() {
        this.initSelects();
    },
    mounted() {},
    methods: {
        async validateFormBeneficiario() {
            const schema = Yup.object().shape({
                aliasBeneficiario: Yup.string().required(
                    "El alias es obligatorio"
                ),
                nombreBeneficiario: Yup.string().required(
                    "El nombre es obligatorio"
                ),
                tipoDocumentoBeneficiario: Yup.string().required(
                    "El tipo documento es obligatorio"
                ),
                documentoBeneficiario: Yup.string().required(
                    "El documento es obligatorio"
                ),
                bancoBeneficiario: Yup.string().required(
                    "El beneficiario es obligatorio"
                ),
                cuentaBeneficiario: Yup.string().required(
                    "La cuenta es obligatoria"
                ),
                pagoMovilBeneficiario: Yup.string().required(
                    "El pago movil es obligatorio"
                ),
            });
            this.errorsBeneficiario = {};
            try {
                await schema.validate(this.beneficiarioForm, {
                    abortEarly: false,
                });
                return true;
            } catch (err) {
                err.inner.forEach((error) => {
                    this.errorsBeneficiario[error.path] = error.message;
                });
                return false;
            }
        },
        async validateFormDepositante() {
            const schema = Yup.object().shape({
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
                correoDepositante: Yup.string()
                    .email("El formato del correo electrónico no es válido")
                    .required("El beneficiario es obligatorio"),
                codigoIDepositante: Yup.string().required(
                    "La cuenta es obligatoria"
                ),
                celularDepositante: Yup.string().required(
                    "El pago movil es obligatorio"
                ),
                paisDepositante: Yup.string().required(
                    "El pago movil es obligatorio"
                ),
                adjuntarDocumento: Yup.string().required(
                    "La foto es obligatoria"
                ),
            });
            this.errorsDepositante = {};
            try {
                await schema.validate(this.depositanteForm, {
                    abortEarly: false,
                });
                return true;
            } catch (err) {
                err.inner.forEach((error) => {
                    this.errorsDepositante[error.path] = error.message;
                });
                return false;
            }
        },
        async initSelects() {
            this.optionsServices = await this.getForms();
            this.optionsMonedas = await this.getMonedas();
        },
        handleSelectService(event) {
            this.beneficiarios = [];
            this.depositantes = [];
            this.checkService = event.value;
            switch (event.value) {
                case 1:
                    this.beneficiarioForm.servicio = "TP-01";
                    this.initServicePaypal();
                    break;
                default:
                    break;
            }
        },
        async handleSelectAfiliado(event) {
            this.errorsBeneficiario = {};
            this.createOrUpdateBeneficiario = "edit";
            let tmpAfiliado = [];
            switch (this.checkService) {
                case 1:
                    const code = "TB";
                    const servicio = "TP-01";
                    tmpAfiliado = await this.showTercero(
                        event.value,
                        code,
                        servicio
                    );
                    this.isEditBeneficiario = true;
                    this.formBeneficiarioVisible = true;
                    this.setFormBeneficiario(tmpAfiliado.data);
                    this.beneficiarioForm.servicio = servicio;
                    this.beneficiarioForm.code = code;
                    break;
                default:
                    tmpAfiliado = [];
                    break;
            }
        },
        async handleSelectDepositante(event) {
            this.errorsDepositante = {};
            this.createOrUpdateDepositante = "edit";
            let tmpAfiliado = [];
            switch (this.checkService) {
                case 1:
                    const code = "TD";
                    const servicio = "TP-01";
                    tmpAfiliado = await this.showTercero(
                        event.value,
                        code,
                        servicio
                    );
                    this.isEditDepositante = true;
                    this.formDepositanteVisible = true;
                    this.setFormDepositante(tmpAfiliado.data);
                    this.depositanteForm.servicio = servicio;
                    this.depositanteForm.code = code;
                    break;
                default:
                    tmpAfiliado = [];
                    break;
            }
        },
        async initServicePaypal() {
            this.beneficiarios = await this.getTerceros("TB", "TP-01");
            this.depositantes = await this.getTerceros("TD", "TP-01");
            const comboNames = [
                "tipo_documento",
                "pais_telefono",
                "pais",
                "banco",
            ];

            const response = await this.$getComboRelations(comboNames);
            const {
                tipo_documento: responseTipoDocumento,
                pais_telefono: responsePaisTelefono,
                pais: responsePais,
                banco: responseBanco,
            } = response;

            this.optionsDocument = responseTipoDocumento;
            this.optionsCodigoI = responsePaisTelefono;
            this.optionsPais = responsePais;
            this.optionsBancos = responseBanco;
        },
        async getForms(principal = 1) {
            return new Promise(async (resolve, reject) => {
                try {
                    const response = await axios.get(
                        "/gestion/formularios/" + principal
                    );
                    resolve(response.data);
                } catch (error) {
                    handleErrors(error);
                    reject(error);
                }
            });
        },
        async getMonedas() {
            return new Promise(async (resolve, reject) => {
                try {
                    const response = await axios.get("/gestion/monedas");
                    resolve(response.data);
                } catch (error) {
                    handleErrors(error);
                    reject(error);
                }
            });
        },
        initBeneficiario() {
            this.createOrUpdateBeneficiario = "create";
            this.formBeneficiarioVisible = true;
            this.isEditBeneficiario = false;
            switch (this.checkService) {
                case 1:
                    this.resetFormBeneficiario();
                    this.beneficiarioForm.servicio = "TP-01";
                    this.beneficiarioForm.code = "TB";
                    break;
                default:
                    break;
            }
        },
        initDepositante() {
            this.createOrUpdateDepositante = "create";
            this.formDepositanteVisible = true;
            this.isEditDepositante = false;
            this.isEditImage = true;
            switch (this.checkService) {
                case 1:
                    this.resetFormDepositante();
                    this.depositanteForm.servicio = "TP-01";
                    this.depositanteForm.code = "TD";
                    break;
                default:
                    break;
            }
        },
        habilitarEdicion(codigo) {
            switch (codigo) {
                case "TB":
                    this.errorsBeneficiario = {};
                    this.createOrUpdateBeneficiario = "update";
                    this.isEditBeneficiario = false;
                    break;
                case "TD":
                    this.errorsDepositante = {};
                    this.createOrUpdateDepositante = "update";
                    this.isEditDepositante = false;
                    break;
                default:
                    break;
            }
        },
        mapTercero() {
            const servicio = this.mapSolicitud.servicio;
            const tipo = this.mapSolicitud.tipo;
            switch (servicio) {
                case "TP-01":
                    if (tipo == "TB") {
                    } else {
                    }
                    break;
                default:
                    break;
            }
        },
        async getTerceros(code, servicio) {
            return new Promise(async (resolve, reject) => {
                try {
                    const response = await axios.get(
                        "/terceros/list/" + code + "/" + servicio
                    );
                    resolve(response.data);
                } catch (error) {
                    handleErrors(error);
                    reject(error);
                }
            });
        },
        async addBeneficiario() {
            const isValid = await this.validateFormBeneficiario();
            if (isValid) {
                this.$axios
                    .post("/terceros/store", this.beneficiarioForm, {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    })
                    .then((response) => {
                        this.$alertSuccess("Beneficiario Añadido");
                        this.initServicePaypal();
                        this.resetFormBeneficiario();
                    })
                    .catch((error) => {
                        this.$readStatusHttp(error);
                    });
            }
        },
        async addDepositante() {
            const isValid = await this.validateFormDepositante();
            if (isValid) {
                this.$axios
                    .post("/terceros/store", this.depositanteForm, {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    })
                    .then((response) => {
                        this.$alertSuccess("Depositante Añadido");
                        this.initServicePaypal();
                        this.resetFormDepositante();
                        this.isEditImage = true;
                        this.$refs.fileUpload.clear();
                    })
                    .catch((error) => {
                        this.$readStatusHttp(error);
                    });
            }
        },
        async updateBeneficiario() {
            const isValid = await this.validateFormBeneficiario();
            if (isValid) {
                this.$axios
                    .post(
                        "/terceros/update/" + this.beneficiarioForm.id,
                        this.beneficiarioForm,
                        {
                            headers: {
                                "Content-Type": "multipart/form-data",
                            },
                        }
                    )
                    .then((response) => {
                        this.$alertSuccess("Beneficiario Actualizado");
                        this.createOrUpdateBeneficiario = "edit";
                        this.isEditBeneficiario = true;
                        this.isEditImage = false;
                    })
                    .catch((error) => {
                        this.$readStatusHttp(error);
                    });
            }
        },
        async updateDepositante() {
            const isValid = await this.validateFormDepositante();
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
                        this.$alertSuccess("Depositante Actualizado");
                        this.createOrUpdateDepositante = "edit";
                        this.isEditDepositante = true;
                        this.isEditImage = false;
                        this.depositanteForm.adjuntarDocumento =
                            response.data.data.adjuntar_documento;
                    })
                    .catch((error) => {
                        this.$readStatusHttp(error);
                    });
            }
        },
        async showTercero(id, code, servicio) {
            return new Promise(async (resolve, reject) => {
                try {
                    const response = await axios.get(
                        "/terceros/show/" + id + "/" + code + "/" + servicio
                    );
                    resolve(response.data);
                } catch (error) {
                    handleErrors(error);
                    reject(error);
                }
            });
        },
        deleteBeneficiario() {
            this.$swal
                .fire({
                    title: "Estas seguro de eliminar el beneficiario?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, eliminar!",
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        axios
                            .post(
                                "/terceros/destroy/" +
                                    this.beneficiarioForm.id +
                                    "/" +
                                    "TB"
                            )
                            .then((response) => {
                                this.$alertSuccess("Beneficiario Eliminado");
                                this.initServicePaypal();
                                this.resetFormBeneficiario();
                            })
                            .catch((error) => {
                                handleErrors(error);
                            });
                    }
                });
        },
        deleteDepositante() {
            this.$swal
                .fire({
                    title: "Estas seguro de eliminar el depositante?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, eliminar!",
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        axios
                            .post(
                                "/terceros/destroy/" +
                                    this.depositanteForm.id +
                                    "/" +
                                    "TD"
                            )
                            .then((response) => {
                                this.$alertSuccess("Beneficiario Eliminado");
                                this.initServicePaypal();
                                this.resetFormDepositante();
                                this.createOrUpdateDepositante = "create";
                                this.isEditDepositante = false;
                                this.isEditImage = true;
                            })
                            .catch((error) => {
                                handleErrors(error);
                            });
                    }
                });
        },
        setFormBeneficiario(beneficiario) {
            this.beneficiarioForm.id = beneficiario.id;
            this.beneficiarioForm.aliasBeneficiario = beneficiario.alias;
            this.beneficiarioForm.nombreBeneficiario = beneficiario.nombre;
            this.beneficiarioForm.tipoDocumentoBeneficiario = parseInt(
                beneficiario.tipo_documento_id
            );
            this.beneficiarioForm.documentoBeneficiario = parseInt(
                beneficiario.documento
            );
            this.beneficiarioForm.bancoBeneficiario = parseInt(
                beneficiario.banco_id
            );
            this.beneficiarioForm.cuentaBeneficiario = parseInt(
                beneficiario.cuenta
            );
            this.beneficiarioForm.pagoMovilBeneficiario =
                beneficiario.pago_movil;
        },
        setFormDepositante(depositante) {
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
            this.isEditImage = depositante.path_documento ? false : true;
        },
        resetFormBeneficiario() {
            this.beneficiarioForm.id = null;
            this.beneficiarioForm.aliasBeneficiario = null;
            this.beneficiarioForm.nombreBeneficiario = null;
            this.beneficiarioForm.tipoDocumentoBeneficiario = null;
            this.beneficiarioForm.documentoBeneficiario = null;
            this.beneficiarioForm.bancoBeneficiario = null;
            this.beneficiarioForm.cuentaBeneficiario = null;
            this.beneficiarioForm.pagoMovilBeneficiario = null;
            this.beneficiarioForm.servicio = null;
            this.beneficiarioForm.code = null;
        },
        resetFormDepositante() {
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
            this.depositanteForm.servicio = null;
            this.depositanteForm.code = null;
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
            };
            if (isDelete) {
                swalOptions.showCancelButton = true;
                swalOptions.cancelButtonText = "Eliminar";
                (swalOptions.cancelButtonColor = "#d33"),
                    (swalOptions.focusCancel = true);
            }
            this.$swal.fire(swalOptions).then((result) => {
                if (result.isConfirmed) {
                    this.$downloadImagen(imageUrl);
                } else if (result.dismiss === Swal.DismissReason.cancel) {
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
                    this.$alertSuccess("Depositante Actualizado");
                    this.depositanteForm.adjuntarDocumento = null;
                    this.isEditImage = true;
                })
                .catch((error) => {
                    this.$readStatusHttp(error);
                });
        },
    },
};
</script>

<style>
.input-readonly {
    background-color: #f0f0f0;
    color: #999;
}
.button-readonly {
    background-color: #f0f0f0 !important;
    color: #000000 !important;
}

#adjuntarDocumento [data-pc-name="uploadbutton"],
#adjuntarDocumento [data-pc-name="cancelbutton"] {
    display: none;
}
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
