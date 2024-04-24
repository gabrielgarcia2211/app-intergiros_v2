<template>
    <Menubar class="custom-menubar">
        <template #start>
            <img src="img/Logo3-5.png" alt="Logo" class="navbar-logo" />
        </template>
        <template #end>
            <div class="menu-items">
                <Menubar :model="menuItems" class="custom-menubar"  />
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
                        icon: "pi pi-check-circle",
                        style: this.verificado
                            ? {
                                  color: "#ffffff",
                                  padding: "5px",
                                  borderRadius: "35px",
                                  backgroundColor: "#009d2c",
                              }
                            : {},
                        items: [
                            {
                                label: "Mi Perfil",
                                icon: "pi pi-user",
                                url: this.perfil,
                                style: {
                                    paddingLeft: "0 !important",
                                    marginBottom: "0 !important",
                                },
                            },
                            {
                                label: "Panel de envíos",
                                icon: "pi pi-money-bill",
                                url: this.historial,
                                style: {
                                    paddingLeft: "0 !important",
                                    marginBottom: "0 !important",
                                },
                            },
                            {
                                label: "Cerrar sesión",
                                icon: "pi pi-sign-out",
                                url: this.logout,
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
                        style: {
                            color: "white",
                        },
                    },
                    {
                        label: "Regístrate",
                        url: this.registro,
                        style: {
                            color: "#fffff",
                            padding: "5px",
                            borderRadius: "10px",
                            backgroundColor: "#009d2c",
                        },
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
.custom-menubar {
    background-color: #ffffff;
    font-family: "Lato", sans-serif;
}

.navbar-logo {
    max-width: 250px !important;
    margin-left: 20px !important;
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

.menu-items .custom-menubar .pi.pi-check-circle {
  color: #f3d40a; 
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

[aria-labelledby="pv_id_1_4_label"] {
    padding-left: 0 !important;
    margin-bottom: 0 !important;
}
</style>
