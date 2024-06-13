<script>
export default {
    methods: {
        $getEnumsRelations(type) {
            const vm = this;
            return new Promise((resolve, reject) => {
                this.$axios
                    .get(`/enums/types/${type.join(",")}`)
                    .then(function (response) {
                        resolve(response.data);
                    })
                    .catch((error) => {
                        vm.$readStatusHttp(error);
                        reject(error);
                    });
            });
        },
        $viewModalImagen(imageUrl, titulo, isDelete, solicitudId) {
            let swalOptions = {
                imageUrl: imageUrl,
                imageAlt: titulo,
                showCloseButton: true,
                showConfirmButton: true,
                confirmButtonText: "Descargar",
                focusConfirm: false,
            };
            if (isDelete) {
                swalOptions.showCancelButton = true;
                swalOptions.cancelButtonText = "Eliminar";
                (swalOptions.cancelButtonColor = "#d33"),
                    (swalOptions.focusCancel = true);
            }

            this.$swal.fire(swalOptions).then((result) => {
                if (result.isConfirmed) {
                    this.$downloadImagen(imageUrl);
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    this.$swal
                        .fire({
                            title: "¿Estás seguro?",
                            text: "Estás a punto de eliminar esta imagen. ¿Estás seguro de que deseas continuar?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Sí, eliminar",
                            cancelButtonText: "Cancelar",
                        })
                        .then((result) => {
                            if (result.isConfirmed) {
                                this.$eliminarImagen(
                                    imageUrl,
                                    "DELETE",
                                    solicitudId
                                );
                            }
                        });
                }
            });
        },
        $downloadImagen(imageUrl) {
            const fechaActual = new Date();
            const fechaFormateada = fechaActual
                .toISOString()
                .replace(/[-:]/g, "")
                .replace("T", "")
                .slice(0, -5);
            const link = document.createElement("a");
            link.download = `imagen_${fechaFormateada}`;
            link.href = imageUrl;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        },
        $eliminarImagen(path, action, solicitud_id) {
            let formData = {
                path: path,
                action: action,
                solicitud_id: solicitud_id,
            };
            this.$axios
                .post("/admin/solicitudes/up/voucher", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((response) => {
                    this.$alertSuccess("Proceso completo");
                    location.reload();
                })
                .catch((error) => {
                    this.$readStatusHttp(error);
                });
        },
        $getComboRelations(gestor) {
            return new Promise((resolve, reject) => {
                this.$axios
                    .get(`/configuration/gestor/${gestor.join(",")}`)
                    .then(function (response) {
                        resolve(response.data);
                    })
                    .catch((error) => {
                        this.$readStatusHttp(error);
                        reject(error);
                    });
            });
        },
        $devFormatoMoneda(service, moneda, value) {
            return new Promise((resolve, reject) => {
                var formData = new FormData();
                formData.append("tipo_formulario", service);
                formData.append("tipo_moneda", moneda);
                formData.append("monto", value);
                if (
                    formData.has("tipo_formulario") &&
                    formData.has("tipo_moneda") &&
                    formData.has("monto")
                ) {
                    this.$axios
                        .post("/tasa-cambio/convert", formData)
                        .then((response) => {
                            resolve(response.data);
                        })
                        .catch((error) => {
                            this.$readStatusHttp(error);
                            reject(error);
                        });
                }
            });
        },
        $getBancoByMoneda(key) {
            return new Promise((resolve, reject) => {
                this.$axios
                    .get(`/configuration/banco_moneda/${key}`)
                    .then(function (response) {
                        resolve(response.data);
                    })
                    .catch((error) => {
                        this.$readStatusHttp(error);
                        reject(error);
                    });
            });
        },
        // codigos de documento por moneda
        $getTDByMoneda(key) {
            return new Promise((resolve, reject) => {
                this.$axios
                    .get(`/configuration/ci_moneda/${key}`)
                    .then(function (response) {
                        resolve(response.data);
                    })
                    .catch((error) => {
                        this.$readStatusHttp(error);
                        reject(error);
                    });
            });
        },
        $isNextDay(created_at) {
            const createdAtDate = new Date(created_at);
            const nextDayDate = new Date(createdAtDate);
            nextDayDate.setDate(createdAtDate.getDate() + 1);
            const currentDate = new Date();
            return currentDate > nextDayDate;
        },
        $getEstadoBackground(estado) {
            switch (estado) {
                case 0:
                    return { backgroundColor: "#ECE731", color: "black" };
                case 1:
                    return { backgroundColor: "green", color: "white" };
                case 2:
                    return { backgroundColor: "red", color: "white" };
                case 3:
                    return { backgroundColor: "#2B93E7", color: "white" };
                default:
                    return {};
            }
        },
        $getEstadoVerificado(estado) {
            switch (estado) {
                case 0:
                    return "SIN VERIFICAR";
                case 1:
                    return "VERIFICADO";
                case 2:
                    return "RECHAZADO";
                case 3:
                    return "SOLICITUD VERIFICACION";
                default:
                    return {};
            }
        },
        $formatNumero(numero) {
            if (numero) {
                var partes = numero.toString().split(".");
                partes[0] = partes[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                return partes.join(",");
            }
        },
        async $getMonedas() {
            return new Promise(async (resolve, reject) => {
                try {
                    const response = await axios.get("/gestion/monedas");
                    resolve(response.data);
                } catch (error) {
                    this.$readStatusHttp(error);
                    reject(error);
                }
            });
        },
        async $getMonedaByCodigo(codigo) {
            return new Promise(async (resolve, reject) => {
                try {
                    const response = await axios.get(
                        "/gestion/monedas/" + codigo
                    );
                    resolve(response.data);
                } catch (error) {
                    this.$readStatusHttp(error);
                    reject(error);
                }
            });
        },
        async $getTercerosByService(code, servicio) {
            return new Promise(async (resolve, reject) => {
                try {
                    const response = await axios.get(
                        "/terceros/list/service/" + code + "/" + servicio
                    );
                    resolve(response.data);
                } catch (error) {
                    this.$readStatusHttp(error);
                    reject(error);
                }
            });
        },
        async $getBancoByMonedas(moneda) {
            return new Promise(async (resolve, reject) => {
                try {
                    const response = await axios.get(
                        "/configuration/bancos/" + moneda
                    );
                    resolve(response.data);
                } catch (error) {
                    this.$readStatusHttp(error);
                    reject(error);
                }
            });
        },
        async $getDocumentByMonedas(moneda) {
            return new Promise(async (resolve, reject) => {
                try {
                    const response = await axios.get(
                        "/configuration/documento/" + moneda
                    );
                    resolve(response.data);
                } catch (error) {
                    this.$readStatusHttp(error);
                    reject(error);
                }
            });
        },
        async $showTercero(id, code, servicio) {
            return new Promise(async (resolve, reject) => {
                try {
                    const response = await axios.get(
                        "/terceros/show/" + id + "/" + code + "/" + servicio
                    );
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
