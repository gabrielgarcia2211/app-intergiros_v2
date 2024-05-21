<template>
    <div class="container login">
        <div id="div1">
            <div class="row justify-content-center">
                <div class="col-3">
                    <div class="col-3 text-center">
                        <a
                            v-if="isVisibleForm > 1 && isVisibleForm != 5"
                            href="#"
                            @click="isVisibleForm--"
                            class="atras"
                            ><i class="fas fa-solid fa-chevron-left"></i
                            ><b>Atrás</b></a
                        >
                    </div>
                </div>
                <div class="col">
                    <div class="timeline">
                        <div class="circle" id="circle1">1</div>
                        <div class="line"></div>
                        <div class="circle" id="circle2">2</div>
                        <div class="line"></div>
                        <div class="circle" id="circle3">3</div>
                        <div class="line"></div>
                        <div class="circle" id="circle4">4</div>
                    </div>
                </div>
                <div class="col-3">
                    <p
                        v-if="isVisibleForm == 3"
                        style="font-size: 20px; color: #a7a6a6"
                    >
                        ¡Ya casi terminamos!
                    </p>
                </div>
            </div>
            <hr />
            <form id="formInfoGeneral" v-if="isVisibleForm == 1">
                <div class="text-center mt-5">
                    <h5><strong>Suminístranos tus datos personales</strong></h5>
                </div>
                <div class="row mt-5">
                    <div class="col-md-6" style="text-align: center">
                        <div class="form-group">
                            <InputText
                                v-model="registroForm.nombre"
                                placeholder="Nombre"
                                class="w-full md:w-14rem input-registro"
                                style="width: 80%"
                                :class="{
                                    'p-invalid': errors.nombre,
                                }"
                            />
                            <small
                                v-if="errors.nombre"
                                style="display: block"
                                class="p-error"
                                >{{ errors.nombre }}</small
                            >
                        </div>
                        <div class="form-group">
                            <InputText
                                v-model="registroForm.correo"
                                placeholder="Correo Electronico"
                                class="w-full md:w-14rem input-registro"
                                style="width: 80%"
                                :class="{
                                    'p-invalid': errors.correo,
                                }"
                            />
                            <small
                                v-if="errors.correo"
                                style="display: block"
                                class="p-error"
                                >{{ errors.correo }}</small
                            >
                        </div>
                        <div class="form-group">
                            <Dropdown
                                id="selectPais"
                                v-model="registroForm.pais"
                                :options="optionsPais"
                                placeholder="Pais"
                                optionLabel="name"
                                optionValue="id"
                                class="w-full md:w-14rem input-registro"
                                style="width: 80%; text-align: left"
                                :class="{
                                    'p-invalid': errors.pais,
                                }"
                                filter
                            />
                            <small
                                v-if="errors.pais"
                                style="display: block"
                                class="p-error"
                                >{{ errors.pais }}</small
                            >
                        </div>
                    </div>
                    <div class="col-md-6" style="text-align: center">
                        <div class="form-group">
                            <InputText
                                v-model="registroForm.apellido"
                                placeholder="Apellido(s)"
                                class="w-full md:w-14rem input-registro"
                                style="width: 80%"
                                :class="{
                                    'p-invalid': errors.apellido,
                                }"
                            />
                            <small
                                v-if="errors.apellido"
                                style="display: block"
                                class="p-error"
                                >{{ errors.apellido }}</small
                            >
                        </div>
                        <div
                            class="form-group"
                            style="width: 80%; display: inline-block"
                        >
                            <InputGroup>
                                <Dropdown
                                    id="tipoIndicativo"
                                    v-model="registroForm.tipoCelular"
                                    :options="optionsCodigoI"
                                    placeholder="+"
                                    :optionLabel="optionLabelFunction"
                                    optionValue="id"
                                    style="width: 31%"
                                    class="input-indicativo"
                                    :class="{
                                        'p-invalid': errors.tipoCelular,
                                    }"
                                    filter
                                    @change="handleCodigoI"
                                ></Dropdown>
                                <InputNumber
                                    id=""
                                    v-model="registroForm.celular"
                                    placeholder="Número celular"
                                    class="input-telefono"
                                    style="width: 80%"
                                    :useGrouping="false"
                                    :class="{
                                        'p-invalid': errors.celular,
                                    }"
                                />
                            </InputGroup>
                            <small
                                v-if="errors.celular"
                                style="display: block"
                                class="p-error"
                                >{{ errors.celular }}</small
                            >
                        </div>
                        <div class="form-group" style="text-align: center">
                            <Calendar
                                v-model="registroForm.fehaNacimiento"
                                placeholder="Fecha de nacimiento"
                                class="input-registro"
                                style="width: 80%"
                                :class="{
                                    'p-invalid': errors.fehaNacimiento,
                                }"
                                :manualInput="false"
                                :minDate="minDate"
                                :maxDate="maxDate"
                            />
                            <small
                                v-if="errors.fehaNacimiento"
                                style="display: block"
                                class="p-error"
                                >{{ errors.fehaNacimiento }}</small
                            >
                        </div>
                    </div>
                </div>
                <br />
                <div class="text-center mt-5 button">
                    <button
                        type="button"
                        class="btn btn-primary mb-2"
                        @click="checkInfo('general')"
                    >
                        Continuar
                    </button>
                </div>
            </form>
            <form id="formPassword" v-if="isVisibleForm == 2">
                <div class="text-center mt-5">
                    <h5><strong>Crea tu contraseña</strong></h5>
                </div>
                <br />
                <br />
                <div class="form-row mt-1" style="text-align: center">
                    <div class="form-group col-md-6">
                        <div class="input-group">
                            <input
                                v-model="registroForm.password"
                                type="password"
                                class="form-control"
                                name="inputPassword1"
                                id="inputPassword1"
                                :class="{
                                    'is-invalid': errors.password,
                                }"
                                placeholder="Contraseña"
                            />
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i
                                        class="fa fa-eye toggle-password1"
                                        data-toggle="inputPassword1"
                                        @click="
                                            togglePasswordVisibility(
                                                'inputPassword1',
                                                'toggle-password1'
                                            )
                                        "
                                    ></i>
                                </span>
                            </div>
                        </div>
                        <small
                            v-if="errors.password"
                            style="display: block"
                            class="p-error"
                            >{{ errors.password }}</small
                        >
                    </div>
                    <div class="form-group col-md-6" style="text-align: center">
                        <div class="input-group">
                            <input
                                v-model="registroForm.confirmPassword"
                                type="password"
                                class="form-control"
                                name="inputPassword2"
                                id="inputPassword2"
                                :class="{
                                    'is-invalid': errors.confirmPassword,
                                }"
                                placeholder="Confirma la contraseña"
                            />
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i
                                        class="fa fa-eye toggle-password2"
                                        data-toggle="inputPassword2"
                                        @click="
                                            togglePasswordVisibility(
                                                'inputPassword2',
                                                'toggle-password2'
                                            )
                                        "
                                    ></i>
                                </span>
                            </div>
                        </div>
                        <small
                            v-if="errors.confirmPassword"
                            style="display: block"
                            class="p-error"
                            >{{ errors.confirmPassword }}</small
                        >
                    </div>
                </div>
                <br />
                <div class="text-center mt-5 button">
                    <button
                        type="button"
                        class="btn btn-primary mb-2"
                        @click="checkInfo('password')"
                    >
                        Continuar
                    </button>
                </div>
            </form>
            <form id="formRedes" v-if="isVisibleForm == 3">
                <div class="text-center mt-5">
                    <h5>
                        <strong
                            >¿Por cuáles otras vías podemos contactarte?</strong
                        >
                    </h5>
                </div>
                <div class="form-row mt-5" style="text-align: center">
                    <div class="col-md-6">
                        <div class="form-group">
                            <Dropdown
                                id="selectedOptionRedes"
                                v-model="registroForm.red1"
                                :options="optionsRedes"
                                optionLabel="name"
                                optionValue="id"
                                :placeholder="'Opciones'"
                                class="w-full md:w-14rem input-registro"
                                style="width: 100%; text-align: left"
                                @change="handleRed($event, 'uno')"
                                showClear
                            ></Dropdown>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <InputText
                                v-model="registroForm.nombreRed1"
                                placeholder="Nombre"
                                class="w-full md:w-14rem input-registro"
                                style="width: 80%"
                                :class="{
                                    'p-invalid': errors.nombreRed1,
                                }"
                            />
                            <small
                                v-if="errors.nombreRed1"
                                style="display: block"
                                class="p-error"
                                >{{ errors.nombreRed1 }}</small
                            >
                        </div>
                    </div>
                </div>
                <div id="otroP" v-if="isVisibleRed2">
                    <div class="form-row" style="text-align: center">
                        <div class="col-md-6">
                            <div class="form-group">
                                <Dropdown
                                    id="selectedOptionRedes"
                                    v-model="registroForm.red2"
                                    :options="optionsRedes"
                                    optionLabel="name"
                                    optionValue="id"
                                    :placeholder="'Opciones'"
                                    class="w-full md:w-14rem input-registro"
                                    style="width: 100%; text-align: left"
                                    @change="handleRed($event, 'dos')"
                                    showClear
                                ></Dropdown>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <InputText
                                    v-model="registroForm.nombreRed2"
                                    placeholder="Nombre"
                                    class="w-full md:w-14rem input-registro"
                                    style="width: 80%"
                                    :class="{
                                        'p-invalid': errors.nombreRed2,
                                    }"
                                />
                                <small
                                    v-if="errors.nombreRed2"
                                    style="display: block"
                                    class="p-error"
                                    >{{ errors.nombreRed2 }}</small
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <a
                        href="#"
                        v-if="!isVisibleRed2"
                        @click="addRed()"
                        id="agregar"
                        ><i class="fas fa-plus"></i> Agregar otro</a
                    >
                </div>
                <br />
                <div class="text-center mt-5 button">
                    <button
                        type="button"
                        class="btn btn-primary mb-2"
                        @click="checkInfo('redes')"
                    >
                        Continuar
                    </button>
                </div>
            </form>
            <form id="formVerificacion" v-if="isVisibleForm == 4">
                <div class="text-center mt-5">
                    <h5><strong>Verifica tu identidad</strong></h5>
                    <h5>
                        <strong
                            >¡Ayúdanos a que todo el proceso sea más
                            seguro!</strong
                        >
                    </h5>
                </div>
                <div class="row mt-5" style="text-align: center">
                    <div class="col-md-6">
                        <div
                            class="form-group"
                            style="width: 80%; display: inline-block"
                        >
                            <InputGroup>
                                <Dropdown
                                    id="tipoDocumento"
                                    v-model="registroForm.tipoDocumento"
                                    :options="optionsDocument"
                                    placeholder="TD"
                                    :optionLabel="'name'"
                                    optionValue="id"
                                    class="input-indicativo"
                                    style="width: 30%; text-align: left"
                                    :class="{
                                        'p-invalid': errors.tipoDocumento,
                                    }"
                                    filter
                                ></Dropdown>
                                <InputNumber
                                    id=""
                                    v-model="registroForm.documento"
                                    placeholder="Número documento"
                                    class="w-full md:w-14rem input-telefono"
                                    style="width: 80%"
                                    :class="{
                                        'p-invalid': errors.documento,
                                    }"
                                />
                            </InputGroup>
                            <small
                                v-if="errors.documento"
                                style="display: block"
                                class="p-error"
                                >{{ errors.documento }}</small
                            >
                        </div>
                        <div class="mt-3">
                            <div
                                class="form-group file-selfie"
                                style="width: 80%; display: inline-block"
                            >
                                <h5>Adjuntar Selfie</h5>
                                <FileUpload
                                    id="adjuntarDocumento"
                                    ref="fileUpload1"
                                    accept="image/*"
                                    :multiple="false"
                                    :fileLimit="1"
                                    :class="{
                                        'p-invalid': errors.inputGroupFile01,
                                    }"
                                    @change="onFileUpload('1')"
                                >
                                    <template #empty>
                                        <p>Adjuntar Selfie.</p>
                                    </template>
                                    <template
                                        #content="{ files, removeFileCallback }"
                                    >
                                        <div
                                            v-if="files.length > 0"
                                            class="image-container"
                                        >
                                            <img
                                                v-if="
                                                    registroForm.inputGroupFile01
                                                "
                                                :src="
                                                    registroForm
                                                        .inputGroupFile01
                                                        .objectURL
                                                "
                                                alt="Uploaded Image"
                                                class="uploaded-image"
                                                style="
                                                    width: 400px;
                                                    height: 320px;
                                                "
                                                @click="openModal"
                                            />
                                            <button
                                                @click="
                                                    removeFile(
                                                        files[0],
                                                        removeFileCallback
                                                    )
                                                "
                                                class="remove-button"
                                                v-if="
                                                    registroForm.inputGroupFile01
                                                "
                                            >
                                                Eliminar
                                            </button>
                                        </div>
                                    </template>
                                </FileUpload>

                                <small
                                    v-if="errors.inputGroupFile01"
                                    style="display: block"
                                    class="p-error"
                                    >{{ errors.inputGroupFile01 }}</small
                                >
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <h6>
                                Tomate una foto tipo selfie con el documento de
                                identidad en la mano.
                            </h6>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div
                            class="form-group"
                            style="width: 80%; display: inline-block"
                        >
                            <h5>Adjuntar Documento</h5>
                            <FileUpload
                                id="adjuntarDocumento"
                                ref="fileUpload2"
                                accept="image/*"
                                :multiple="false"
                                :fileLimit="1"
                                :class="{
                                    'p-invalid': errors.inputGroupFile02,
                                }"
                                @change="onFileUpload('2')"
                            >
                                <template #empty>
                                    <p>Adjuntar foto del documento.</p>
                                </template>
                            </FileUpload>
                            <small
                                v-if="errors.inputGroupFile02"
                                style="display: block"
                                class="p-error"
                                >{{ errors.inputGroupFile02 }}</small
                            >
                        </div>
                    </div>
                </div>
                <br />
                <div class="text-center mt-5 button">
                    <button
                        type="button"
                        class="btn btn-primary mb-2"
                        @click="checkInfo('verificacion')"
                    >
                        Continuar
                    </button>
                </div>
                <div class="text-center">
                    <a href="#" class="atras" @click="showOmitir(true)"
                        >Omitir por ahora</a
                    >
                </div>
            </form>
            <div v-if="isVisibleForm == 5">
                <br />
                <div class="text-center mt-5">
                    <i class="fas fa-check fa-7x"></i>
                    <br />
                    <h2 id="miH2">
                        <strong>
                            {{ registroForm.nombre }}
                            {{ registroForm.apellido }}
                        </strong>
                    </h2>
                    <h4>
                        <strong
                            >¡Te damos la bienvenida a la familia
                            Intergiros!</strong
                        >
                    </h4>
                    <br /><br />
                    <h4>Cuéntanos qué deseas hacer</h4>
                </div>
                <div class="form-row mt-5">
                    <div class="col-md-4 button text-center">
                        <a
                            class="btn btn-primary mb-2"
                            href="#"
                            @click="showContactar"
                            >Contactarnos</a
                        >
                    </div>
                    <div class="col-md-4 button text-center">
                        <a class="btn btn-primary mb-2" href="/perfil"
                            >Ver mi perfil</a
                        >
                    </div>
                    <div class="col-md-4 button text-center">
                        <a class="btn btn-primary mb-2" href="/servicios"
                            >Ir al panel de envios</a
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>

    <Dialog v-model:visible="isOmitir" style="width: 600px">
        <template #header>
            <h1>Omitir este paso</h1>
        </template>
        <div class="text-center">
            <i class="fas fa-bell fa-3x" style="color: #0035aa"></i>
        </div>
        <div>
            Si omites este paso ahora, podrás completarlo en otro momento, crear
            tu usuario y acceder a él,
            <strong>pero no podrás realizar pedidos</strong>
        </div>
        <template #footer
            ><Button
                class="btn-primary"
                style="
                    font-size: 18px;
                    text-align: center;
                    border-radius: 25px;
                    background-color: #0035aa;
                "
                @click="checkInfo('omitir_verificacion')"
                >Omitir y continuar</Button
            >
            <Button
                class="btn-primary"
                style="
                    font-size: 18px;
                    text-align: center;
                    border-radius: 25px;
                    background-color: #0035aa;
                "
                @click="showOmitir(false)"
                >Ir Atras</Button
            >
        </template>
    </Dialog>

    <Dialog v-model:visible="isContact" style="width: 450px">
        <div style="text-align: center; font-size: 20px;padding: 20px">
            Selecciona la plataforma a la cual deseas contactarnos
        </div>
        <template #footer>
            <a
                class="btn-primary"
                style="
                    font-size: 18px;
                    text-align: center;
                    border-radius: 25px;
                    background-color: #0035aa;
                    display: inline-block;
                    padding: 10px 20px;
                    color: white !important;
                    text-decoration: none;
                "
                href="https://www.facebook.com/intergiros.oficial"
                target="_blank"
                >Facebook</a
            >
            <a
                class="btn-primary"
                style="
                    font-size: 18px;
                    text-align: center;
                    border-radius: 25px;
                    background-color: #0035aa;
                    display: inline-block;
                    padding: 10px 20px;
                    color: white !important;
                    text-decoration: none;
                "
                href="https://www.instagram.com/intergiros.oficial"
                target="_blank"
                >Instagram
            </a>
        </template>
    </Dialog>
