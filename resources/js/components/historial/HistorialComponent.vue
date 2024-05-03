<template>
    <div class="container notificaciones">
        <TabView class="tabview-custom" @tab-change="handleTabStatus">
            <TabPanel>
                <template #header>
                    <div class="flex align-items-center gap-2">
                        <span
                            id="opcion1-tab"
                            class="font-bold white-space-nowrap"
                            >EN PROCESO</span
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
                    <div v-else-if="solicitudes.length == 0">
                        <div
                            class="d-flex align-items-center justify-content-center mt-4"
                        >
                            <img
                                src="img/notificaciones/Sin mensajes.png"
                                class="img-fluid"
                                alt="not found"
                                width="400px"
                            />
                        </div>
                    </div>
                    <div
                        v-else
                        v-for="(item, index) in solicitudes"
                        :key="index"
                        class="m-0 seccion-historial"
                    >
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="text-center">
                                        <img
                                            src="img/notificaciones/proceso.png"
                                            class="img-fluid"
                                            alt=""
                                            width="100px"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="text-left">
                                                <p style="margin-bottom: 0px">
                                                    ID#{{ item.id }}
                                                </p>
                                                <p style="color: #0035aa">
                                                    Pedido en proceso
                                                </p>
                                                <p
                                                    style="
                                                        margin-bottom: 0px;
                                                        color: #009d2c;
                                                    "
                                                >
                                                    Monto pagado
                                                </p>
                                                <p style="color: #009d2c">
                                                    USD {{ item.monto_a_pagar }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <p>{{ item.created_at }}</p>
                                                <p
                                                    style="
                                                        margin-bottom: 0px;
                                                        color: #009d2c;
                                                    "
                                                >
                                                    Monto a recibir
                                                </p>
                                                <p style="color: #009d2c">
                                                    {{ item.monto_a_recibir }}
                                                    BS.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a
                                    href="#"
                                    @click="
                                        toggleCollapse(
                                            'iconoProceso',
                                            'proceso',
                                            index
                                        )
                                    "
                                    style="color: #818181"
                                >
                                    <i
                                        class="fas fa-chevron-down"
                                        :id="'iconoProceso' + index"
                                    ></i>
                                </a>
                            </div>
                        </div>
                        <div :id="'proceso' + index" class="collapse container">
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-left">
                                        <p>Tasa de cambio:</p>
                                        <p>Pagado desde:</p>
                                        <p>Enviado por:</p>
                                        <p>Enviado a:</p>
                                        <br />
                                        <button
                                            v-if="$isNextDay(item.created_at)"
                                            class="btn btn-primary"
                                            @click="openModalEnProceso(item)"
                                        >
                                            Reclamar
                                        </button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <p>
                                            USD 1 =
                                            {{
                                                item.tipo_formulario
                                                    .tasa_cambios.valor
                                            }}
                                            Bs.
                                        </p>
                                        <p>
                                            {{
                                                item.tipo_formulario.descripcion
                                            }}
                                        </p>
                                        <p>{{ item.depositante.alias }}</p>
                                        <p>{{ item.beneficiario.alias }}</p>
                                        <p>{{ item.beneficiario.banco }}</p>
                                        <p>V {{ item.beneficiario.cuenta }}</p>
                                        <p>
                                            {{ item.beneficiario?.pago_movil }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr v-if="index !== solicitudes.length - 1" />
                    </div>
                </div>
            </TabPanel>
            <TabPanel>
                <template #header>
                    <div class="flex align-items-center gap-2">
                        <span
                            id="opcion1-tab"
                            class="font-bold white-space-nowrap"
                            >POR SOLUCIONAR</span
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
                    <div v-else-if="solicitudes.length == 0">
                        <div
                            class="d-flex align-items-center justify-content-center mt-4"
                        >
                            <img
                                src="img/notificaciones/Sin mensajes.png"
                                class="img-fluid"
                                alt="not found"
                                width="400px"
                            />
                        </div>
                    </div>
                    <div
                        v-else
                        v-for="(item, index) in solicitudes"
                        :key="index"
                        class="m-0 seccion-historial"
                    >
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="text-center">
                                        <img
                                            src="img/notificaciones/solucionar.png"
                                            class="img-fluid"
                                            alt=""
                                            width="100px"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="text-left">
                                                <p style="margin-bottom: 0px">
                                                    ID#{{ item.id }}
                                                </p>
                                                <p style="color: #cf0000">
                                                    Datos erróneos del
                                                    beneficiario
                                                </p>
                                                <p
                                                    style="
                                                        margin-bottom: 0px;
                                                        color: #009d2c;
                                                    "
                                                >
                                                    Monto pagado
                                                </p>
                                                <p style="color: #009d2c">
                                                    USD {{ item.monto_a_pagar }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <p>{{ item.created_at }}</p>
                                                <p
                                                    style="
                                                        margin-bottom: 0px;
                                                        color: #009d2c;
                                                    "
                                                >
                                                    Monto a recibir
                                                </p>
                                                <p style="color: #009d2c">
                                                    {{ item.monto_a_recibir }}
                                                    BS.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a
                                    :href="'#solucionar' + index"
                                    @click="
                                        toggleCollapse(
                                            'iconoSolucionar2',
                                            'solucionar',
                                            index
                                        )
                                    "
                                    style="color: #818181"
                                >
                                    <i
                                        class="fas fa-chevron-down"
                                        :id="'iconoSolucionar2' + index"
                                    ></i>
                                </a>
                            </div>
                        </div>
                        <div
                            :id="'solucionar' + index"
                            class="collapse container"
                        >
                            <div class="text-center">
                                <p>
                                    <strong
                                        >Su solicitud ha sido rechazada debido a
                                        que el pago realizado no figura en
                                        nuestra cuenta.</strong
                                    >
                                </p>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-left">
                                        <p>Tasa de cambio:</p>
                                        <p>Pagado desde:</p>
                                        <p>Enviado por:</p>
                                        <p>Enviado a:</p>
                                        <br />
                                        <button
                                            class="btn btn-primary"
                                            @click="
                                                openModalPorSolucionar(item)
                                            "
                                        >
                                            Reclamar
                                        </button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <p>
                                            USD 1 =
                                            {{
                                                item.tipo_formulario
                                                    .tasa_cambios.valor
                                            }}
                                            Bs.
                                        </p>
                                        <p>
                                            {{
                                                item.tipo_formulario.descripcion
                                            }}
                                        </p>
                                        <p>{{ item.depositante.alias }}</p>
                                        <p>{{ item.beneficiario.alias }}</p>
                                        <p>{{ item.beneficiario.banco }}</p>
                                        <p>V {{ item.beneficiario.cuenta }}</p>
                                        <p>
                                            {{ item.beneficiario?.pago_movil }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr v-if="index !== solicitudes.length - 1" />
                    </div>
                </div>
            </TabPanel>
            <TabPanel>
                <template #header>
                    <div class="flex align-items-center gap-2">
                        <span
                            id="opcion1-tab"
                            class="font-bold white-space-nowrap"
                            >PROCESADOS</span
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
                    <div v-else-if="solicitudes.length == 0">
                        <div
                            class="d-flex align-items-center justify-content-center mt-4"
                        >
                            <img
                                src="img/notificaciones/Sin mensajes.png"
                                class="img-fluid"
                                alt="not found"
                                width="400px"
                            />
                        </div>
                    </div>
                    <div
                        v-else
                        v-for="(item, index) in solicitudes"
                        :key="index"
                        class="m-0 seccion-historial"
                    >
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="text-center">
                                        <img
                                            src="img/notificaciones/aprobados.png"
                                            class="img-fluid"
                                            alt=""
                                            width="100px"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="text-left">
                                                <p style="margin-bottom: 0px">
                                                    ID#{{ item.id }}
                                                </p>
                                                <p style="color: #0035aa">
                                                    Procesado
                                                </p>
                                                <p
                                                    style="
                                                        margin-bottom: 0px;
                                                        color: #009d2c;
                                                    "
                                                >
                                                    Monto pagado
                                                </p>
                                                <p style="color: #009d2c">
                                                    USD {{ item.monto_a_pagar }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <p>{{ item.created_at }}</p>
                                                <p style="color: #009d2c">
                                                    {{ item.monto_a_recibir }}
                                                    BS.
                                                </p>
                                                <p style="color: #009d2c">
                                                    301,20 BS.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a
                                    :href="'#procesados' + index"
                                    @click="
                                        toggleCollapse(
                                            'iconoProcesado',
                                            'procesados',
                                            index
                                        )
                                    "
                                    style="color: #818181"
                                >
                                    <i
                                        class="fas fa-chevron-down"
                                        :id="'iconoProcesado' + index"
                                    ></i>
                                </a>
                            </div>
                        </div>
                        <div
                            :id="'procesados' + index"
                            class="collapse container"
                        >
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-left">
                                        <p>Tasa de cambio:</p>
                                        <p>Pagado desde:</p>
                                        <p>Enviado por:</p>
                                        <p>Enviado a:</p>
                                        <br /><br />
                                        <a
                                            href="#"
                                            style="color: #0035aa"
                                            :id="'openModal' + index"
                                            :class="{
                                                'disabled-link':
                                                    item.voucher_referencia ==
                                                    null,
                                            }"
                                            @click="
                                                previewImagen(
                                                    item,
                                                    'Comprobante'
                                                )
                                            "
                                        >
                                            Ver comprobante
                                        </a>
                                        <br /><br />
                                        <a
                                            class="btn btn-primary"
                                            @click="opennModalProcesado(item)"
                                            >Reclamar</a
                                        >
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <p>
                                            USD 1 =
                                            {{
                                                item.tipo_formulario
                                                    .tasa_cambios.valor
                                            }}
                                            Bs.
                                        </p>
                                        <p>
                                            {{
                                                item.tipo_formulario.descripcion
                                            }}
                                        </p>
                                        <p>{{ item.depositante.alias }}</p>
                                        <p>{{ item.beneficiario.alias }}</p>
                                        <p>{{ item.beneficiario.banco }}</p>
                                        <p>V {{ item.beneficiario.cuenta }}</p>
                                        <p>
                                            {{ item.beneficiario?.pago_movil }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr v-if="index !== solicitudes.length - 1" />
                    </div>
                </div>
            </TabPanel>
            <TabPanel>
                <template #header>
                    <div class="flex align-items-center gap-2">
                        <span
                            id="opcion1-tab"
                            class="font-bold white-space-nowrap"
                            >RECHAZADOS</span
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
                    <div v-else-if="solicitudes.length == 0">
                        <div
                            class="d-flex align-items-center justify-content-center mt-4"
                        >
                            <img
                                src="img/notificaciones/Sin mensajes.png"
                                class="img-fluid"
                                alt="not found"
                                width="400px"
                            />
                        </div>
                    </div>
                    <div
                        v-else
                        v-for="(item, index) in solicitudes"
                        :key="index"
                        class="m-0 seccion-historial"
                    >
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="text-center">
                                        <img
                                            src="img/notificaciones/rechazados.png"
                                            class="img-fluid"
                                            alt=""
                                            width="100px"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="text-left">
                                                <p style="margin-bottom: 0px">
                                                    ID#{{ item.id }}
                                                </p>
                                                <p>Rechazado</p>
                                                <p style="margin-bottom: 0px">
                                                    Monto pagado
                                                </p>
                                                <p>
                                                    USD {{ item.monto_a_pagar }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <p>{{ item.created_at }}</p>
                                                <p style="margin-bottom: 0px">
                                                    Monto a recibir
                                                </p>
                                                <p>
                                                    {{ item.monto_a_recibir }}
                                                    BS.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a
                                    :href="'#rechazados' + index"
                                    @click="
                                        toggleCollapse(
                                            'iconoRechazado1',
                                            'rechazados',
                                            index
                                        )
                                    "
                                    style="color: #818181"
                                >
                                    <i
                                        class="fas fa-chevron-down"
                                        :id="'iconoRechazado1' + index"
                                    ></i>
                                </a>
                            </div>
                        </div>
                        <div
                            :id="'rechazados' + index"
                            class="collapse container"
                        >
                            <div class="text-center">
                                <p>
                                    <strong
                                        >Su solicitud ha sido rechazada debido a
                                        que el pago realizado no figura en
                                        nuestra cuenta.</strong
                                    >
                                </p>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-left">
                                        <p>Tasa de cambio:</p>
                                        <p>Pagado desde:</p>
                                        <p>Enviado por:</p>
                                        <p>Enviado a:</p>
                                        <br /><br />
                                        <a
                                            href="#"
                                            class="btn btn-primary"
                                            id="openContacto"
                                            >Contáctanos</a
                                        >
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <p>
                                            USD 1 =
                                            {{
                                                item.tipo_formulario
                                                    .tasa_cambios.valor
                                            }}
                                            Bs.
                                        </p>
                                        <p>
                                            {{
                                                item.tipo_formulario.descripcion
                                            }}
                                        </p>
                                        <p>{{ item.depositante.alias }}</p>
                                        <p>{{ item.beneficiario.alias }}</p>
                                        <p>{{ item.beneficiario.banco }}</p>
                                        <p>V {{ item.beneficiario.cuenta }}</p>
                                        <p>
                                            {{ item.beneficiario?.pago_movil }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr v-if="index !== solicitudes.length - 1" />
                    </div>
                </div>
            </TabPanel>
            <TabPanel>
                <template #header>
                    <div class="flex align-items-center gap-2">
                        <span
                            id="opcion1-tab"
                            class="font-bold white-space-nowrap"
                            >REEMBOLSO</span
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
                    <div v-else-if="solicitudes.length == 0">
                        <div
                            class="d-flex align-items-center justify-content-center mt-4"
                        >
                            <img
                                src="img/notificaciones/Sin mensajes.png"
                                class="img-fluid"
                                alt="not found"
                                width="400px"
                            />
                        </div>
                    </div>
                    <div
                        v-else
                        v-for="(item, index) in solicitudes"
                        :key="index"
                        class="m-0 seccion-historial"
                    >
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="text-center">
                                        <img
                                            src="img/notificaciones/reembolsado.png"
                                            class="img-fluid"
                                            alt=""
                                            width="100px"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="text-left">
                                                <p style="margin-bottom: 0px">
                                                    ID#{{ item.id }}
                                                </p>
                                                <p style="color: #0035aa">
                                                    Procesado
                                                </p>
                                                <p
                                                    style="
                                                        margin-bottom: 0px;
                                                        color: #009d2c;
                                                    "
                                                >
                                                    Monto pagado
                                                </p>
                                                <p style="color: #009d2c">
                                                    USD {{ item.monto_a_pagar }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <p>{{ item.created_at }}</p>
                                                <p style="color: #009d2c">
                                                    {{ item.monto_a_recibir }}
                                                    BS.
                                                </p>
                                                <p style="color: #009d2c">
                                                    301,20 BS.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a
                                    :href="'#reembolsado' + index"
                                    @click="
                                        toggleCollapse(
                                            'iconoProcesado',
                                            'reembolsado',
                                            index
                                        )
                                    "
                                    style="color: #818181"
                                >
                                    <i
                                        class="fas fa-chevron-down"
                                        :id="'iconoProcesado' + index"
                                    ></i>
                                </a>
                            </div>
                        </div>
                        <div
                            :id="'reembolsado' + index"
                            class="collapse container"
                        >
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-left">
                                        <p>Tasa de cambio:</p>
                                        <p>Pagado desde:</p>
                                        <p>Enviado por:</p>
                                        <p>Enviado a:</p>
                                        <br /><br />
                                        <a
                                            href="#"
                                            style="color: #0035aa"
                                            :id="'openModal' + index"
                                            :class="{
                                                'disabled-link':
                                                    item.voucher_referencia ==
                                                    null,
                                            }"
                                            @click="
                                                previewImagen(
                                                    item,
                                                    'Comprobante'
                                                )
                                            "
                                        >
                                            Ver comprobante
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <p>
                                            USD 1 =
                                            {{
                                                item.tipo_formulario
                                                    .tasa_cambios.valor
                                            }}
                                            Bs.
                                        </p>
                                        <p>
                                            {{
                                                item.tipo_formulario.descripcion
                                            }}
                                        </p>
                                        <p>{{ item.depositante.alias }}</p>
                                        <p>{{ item.beneficiario.alias }}</p>
                                        <p>{{ item.beneficiario.banco }}</p>
                                        <p>V {{ item.beneficiario.cuenta }}</p>
                                        <p>
                                            {{ item.beneficiario?.pago_movil }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr v-if="index !== solicitudes.length - 1" />
                    </div>
                </div>
            </TabPanel>
        </TabView>
    </div>

    <!-- openEnProceso -->
    <Dialog v-model:visible="visibleEnProceso" style="width: 500px">
        <template #header>
            <h1>Realizar Reclamo - EnProceso</h1>
        </template>
        <div class="flex align-items-center mb-5">
            <Dropdown
                id="selectedOptionEnProceso"
                v-model="selectedOptionEnProceso"
                :options="optionEnProceso"
                optionLabel="name"
                optionValue="id"
                :placeholder="'Opciones'"
                class="w-full md:w-14rem input-registro"
                style="width: 100%; text-align: left"
                @change="handleReclamo('en_proceso', $event)"
                showClear
            ></Dropdown>
        </div>
        <div v-if="checkEnProceso.visible">
            <div
                v-for="item in checkEnProceso.data"
                :key="item.id"
                class="form-check"
            >
                <input
                    type="checkbox"
                    class="form-check-input opcion-reclamo-entregado"
                    :id="'option' + item.id"
                    :data-code="item.code"
                    :value="item.id"
                    v-model="formData.opciones"
                />
                <label class="form-check-label" :for="'option' + item.id">{{
                    item.valor1
                }}</label>
            </div>
            <div class="form-group mt-5">
                <label>Escribenos un mensaje (Opcional)</label>
                <Textarea
                    v-model="formData.comentario"
                    rows="5"
                    cols="30"
                    style="width: 100%"
                />
            </div>
        </div>
        <template #footer
            ><Button
                class="btn-primary"
                :disabled="formData.opciones.length == 0"
                @click="sendReclamo"
                style="
                    background-color: transparent;
                    border: none;
                    font-size: 18px;
                    text-align: center;
                "
                >Enviar Reclamo</Button
            ></template
        >
    </Dialog>

    <!-- openPorSolucionar -->
    <Dialog
        v-model:visible="visiblePorSolucionar"
        style="width: 800px; top: 20%"
    >
        <template #header>
            <h1>Realizar Reclamo - PorSolucionar</h1>
        </template>
        <div class="flex align-items-center mb-5">
            <Dropdown
                id="selectedOptionPorSolucionar"
                v-model="selectedOptionPorSolucionar"
                :options="optionPorSolucionar"
                optionLabel="name"
                optionValue="id"
                :placeholder="'Opciones'"
                class="w-full md:w-14rem input-registro"
                style="width: 100%; text-align: left"
                @change="handleReclamo('por_solucionar', $event)"
                showClear
            ></Dropdown>
        </div>
        <div v-if="checkPorSolucionar.visible">
            <div
                v-for="item in checkPorSolucionar.data"
                :key="item.id"
                class="form-check"
            >
                <input
                    type="checkbox"
                    class="form-check-input opcion-reclamo-entregado"
                    :id="'option' + item.id"
                    :data-code="item.code"
                    :value="item.id"
                    v-model="formData.opciones"
                />
                <label class="form-check-label" :for="'option' + item.id">{{
                    item.valor1
                }}</label>
            </div>
            <depositante-component
                ref="historialTerceros"
                @formId="capFormId"
                v-if="visiblePorSolucionar"
            ></depositante-component>
            <div class="form-group mt-5">
                <label>Escribenos un mensaje (Opcional)</label>
                <Textarea
                    v-model="formData.comentario"
                    rows="5"
                    cols="30"
                    style="width: 100%"
                />
            </div>
        </div>
        <template #footer
            ><Button
                class="btn-primary"
                :disabled="!isReclamo"
                @click="sendReclamo"
                style="
                    background-color: transparent;
                    border: none;
                    font-size: 18px;
                    text-align: center;
                "
                >Enviar Reclamo</Button
            ></template
        >
    </Dialog>

    <!-- openProcesado -->
    <Dialog v-model:visible="visibleProcesado" style="width: 800px; top: 20%">
        <template #header>
            <h1>Realizar Reclamo - Procesado</h1>
        </template>
        <div class="flex align-items-center mb-5">
            <Dropdown
                id="selectedOptionProcesado"
                v-model="selectedOptionProcesado"
                :options="optionProcesado"
                optionLabel="name"
                optionValue="id"
                :placeholder="'Opciones'"
                class="w-full md:w-14rem input-registro"
                style="width: 100%; text-align: left"
                @change="handleReclamo('procesado', $event)"
                showClear
            ></Dropdown>
        </div>
        <div v-if="checkProcesado.visible">
            <div
                v-for="item in checkProcesado.data"
                :key="item.id"
                class="form-check"
            >
                <input
                    type="checkbox"
                    class="form-check-input opcion-reclamo-entregado"
                    :id="'option' + item.id"
                    :data-code="item.code"
                    :value="item.id"
                    v-model="formData.opciones"
                />
                <label class="form-check-label" :for="'option' + item.id">{{
                    item.valor1
                }}</label>
            </div>
            <depositante-component
                ref="historialTerceros"
                @formId="capFormId"
                v-if="visibleProcesado"
            ></depositante-component>
            <div class="form-group mt-5">
                <label>Escribenos un mensaje (Opcional)</label>
                <Textarea
                    v-model="formData.comentario"
                    rows="5"
                    cols="30"
                    style="width: 100%"
                />
            </div>
        </div>
        <template #footer>
            <Button
                class="btn-primary"
                :disabled="!isReclamo"
                @click="sendReclamo"
                style="
                    background-color: transparent;
                    border: none;
                    font-size: 18px;
                    text-align: center;
                "
                >Enviar Reclamo</Button
            >
        </template>
    </Dialog>
</template>

<script>
// Importar Librerias o Modulos
import DepositanteComponent from "./terceros/DepositanteComponent.vue";

export default {
    data() {
        return {
            solicitudes: [],
            optionsDocument: [],
            optionsBancos: [],
            optionsCodigoI: [],
            optionsPais: [],
            loading: true,
            solicitudSolucionar: {},
            isReclamo: false,
            /** En proceso */
            visibleEnProceso: false,
            optionEnProceso: [
                { id: 1, name: "Mi pedido no ha sido procesado" },
            ],
            checkEnProceso: {
                visible: false,
                data: [],
            },
            selectedOptionEnProceso: null,
            /** Por solucionar */
            visiblePorSolucionar: false,
            optionPorSolucionar: [
                { id: 1, name: "Mi beneficiario no recibio el pago" },
            ],
            checkPorSolucionar: {
                visible: false,
                data: [],
            },
            selectedOptionPorSolucionar: null,
            /** Procesados */
            visibleProcesado: false,
            optionProcesado: [
                { id: 1, name: "Mi beneficiario no recibio el pago" },
            ],
            checkProcesado: {
                visible: false,
                data: [],
            },
            selectedOptionProcesado: null,
            /** formulario de envio */
            formData: {
                solicitud_id: null,
                opciones: [],
                comentario: null,
                beneficiario_id: null,
                estadoCuenta: null,
            },
            servicioDepositanteVisible: false,
        };
    },
    components: {
        DepositanteComponent,
    },
    watch: {
        "formData.opciones": async function (value) {
            if (this.visiblePorSolucionar || this.visibleProcesado) {
                if (value.length > 0) {
                    let values = await this.visibleFormBeneficiario(value);
                    if (
                        values.includes("reintentar_beneficiario_pr") ||
                        values.includes("reintentar_beneficiario_p")
                    ) {
                        if (!this.servicioDepositanteVisible) {
                            this.depositanteFormId = null;
                            this.servicioDepositanteVisible = true;
                            this.validateDepositante(true, true);
                        }
                    } else {
                        this.depositanteFormId = null;
                        this.servicioDepositanteVisible = false;
                        this.validateDepositante(false, false);
                    }
                } else {
                    this.depositanteFormId = null;
                    this.servicioDepositanteVisible = false;
                    this.validateDepositante(false, false);
                }
                this.validateReclamo();
            }
        },
    },
    created() {
        this.handleTabStatus({ index: 0 });
        this.getTypeReclamos();
    },
    mounted() {},
    methods: {
        getSolicitudes(estado) {
            return new Promise((resolve, reject) => {
                axios
                    .get(`/historial/solicitudes/${estado}`)
                    .then(function (response) {
                        resolve(response.data.data);
                    })
                    .catch((error) => {
                        this.loading = false;
                        this.$readStatusHttp(error);
                        reject(error);
                    });
            });
        },
        openModalEnProceso(item) {
            this.resetForm();
            this.visibleEnProceso = true;
            this.formData.solicitud_id = item.id;
        },
        openModalPorSolucionar(item) {
            this.resetForm();
            this.visiblePorSolucionar = true;
            this.formData.solicitud_id = item.id;
        },
        opennModalProcesado(item) {
            this.resetForm();
            this.visibleProcesado = true;
            this.formData.solicitud_id = item.id;
        },
        async getTypeReclamos() {
            const comboNames = [
                "m_reclamo_en_proceso",
                "m_reclamo_por_solucionar",
                "m_reclamo_procesado",
            ];
            const response = await this.$getComboRelations(comboNames);
            const {
                m_reclamo_en_proceso: responseEnProceso,
                m_reclamo_por_solucionar: responsePorSolucionar,
                m_reclamo_procesado: responseProcesado,
            } = response;
            this.checkEnProceso.data = responseEnProceso;
            this.checkPorSolucionar.data = responsePorSolucionar;
            this.checkProcesado.data = responseProcesado;
        },
        handleReclamo(tipo, event) {
            switch (tipo) {
                case "en_proceso":
                    this.checkEnProceso.visible =
                        event.value == 1 ? true : false;
                    break;
                case "por_solucionar":
                    this.checkPorSolucionar.visible =
                        event.value == 1 ? true : false;
                    break;
                case "procesado":
                    this.checkProcesado.visible =
                        event.value == 1 ? true : false;
                    break;
                default:
                    break;
            }
        },
        async handleTabStatus(estado) {
            this.loading = true;
            const tipo = this.mapIndexSolicitud(estado.index);
            this.solicitudes = await this.getSolicitudes(tipo);
            this.loading = false;
            this.visiblePorSolucionar = false;
            this.visibleEnProceso = false;
            this.visibleProcesado = false;
        },
        async visibleFormBeneficiario(id) {
            return new Promise((resolve, reject) => {
                this.$axios
                    .get(`/configuration/ids/${id.join(",")}`)
                    .then(function (response) {
                        resolve(response.data);
                    })
                    .catch((error) => {
                        this.$readStatusHttp(error);
                        reject(error);
                    });
            });
        },
        sendReclamo() {
            this.formData.beneficiario_id = this.depositanteFormId;
            this.$axios
                .post("/historial/store", this.formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((response) => {
                    this.$alertSuccess("Solicitud realizada correctamente");
                    this.visiblePorSolucionar = false;
                    this.visibleEnProceso = false;
                    this.visibleProcesado = false;
                })
                .catch((error) => {
                    this.$readStatusHttp(error);
                });
        },
        toggleCollapse(var1, var2, index) {
            const icon = document.getElementById(var1 + index);
            const collapse = document.getElementById(var2 + index);
            if (icon.classList.contains("fa-chevron-down")) {
                icon.classList.remove("fa-chevron-down");
                icon.classList.add("fa-chevron-up");
            } else {
                icon.classList.remove("fa-chevron-up");
                icon.classList.add("fa-chevron-down");
            }
            $(collapse).collapse("toggle");
        },
        mapIndexSolicitud(index) {
            let tipo = "";
            switch (index) {
                case 0:
                    tipo = "en_proceso";
                    break;
                case 1:
                    tipo = "pendiente";
                    break;
                case 2:
                    tipo = "entregado";
                    break;
                case 3:
                    tipo = "cancelado";
                    break;
                case 4:
                    tipo = "reembolsado";
                    break;
                default:
                    break;
            }

            return tipo;
        },
        resetForm() {
            this.formData.solicitud_id = null;
            this.formData.opciones = [];
            this.formData.comentario = null;
            this.formData.beneficiario_id = null;
            this.formData.estadoCuenta = null;
            this.checkEnProceso.visible = false;
        },
        validateReclamo() {
            if (this.servicioDepositanteVisible) {
                if (this.depositanteFormId) {
                    this.isReclamo = true;
                } else {
                    this.isReclamo = false;
                }
            } else if (this.formData.opciones.length > 0) {
                this.isReclamo = true;
            } else {
                this.isReclamo = false;
            }
        },
        validateDepositante(service, others) {
            if (
                this.$refs.historialTerceros &&
                this.$refs.historialTerceros.checkValidateProceso
            ) {
                this.$refs.historialTerceros.checkValidateProceso(
                    service,
                    others
                );
            }
        },
        capFormId(value) {
            this.depositanteFormId = value;
            this.validateReclamo();
        },
        previewImagen(data, titulo) {
            const randomNumber = Math.floor(Math.random() * 10000);
            let swalOptions = {
                title: `<strong>ID #${data.id}${randomNumber}</strong>`,
                html: `
                <h6>Enviado: ${data.user.email}</h6>
                <h6>Fecha: ${data.created_at}</h6> `,
                imageUrl: "comprobantes/" + data.voucher_referencia,
                imageAlt: titulo,
                showCloseButton: true,
                showConfirmButton: true,
                confirmButtonText: "Descargar",
                focusConfirm: false,
                customClass: {
                    container: "custom-swal-container",
                    popup: "custom-swal-popup",
                },
            };

            this.$swal
                .mixin({
                    customClass: {
                        container: "custom-swal-container",
                        popup: "custom-swal-popup",
                    },
                })
                .fire(swalOptions)
                .then((result) => {
                    if (result.isConfirmed) {
                        this.$downloadImagen(imageUrl);
                    }
                });
        },
    },
};
</script>

<style>
.input-readonly {
    background-color: #f0f0f0;
    color: #999;
}
.p-tabview-header > a {
    text-decoration: none;
}

.button-readonly {
    background-color: #f0f0f0 !important;
    color: #000000 !important;
}

#adjuntarDocumento [data-pc-name="uploadbutton"],
#adjuntarDocumento [data-pc-name="cancelbutton"] {
    display: none;
}

.preview {
    border: 1px;
    border-radius: 10px;
    background-color: rgb(4, 155, 4);
    color: white;
}

.p-voucher {
    border: 1px;
    border-radius: 10px;
    background-color: rgb(4, 92, 155);
    color: white;
}

.custom-swal-container {
    z-index: 999999;
}

.custom-swal-popup {
    z-index: 999999;
}

.disabled-link {
    color: gray;
    cursor: not-allowed;
    pointer-events: none;
}

.p-tabview-panels {
    background: none;
}

.seccion-historial {
    padding: 10px 0;
    background-color: #ffffff;
}
</style>
