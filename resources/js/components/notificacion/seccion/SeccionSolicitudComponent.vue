<template>
    <div class="seccion-notificacion" :class="{ nueva: isNew }">
        <div class="text-right">
            {{ notificacion.formatted_created_at }}
            <a href="#" @click="hiddenNotificacion(notificacion.id)">
                <i class="fas fa-trash-alt" v-if="isNew"></i>
            </a>
        </div>
        <h5>
            <strong>{{ notificacion.name }}</strong>
        </h5>
        <h5><strong># ID: </strong>{{ notificacion.uuid }}</h5>
        <h5>{{ notificacion.valor1 }}</h5>
        <p>{{ notificacion.valor2 }}</p>
    </div>
</template>

<script>
export default {
    props: {
        notificacion: Object,
        isNew: Boolean,
    },
    methods: {
        hiddenNotificacion(id) {
            this.$axios
                .post("/notificaciones/update", {
                    id: id,
                })
                .then((response) => {
                    this.$alertSuccess(
                        "Información actualizada correctamente!"
                    );
                    this.$emit("actualizarNotificaciones", 0);
                })
                .catch((error) => {
                    this.$readStatusHttp(error);
                });
        },
    },
};
</script>

<style>
.seccion-notificacion {
    margin-top: 60px;
    padding-right: 20px;
}
</style>
