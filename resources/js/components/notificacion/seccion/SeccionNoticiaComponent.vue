<template>
    <div class="seccion-noticia" :class="{ nueva: isNew }">
        <div class="text-right">
            {{ noticia.created_at }}
            <a
                href="#"
                @click.prevent="hiddenNoticia(noticia.user_noticia_id)"
            >
                <i class="fas fa-trash-alt" v-if="isNew"></i>
            </a>
        </div>
        <h5>
            <strong>{{ noticia.titulo }}</strong>
        </h5>
        <h5><strong># ID: </strong>{{ noticia.id }}</h5>
        <h5>{{ noticia.referencia }}</h5>
        <h6>{{ noticia.descripcion }}</h6>
    </div>
</template>

<script>
export default {
    props: {
        noticia: Object,
        isNew: Boolean,
    },
    methods: {
        hiddenNoticia(id) {
            this.$axios
                .post("/noticias/update/" + id)
                .then((response) => {
                    this.$alertSuccess(
                        "Información actualizada correctamente!"
                    );
                    this.$emit("actualizarNoticias", 0);
                })
                .catch((error) => {
                    this.$readStatusHttp(error);
                });
        },
    },
};
</script>

<style>
.seccion-noticia {
    margin-top: 60px;
    padding-right: 20px;
}
</style>
