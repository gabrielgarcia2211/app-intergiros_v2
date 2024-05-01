<template>
    <Dialog class="pago" v-model:visible="visible" style="width: 50%">
        <template #header>
            <h1>Realizar Pago</h1>
        </template>
        <div class="d-flex">
            <div class="col-5" style="margin-left: 20px">
                <Dropdown
                    id="selectedOptionPago"
                    v-model="isPagoComplet"
                    :options="optionsPago"
                    :optionLabel="optionLabelFunction"
                    optionValue="id"
                    :placeholder="'Opciones'"
                    class="w-full md:w-14rem input-registro"
                    style="width: 100%; text-align: left"
                    @change="handleSelectPago"
                    showClear
                ></Dropdown>
                <div class="referencia">
                    <h5 style="font-weight: bold">Datos de pago disponibles</h5>
                    <div class="row mt-3">
                        <InputGroup>
                            <Button
                                style="
                                    background-color: #fff;
                                    color: black;
                                    border: none;
                                "
                                icon="pi pi-clone"
                                class="input-indicativo"
                                @click="copyContenido(formPago.banco)"
                            />
                            <InputText
                                placeholder="Nombre Cuenta"
                                class="input-telefono"
                                style="width: 100%"
                                v-model="formPago.banco"
                                :disabled="true"
                            />
                        </InputGroup>
                    </div>
                    <div class="row mt-3">
                        <InputGroup>
                            <Button
                                style="
                                    background-color: #fff;
                                    color: black;
                                    border: none;
                                "
                                icon="pi pi-clone"
                                class="input-indicativo"
                                @click="copyContenido(formPago.tipo)"
                            />
                            <InputText
                                placeholder="Tipo Cuenta"
                                class="input-telefono"
                                style="width: 100%"
                                v-model="formPago.tipo"
                                :disabled="true"
                            />
                        </InputGroup>
                    </div>
                    <div class="row mt-3">
                        <InputGroup>
                            <Button
                                style="
                                    background-color: #fff;
                                    color: black;
                                    border: none;
                                "
                                icon="pi pi-clone"
                                class="input-indicativo"
                                @click="copyContenido(formPago.titular)"
                            />
                            <InputText
                                placeholder="Titular Cuenta"
                                class="input-telefono"
                                style="width: 100%"
                                v-model="formPago.titular"
                                :disabled="true"
                            />
                        </InputGroup>
                    </div>
                    <div class="row mt-3">
                        <Textarea
                            v-if="formPago.otros"
                            v-model="formPago.otros"
                            variant="filled"
                            rows="5"
                            cols="30"
                        />
                    </div>
                </div>
            </div>
            <div class="col-7" style="margin-top: 120px">
                <div style="padding: 10px">
                    <div class="content-imagen">
                        <Image
                            v-if="pathComprobante"
                            :src="pathComprobante"
                            alt="Image"
                            width="100%"
                            height="430px"
                            preview
                        />
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12" style="text-align: center; font-size: 16px">
                <p>
                    Seleccione la cuenta de pago para obtener los datos de pago
                    disponibles para su selección. Tome de referencia el ejemplo
                    de comprobante, realice el pago y adjunte el comprobante del
                    pago realizado
                </p>
            </div>
        </div>
        <div class="row mt-5 mb-2" style="justify-content: center">
            <div class="text-center mt-4">
                <FileUpload
                    v-if="!pathComprobante"
                    ref="fileUpload"
                    chooseLabel="Adjuntar Documento"
                    mode="basic"
                    accept="image/*"
                    @change="onFileUpload"
                />
                <i
                    v-else
                    class="pi pi-times"
                    style="
                        font-size: 1.5rem;
                        background-color: #0035aa;
                        padding: 10px;
                        border-radius: 10px;
                        color: white;
                        cursor: pointer;
                    "
                    @click="clearImageUpload"
                ></i>
            </div>
        </div>
        <template #footer>
            <div class="text-center">
                <Button
                    type="button"
                    class="btn-pago btn btn-primary mr-4"
                    style="background-color: #0035aa !important"
                    :disabled="!this.pathComprobante"
                    @click="savePago"
                    >Guardar</Button
                >
                <Button
                    type="button"
                    class="btn-pago cancel btn btn-secondary"
                    @click="handleDialogClose"
                    >Cancelar</Button
                >
            </div>
        </template>
    </Dialog>
