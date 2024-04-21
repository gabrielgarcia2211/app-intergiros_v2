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
                        @change="handleSelectMoneda"
                    ></Dropdown>
                </InputGroup>
            </div>
        </div>
        <servicio-paypal-component
            v-if="checkService == 'TP-01' && monedaId"
            :idService="idService"
            :monedaId="monedaId"
        ></servicio-paypal-component>
    </div>
</template>
<script>
// Importar Librerias o Modulos
import PaypalComponent from "./servicios/PaypalComponent.vue";

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
    components: {
        PaypalComponent,
    },
    created() {
        this.initSelects();
    },
    mounted() {},
    methods: {
        handleSelectService(event) {
            this.checkService = null;
            switch (event.value) {
                case 1:
                    this.idService = 1;
                    this.checkService = "TP-01";
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
            this.optionsMonedas = await this.getMonedas();
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
    },
};
</script>

<style></style>
