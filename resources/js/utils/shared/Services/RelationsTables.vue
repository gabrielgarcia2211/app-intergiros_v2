<script>
export default {
    methods: {
        $relationTableSolicitudes(selector) {
            switch (selector) {
                case "apellidos_user":
                    return "users.apellidos";
                case "email_user":
                    return "users.email";
                case "documento_user":
                    return "users.documento";
                case "telefono_user":
                    return "users.telefono";
                case "path_selfie_user":
                    return "users.path_selfie";
                case "path_documento_user":
                    return "users.path_documento";
                case "verificado":
                    return "users.verificado";
                case "monto_a_pagar":
                    return "solicitudes.monto_a_pagar";
                case "monto_a_recibir":
                    return "solicitudes.monto_a_recibir";
                case "revisiones":
                    return "solicitudes.revisiones";
                case "imagen_comprobante":
                    return "solicitudes.imagen_comprobante";
                case "tipo_formulario":
                    return "tipo_formulario.descripcion";
                case "tipo_moneda":
                    return "tipo_moneda.tipo";
                case "descripcion_moneda":
                    return "tipo_moneda.descripcion";
                case "nombre_depositante":
                    return "ter_d.nombre";
                case "documento_depositante":
                    return "ter_d.documento";
                case "banco_depositante":
                    return "ter_d.banco";
                case "cuenta_depositante":
                    return "ter_d.cuenta";
                case "pago_movil_depositante":
                    return "ter_d.pago_movil";
                case "correo_depositante":
                    return "ter_d.correo";
                case "celular_depositante":
                    return "ter_d.celular";
                case "path_documento_depositante":
                    return "ter_d.path_documento";
                case "nombre_beneficiario":
                    return "ter_b.nombre";
                case "documento_beneficiario":
                    return "ter_b.documento";
                case "banco_beneficiario":
                    return "ter_b.banco";
                case "cuenta_beneficiario":
                    return "ter_b.cuenta";
                case "pago_movil_beneficiario":
                    return "ter_b.pago_movil";
                case "correo_beneficiario":
                    return "ter_b.correo";
                case "celular_beneficiario":
                    return "ter_b.celular";
                case "path_documento_beneficiario":
                    return "ter_b.path_documento";
                case "nombre_producto":
                    return "productos.nombre";
                case "costo_base_producto":
                    return "productos.costo_base";
                case "rango_min_producto":
                    return "productos.rango_min";
                case "rango_max_producto":
                    return "productos.rango_max";
                case "estado_actual":
                    return "mc_estado.name";
                default:
                    return selector;
            }
        },
    },
};
</script>
