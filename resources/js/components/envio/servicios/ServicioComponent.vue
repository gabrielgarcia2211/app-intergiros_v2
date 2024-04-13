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
                    <Button label="a" class="izquierda" />
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
            <p>
                <strong>Monto minimo:</strong> $5USD+comisión PayPal($5,60USD)
            </p>
            <p>
                <strong>Tiempo aproximado de espera:</strong> 8 horas laborales
            </p>
        </div>
        <div class="row mt-5">
            <!-- beneficiario -->
            <div class="col-md-6" style="text-align: center">
                <Dropdown
                    id="selectBeneficiario"
                    v-model="selectedBeneficiario"
                    :options="beneficiarios"
                    optionLabel="nombre"
                    optionValue="id"
                    :placeholder="'Beneficiarios afiliados'"
                    class="w-full md:w-14rem input-registro"
                    style="width: 80%"
                ></Dropdown>
                <div class="text-center">
                    <p
                        @click="addBeneficiario()"
                        style="
                            color: #0035aa;
                            cursor: pointer;
                            text-decoration: underline;
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
                            :class="{ 'p-invalid': errors.aliasBeneficiario }"
                        />
                        <small
                            v-if="errors.aliasBeneficiario"
                            style="display: block"
                            class="p-error"
                            >{{ errors.aliasBeneficiario }}</small
                        >
                    </div>
                    <div class="form-group">
                        <InputText
                            v-model="beneficiarioForm.nombreBeneficiario"
                            placeholder="Nombres y apellidos"
                            class="w-full md:w-14rem input-registro"
                            style="width: 80%"
                            :class="{ 'p-invalid': errors.nombreBeneficiario }"
                        />
                        <small
                            v-if="errors.nombreBeneficiario"
                            style="display: block"
                            class="p-error"
                            >{{ errors.nombreBeneficiario }}</small
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
                                :class="{
                                    'p-invalid':
                                        errors.tipoDocumentoBeneficiario,
                                }"
                            ></Dropdown>
                            <InputNumber
                                v-model="beneficiarioForm.documentoBeneficiario"
                                placeholder="Número documento"
                                class="w-full md:w-14rem input-registro"
                                style="width: 80%"
                                :class="{
                                    'p-invalid': errors.documentoBeneficiario,
                                }"
                            />
                        </InputGroup>
                        <small
                            v-if="errors.documentoBeneficiario"
                            style="display: block"
                            class="p-error"
                            >{{ errors.documentoBeneficiario }}</small
                        >
                    </div>
                    <div class="form-group">
                        <InputText
                            v-model="beneficiarioForm.bancoBeneficiario"
                            placeholder="Banco"
                            class="w-full md:w-14rem input-registro"
                            style="width: 80%"
                            :class="{ 'p-invalid': errors.bancoBeneficiario }"
                        />
                        <small
                            v-if="errors.bancoBeneficiario"
                            style="display: block"
                            class="p-error"
                            >{{ errors.bancoBeneficiario }}</small
                        >
                    </div>
                    <div class="form-group">
                        <InputNumber
                            v-model="beneficiarioForm.cuentaBeneficiario"
                            placeholder="Número de cuenta"
                            class="w-full md:w-14rem input-registro"
                            style="width: 80%"
                            :class="{ 'p-invalid': errors.cuentaBeneficiario }"
                        />
                        <small
                            v-if="errors.cuentaBeneficiario"
                            style="display: block"
                            class="p-error"
                            >{{ errors.cuentaBeneficiario }}</small
                        >
                    </div>
                    <div class="form-group">
                        <InputText
                            v-model="beneficiarioForm.pagoMovilBeneficiario"
                            placeholder="Pago móvil"
                            class="w-full md:w-14rem input-registro"
                            style="width: 80%"
                            :class="{
                                'p-invalid': errors.pagoMovilBeneficiario,
                            }"
                        />
                        <small
                            v-if="errors.pagoMovilBeneficiario"
                            style="display: block"
                            class="p-error"
                            >{{ errors.pagoMovilBeneficiario }}</small
                        >
                    </div>
                    <div class="text-center">
                        <div
                            class="text-center"
                            style="display: flex; justify-content: center"
                        >
                            <Button
                                class="btn-primary"
                                @click.prevent="addTercero"
                                style="
                                    background-color: transparent;
                                    border: none;
                                    color: #0035aa;
                                "
                                >Guardar</Button
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
            checkService: null,
            selectedBeneficiario: null,
            /** Formulario */
            formBeneficiarioVisible: false,
            beneficiarioForm: {
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
            errors: {},
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
            this.errors = {};
            try {
                await schema.validate(this.beneficiarioForm, {
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
                    this.initServicePaypal();
                    break;
                default:
                    break;
            }
        },
        async initServicePaypal() {
            this.beneficiarios = await this.getTerceros("TB", "TP-01");
            this.depositantes = await this.getTerceros("TD", "TP-01");
            const comboNames = ["tipo_documento"];

            const response = await this.$getComboRelations(comboNames);
            const { tipo_documento: responseTipoDocumento } = response;

            this.optionsDocument = responseTipoDocumento;
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
        addBeneficiario() {
            this.formBeneficiarioVisible = true;
            switch (this.checkService) {
                case 1:
                    this.beneficiarioForm.servicio = "TP-01";
                    this.beneficiarioForm.code = "TB";
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
        async addTercero() {
            const isValid = await this.validateFormBeneficiario();
            console.log(isValid);
            if (isValid) {
                this.$axios
                    .post("/terceros/store", this.beneficiarioForm, {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    })
                    .then((response) => {
                        console.log(response);
                        this.$alertSuccess("Beneficiario Añadido");
                        this.initServicePaypal();
                        this.resetFormBeneficiario();
                    })
                    .catch((error) => {
                        this.$readStatusHttp(error);
                    });
            }
        },
        resetFormBeneficiario() {
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
    },
};
</script>

<style>
.input-group-prepend {
    display: flex;
    align-items: center;
}
</style>
