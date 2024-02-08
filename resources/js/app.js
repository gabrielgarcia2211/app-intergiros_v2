import './bootstrap';
import { createApp } from 'vue';
import axios from "axios";
import Swal from "sweetalert2";

// Importacion de funciones compartidas
import shared from "./utils/shared";

import PrimeVue from "primevue/config";
import esLocale from "./translations/primevue-es.json";
import "primeicons/primeicons.css";
import "primevue/resources/themes/bootstrap4-light-blue/theme.css";
import InputText from "primevue/inputtext";
import InputNumber from "primevue/inputnumber";
import Calendar from "primevue/calendar";
import Dropdown from "primevue/dropdown";
import Button from "primevue/button";
import Dialog from "primevue/dialog";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Toolbar from "primevue/toolbar";
import Textarea from "primevue/textarea";


const app = createApp({});

app.use(PrimeVue, {
    zIndex: {
        modal: 1100, //dialog, sidebar
        overlay: 9999, //dropdown, overlaypanel
        menu: 1000, //overlay menus
        tooltip: 1100, //tooltip
    },
    /* unstyled: true  */
});

// Impotacion de componentes
import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);

// Anexo de componentes de vuejs
app.component("InputText", InputText);
app.component("InputNumber", InputNumber);
app.component("Calendar", Calendar);
app.component("Dropdown", Dropdown);
app.component("Button", Button);
app.component("Dialog", Dialog);
app.component("DataTable", DataTable);
app.component("Column", Column);
app.component("Toolbar", Toolbar);
app.component("Textarea", Textarea);


// Configura Axios globalmente
app.config.globalProperties.$axios = axios;

// Configura SweetAlert2 globalmente
app.config.globalProperties.$swal = Swal;

// Localidad de PrimeVue
app.config.globalProperties.$primevue.config.locale = esLocale;

// Registrar funciones compartidas
app.mixin(shared.AlertsComponent);
app.mixin(shared.ReadHttpStatusErrors);
app.mixin(shared.HelperFunctions);
app.mixin(shared.RelationsTables);

app.mount('#app');
