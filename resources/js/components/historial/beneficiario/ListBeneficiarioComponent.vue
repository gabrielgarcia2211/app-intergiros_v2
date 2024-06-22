<template>
    <!-- beneficiario -->
    <div class="col-md-12 mt-5" style="text-align: center">
        <Dropdown
            id="selectedBeneficiario"
            v-model="selectedBeneficiario"
            :options="beneficiarios"
            optionLabel="alias"
            optionValue="id"
            :placeholder="'Beneficiarios afiliados'"
            class="w-full md:w-14rem input-registro"
            style="width: 80%; text-align: left"
            @change="handleSelect"
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
        <form id="formBeneficiario" v-if="isVisibleForm">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <InputText
                            v-model="beneficiarioForm.aliasBeneficiario"
                            placeholder="Alias"
                            class="w-full md:w-14rem input-registro"
                            style="width: 100%"
                            :class="{
                                'p-invalid': errors.aliasBeneficiario,
                                'input-readonly': isEdit,
                            }"
                            :readOnly="isEdit"
                        />
                        <small
                            v-if="errors.aliasBeneficiario"
                            style="display: block"
                            class="p-error"
                            >{{ errors.aliasBeneficiario }}</small
                        >
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <InputText
                            v-model="beneficiarioForm.nombreBeneficiario"
                            placeholder="Nombres y apellidos"
                            class="w-full md:w-14rem input-registro"
                            style="width: 100%"
                            :class="{
                                'p-invalid': errors.nombreBeneficiario,
                                'input-readonly': isEdit,
                            }"
                            :readOnly="isEdit"
                        />
                        <small
                            v-if="errors.nombreBeneficiario"
                            style="display: block"
                            class="p-error"
                            >{{ errors.nombreBeneficiario }}</small
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
                                id="tipoDocumentoBeneficiario"
                                v-model="
                                    beneficiarioForm.tipoDocumentoBeneficiario
                                "
                                :options="optionsDocument"
                                placeholder="T"
                                optionLabel="name"
                                optionValue="id"
                                style="width: 30%"
                                class="input-indicativo"
                                :class="{
                                    'p-invalid':
                                        errors.tipoDocumentoBeneficiario,
                                    'input-readonly': isEdit,
                                }"
                                :disabled="isEdit"
                                filter
                            ></Dropdown>
                            <InputNumber
                                id=""
                                v-model="beneficiarioForm.documentoBeneficiario"
                                placeholder="Número documento"
                                class="w-full md:w-14rem input-telefono"
                                style="width: 80%"
                                :useGrouping="false"
                                :class="{
                                    'p-invalid': errors.documentoBeneficiario,
                                }"
                                :disabled="isEdit"
                            />
                        </InputGroup>
                        <small
                            v-if="errors.documentoBeneficiario"
                            style="display: block"
                            class="p-error"
                            >{{ errors.documentoBeneficiario }}</small
                        >
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <Dropdown
                            id="selectBanco"
                            v-model="beneficiarioForm.bancoBeneficiario"
                            :options="optionsBancos"
                            placeholder="Bancos"
                            optionLabel="name"
                            optionValue="id"
                            class="w-full md:w-14rem input-registro"
                            style="width: 100%; text-align: left"
                            :class="{
                                'p-invalid': errors.bancoBeneficiario,
                                'input-readonly': isEdit,
                            }"
                            :disabled="isEdit"
                            @change="handleSelectBanco"
                        />
                        <small
                            v-if="errors.bancoBeneficiario"
                            style="display: block"
                            class="p-error"
                            >{{ errors.bancoBeneficiario }}</small
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
                                id="tipoCuentaBeneficiario"
                                v-model="
                                    beneficiarioForm.tipoCuentaBeneficiario
                                "
                                :options="optionsTipoCuenta"
                                placeholder="T"
                                optionLabel="name"
                                optionValue="id"
                                style="width: 30%"
                                class="input-indicativo"
                                :class="{
                                    'p-invalid': errors.tipoCuentaBeneficiario,
                                    'input-readonly': isEdit,
                                }"
                                :disabled="isEdit"
                                @change="handleTipoC"
                            ></Dropdown>
                            <InputText
                                v-model="beneficiarioForm.cuentaBeneficiario"
                                :placeholder="placeholderCuenta"
                                style="width: 80%"
                                class="w-full md:w-14rem input-telefono"
                                :useGrouping="false"
                                :class="{
                                    'p-invalid': errors.cuentaBeneficiario,
                                }"
                                :disabled="isEdit"
                            />
                        </InputGroup>
                        <small
                            v-if="errors.cuentaBeneficiario"
                            style="display: block"
                            class="p-error"
                            >{{ errors.cuentaBeneficiario }}</small
                        >
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <InputText
                            v-model="beneficiarioForm.pagoMovilBeneficiario"
                            placeholder="Pago móvil (opcional)"
                            class="w-full md:w-14rem input-registro"
                            style="width: 100%"
                            :class="{
                                'p-invalid': errors.pagoMovilBeneficiario,
                                'input-readonly': isEdit,
                            }"
                            :readOnly="isEdit"
                        />
                        <small
                            v-if="errors.pagoMovilBeneficiario"
                            style="display: block"
                            class="p-error"
                            >{{ errors.pagoMovilBeneficiario }}</small
                        >
                    </div>
                </div>
            </div>
            <div class="text-center" v-if="createOrUpdate == 'create'">
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
            <div class="text-center" v-if="createOrUpdate == 'edit'">
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
            <div class="text-center" v-if="createOrUpdate == 'update'">
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
    props: ["selectedService", "selectedTercero", "selectedTipoMoneda"],
    emits: ["formId"],
    data() {
        return {
            optionsTipoCuenta: [],
            optionsDocument: [],
            optionsBancos: [],
            placeholderCuenta: "Número de cuenta",
            beneficiarios: [],
            selectedBeneficiario: null,
            isEdit: true,
            createOrUpdate: null,
            beneficiarioForm: {
                id: null,
                aliasBeneficiario: "",
                nombreBeneficiario: "",
                tipoDocumentoBeneficiario: null,
                documentoBeneficiario: null,
                tipoCuentaBeneficiario: null,
                bancoBeneficiario: "",
                cuentaBeneficiario: null,
                pagoMovilBeneficiario: "",
                servicio: null,
                code: null,
            },
            errors: {},
            isVisibleForm: false,
        };
    },
    components: {},
    watch: {},
    created() {
        this.initModal();
    },
    mounted() {},
    methods: {
        async initModal() {
            console.log(this.selectedTercero);
            this.beneficiarios = await this.$getTerceros(
                "TB",
                this.selectedService.codigo,
                this.selectedTercero
            );
            this.isVisibleForm = false;
            this.optionsBancos = await this.$getBancoByMonedas(
                this.selectedTipoMoneda.codigo
            );
            this.optionsDocument = await this.$getDocumentByMonedas(
                this.selectedTipoMoneda.codigo
            );
            const comboNames = ["tipo_cuenta"];
            const response = await this.$getComboRelations(comboNames);
            const { tipo_cuenta: responseTipoCuenta } = response;
            this.optionsTipoCuenta = responseTipoCuenta;
        },
        initBeneficiario() {
            this.createOrUpdate = "create";
            this.isEdit = false;
            this.resetForm();
            this.beneficiarioForm.servicio = this.selectedService.codigo;
            this.beneficiarioForm.code = "TB";
            this.isVisibleForm = true;
        },
        async handleSelect(event) {
            let tmpAfiliado = await this.$showTercero(
                event.value,
                "TB",
                this.selectedService.codigo
            );
            this.setForm(tmpAfiliado.data);
            this.isVisibleForm = true;
            this.createOrUpdate = "edit";
            this.$emit("formId", this.beneficiarioForm.id, "beneficiario_id");
        },
        habilitarEdicion() {
            this.errors = {};
            this.createOrUpdate = "update";
            this.isEdit = false;
        },
        handleSelectBanco(event) {
            this.placeholderCuenta = "Número de cuenta";
            var bancosPeru = ["bcp_pen", "interbank_pen", "bbva_pen"];
            let banco = this.optionsBancos.find((item) => {
                return item.id == event.value;
            });
            if (bancosPeru.includes(banco.code)) {
                this.placeholderCuenta = "Código de cuenta interbancario";
            }
        },
        handleTipoC(event) {
            const selectedObj = this.optionsTipoCuenta.find(
                (option) => option.id === event.value
            );
            if (selectedObj) {
                $("#tipoCuentaBeneficiario > .p-dropdown-label").text(
                    selectedObj.valor1
                );
            }
        },
        async add() {
            const isValid = await this.validateForm();
            if (isValid) {
                this.$axios
                    .post("/terceros/store", this.beneficiarioForm)
                    .then(async (response) => {
                        this.$alertSuccess("Añadido");
                        this.initModal();
                        this.resetForm();
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
                        "/terceros/update/" + this.beneficiarioForm.id,
                        this.beneficiarioForm
                    )
                    .then((response) => {
                        this.$alertSuccess("Actualizado");
                        this.initModal();
                        this.createOrUpdate = "edit";
                        this.isEdit = true;
                    })
                    .catch((error) => {
                        this.$readStatusHttp(error);
                    });
            }
        },
        async validateForm() {
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
                documentoBeneficiario: Yup.string()
                    .required("El documento es obligatorio")
                    .min(5, "El documento debe tener al menos 5 caracteres")
                    .max(15, "El documento no debe tener mas de 15 caracteres"),
                tipoCuentaBeneficiario: Yup.string().required(
                    "El tipo banco es obligatorio"
                ),
                bancoBeneficiario: Yup.string().required(
                    "El banco es obligatorio"
                ),
                cuentaBeneficiario: Yup.string().required(
                    "La cuenta es obligatoria"
                ),
                pagoMovilBeneficiario: Yup.string()
                    .nullable()
                    .test(
                        "length-check",
                        "El pago movil debe tener entre 10 y 11 caracteres",
                        (value) =>
                            value === null ||
                            value === undefined ||
                            value === "" ||
                            (value.length >= 10 && value.length <= 11)
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
        setForm(beneficiario) {
            this.beneficiarioForm.id = beneficiario.id;
            this.beneficiarioForm.aliasBeneficiario = beneficiario.alias;
            this.beneficiarioForm.nombreBeneficiario = beneficiario.nombre;
            this.beneficiarioForm.tipoDocumentoBeneficiario = parseInt(
                beneficiario.tipo_documento_id
            );
            this.beneficiarioForm.documentoBeneficiario = parseInt(
                beneficiario.documento
            );
            this.beneficiarioForm.tipoCuentaBeneficiario = parseInt(
                beneficiario.tipo_cuenta_id
            );
            this.beneficiarioForm.bancoBeneficiario = parseInt(
                beneficiario.banco_id
            );
            this.beneficiarioForm.cuentaBeneficiario = beneficiario.cuenta;
            this.beneficiarioForm.pagoMovilBeneficiario =
                beneficiario.pago_movil;
            this.beneficiarioForm.servicio = this.selectedService.codigo;
            this.beneficiarioForm.code = "TB";
        },
        resetForm() {
            this.beneficiarioForm.id = null;
            this.beneficiarioForm.aliasBeneficiario = null;
            this.beneficiarioForm.nombreBeneficiario = null;
            this.beneficiarioForm.tipoDocumentoBeneficiario = null;
            this.beneficiarioForm.documentoBeneficiario = null;
            this.beneficiarioForm.tipoCuentaBeneficiario = null;
            this.beneficiarioForm.bancoBeneficiario = null;
            this.beneficiarioForm.cuentaBeneficiario = null;
            this.beneficiarioForm.pagoMovilBeneficiario = null;
            this.beneficiarioForm.servicio = null;
            this.beneficiarioForm.code = null;
        },
    },
};
</script>
