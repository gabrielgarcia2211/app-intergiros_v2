<template>
    <div class="container notificaciones">
        <TabView class="tabview-custom" @tab-change="handleTabStatus">
            <TabPanel>
                <template #header>
                    <div class="flex align-items-center gap-2">
                        <span
                            id="opcion1-tab"
                            class="font-bold white-space-nowrap"
                            >Solicitudes</span
                        >
                    </div>
                </template>
                <div class="seccion">
                    <ProgressSpinner
                        v-if="loading"
                        style="
                            width: 180px;
                            height: 180px;
                            justify-content: center;
                            display: block;
                        "
                    />
                    <div
                        v-else-if="
                            notificaciones.nuevas.lenght != 0 ||
                            notificaciones.anteriores.lenght != 0
                        "
                        style="margin-left: 20px"
                    >
                        <h2 class="title-notificaciones">
                            Notificaciones nuevas
                        </h2>
                        <div v-if="notificaciones.nuevas.length == 0">
                            No hay notificaciones nuevas
                        </div>
                        <div v-else>
                            <seccion-solicitud-component
                                v-for="(
                                    notificacion, index
                                ) in notificaciones.nuevas"
                                :key="index"
                                :notificacion="notificacion"
                                :isNew="true"
                                @actualizarNotificaciones="loadNotificaciones"
                            />
                        </div>
                        <hr style="margin: 50px 0" />
                        <h2 class="title-notificaciones">
                            Notificaciones anteriores
                        </h2>
                        <div v-if="notificaciones.anteriores.length == 0">
                            No hay notificaciones anteriores
                        </div>
                        <div v-else>
                            <seccion-solicitud-component
                                v-for="(
                                    notificacion, index
                                ) in notificaciones.anteriores"
                                :key="index"
                                :notificacion="notificacion"
                                :isNew="false"
                                @actualizarNotificaciones="loadNotificaciones"
                            />
                        </div>
                    </div>
                </div>
            </TabPanel>
            <TabPanel>
                <template #header>
                    <div class="flex align-items-center gap-2">
                        <span
                            id="opcion1-tab"
                            class="font-bold white-space-nowrap"
                            >Noticias</span
                        >
                    </div>
                </template>
                <div class="seccion">
                    <ProgressSpinner
                        v-if="loading"
                        style="
                            width: 180px;
                            height: 180px;
                            justify-content: center;
                            display: block;
                        "
                    />
                    <div
                        v-else-if="
                            noticias.nuevas.lenght != 0 ||
                            noticias.anteriores.lenght != 0
                        "
                        style="margin-left: 20px"
                    >
                        <h2 class="title-noticias">Noticias nuevas</h2>
                        <div v-if="noticias.nuevas.length == 0">
                            No hay noticias nuevas
                        </div>
                        <div v-else>
                            <seccion-noticia-component
                                v-for="(noticia, index) in noticias.nuevas"
                                :key="index"
                                :noticia="noticia"
                                :isNew="true"
                                @actualizarNoticias="loadNoticias"
                            />
                        </div>
                        <hr style="margin: 50px 0" />
                        <h2 class="title-notificaciones">
                            Noticias anteriores
                        </h2>
                        <div v-if="noticias.anteriores.length == 0">
                            No hay noticias anteriores
                        </div>
                        <div v-else>
                            <seccion-noticia-component
                                v-for="(noticia, index) in noticias.anteriores"
                                :key="index"
                                :noticia="noticia"
                                :isNew="false"
                                @actualizarNoticias="loadNoticias"
                            />
                        </div>
                    </div>
                </div>
            </TabPanel>
        </TabView>
    </div>
</template>

<script>
import SeccionSolicitudComponent from "./seccion/SeccionSolicitudComponent.vue";
import SeccionNoticiaComponent from "./seccion/SeccionNoticiaComponent.vue";

export default {
    data() {
        return {
            notificaciones: {
                nuevas: {},
                anteriores: {},
            },
            noticias: {
                nuevas: {},
                anteriores: {},
            },
            loading: true,
        };
    },
    components: {
        SeccionSolicitudComponent,
        SeccionNoticiaComponent,
    },
    watch: {},
    created() {
        this.handleTabStatus({ index: 0 });
    },
    mounted() {},
    methods: {
        async handleTabStatus(estado) {
            this.loading = true;
            this.mapIndexSolicitud(estado.index);
            this.loading = false;
        },
        async mapIndexSolicitud(index) {
            switch (index) {
                case 0:
                    this.loadNotificaciones();
                    break;
                case 1:
                    this.loadNoticias();
                    break;
                default:
                    break;
            }

            return;
        },
        async loadNotificaciones() {
            const reponse = await this.getNotificaciones();
            this.notificaciones.nuevas = reponse.data.nuevas;
            this.notificaciones.anteriores = reponse.data.anteriores;
        },
        async loadNoticias() {
            const reponse = await this.getNoticias();
            this.noticias.nuevas = reponse.data.nuevas;
            this.noticias.anteriores = reponse.data.anteriores;
        },
        getNotificaciones() {
            return new Promise((resolve, reject) => {
                this.$axios
                    .get(`/notificaciones/list`)
                    .then(function (response) {
                        resolve(response.data);
                    })
                    .catch(function (error) {
                        this.$readStatusHttp(error);
                        reject(error);
                    });
            });
        },
        getNoticias() {
            return new Promise((resolve, reject) => {
                this.$axios
                    .get(`/noticias/list`)
                    .then(function (response) {
                        resolve(response.data);
                    })
                    .catch(function (error) {
                        this.$readStatusHttp(error);
                        reject(error);
                    });
            });
        },
    },
};
</script>

<style>
.title-notificaciones {
    text-align: center;
    color: #0035aa;
}
.title-noticias {
    text-align: center;
    color: #0035aa;
}
</style>
