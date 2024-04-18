<template>
    <div style="height: 10px;"></div>
    <div class="card">
        <Menubar class="custom-menubar" style="height: 60px; padding-bottom: 0px; padding-top: 18px;">
            <template #start>
                <img src="img/Logo3-5.png" alt="Logo" class="navbar-logo" width="130px"/>
            </template>
            <template #end>
                <div class="menu-items">
                    <Menubar :model="menuItems" />
                </div>
            </template>
        </Menubar>
    </div>
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
    ],
    data() {
        return {
            menuItems: [
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
                    icon: "pi pi-check",
                    items: [
                        {
                            label: "Mi Perfil",
                            icon: "pi pi-user",
                            url: this.perfil,
                        },
                        {
                            label: "Panel de envíos",
                            icon: "pi pi-money-bill",
                            url: this.historial,
                        },
                        {
                            label: "Cerrar sesión",
                            icon: "pi pi-sign-out",
                            url: this.logout,
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
            ],
        };
    },
    mounted() {
        this.$nextTick(() => {
            if (this.verificado) {
                this.addClassesToElement("pv_id_1_4", ["user-verificado"]);
            } else {
                this.removeClassesFromElement("pv_id_1_4", ["user-verificado"]);
            }
        });
    },
    methods: {
        addClassesToElement(id, classes) {
            const element = document.getElementById(id);
            if (element) {
                classes.forEach((className) => {
                    element.classList.add(className);
                });
            }
        },
        removeClassesFromElement(id, classes) {
            const element = document.getElementById(id);
            if (element) {
                classes.forEach((className) => {
                    element.classList.remove(className);
                });
            }
        },
    },
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

[aria-labelledby="pv_id_1_4_label"] {
    padding-left: 0 !important;
    margin-bottom: 0 !important;
}

.p-menubar .p-menuitem-link .p-menuitem-icon {
    color: black;
    font-size: 28px;
}

.p-menubar .p-menuitem-link .p-menuitem-icon.pi.pi-check {
    color: rgb(255, 255, 255) !important;
    font-size: 20px !important;
}

.user-verificado {
    border-radius: 10px !important;
    background-color: rgb(43, 211, 13) !important;
}
</style>
