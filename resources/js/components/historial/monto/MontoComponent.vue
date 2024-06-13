<template>
    <!-- monto -->
    <div class="col-md-12">
        <div class="text-center mt-4">
            <InputNumber
                v-model="montoBruto"
                class="input-registro"
                :class="{
                    'valor-menor-500': montoBruto < 5,
                }"
                placeholder="Monto a cambiar"
                @input="handleInputChange"
            />
            <small
                v-if="montoBruto < 5 || montoBruto > 500"
                style="display: block; font-size: 16px"
                class="p-error"
            >
                <p v-if="montoBruto < 5">El monto debe ser mayor a 5,00</p>
                <p v-else-if="montoBruto > 500">
                    El monto debe ser menor a 500,00
                </p>
            </small>
            <div class="mt-2">
                <p style="color: #0035aa">
                    <strong style="font-size: 18px">
                        Monto a pagar:
                        <p v-if="montoCambiar" style="display: inline-block">
                            {{ montoCambiar.monto_a_pagar }}
                        </p>
                    </strong>
                </p>
                <p style="color: #0035aa">
                    <strong style="font-size: 18px">
                        Monto a recibir:
                        <p v-if="montoCambiar" style="display: inline-block">
                            {{ montoCambiar.monto_a_recibir }}
                        </p>
                    </strong>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
// Importar Librerias o Modulos

export default {
    props: ["formularioId", "monedaId"],
    emits: ["formMonto"],
    data() {
        return {
            montoCambiar: {
                monto_a_pagar: 0,
                monto_a_recibir: 0,
                monto_a_pagar_comision: 0,
            },
            montoBruto: 0,
            isPay: null,
        };
    },
    watch: {},
    methods: {
        async handleInputChange(event) {
            this.montoBruto = event.value;
            await this.convertService();
            this.validateSendSolicitud();
            this.$emit("formMonto", this.isPay, this.montoCambiar);
        },
        async convertService() {
            const convertidor = await this.$devFormatoMoneda(
                this.formularioId,
                this.monedaId,
                this.montoBruto
            );
            if (convertidor.data) {
                const currncy = convertidor.data;
                this.montoCambiar.monto_a_pagar = currncy.pagar;
                this.montoCambiar.monto_a_recibir = currncy.recibir;
                this.montoCambiar.monto_a_pagar_comision =
                    currncy.pagar_con_comision;
            } else {
                this.montoCambiar.monto_a_pagar = 0;
                this.montoCambiar.monto_a_recibir = 0;
                this.montoCambiar.monto_a_pagar_comision = 0;
            }
        },
        validateSendSolicitud() {
            if (
                this.montoCambiar.monto_a_pagar != null &&
                this.montoCambiar.monto_a_recibir != null &&
                this.montoBruto > 5 &&
                this.montoBruto < 500
            ) {
                this.isPay = true;
            } else {
                this.isPay = false;
            }
        },
    },
};
</script>

<style>
/* Estilos opcionales */
</style>
