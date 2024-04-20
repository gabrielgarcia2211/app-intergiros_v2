<template>
    <div class="container notificaciones" style="overflow-y: auto">
        <TabView class="tabview-custom" @tab-change="handleTabStatus">
            <TabPanel>
                <template #header>
                    <div class="flex align-items-center gap-2">
                        <span class="font-bold white-space-nowrap"
                            >EN PROCESO</span
                        >
                    </div>
                </template>
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
                    class="m-0"
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
                                                {{ item.monto_a_recibir }} BS.
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
                                            item.tipo_formulario.tasa_cambios
                                                .valor
                                        }}
                                        Bs.
                                    </p>
                                    <p>
                                        {{ item.tipo_formulario.descripcion }}
                                    </p>
                                    <p>{{ item.depositante.alias }}</p>
                                    <p>{{ item.beneficiario.alias }}</p>
                                    <p>{{ item.beneficiario.banco }}</p>
                                    <p>V {{ item.beneficiario.cuenta }}</p>
                                    <p>{{ item.beneficiario?.pago_movil }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr v-if="index !== solicitudes.length - 1" />
                </div>
            </TabPanel>
            <TabPanel>
                <template #header>
                    <div class="flex align-items-center gap-2">
                        <span class="font-bold white-space-nowrap"
                            >POR SOLUCIONAR</span
                        >
                    </div>
                </template>
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
                    class="m-0"
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
                                                Datos erróneos del beneficiario
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
                    <div :id="'solucionar' + index" class="collapse container">
                        <div class="text-center">
                            <p>
                                <strong
                                    >Su solicitud ha sido rechazada debido a que
                                    el pago realizado no figura en nuestra
                                    cuenta.</strong
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
                                        @click="openModalPorSolucionar(item)"
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
                                            item.tipo_formulario.tasa_cambios
                                                .valor
                                        }}
                                        Bs.
                                    </p>
                                    <p>
                                        {{ item.tipo_formulario.descripcion }}
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
            </TabPanel>
            <TabPanel>
                <template #header>
                    <div class="flex align-items-center gap-2">
                        <span class="font-bold white-space-nowrap"
                            >PROCESADOS</span
                        >
                    </div>
                </template>
                <p class="m-0">
                    At vero eos et accusamus et iusto odio dignissimos ducimus
                    qui blanditiis praesentium voluptatum deleniti atque
                    corrupti quos dolores et quas molestias excepturi sint
                    occaecati cupiditate non provident, similique sunt in culpa
                    qui officia deserunt mollitia animi, id est laborum et
                    dolorum fuga. Et harum quidem rerum facilis est et expedita
                    distinctio. Nam libero tempore, cum soluta nobis est
                    eligendi optio cumque nihil impedit quo minus.
                </p>
            </TabPanel>
            <TabPanel>
                <template #header>
                    <div class="flex align-items-center gap-2">
                        <span class="font-bold white-space-nowrap"
                            >RECHAZADOS</span
                        >
                    </div>
                </template>
                <p class="m-0">
                    At vero eos et accusamus et iusto odio dignissimos ducimus
                    qui blanditiis praesentium voluptatum deleniti atque
                    corrupti quos dolores et quas molestias excepturi sint
                    occaecati cupiditate non provident, similique sunt in culpa
                    qui officia deserunt mollitia animi, id est laborum et
                    dolorum fuga. Et harum quidem rerum facilis est et expedita
                    distinctio. Nam libero tempore, cum soluta nobis est
                    eligendi optio cumque nihil impedit quo minus.
                </p>
            </TabPanel>
        </TabView>
    </div>

    <!-- openEnProceso -->
    <Dialog v-model:visible="visibleEnProceso" style="width: 500px">
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
        <Button
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
        >
    </Dialog>

    <!-- openPorSolucionar -->
    <Dialog
        v-model:visible="visiblePorSolucionar"
        style="width: 800px; top: 20%"
    >
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
            <!-- depositante -->
            <div
                class="col-md-12 mt-5"
                style="text-align: center"
                v-if="selectDepositanteVisible"
            >
                <Dropdown
                    id="selectedDepositanteReclamo"
                    v-model="selectedDepositante"
                    :options="depositantes"
                    optionLabel="nombre"
                    optionValue="id"
                    :placeholder="'Depositantes afiliados'"
                    class="w-full md:w-14rem input-registro"
                    style="width: 80%; text-align: left"
                    @change="handleSelectDepositante"
                ></Dropdown>
                <div class="text-center">
                    <p
                        @click="initDepositante()"
                        style="
                            color: #0035aa;
                            cursor: pointer;
                            text-decoration: underline;
                            font-size: 18px;
                        "
                    >
                        <i class="fas fa-plus"></i>
                        Afiliar nuevo depositante
                    </p>
                </div>
                <form id="formDepositante" v-if="formDepositanteVisible">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <InputText
                                    v-model="depositanteForm.aliasDepositante"
                                    placeholder="Alias"
                                    class="w-full md:w-14rem input-registro"
                                    style="width: 100%"
                                    :class="{
                                        'p-invalid':
                                            errorsDepositante.aliasDepositante,
                                        'input-readonly': isEditDepositante,
                                    }"
                                    :readOnly="isEditDepositante"
                                />
                                <small
                                    v-if="errorsDepositante.aliasDepositante"
                                    style="display: block"
                                    class="p-error"
                                    >{{
                                        errorsDepositante.aliasDepositante
                                    }}</small
                                >
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <InputText
                                    v-model="depositanteForm.nombreDepositante"
                                    placeholder="Nombres y apellidos"
                                    class="w-full md:w-14rem input-registro"
                                    style="width: 100%"
                                    :class="{
                                        'p-invalid':
                                            errorsDepositante.nombreDepositante,
                                        'input-readonly': isEditDepositante,
                                    }"
                                    :readOnly="isEditDepositante"
                                />
                                <small
                                    v-if="errorsDepositante.nombreDepositante"
                                    style="display: block"
                                    class="p-error"
                                    >{{
                                        errorsDepositante.nombreDepositante
                                    }}</small
                                >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div
                                class="form-group"
                                style="width: 100%; display: inline-block"
                            >
                                <InputGroup>
                                    <Dropdown
                                        id="tipoDocumentoDepositanteReclamo"
                                        v-model="
                                            depositanteForm.tipoDocumentoDepositante
                                        "
                                        :options="optionsDocument"
                                        placeholder="TD"
                                        optionLabel="name"
                                        optionValue="id"
                                        style="width: 30%"
                                        class="input-indicativo"
                                        :class="{
                                            'p-invalid':
                                                errorsDepositante.tipoDocumentoDepositante,
                                            'input-readonly': isEditDepositante,
                                        }"
                                        :readOnly="isEditDepositante"
                                    ></Dropdown>
                                    <InputNumber
                                        id=""
                                        v-model="
                                            depositanteForm.documentoDepositante
                                        "
                                        placeholder="Número documento"
                                        class="w-full md:w-14rem input-telefono"
                                        style="width: 80%"
                                        :class="{
                                            'p-invalid':
                                                errorsDepositante.documentoDepositante,
                                        }"
                                        :disabled="isEditDepositante"
                                    />
                                </InputGroup>
                                <small
                                    v-if="
                                        errorsDepositante.documentoDepositante
                                    "
                                    style="display: block"
                                    class="p-error"
                                    >{{
                                        errorsDepositante.documentoDepositante
                                    }}</small
                                >
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <InputText
                                    v-model="depositanteForm.correoDepositante"
                                    placeholder="Correo Electronico"
                                    class="w-full md:w-14rem input-registro"
                                    style="width: 100%"
                                    :class="{
                                        'p-invalid':
                                            errorsDepositante.correoDepositante,
                                        'input-readonly': isEditDepositante,
                                    }"
                                    :readOnly="isEditDepositante"
                                />
                                <small
                                    v-if="errorsDepositante.correoDepositante"
                                    style="display: block"
                                    class="p-error"
                                    >{{
                                        errorsDepositante.correoDepositante
                                    }}</small
                                >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div
                                class="form-group"
                                style="width: 100%; display: inline-block"
                            >
                                <InputGroup>
                                    <Dropdown
                                        id="codigoIDepositanteReclamo"
                                        v-model="
                                            depositanteForm.codigoIDepositante
                                        "
                                        :options="optionsCodigoI"
                                        placeholder="CI"
                                        optionLabel="name"
                                        optionValue="id"
                                        style="width: 30%"
                                        class="input-indicativo"
                                        :class="{
                                            'p-invalid':
                                                errorsDepositante.codigoIDepositante,
                                            'input-readonly': isEditDepositante,
                                        }"
                                        :readOnly="isEditDepositante"
                                    ></Dropdown>
                                    <InputNumber
                                        id=""
                                        v-model="
                                            depositanteForm.celularDepositante
                                        "
                                        placeholder="Número celular"
                                        class="w-full md:w-14rem input-telefono"
                                        style="width: 80%"
                                        :class="{
                                            'p-invalid':
                                                errorsDepositante.celularDepositante,
                                        }"
                                        :disabled="isEditDepositante"
                                    />
                                </InputGroup>
                                <small
                                    v-if="errorsDepositante.celularDepositante"
                                    style="display: block"
                                    class="p-error"
                                    >{{
                                        errorsDepositante.celularDepositante
                                    }}</small
                                >
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <Dropdown
                                    id="selectPaisReclamo"
                                    v-model="depositanteForm.paisDepositante"
                                    :options="optionsPais"
                                    placeholder="Pais"
                                    optionLabel="name"
                                    optionValue="id"
                                    class="w-full md:w-14rem input-registro"
                                    style="width: 100%; text-align: left"
                                    :class="{
                                        'p-invalid':
                                            errorsDepositante.paisDepositante,
                                        'input-readonly': isEditDepositante,
                                    }"
                                    :readOnly="isEditDepositante"
                                />
                                <small
                                    v-if="errorsDepositante.paisDepositante"
                                    style="display: block"
                                    class="p-error"
                                    >{{
                                        errorsDepositante.paisDepositante
                                    }}</small
                                >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div
                                class="form-group"
                                style="width: 100%; display: inline-block"
                                v-if="isEditImage"
                            >
                                <FileUpload
                                    id="adjuntarDocumento"
                                    ref="fileUpload"
                                    accept="image/*"
                                    :multiple="false"
                                    :fileLimit="1"
                                    :class="{
                                        'p-invalid':
                                            errorsDepositante.adjuntarDocumento,
                                        'input-readonly': isEditDepositante,
                                    }"
                                    @change="onFileUpload"
                                    :disabled="isEditDepositante"
                                >
                                    <template #empty>
                                        <p>Adjuntar foto del documento.</p>
                                    </template>
                                </FileUpload>
                                <small
                                    v-if="errorsDepositante.adjuntarDocumento"
                                    style="display: block"
                                    class="p-error"
                                    >{{
                                        errorsDepositante.adjuntarDocumento
                                    }}</small
                                >
                            </div>
                            <div
                                style="width: 80%; display: inline-block"
                                v-else
                            >
                                <button
                                    @click.prevent="
                                        previewImagen(
                                            depositanteForm.adjuntarDocumento,
                                            true,
                                            true,
                                            depositanteForm.id
                                        )
                                    "
                                    :disabled="isEditDepositante"
                                    class="preview p-voucher"
                                    :class="{
                                        'button-readonly': isEditDepositante,
                                    }"
                                >
                                    <i class="pi pi-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div
                        class="text-center mt-5"
                        v-if="createOrUpdateDepositante == 'create'"
                    >
                        <div
                            class="text-center"
                            style="display: flex; justify-content: center"
                        >
                            <Button
                                class="btn-primary"
                                @click.prevent="addDepositante"
                                style="
                                    background-color: transparent;
                                    border: none;
                                    color: #fff !important;
                                    font-size: 18px;
                                "
                                >Guardar</Button
                            >
                        </div>
                    </div>
                    <div
                        class="text-center mt-5"
                        v-if="createOrUpdateDepositante == 'edit'"
                    >
                        <div
                            class="text-center"
                            style="display: flex; justify-content: center"
                        >
                            <Button
                                class="btn-primary"
                                @click="habilitarEdicion()"
                                style="
                                    background-color: transparent;
                                    border: none;
                                    color: #fff !important;
                                    font-size: 18px;
                                "
                                >Habilitar Edición</Button
                            >
                        </div>
                    </div>
                    <div
                        class="text-center mt-5"
                        v-if="createOrUpdateDepositante == 'update'"
                    >
                        <div
                            class="text-center"
                            style="display: flex; justify-content: center"
                        >
                            <Button
                                class="btn-primary"
                                @click.prevent="updateDepositante"
                                style="
                                    background-color: transparent;
                                    border: none;
                                    color: #fff !important;
                                    font-size: 18px;
                                "
                                >Actualizar</Button
                            >
                        </div>
                    </div>
                </form>
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
        <Button
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
        >
    </Dialog>