</template>

<script>
// Importar Librerias o Modulos

export default {
    props: ["isRealizarPago", "idService", "monedaId"],
    watch: {
        isRealizarPago(value) {
            this.visible = value;
        },
        idService() {
            this.loadReferencias();
        },
        monedaId() {
            this.loadReferencias();
        },
    },
    data() {
        return {
            visible: false,
            isPagoComplet: null,
            pathComprobante: null,
            pathSavedComprobante: null,
            optionsPago: [],
            formPago: {
                banco: null,
                tipo: null,
                titular: null,
                otros: null,
            },
        };
    },
    components: {},
    mounted() {},
    created() {
        this.loadReferencias();
    },
    methods: {
        onFileUpload() {
            let file = this.$refs.fileUpload;
            if (file) {
                const fileUpload = file.files[0];
                if (fileUpload) {
                    this.pathComprobante = fileUpload.objectURL;
                }
                if (fileUpload.type && fileUpload.type.startsWith("image/")) {
                    this.pathSavedComprobante = fileUpload;
                }
            }
        },
        clearImageUpload() {
            this.pathComprobante = null;
            this.pathSavedComprobante = null;
            this.$emit("savePago", this.pathSavedComprobante);
        },
        async copyContenido(value) {
            await navigator.clipboard.writeText(value);
            this.$swal.fire({
                position: "top-end",
                icon: "info",
                title: "Elemento copiado!",
                showConfirmButton: false,
                timer: 800,
                backdrop: false ,
                customClass: {
                    container: "custom-swal-container",
                    popup: "custom-swal-popup small-popup",
                },
                width: '10rem',
                heightAuto: false
            });
        },
        handleDialogClose() {
            this.visible = false;
            this.$emit("hidden", this.visible);
        },
        loadReferencias() {
            if (this.idService && this.monedaId) {
                this.$axios
                    .post("/referencias/list", {
                        tipo_formulario_id: this.idService,
                        tipo_moneda_id: this.monedaId,
                    })
                    .then((response) => {
                        this.optionsPago = response.data.data;
                    })
                    .catch((error) => {
                        this.$readStatusHttp(error);
                    });
            }
        },
        handleSelectPago(event) {
            this.resetForm();
            const response = this.optionsPago.find(
                (item) => item.id == event.value
            );
            if (response) {
                this.formPago.banco = response.banco;
                this.formPago.tipo = response.tipo ?? "N/A";
                this.formPago.titular = response.titular ?? "N/A";
                if (response.especial) {
                    this.formPago.otros = this.formattedJSON(
                        JSON.parse(response.otros)
                    );
                }
            }
        },
        formattedJSON(jsonData) {
            let formattedText = "";
            for (const key in jsonData) {
                if (Object.hasOwnProperty.call(jsonData, key)) {
                    formattedText += `${key} : ${jsonData[key]} \n`;
                }
            }
            return formattedText;
        },
        resetForm() {
            this.formPago.banco = null;
            this.formPago.tipo = null;
            this.formPago.titular = null;
            this.formPago.otros = null;
        },
        optionLabelFunction(option) {
            let tipo = option.tipo;
            if (tipo == null || tipo == "null") {
                tipo = "Otros";
            }
            return `${option.banco} - ${tipo}`;
        },
        savePago() {
            this.$emit("savePago", this.pathSavedComprobante);
            this.handleDialogClose();
        },
    },
};
</script>

<style>
.pago .p-dialog-content {
    background-color: #e9e6e6 !important;
}

.pago > .p-dialog-header [data-pc-section="closebuttonicon"] {
    display: none !important;
}

.pago > .p-dialog-header {
    justify-content: center !important;
}

.content-imagen {
    padding: 10px;
    background-color: white;
    width: 100%;
    height: 450px !important;
    object-fit: cover;
}

.referencia {
    text-align: center;
    margin-top: 100px;
    margin-bottom: 100px;
}

.btn-pago {
    font-size: 20px;
    background-color: #0035aa;
    border-radius: 25px;
    font-family: "Lato", sans-serif !important;
    width: 200px;
}

.cancel {
    background-color: #777777;
}

.pago > .p-dialog-footer {
    justify-content: center;
}

.small-popup {
  font-size: 10px !important;
}
</style>
