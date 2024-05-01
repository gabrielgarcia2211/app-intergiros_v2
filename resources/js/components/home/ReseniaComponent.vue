<template>
    <div class="carousel-container">
        <Carousel
            :value="cards"
            :numVisible="numVisible"
            :numScroll="numVisible"
            :circular="true"
            :autoplay="true"
            :autoplayInterval="5000"
            :responsiveOptions="responsiveOptions"
            class="carousel-resenia"
        >
            <template #item="{ data, index }">
                <div class="card-container">
                    <div class="card modal-medium">
                        <img
                            :src="data.image"
                            :alt="data.alt"
                            class="card-img-top"
                        />
                        <div class="card-body">
                            <h6 class="card-title">
                                <strong>{{ data.name }}</strong>
                            </h6>
                            <div class="estrellas mt-3">★ ★ ★ ★ ★</div>
                            <p class="card-text">{{ data.description }}</p>
                        </div>
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
            cards: [
                {
                    image: "img/home/people.jpg",
                    alt: "Persona 1",
                    name: "Nombre Persona #1",
                    description:
                        "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sed quasi non aperiam itaque earum voluptatem sequi, ut rem veniam hic nesciunt numquam veritatis quaerat laboriosam possimus, nulla libero temporibus! Laudantium.",
                },
                {
                    image: "img/home/people.jpg",
                    alt: "Persona 2",
                    name: "Nombre Persona #2",
                    description:
                        "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sed quasi non aperiam itaque earum voluptatem sequi, ut rem veniam hic nesciunt numquam veritatis quaerat laboriosam possimus, nulla libero temporibus! Laudantium.",
                },
                {
                    image: "img/home/people.jpg",
                    alt: "Persona 3",
                    name: "Nombre Persona #3",
                    description:
                        "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sed quasi non aperiam itaque earum voluptatem sequi, ut rem veniam hic nesciunt numquam veritatis quaerat laboriosam possimus, nulla libero temporibus! Laudantium.",
                },
                {
                    image: "img/home/people.jpg",
                    alt: "Persona 4",
                    name: "Nombre Persona #4",
                    description:
                        "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sed quasi non aperiam itaque earum voluptatem sequi, ut rem veniam hic nesciunt numquam veritatis quaerat laboriosam possimus, nulla libero temporibus! Laudantium.",
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

<style>
.carousel-container {
    background-color: #ededed;
    text-align: center;
}

.carousel-resenia .card-img-top {
    width: 30%;
    border-radius: 50%;
    padding-top: 15px;
    padding-left: 15px;
}

.carousel-resenia .card {
    box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    border-radius: 10px;
    width: 70%;
    margin-top: 30px;
    margin-bottom: 30px;
    margin-left: auto !important;
    margin-right: auto !important;
}

.carousel-resenia .card:hover {
    cursor: pointer;
    transform: scale(1.1);
}

.carousel-resenia .card-body {
    padding: 1rem;
}

.carousel-resenia .card-title {
    margin-bottom: 0.5rem;
}

.carousel-resenia .estrellas {
    color: gold;
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
}

.carousel-resenia .card-text {
    font-size: 1rem;
    line-height: 1.5;
}

.btn-reseña {
    border-radius: 25px;
    font-size: 25px;
    background-color: #0035aa;
    width: 330px;
}
</style>
