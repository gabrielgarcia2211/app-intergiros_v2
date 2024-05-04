<template>
    <div class="text-center mt-5">
        <div class="table-responsive">
            <DataTable :value="products" tableStyle="min-width: 50rem">
                <Column field="cantidad" header="Cantidad"></Column>
                <Column field="nombre" header="Nombre"></Column>
                <Column field="costo" header="Costo"></Column>
                <Column field="total" header="Total"></Column>
            </DataTable>
        </div>
    </div>
    <div class="mt-5">
        <div class="row no-gutters">
            <div class="col-6 col-md-8" style="text-align: right">
                <p><strong>Subtotal</strong></p>
                <p><strong>Comisiones</strong></p>
                <p><strong>TOTAL</strong></p>
            </div>
            <div class="col-6 col-md-4" style="text-align: right">
                <p>
                    $
                    <strong
                        ><span
                            v-if="montoCambiar"
                            id="monto_a_pagar"
                            style="display: inline-block"
                            >{{ montoCambiar.monto_a_pagar }}</span
                        >
                        USD</strong
                    >
                </p>
                <p>
                    $
                    <strong
                        ><span
                            v-if="montoCambiar"
                            id="monto_comision"
                            style="display: inline-block"
                            >{{ montoCambiar.monto_comision }}</span
                        >
                        USD</strong
                    >
                </p>
                <p>
                    $
                    <strong
                        ><span
                            v-if="montoCambiar"
                            id="monto_total"
                            style="display: inline-block"
                            >{{ montoCambiar.monto_total }}</span
                        >
                        USD</strong
                    >
                </p>
            </div>
        </div>
    </div>
    <div class="mt-5">
        <h4><strong>Datos del contratante</strong></h4>
        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group">
                    <InputText
                        v-model="depositante.nombreDepositante"
                        placeholder="Nombres y apellidos"
                        class="w-full md:w-14rem input-registro input-readonly"
                        style="width: 100%"
                        :disabled="true"
                    />
                </div>
                <div class="form-group">
                    <InputGroup>
                        <Dropdown
                            v-model="depositante.tipoDocumentoDepositante"
                            :options="optionsDocument"
                            placeholder="TD"
                            optionLabel="name"
                            optionValue="id"
                            style="width: 30%"
                            class="input-indicativo input-readonly"
                            :disabled="true"
                        ></Dropdown>
                        <InputNumber
                            v-model="depositante.documentoDepositante"
                            placeholder="Número documento"
                            class="w-full md:w-14rem input-telefono p-readonly"
                            style="width: 80%"
                            :disabled="true"
                        />
                    </InputGroup>
                </div>
                <div class="form-group">
                    <InputText
                        v-model="depositante.correoDepositante"
                        placeholder="Correo Electronico"
                        class="w-full md:w-14rem input-registro input-readonly"
                        style="width: 100%"
                        :disabled="true"
                    />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group" style="margin-bottom: 16px">
                    <InputGroup>
                        <Dropdown
                            id="codigoIDepositante"
                            v-model="depositante.codigoIDepositante"
                            :options="optionsCodigoI"
                            placeholder="CI"
                            optionLabel="name"
                            optionValue="id"
                            style="width: 30%"
                            class="input-indicativo input-readonly"
                            :disabled="true"
                        ></Dropdown>
                        <InputNumber
                            v-model="depositante.celularDepositante"
                            placeholder="Número celular"
                            class="w-full md:w-14rem input-telefono input-readonly"
                            style="width: 80%"
                            :disabled="true"
                        />
                    </InputGroup>
                </div>
                <div class="form-group">
                    <Dropdown
                        id="selectPais"
                        v-model="depositante.paisDepositante"
                        :options="optionsPais"
                        placeholder="Pais"
                        optionLabel="name"
                        optionValue="id"
                        class="w-full md:w-14rem input-registro input-readonly"
                        style="width: 100%"
                        :disabled="true"
                    />
                </div>
            </div>
        </div>
    </div>
    <div class="text-justify mt-5">
        <p>
            Será redirigido a la página de pago de Paypal una vez dé clic en el
            botón <strong>"Realizar pago".</strong> Después de completar su
            pago, será redirigido a nuestro sitio para completar el envío.
        </p>
    </div>
    <div class="text-center mt-5 mb-5 boton">
        <button
            v-if="depositante.nombreDepositante"
            type="submit"
            class="btn btn-primary mb-2"
            @click="sendPaytoPaypal"
        >
            <strong>Realizar pago</strong>
        </button>
        <div v-else>
            <h3 style="color: red">No Aplica Transacción.</h3>
        </div>
    </div>
