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
                    .catch(function (error) {
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
                swalOptions.cancelButtonColor = "#d33",
                swalOptions.focusCancel = true;
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
    },
};
</script>