</template>

<script>
// Importar Librerias o Modulos
import * as Yup from "yup";

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
            /** formulario de envio */
            formData: {
                solicitud_id: null,
                opciones: [],
                comentario: null,
                beneficiario_id: null,
                estadoCuenta: null,
            },
            depositantes: [],
            selectedDepositante: null,
            selectDepositanteVisible: false,
            formDepositanteVisible: false,
            isEditDepositante: true,
            createOrUpdateDepositante: null,
            isEditImage: true,
            depositanteForm: {
                id: null,
                aliasDepositante: "",
                nombreDepositante: "",
                tipoDocumentoDepositante: null,
                documentoDepositante: null,
                correoDepositante: null,
                codigoIDepositante: null,
                celularDepositante: null,
                paisDepositante: null,
                adjuntarDocumento: null,
                servicio: null,
                code: null,
            },
            errorsDepositante: {},
        };
    },
    components: {},
    watch: {
        "formData.opciones": async function (value) {
            this.selectDepositanteVisible = false;
            this.formDepositanteVisible = false;
            if (this.visiblePorSolucionar && value.length > 0) {
                let values = await this.visibleFormBeneficiario(value);
                if (values.includes("reintentar_beneficiario")) {
                    this.listDepositantes();
                    this.selectDepositanteVisible = true;
                }
            }
        },
    },
    created() {
        this.handleTabStatus({ index: 0 });
        this.getTypeReclamos();
    },
    mounted() {},
    methods: {
        async validateFormDepositante() {
            const schema = Yup.object().shape({
                aliasDepositante: Yup.string().required(
                    "El alias es obligatorio"
                ),
                nombreDepositante: Yup.string().required(
                    "El nombre es obligatorio"
                ),
                tipoDocumentoDepositante: Yup.string().required(
                    "El tipo documento es obligatorio"
                ),
                documentoDepositante: Yup.string().required(
                    "El documento es obligatorio"
                ),
                correoDepositante: Yup.string()
                    .email("El formato del correo electrónico no es válido")
                    .required("El beneficiario es obligatorio"),
                codigoIDepositante: Yup.string().required(
                    "La cuenta es obligatoria"
                ),
                celularDepositante: Yup.string().required(
                    "El pago movil es obligatorio"
                ),
                paisDepositante: Yup.string().required(
                    "El pais es obligatorio"
                ),
                adjuntarDocumento: Yup.string().required(
                    "La foto es obligatoria"
                ),
            });
            this.errorsDepositante = {};
            try {
                await schema.validate(this.depositanteForm, {
                    abortEarly: false,
                });
                return true;
            } catch (err) {
                err.inner.forEach((error) => {
                    this.errorsDepositante[error.path] = error.message;
                });
                return false;
            }
        },
        async handleTabStatus(estado) {
            this.loading = true;
            const tipo = this.mapIndexSolicitud(estado.index);
            this.solicitudes = await this.getSolicitudes(tipo);
            this.loading = false;
            this.visiblePorSolucionar = false;
            this.visibleEnProceso = false;
        },
        getSolicitudes(estado) {
            return new Promise((resolve, reject) => {
                axios
                    .get(`/historial/solicitudes/${estado}`)
                    .then(function (response) {
                        resolve(response.data.data);
                    })
                    .catch(function (error) {
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
        async getTypeReclamos() {
            const comboNames = [
                "m_reclamo_en_proceso",
                "m_reclamo_por_solucionar",
            ];
            const response = await this.$getComboRelations(comboNames);
            const {
                m_reclamo_en_proceso: responseEnProceso,
                m_reclamo_por_solucionar: responsePorSolucionar,
            } = response;
            this.checkEnProceso.data = responseEnProceso;
            this.checkPorSolucionar.data = responsePorSolucionar;
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
                default:
                    break;
            }
        },
        initDepositante() {
            this.createOrUpdateDepositante = "create";
            this.formDepositanteVisible = true;
            this.isEditDepositante = false;
            this.isEditImage = true;
            this.resetFormDepositante();
            this.depositanteForm.servicio = "TP-01";
            this.depositanteForm.code = "TD";
        },
        async listDepositantes() {
            this.depositantes = await this.getTerceros("TD", "ALL");
            const comboNames = [
                "tipo_documento",
                "pais_telefono",
                "pais",
                "banco",
            ];

            const response = await this.$getComboRelations(comboNames);
            const {
                tipo_documento: responseTipoDocumento,
                pais_telefono: responsePaisTelefono,
                pais: responsePais,
                banco: responseBanco,
            } = response;

            this.optionsDocument = responseTipoDocumento;
            this.optionsCodigoI = responsePaisTelefono;
            this.optionsPais = responsePais;
            this.optionsBancos = responseBanco;
        },
        async handleSelectDepositante(event) {
            const code = "TD";
            const servicio = "TP-01";
            this.errorsDepositante = {};
            this.createOrUpdateDepositante = "edit";
            let tmpAfiliado = await this.showTercero(
                event.value,
                code,
                servicio
            );
            this.isEditDepositante = true;
            this.formDepositanteVisible = true;
            this.setFormDepositante(tmpAfiliado.data);
            this.depositanteForm.servicio = servicio;
            this.depositanteForm.code = code;
        },
        async addDepositante() {
            const isValid = await this.validateFormDepositante();
            if (isValid) {
                this.$axios
                    .post("/terceros/store", this.depositanteForm, {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    })
                    .then((response) => {
                        this.$alertSuccess("Depositante Añadido");
                        this.initServicePaypal();
                        this.resetFormDepositante();
                        this.isEditImage = true;
                        this.$refs.fileUpload.clear();
                    })
                    .catch((error) => {
                        this.$readStatusHttp(error);
                    });
            }
        },
        async updateDepositante() {
            const isValid = await this.validateFormDepositante();
            if (isValid) {
                this.$axios
                    .post(
                        "/terceros/update/" + this.depositanteForm.id,
                        this.depositanteForm,
                        {
                            headers: {
                                "Content-Type": "multipart/form-data",
                            },
                        }
                    )
                    .then((response) => {
                        this.$alertSuccess("Depositante Actualizado");
                        this.createOrUpdateDepositante = "edit";
                        this.isEditDepositante = true;
                        this.isEditImage = false;
                        this.depositanteForm.adjuntarDocumento =
                            response.data.data.adjuntar_documento;
                    })
                    .catch((error) => {
                        this.$readStatusHttp(error);
                    });
            }
        },
        setFormDepositante(depositante) {
            this.depositanteForm.id = depositante.id;
            this.depositanteForm.aliasDepositante = depositante.alias;
            this.depositanteForm.nombreDepositante = depositante.nombre;
            this.depositanteForm.tipoDocumentoDepositante =
                depositante.tipo_documento_id;
            this.depositanteForm.documentoDepositante = depositante.documento;
            this.depositanteForm.correoDepositante = depositante.correo;
            this.depositanteForm.codigoIDepositante =
                depositante.pais_telefono_id;
            this.depositanteForm.adjuntarDocumento = depositante.path_documento;
            this.depositanteForm.celularDepositante = parseInt(
                depositante.celular
            );
            this.depositanteForm.paisDepositante = depositante.pais_id;
            this.isEditImage = depositante.path_documento ? false : true;
        },
        resetFormDepositante() {
            this.depositanteForm.id = null;
            this.depositanteForm.aliasDepositante = null;
            this.depositanteForm.nombreDepositante = null;
            this.depositanteForm.tipoDocumentoDepositante = null;
            this.depositanteForm.documentoDepositante = null;
            this.depositanteForm.correoDepositante = null;
            this.depositanteForm.codigoIDepositante = null;
            this.depositanteForm.celularDepositante = null;
            this.depositanteForm.paisDepositante = null;
            this.depositanteForm.adjuntarDocumento = null;
            this.depositanteForm.servicio = null;
            this.depositanteForm.code = null;
        },
        habilitarEdicion() {
            this.errorsDepositante = {};
            this.createOrUpdateDepositante = "update";
            this.isEditDepositante = false;
        },
        async visibleFormBeneficiario(id) {
            return new Promise((resolve, reject) => {
                this.$axios
                    .get(`/configuration/ids/${id.join(",")}`)
                    .then(function (response) {
                        resolve(response.data);
                    })
                    .catch(function (error) {
                        this.$readStatusHttp(error);
                        reject(error);
                    });
            });
        },
        async getTerceros(code, servicio) {
            return new Promise(async (resolve, reject) => {
                try {
                    const response = await axios.get(
                        "/terceros/list/" + code + "/" + servicio
                    );
                    resolve(response.data);
                } catch (error) {
                    this.$readStatusHttp(error);
                    reject(error);
                }
            });
        },
        async showTercero(id, code, servicio) {
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
        resetForm() {
            this.formData.solicitud_id = null;
            this.formData.opciones = [];
            this.formData.comentario = null;
            this.formData.beneficiario_id = null;
            this.formData.estadoCuenta = null;
            this.checkEnProceso.visible = false;
        },
        sendReclamo() {
            this.$axios
                .post("/historial/store", this.formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((response) => {
                    this.$alertSuccess("Solicitud realizada correctamente");
                    this.visibleEnProceso = false;
                })
                .catch((error) => {
                    this.$readStatusHttp(error);
                });
        },
        onFileUpload() {
            const fileUploadComponent = this.$refs.fileUpload;
            if (fileUploadComponent) {
                const file = fileUploadComponent.files[0];
                if (file) {
                    if (file.type && file.type.startsWith("image/")) {
                        this.depositanteForm.adjuntarDocumento = file;
                    }
                }
            }
        },
        previewImagen(imageUrl, titulo, isDelete, solicitudId) {
            let swalOptions = {
                imageUrl: imageUrl,
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

            if (isDelete) {
                swalOptions.showCancelButton = true;
                swalOptions.cancelButtonText = "Eliminar";
                swalOptions.cancelButtonColor = "#d33";
                swalOptions.focusCancel = true;
            }

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
                    } else if (
                        result.dismiss === this.$swal.DismissReason.cancel
                    ) {
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
                                customClass: {
                                    container: "custom-swal-container",
                                    popup: "custom-swal-popup",
                                },
                            })
                            .then((result) => {
                                if (result.isConfirmed) {
                                    this.deleteImagen(imageUrl, solicitudId);
                                }
                            });
                    }
                });
        },
        deleteImagen(path, solicitud_id) {
            let formData = {
                path_document: path,
                id: solicitud_id,
            };
            this.$axios
                .post("/terceros/destroy/path_document", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((response) => {
                    this.$alertSuccess("Depositante Actualizado");
                    this.depositanteForm.adjuntarDocumento = null;
                    this.isEditImage = true;
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
                    tipo = "pendiente";
                    break;
                case 1:
                    tipo = "en_proceso";
                    break;
                case 2:
                    tipo = "entregado";
                    break;
                case 3:
                    tipo = "cancelado";
                    break;
                default:
                    break;
            }

            return tipo;
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
</style>
