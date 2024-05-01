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
                    src: "img/home/TDC Intergiros - Bitcoin.png",
                    alt: "Bitcoin",
                    descriptions: ["Todos los bancos - 1 USD=31,00 BS."],
                },
                {
                    src: "img/home/TDC Intergiros - Colombia.png",
                    alt: "Colombia",
                    descriptions: [
                        "Banesco - 1 USD=31,03 BS.",
                        "Otros bancos - 1 USD=31,00 BS.",
                    ],
                },
                {
                    src: "img/home/TDC Intergiros - PayPal.png",
                    alt: "PayPal",
                    descriptions: ["Todos los bancos - 1 USD=31,00 BS."],
                },
                {
                    src: "img/home/TDC Intergiros - Skrill.png",
                    alt: "Skrill",
                    descriptions: ["Todos los bancos - 1 USD=31,00 BS."],
                },
                {
                    src: "img/home/TDC Intergiros - Perú.png",
                    alt: "Perú",
                    descriptions: [
                        "Banesco - 1 USD=31,03 BS.",
                        "Otros bancos - 1 USD=31,00 BS.",
                    ],
                },
                {
                    src: "img/home/TDC Intergiros - USDT.png",
                    alt: "USDT",
                    descriptions: ["Todos los bancos - 1 USD=31,00 BS."],
                },
                {
                    src: "img/home/TDC Intergiros - Zinli.png",
                    alt: "Zinli",
                    descriptions: ["Todos los bancos - 1 USD=31,00 BS."],
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
