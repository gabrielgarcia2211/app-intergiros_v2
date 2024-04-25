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
                        url: this.servicio,
                    },
                    { label: "Tasas", url: "#" },
                    { label: "Noticias", url: "#" },
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
                        url: "#",
                    },
                    {
                        icon: "pi pi-facebook",
                        url: "#",
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
                        url: this.servicio,
                    },
                    { label: "Tasas", url: "#" },
                    { label: "Noticias", url: "#" },
                    {
                        label: "Iniciar Sesion",
                        url: this.login,
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
                        url: "#",
                    },
                    {
                        icon: "pi pi-facebook",
                        url: "#",
                    },
                ];
            }
        });
    },
    methods: {},
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
.user-verificado {
    background-color: #5fbc4a;
    border-radius: 35px;
}

.user-verificado:hover {
    background-color: #5fbc4a;
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
    background-color: #5fbc4a;
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
</style>
