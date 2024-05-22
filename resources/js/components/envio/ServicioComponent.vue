<template>
    <div class="container mt-5" style="margin-bottom: 150px">
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
                        optionLabel="descripcion"
                        optionValue="id"
                        :placeholder="'Selecciona'"
                        class="w-full md:w-14rem"
                        style="width: 100%"
                        @change="handleSelectMoneda"
                        emptyMessage="Desbes seleccionar un formulario"
                    ></Dropdown>
                </InputGroup>
            </div>
        </div>
        <servicio-paypal-component
            v-if="checkService == 'TP-01' && monedaId"
            :idService="idService"
            :monedaId="monedaId"
        ></servicio-paypal-component>
        <servicio-usdt-component
            v-if="checkService == 'TP-02' && monedaId"
            :idService="idService"
            :monedaId="monedaId"
        ></servicio-usdt-component>
        <servicio-zinli-component
            v-if="checkService == 'TP-03' && monedaId"
            :idService="idService"
            :monedaId="monedaId"
        ></servicio-zinli-component>
        <servicio-peru-component
            v-if="checkService == 'TP-04' && monedaId"
            :idService="idService"
            :monedaId="monedaId"
        ></servicio-peru-component>
        <servicio-peru-usd-component
            v-if="checkService == 'TP-05' && monedaId"
            :idService="idService"
            :monedaId="monedaId"
        ></servicio-peru-usd-component>
        <!-- <servicio-colombia-component
            v-if="checkService == 'TP-06' && monedaId"
            :idService="idService"
            :monedaId="monedaId"
            :optionsMonedas="optionsMonedas"
        ></servicio-colombia-component> -->
    </div>
</template>
<script>
// Importar Librerias o Modulos

export default {
    data() {
        return {
            idService: null,
            monedaId: null,
            checkService: null,
            optionsServices: [],
            optionsMonedas: [],
            selectedService: null,
            selectedMoneda: null,
        };
    },
    components: {},
    created() {
        this.initSelects();
    },
    mounted() {},
    methods: {
        async handleSelectService(event) {
            const currentService = this.optionsServices.find(
                (item) => item.id == event.value
            );
            this.idService = null;
            this.checkService = null;
            this.optionsMonedas = null;
            this.selectedMoneda = null;
            this.monedaId = null;
            switch (currentService.codigo) {
                case "TP-01":
                    this.idService = currentService.id;
                    this.checkService = currentService.codigo;
                    this.optionsMonedas = await this.getMonedas();
                    break;
                case "TP-02":
                    this.idService = currentService.id;
                    this.checkService = currentService.codigo;
                    this.optionsMonedas = await this.getMonedas();
                    break;
                case "TP-03":
                    this.idService = currentService.id;
                    this.checkService = currentService.codigo;
                    this.optionsMonedas = await this.getMonedaByCodigo("VES");
                    break;
                case "TP-04":
                    this.idService = currentService.id;
                    this.checkService = currentService.codigo;
                    this.optionsMonedas = await this.getMonedaByCodigo(
                        "VES,COP"
                    );
                    break;
                case "TP-05":
                    this.idService = currentService.id;
                    this.checkService = currentService.codigo;
                    this.optionsMonedas = await this.getMonedaByCodigo(
                        "VES,COP"
                    );
                    break;
                case "TP-06":
                    this.idService = currentService.id;
                    this.checkService = currentService.codigo;
                    this.optionsMonedas = await this.getMonedaByCodigo(
                        "VES,PEN,USD"
                    );
                    break;
                default:
                    break;
            }
        },
        handleSelectMoneda(event) {
            this.monedaId = event.value;
        },
        async initSelects() {
            this.optionsServices = await this.getForms();
        },
        async getForms(principal = 1) {
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
        async getMonedas() {
            return new Promise(async (resolve, reject) => {
                try {
                    const response = await axios.get("/gestion/monedas");
                    resolve(response.data);
                } catch (error) {
                    this.$readStatusHttp(error);
                    reject(error);
                }
            });
        },
        async getMonedaByCodigo(codigo) {
            return new Promise(async (resolve, reject) => {
                try {
                    const response = await axios.get(
                        "/gestion/monedas/" + codigo
                    );
                    resolve(response.data);
                } catch (error) {
                    this.$readStatusHttp(error);
                    reject(error);
                }
            });
        },
    },
};
</script>

<style></style>
