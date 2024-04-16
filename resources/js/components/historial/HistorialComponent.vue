<template>
    <div class="container notificaciones" style="overflow-y: auto">
        <TabView class="tabview-custom" @tab-change="handleTabStatus">
            <TabPanel>
                <template #header>
                    <div class="flex align-items-center gap-2">
                        <span class="font-bold white-space-nowrap"
                            >EN PROCESO</span
                        >
                    </div>
                </template>
                <ProgressSpinner
                    v-if="loading"
                    style="
                        width: 180px;
                        height: 180px;
                        justify-content: center;
                        display: block;
                    "
                />
                <div v-else-if="solicitudes.length == 0">
                    <div
                        class="d-flex align-items-center justify-content-center mt-4"
                    >
                        <img
                            src="img/notificaciones/Sin mensajes.png"
                            class="img-fluid"
                            alt="not found"
                            width="400px"
                        />
                    </div>
                </div>
                <div
                    v-else
                    v-for="(item, index) in solicitudes"
                    :key="index"
                    class="m-0"
                >
                    <div class="container">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="text-center">
                                    <img
                                        src="img/notificaciones/proceso.png"
                                        class="img-fluid"
                                        alt=""
                                        width="100px"
                                    />
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="text-left">
                                            <p style="margin-bottom: 0px">
                                                ID#{{ item.id }}
                                            </p>
                                            <p style="color: #0035aa">
                                                Pedido en proceso
                                            </p>
                                            <p
                                                style="
                                                    margin-bottom: 0px;
                                                    color: #009d2c;
                                                "
                                            >
                                                Monto pagado
                                            </p>
                                            <p style="color: #009d2c">
                                                USD {{ item.monto_a_pagar }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <p>{{ item.created_at }}</p>
                                            <p
                                                style="
                                                    margin-bottom: 0px;
                                                    color: #009d2c;
                                                "
                                            >
                                                Monto a recibir
                                            </p>
                                            <p style="color: #009d2c">
                                                {{ item.monto_a_recibir }} BS.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <a
                                href="#"
                                @click="toggleCollapse(index)"
                                style="color: #818181"
                            >
                                <i
                                    class="fas fa-chevron-down"
                                    :id="'iconoProceso' + index"
                                ></i>
                            </a>
                        </div>
                    </div>
                    <div :id="'proceso' + index" class="collapse container">
                        <div class="row">
                            <div class="col-6">
                                <div class="text-left">
                                    <p>Tasa de cambio:</p>
                                    <p>Pagado desde:</p>
                                    <p>Enviado por:</p>
                                    <p>Enviado a:</p>
                                    <br />
                                    <button
                                        class="btn btn-primary"
                                        @click="openModalPorSolucionar(item)"
                                    >
                                        Reclamar
                                    </button>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <p>
                                        USD 1 =
                                        {{
                                            item.tipo_formulario.tasa_cambios
                                                .valor
                                        }}
                                        Bs.
                                    </p>
                                    <p>
                                        {{ item.tipo_formulario.descripcion }}
                                    </p>
                                    <p>{{ item.depositante.alias }}</p>
                                    <p>{{ item.beneficiario.alias }}</p>
                                    <p>{{ item.beneficiario.banco }}</p>
                                    <p>V {{ item.beneficiario.cuenta }}</p>
                                    <p>{{ item.beneficiario?.pago_movil }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr v-if="index !== solicitudes.length - 1" />
                </div>
            </TabPanel>
            <TabPanel>
                <template #header>
                    <div class="flex align-items-center gap-2">
                        <span class="font-bold white-space-nowrap"
                            >POR SOLUCIONAR</span
                        >
                    </div>
                </template>
                <p class="m-0">
                    Sed ut perspiciatis unde omnis iste natus error sit
                    voluptatem accusantium doloremque laudantium, totam rem
                    aperiam, eaque ipsa quae ab illo inventore veritatis et
                    quasi architecto beatae vitae dicta sunt explicabo. Nemo
                    enim ipsam voluptatem quia voluptas sit aspernatur aut odit
                    aut fugit, sed quia consequuntur magni dolores eos qui
                    ratione voluptatem sequi nesciunt. Consectetur, adipisci
                    velit, sed quia non numquam eius modi.
                </p>
            </TabPanel>
            <TabPanel>
                <template #header>
                    <div class="flex align-items-center gap-2">
                        <span class="font-bold white-space-nowrap"
                            >PROCESADOS</span
                        >
                    </div>
                </template>
                <p class="m-0">
                    At vero eos et accusamus et iusto odio dignissimos ducimus
                    qui blanditiis praesentium voluptatum deleniti atque
                    corrupti quos dolores et quas molestias excepturi sint
                    occaecati cupiditate non provident, similique sunt in culpa
                    qui officia deserunt mollitia animi, id est laborum et
                    dolorum fuga. Et harum quidem rerum facilis est et expedita
                    distinctio. Nam libero tempore, cum soluta nobis est
                    eligendi optio cumque nihil impedit quo minus.
                </p>
            </TabPanel>
            <TabPanel>
                <template #header>
                    <div class="flex align-items-center gap-2">
                        <span class="font-bold white-space-nowrap"
                            >RECHAZADOS</span
                        >
                    </div>
                </template>
                <p class="m-0">
                    At vero eos et accusamus et iusto odio dignissimos ducimus
                    qui blanditiis praesentium voluptatum deleniti atque
                    corrupti quos dolores et quas molestias excepturi sint
                    occaecati cupiditate non provident, similique sunt in culpa
                    qui officia deserunt mollitia animi, id est laborum et
                    dolorum fuga. Et harum quidem rerum facilis est et expedita
                    distinctio. Nam libero tempore, cum soluta nobis est
                    eligendi optio cumque nihil impedit quo minus.
                </p>
            </TabPanel>
        </TabView>
    </div>

    <!-- openModalPorSolucionar -->
    <Dialog v-model:visible="visibleRS" style="width: 500px">
        <div class="flex align-items-center mb-5">
            <Dropdown
                id="selectedOptionRS"
                v-model="selectedOptionRS"
                :options="optionRS"
                optionLabel="name"
                optionValue="id"
                :placeholder="'Opciones'"
                class="w-full md:w-14rem input-registro"
                style="width: 100%; text-align: left"
                @change="handleReclamoRs"
                showClear
            ></Dropdown>
        </div>
        <div v-if="checkRS.visible">
            <div v-for="item in checkRS.data" :key="item.id" class="form-check">
                <input
                    type="checkbox"
                    class="form-check-input opcion-reclamo-entregado"
                    :id="'option' + item.id"
                    :data-code="item.code"
                    :value="item.id"
                    v-model="formData.opciones"
                />
                <label class="form-check-label" :for="'option' + item.id">{{
                    item.valor1
                }}</label>
            </div>
            <div class="form-group mt-5">
                <label>Escribenos un mensaje (Opcional)</label>
                <Textarea
                    v-model="formData.comentario"
                    rows="5"
                    cols="30"
                    style="width: 100%"
                />
            </div>
        </div>
        <Button
            class="btn-primary"
            :disabled="formData.opciones.length == 0"
            @click="sendReclamo"
            style="
                background-color: transparent;
                border: none;
                font-size: 18px;
                text-align: center;
            "
            >Enviar Reclamo</Button
        >
    </Dialog>
</template>

<script>
// Importar Librerias o Modulos

export default {
    data() {
        return {
            solicitudes: [],
            loading: true,
            solicitudSolucionar: {},
            visibleRS: false,
            optionRS: [{ id: 1, name: "Mi pedido no ha sido procesado" }],
            checkRS: {
                visible: false,
                data: [],
            },
            selectedOptionRS: null,
            /** formulario de envio */
            formData: {
                solicitud_id: null,
                opciones: [],
                comentario: null,
                beneficiario_id: null,
                estadoCuenta: null,
            },
        };
    },
    components: {},
    created() {
        this.handleTabStatus({ index: 0 });
        this.getTypeReclamos();
    },
    mounted() {},
    methods: {
        async handleTabStatus(estado) {
            this.loading = true;
            const tipo = this.mapIndexSolicitud(estado.index);
            this.solicitudes = await this.getSolicitudes(tipo);
            this.loading = false;
        },
        getSolicitudes(estado) {
            return new Promise((resolve, reject) => {
                axios
                    .get(`/historial/solicitudes/${estado}`)
                    .then(function (response) {
                        resolve(response.data.data);
                    })
                    .catch(function (error) {
                        this.loading = false;
                        this.$readStatusHttp(error);
                        reject(error);
                    });
            });
        },
        toggleCollapse(index) {
            const icon = document.getElementById("iconoProceso" + index);
            const collapse = document.getElementById("proceso" + index);
            if (icon.classList.contains("fa-chevron-down")) {
                icon.classList.remove("fa-chevron-down");
                icon.classList.add("fa-chevron-up");
            } else {
                icon.classList.remove("fa-chevron-up");
                icon.classList.add("fa-chevron-down");
            }
            $(collapse).collapse("toggle");
        },
        mapIndexSolicitud(index) {
            let tipo = "";
            switch (index) {
                case 0:
                    tipo = "pendiente";
                    break;
                case 1:
                    tipo = "en_proceso";
                    break;
                case 2:
                    tipo = "entregado";
                    break;
                case 3:
                    tipo = "cancelado";
                    break;
                default:
                    break;
            }

            return tipo;
        },
        openModalPorSolucionar(item) {
            this.resetForm();
            this.visibleRS = true;
            this.formData.solicitud_id = item.id;
        },
        async getTypeReclamos() {
            const comboNames = ["m_reclamo_por_solucionar"];
            const response = await this.$getComboRelations(comboNames);
            const { m_reclamo_por_solucionar: responseReclamo } = response;
            this.checkRS.data = responseReclamo;
        },
        resetForm() {
            this.formData.solicitud_id = null;
            this.formData.opciones = [];
            this.formData.comentario = null;
            this.formData.beneficiario_id = null;
            this.formData.estadoCuenta = null;
            this.checkRS.visible = false;
        },
        handleReclamoRs(event) {
            this.checkRS.visible = event.value == 1 ? true : false;
        },
        sendReclamo() {
            this.$axios
                .post("/historial/store", this.formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((response) => {
                    this.$alertSuccess("Solicitud realizada correctamente");
                    this.visibleRS = false;
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
.p-tabview-header > a {
    text-decoration: none;
}
</style>
