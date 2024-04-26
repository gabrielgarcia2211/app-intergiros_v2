<template>
    <Menubar class="custom-menubar">
        <template #start>
            <img src="img/Logo3-5.png" alt="Logo" class="navbar-logo" />
        </template>
        <template #end>
            <div class="menu-items">
                <Menubar :model="menuItems" class="custom-check" />
            </div>
        </template>
    </Menubar>
</template>

<script>
export default {
    props: [
        "home",
        "servicio",
        "usuario",
        "verificado",
        "notificacion",
        "perfil",
        "historial",
        "logout",
        "registro",
        "login",
    ],
    data() {
        return {
            menuItems: [],
            pointIcon: false,
        };
    },
    mounted() {
        this.$nextTick(() => {
            if (this.usuario) {
                this.menuItems = [
                    {
                        label: "Inicio",
                        url: this.home,
                    },
                    {
                        label: "Servicios",
                        command: () => {
                            this.redirectUrl("calculadora");
                        },
                    },
                    {
                        label: "Tasas",
                        url: "#",
                        command: () => {
                            this.redirectUrl("calculadora");
                        },
                    },
                    {
                        label: "Noticias",
                        url: "#",
                        command: () => {
                            this.redirectUrl("noticias");
                        },
                    },
                    {
                        label: this.usuario,
                        icon:
                            this.verificado == 1
                                ? "pi pi-check-circle"
                                : "pi pi-check",
                        class:
                            this.verificado == 1
                                ? "user-verificado"
                                : "user-not-verificado",
                        items: [
                            {
                                label: "Mi Perfil",
                                icon: "pi pi-user",
                                url: this.perfil,
                                class: "user-child-verificado",
                                style: {
                                    paddingLeft: "0 !important",
                                    marginBottom: "0 !important",
                                },
                            },
                            {
                                label: "Panel de envíos",
                                icon: "pi pi-money-bill",
                                url: this.servicio,
                                class: "user-child-verificado",
                                style: {
                                    paddingLeft: "0 !important",
                                    marginBottom: "0 !important",
                                },
                            },
                            {
                                label: "Historial de envíos",
                                icon: "pi pi-history",
                                url: this.historial,
                                class: "user-child-verificado",
                                style: {
                                    paddingLeft: "0 !important",
                                    marginBottom: "0 !important",
                                },
                            },
                            {
                                label: "Cerrar sesión",
                                icon: "pi pi-sign-out",
                                url: this.logout,
                                class: "user-child-verificado",
                                style: {
                                    paddingLeft: "0 !important",
                                    marginBottom: "0 !important",
                                },
                            },
                        ],
                    },
                    {
                        icon: "pi pi-comment",
                        url: this.notificacion,
                    },
                    {
                        icon: "pi pi-instagram",
                        url: "https://www.instagram.com/intergiros.oficial",
                        target: "_blank",
                    },
                    {
                        icon: "pi pi-facebook",
                        url: "https://www.facebook.com/intergiros.oficial",
                        target: "_blank",
                    },
                ];
            } else {
                this.menuItems = [
                    {
                        label: "Inicio",
                        url: this.home,
                    },
                    {
                        label: "Servicios",
                        command: () => {
                            this.redirectUrl("calculadora");
                        },
                    },
                    {
                        label: "Tasas",
                        url: "#",
                        command: () => {
                            this.redirectUrl("calculadora");
                        },
                    },
                    {
                        label: "Noticias",
                        url: "#",
                        command: () => {
                            this.redirectUrl("noticias");
                        },
                    },
                    {
                        label: "Iniciar Sesion",
                        url: this.login,
                        class: "sesion",
                    },
                    {
                        label: "Regístrate",
                        url: this.registro,
                        class: "registro",
                    },
                    {
                        icon: "pi pi-comment",
                        url: this.notificacion,
                    },
                    {
                        icon: "pi pi-instagram",
                        url: "https://www.instagram.com/intergiros.oficial",
                        target: "_blank",
                    },
                    {
                        icon: "pi pi-facebook",
                        url: "https://www.facebook.com/intergiros.oficial",
                        target: "_blank",
                    },
                ];
            }
            this.loadPanelUrl();
            this.showNotificaciones();
        });
    },
    methods: {
        loadPanelUrl() {
            setTimeout(function () {
                const search = localStorage.getItem("search");
                if (search) {
                    const etiquetaObjetivo = document.getElementById(search);
                    if (etiquetaObjetivo) {
                        etiquetaObjetivo.scrollIntoView({
                            behavior: "smooth",
                        });
                    }
                    localStorage.removeItem("search");
                }
            }, 2000);
        },
        redirectUrl(key) {
            const str = window.location.pathname;
            const substring = "/home";
            const position = str.includes(substring);

            if (!position) {
                localStorage.setItem("search", key);
                window.location.href = "/home";
            }

            const etiquetaObjetivo = document.getElementById(key);
            if (etiquetaObjetivo) {
                etiquetaObjetivo.scrollIntoView({
                    behavior: "smooth",
                });
            }
        },
        getNotificaciones() {
            return new Promise((resolve, reject) => {
                this.$axios
                    .get(`/notificaciones/status`)
                    .then(function (response) {
                        resolve(response.data);
                    })
                    .catch(function (error) {
                        this.$readStatusHttp(error);
                        reject(error);
                    });
            });
        },
        async showNotificaciones() {
            let details = await this.getNotificaciones();
            this.menuItems[5].class = details.data.nuevas ? "status-icon" : "";
        },
    },
};
</script>

<style>
.navbar-logo {
    max-width: 250px !important;
    margin-left: 20px !important;
}

.custom-menubar {
    background-color: #ffffff;
    font-family: "Lato", sans-serif;
}

.menu-items {
    display: flex;
    align-items: center;
    justify-content: flex-end;
}

.menu-items .p-menubar {
    background-color: #ffffff;
}

.p-menubar .p-menuitem-link {
    text-decoration: none;
}

.p-menubar .p-menuitem-text {
    font-family: "Lato", sans-serif !important;
    font-size: 20px;
    color: black;
    font-weight: bold;
}

.p-menubar .p-menuitem-link .p-menuitem-icon {
    color: black;
    font-size: 28px;
}

/** Nuevos estilos */
.sesion .p-menuitem-text {
    color: #009d2c;
}

.user-verificado {
    background-color: #009d2c;
    border-radius: 35px;
}

.user-verificado:hover {
    background-color: #009d2c;
    border-radius: 35px;
}

.user-verificado:hover .p-menuitem-text {
    color: black;
}

.user-verificado .p-menuitem-text {
    color: white;
}

.user-verificado .p-menuitem-link .p-menuitem-icon {
    color: #ffbf00;
}

[aria-labelledby="pv_id_1_4_label"] {
    padding-left: 0 !important;
    margin-bottom: 0 !important;
}

.user-child-verificado .p-menuitem-text {
    color: rgb(0, 0, 0);
}

.user-child-verificado .p-menuitem-link .p-menuitem-icon {
    color: rgb(0, 0, 0);
}

.registro {
    background-color: #009d2c;
    border-radius: 35px;
}

.registro:hover .p-menuitem-text {
    color: black;
}

.registro .p-menuitem-text {
    color: white;
}

.menu-items {
    position: relative;
}

.menu-items .p-menubar-mobile .p-menubar-root-list {
    position: absolute !important;
    left: -200px !important;
    width: 400% !important;
    padding: 10px 20px !important;
}

/** icon de status notificacion */
.status-icon .p-menuitem-link .p-menuitem-icon {
    color: red;
}
</style>