</template>
<script>
// Importar Librerias o Modulos
import * as Yup from "yup";
import { ref } from "vue";

const validDomains = [
    "hotmail.com",
    "gmail.com",
    "outlook.com",
    "yahoo.es",
    "yahoo.com",
];

export default {
    data() {
        return {
            optionsDocument: [],
            optionsCodigoI: [],
            optionsRedes: [],
            optionsPais: [],
            registroForm: {
                nombre: null,
                apellido: null,
                correo: null,
                pais: null,
                celular: null,
                tipoCelular: null,
                documento: null,
                tipoDocumento: null,
                fehaNacimiento: null,
                password: null,
                confirmPassword: null,
                red1: null,
                nombreRed1: null,
                red2: null,
                nombreRed2: null,
                inputGroupFile01: null,
                inputGroupFile02: null,
            },
            isVisibleForm: 5,
            selectedOptionRedes: null,
            errors: {},
            dynamicRulesRed: {},
            dynamicRulesVerificacion: {},
            isVisibleRed2: false,
            isOmitir: false,
            isContact: false,
        };
    },
    components: {},
    watch: {
        isVisibleForm: function (value) {
            this.renderColorCheck();
        },
    },
    created() {
        this.initCombos();
    },
    mounted() {},
    methods: {
        async initCombos() {
            const comboNames = [
                "tipo_documento_registro",
                "pais_telefono",
                "pais",
                "redes",
            ];
            const response = await this.$getComboRelations(comboNames);
            const {
                tipo_documento_registro: responseTipoDocumento,
                pais_telefono: responsePaisTelefono,
                redes: responseRedes,
                pais: responsePais,
            } = response;

            this.optionsDocument = responseTipoDocumento;
            this.optionsCodigoI = responsePaisTelefono;
            this.optionsRedes = responseRedes;
            this.optionsPais = responsePais;
        },
        async validateFormInfoGeneral() {
            const schema = Yup.object().shape({
                nombre: Yup.string()
                    .required("El nombre es obligatorio")
                    .min(3, "El nombre debe tener al menos 3 caracteres")
                    .max(20, "El nombre no debe tener mas de 20 caracteres"),
                apellido: Yup.string()
                    .required("El apellido es obligatorio")
                    .min(3, "El apellido debe tener al menos 3 caracteres")
                    .max(20, "El apellido no debe tener mas de 20 caracteres"),
                correo: Yup.string()
                    .email("El formato del correo electrónico no es válido")
                    .required("El beneficiario es obligatorio")
                    .test(
                        "is-valid-domain",
                        "El dominio del correo electrónico no es válido",
                        (value) => {
                            if (!value) return true;
                            const domain = value.split("@")[1];
                            return validDomains.includes(domain.toLowerCase());
                        }
                    ),
                pais: Yup.string().required("El pais es obligatorio"),
                tipoCelular: Yup.string().required(
                    "El numero indicativo es obligatorio"
                ),
                celular: Yup.string().required("El celular es obligatorio"),
                fehaNacimiento: Yup.string().required(
                    "La fecha de naciemiento es obligatoria"
                ),
            });
            return this.initSchemaValidate(schema);
        },
        async validateFormPassword() {
            const schema = Yup.object().shape({
                password: Yup.string()
                    .required("La contraseña es obligatoria")
                    .min(8, "La contraseña debe tener al menos 8 caracteres"),
                confirmPassword: Yup.string()
                    .required("La confirmación de contraseña es obligatoria")
                    .oneOf(
                        [Yup.ref("password"), null],
                        "Las contraseñas deben coincidir"
                    ),
            });
            return this.initSchemaValidate(schema);
        },
        async validateFormRedes() {
            const schema = Yup.object().shape({ ...this.dynamicRulesRed });
            return this.initSchemaValidate(schema);
        },
        async validateFormVerificacion() {
            const schema = Yup.object().shape({
                ...this.dynamicRulesVerificacion,
            });

            return this.initSchemaValidate(schema);
        },
        async initSchemaValidate(schema) {
            this.errors = {};
            try {
                await schema.validate(this.registroForm, {
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
        async checkInfo(tipo) {
            let isValid = null;
            switch (tipo) {
                case "general":
                    isValid = await this.validateFormInfoGeneral();
                    break;
                case "password":
                    isValid = await this.validateFormPassword();
                    break;
                case "redes":
                    isValid = await this.validateFormRedes();
                    if (!this.dynamicRulesRed.nombreRed1) {
                        this.registroForm.red1 = null;
                        this.registroForm.nombreRed1 = null;
                    }
                    if (!this.dynamicRulesRed.nombreRed2) {
                        this.registroForm.red2 = null;
                        this.registroForm.nombreRed2 = null;
                    }
                    break;
                case "verificacion":
                    this.dynamicRulesVerificacion.documento = Yup.string()
                        .required("El documento es obligatorio")
                        .min(5, "El documento debe tener al menos 5 caracteres")
                        .max(
                            15,
                            "El documento no debe tener mas de 15 caracteres"
                        );
                    this.dynamicRulesVerificacion.tipoDocumento =
                        Yup.string().required(
                            "El tipo documento es obligatorio"
                        );
                    this.dynamicRulesVerificacion.inputGroupFile01 =
                        Yup.string().required("La selfie es obligatoria");
                    this.dynamicRulesVerificacion.inputGroupFile02 =
                        Yup.string().required(
                            "La foto del documento es obligatoria"
                        );
                    isValid = await this.validateFormVerificacion();
                    break;
                case "omitir_verificacion":
                    delete this.dynamicRulesVerificacion.documento;
                    delete this.dynamicRulesVerificacion.tipoDocumento;
                    delete this.dynamicRulesVerificacion.inputGroupFile01;
                    delete this.dynamicRulesVerificacion.inputGroupFile02;
                    isValid = await this.validateFormVerificacion();
                    break;
                default:
                    break;
            }
            if (isValid) {
                this.isVisibleForm++;
                if (this.isVisibleForm == 5) {
                    this.isOmitir = false;
                    this.addUsuario();
                }
            }
        },
        showOmitir(value) {
            this.isOmitir = value;
        },
        handleRed(event, tipo) {
            if (tipo == "uno") {
                if (event.value) {
                    this.dynamicRulesRed.nombreRed1 = Yup.string().required(
                        "Nombre de usuario es obligatorio"
                    );
                } else {
                    delete this.dynamicRulesRed.nombreRed1;
                }
            }
            if (tipo == "dos") {
                if (event.value) {
                    this.dynamicRulesRed.nombreRed2 = Yup.string().required(
                        "Nombre de usuario es obligatorio"
                    );
                } else {
                    delete this.dynamicRulesRed.nombreRed2;
                }
            }
        },
        handleCodigoI(event) {
            const selectedObj = this.optionsCodigoI.find(
                (option) => option.id === event.value
            );
            if (selectedObj) {
                $("#tipoIndicativo > .p-dropdown-label").text(selectedObj.name);
            }
        },
        optionLabelFunction(option) {
            return `${option.name} - ${option.valor1}`;
        },
        togglePasswordVisibility(inputId, toggle) {
            var passwordField = document.getElementById(inputId);
            var toggleIcon = document.querySelector("." + toggle);

            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        },
        showContactar() {
            this.isContact = true;
        },
        addRed() {
            this.isVisibleRed2 = true;
        },
        addUsuario() {
            this.$axios
                .post("/registro", this.registroForm, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((response) => {
                    this.$alertSuccess("Usuario añadido correctamente");
                })
                .catch((error) => {
                    this.isVisibleForm--;
                    this.$readStatusHttp(error);
                });
        },
        onFileUpload(tipo) {
            const adjFile =
                tipo == 1 ? this.$refs.fileUpload1 : this.$refs.fileUpload2;
            const fileUploadComponent = adjFile;
            if (fileUploadComponent) {
                const file = fileUploadComponent.files[0];
                if (file) {
                    if (file.type && file.type.startsWith("image/")) {
                        if (tipo == 1) {
                            this.registroForm.inputGroupFile01 = file;
                        } else {
                            this.registroForm.inputGroupFile02 = file;
                        }
                    }
                }
            }
        },
        removeFile(file, removeFileCallback) {
            this.registroForm.inputGroupFile01 = null;
            removeFileCallback(file);
        },
        renderColorCheck() {
            this.renderColorInit();
            let posiciones = this.isVisibleForm;
            for (let index = 1; index < posiciones; index++) {
                $("#circle" + index).css({
                    "background-color": "#0035aa",
                    color: "white",
                });
            }
        },
        renderColorInit() {
            for (let index = 1; index < 4; index++) {
                $("#circle" + index).css({
                    "background-color": "#ededed",
                    color: "#0035aa",
                });
            }
        },
    },
    setup() {
        const date = ref(null);
        const minDate = ref(new Date(1930, 0, 1));
        const maxDate = ref(new Date(2008, 11, 31));

        return { date, minDate, maxDate };
    },
};
</script>

<style>
.file-selfie .image-container {
    position: relative;
}

.file-selfie .uploaded-image {
    cursor: pointer;
    max-width: 100%;
    height: auto;
}

.file-selfie .remove-button {
    position: absolute;
    bottom: 5px;
    left: 50%;
    transform: translateX(-50%);
    padding: 5px 10px;
    background-color: #dc3545;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.file-selfie .remove-button:hover {
    background-color: #c82333;
}
</style>