</template>

<script>
// Importar Librerias o Modulos

export default {
    props: ["solicitud"],
    data() {
        return {
            products: [],
            montoCambiar: {
                monto_a_pagar: 0,
                monto_comision: 0,
                monto_total: 0,
            },
            depositante: {
                id: null,
                nombreDepositante: "",
                tipoDocumentoDepositante: null,
                documentoDepositante: null,
                correoDepositante: null,
                codigoIDepositante: null,
                celularDepositante: null,
                paisDepositante: null,
            },
            optionsDocument: [],
            optionsCodigoI: [],
            optionsPais: [],
        };
    },
    components: {},
    async created() {
        let response = await this.getSolicitud(this.solicitud);
        this.initSolicitud(response);
        this.initCombos();
    },
    mounted() {},
    methods: {
        async initCombos() {
            const comboNames = ["tipo_documento", "pais_telefono", "pais"];
            const response = await this.$getComboRelations(comboNames);
            const {
                tipo_documento: responseTipoDocumento,
                pais_telefono: responsePaisTelefono,
                pais: responsePais,
            } = response;
            this.optionsDocument = responseTipoDocumento;
            this.optionsCodigoI = responsePaisTelefono;
            this.optionsPais = responsePais;
        },
        initSolicitud(response) {
            let cantidadRevisiones = Math.max(1, response.data.revisiones);
            let costoTotal = cantidadRevisiones * 1;

            var dataTable = [
                {
                    cantidad: 1,
                    nombre: response.data.producto.nombre,
                    costo: response.data.producto.rango_min,
                    total: response.data.producto.rango_min,
                },
                {
                    cantidad: cantidadRevisiones,
                    nombre: "Revision",
                    costo: 1,
                    total: costoTotal,
                },
            ];

            // monto
            this.initMonto(response.data);
            this.initForm(response.data);
            this.products = dataTable;
        },
        initMonto(monto) {
            const montoTotal = parseFloat(monto.monto_a_pagar);
            this.montoCambiar.monto_a_pagar = montoTotal;
            this.montoCambiar.monto_comision = (
                ((montoTotal + 0.3) * 100) / 94.6 -
                montoTotal
            ).toFixed(2);

            this.montoCambiar.monto_total =
                parseFloat(this.montoCambiar.monto_a_pagar) +
                parseFloat(this.montoCambiar.monto_comision);
        },
        initForm(form) {
            this.depositante.nombreDepositante = form.depositante.nombre;
            this.depositante.tipoDocumentoDepositante =
                form.depositante.pais_telefono_id;
            this.depositante.documentoDepositante = parseInt(
                form.depositante.documento
            );
            this.depositante.correoDepositante = form.depositante.correo;
            this.depositante.codigoIDepositante =
                form.depositante.tipo_documento_id;
            this.depositante.celularDepositante = parseInt(
                form.depositante.celular
            );
            this.depositante.paisDepositante = form.depositante.pais_id;
        },
        getSolicitud(id) {
            return new Promise((resolve, reject) => {
                this.$axios
                    .get(`/solicitudes/${id}`)
                    .then(function (response) {
                        resolve(response.data);
                    })
                    .catch((error) => {
                        this.$readStatusHttp(error);
                        reject(error);
                    });
            });
        },
        sendPaytoPaypal() {
            var formData = new FormData();
            formData.append("solicitud_id", this.solicitud);
            this.$swal.fire({
                title: "Cargando...",
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                },
            });
            this.$axios
                .post("/paypal/pay", formData)
                .then((response) => {
                    let info = response.data;
                    this.$swal.close();
                    if (info.success) {
                        window.location.href = info.data.approval_url;
                    } else {
                        window.location.href = info.data.denied_url;
                    }
                })
                .catch((error) => {
                    this.$swal.close();
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
</style>
