<template>
    <div class="carousel-container">
        <Carousel
            :value="images"
            :numVisible="numVisible"
            :numScroll="numVisible"
            :circular="true"
            :autoplay="true"
            :autoplayInterval="5000"
            :responsiveOptions="responsiveOptions"
        >
            <template #item="slotProps">
                <div class="carousel-data">
                    <img
                        :src="slotProps.data.src"
                        :alt="slotProps.data.alt"
                        class="carousel-image"
                    />
                    <div class="carousel-descriptions">
                        <template
                            v-for="description in slotProps.data.descriptions"
                        >
                            <p>{{ description }}</p>
                        </template>
                    </div>
                </div>
            </template>
        </Carousel>
    </div>
</template>

<script>
export default {
    data() {
        return {
            images: [
                {
                    codigo: "TP-06-VES",
                    src: "img/home/TDC Intergiros - Colombia.png",
                    alt: "Colombia",
                    descriptions: null,
                },
                {
                    codigo: "TP-01-VES",
                    src: "img/home/TDC Intergiros - PayPal.png",
                    alt: "PayPal",
                    descriptions: null,
                },
                {
                    codigo: "N/A",
                    src: "img/home/TDC Intergiros - Skrill.png",
                    alt: "Skrill",
                    descriptions: ["Todos los bancos - 1 USD = 00.00 BS."],
                },
                {
                    codigo: "TP-04-VES",
                    src: "img/home/TDC Intergiros - Perú.png",
                    alt: "Perú",
                    descriptions: null,
                },
                {
                    codigo: "TP-02-VES",
                    src: "img/home/TDC Intergiros - USDT.png",
                    alt: "USDT",
                    descriptions: null,
                },
                {
                    codigo: "TP-03-VES",
                    src: "img/home/TDC Intergiros - Zinli.png",
                    alt: "Zinli",
                    descriptions: null,
                },
            ],
            numVisible: 4,
            responsiveOptions: [
                {
                    breakpoint: "1600px",
                    numVisible: 3,
                    numScroll: 3,
                },
                {
                    breakpoint: "1400px",
                    numVisible: 2,
                    numScroll: 2,
                },
                {
                    breakpoint: "900px",
                    numVisible: 1,
                    numScroll: 1,
                },
            ],
        };
    },
    created() {
        this.setValueTasas();
    },
    mounted() {},
    methods: {
        async setValueTasas() {
            let tasas = await this.getTasas();
            tasas.data.forEach((element) => {
                this.images.find((item) => {
                    if (item.codigo == element.codigo) {
                        item.descriptions = [
                            `Todos los bancos - 1 USD = ${element.valor} BS.`,
                        ];
                    }
                });
            });
        },
        async getTasas() {
            return new Promise(async (resolve, reject) => {
                try {
                    const response = await axios.get("/tasa-cambio/list");
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

<style scoped>
.carousel-container {
    padding-top: 45px;
    background-color: #ededed;
    text-align: center;
}

.carousel-image {
    height: auto;
    max-width: 80%;
}

.carousel-demo {
    text-align: center;
    margin: 2rem auto;
}

.carousel-data {
    text-align: center;
}

.carousel-descriptions {
    margin-top: 10px;
    font-size: 2rm;
    font-family: "Lato", sans-serif !important;
    font-weight: bold;
}
</style>
