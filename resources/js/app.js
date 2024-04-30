import "./bootstrap";
import { createApp } from "vue";
import axios from "axios";
import Swal from "sweetalert2";
// Importacion de funciones compartidas
import shared from "./utils/shared";

import PrimeVue from "primevue/config";
import esLocale from "./translations/primevue-es.json";
import "primeicons/primeicons.css";
import "primevue/resources/themes/bootstrap4-light-blue/theme.css";
import Checkbox from "primevue/checkbox";
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
import InputGroup from "primevue/inputgroup";
import FileUpload from "primevue/fileupload";
import TabView from "primevue/tabview";
import TabPanel from "primevue/tabpanel";
import ProgressSpinner from "primevue/progressspinner";
import Menubar from "primevue/menubar";
import Carousel from "primevue/carousel";
import InputGroupAddon from "primevue/inputgroupaddon";
import Image from "primevue/image";

const app = createApp({});

app.use(PrimeVue, {
    zIndex: {
        modal: 1100, //dialog, sidebar
        overlay: 9999, //dropdown, overlaypanel
        menu: 1000, //overlay menus
        tooltip: 1100, //tooltip
    },
});

// Registrar funciones compartidas
app.mixin(shared.AlertsComponent);
app.mixin(shared.ReadHttpStatusErrors);
app.mixin(shared.HelperFunctions);
app.mixin(shared.RelationsTables);

// Impotacion de componentes admin
import SolicitudComponent from "./components/admin/solicitudes/SolicitudComponent.vue";
import TasaComponent from "./components/admin/tasas/TasaComponent.vue";
import VerificacionComponent from "./components/admin/verificacion/VerificacionComponent.vue";
import NoticiaComponent from "./components/admin/noticias/NoticiaComponent.vue";
app.component("solicitud-component", SolicitudComponent);
app.component("tasas-component", TasaComponent);
app.component("verificacion-component", VerificacionComponent);
app.component("noticia-component", NoticiaComponent);

// Anexo de componentes de vuejs
app.component("Dropdown", Dropdown);
app.component("InputText", InputText);
app.component("InputNumber", InputNumber);
app.component("Calendar", Calendar);
app.component("Button", Button);
app.component("Dialog", Dialog);
app.component("DataTable", DataTable);
app.component("Column", Column);
app.component("Toolbar", Toolbar);
app.component("Textarea", Textarea);
app.component("InputGroup", InputGroup);
app.component("FileUpload", FileUpload);
app.component("Checkbox", Checkbox);
app.component("TabView", TabView);
app.component("TabPanel", TabPanel);
app.component("ProgressSpinner", ProgressSpinner);
app.component("Menubar", Menubar);
app.component("Carousel", Carousel);
app.component("InputGroupAddon", InputGroupAddon);
app.component("Image", Image);

// Importacion de componentes envio
import ServicioComponent from "./components/envio/ServicioComponent.vue";
import PaypalComponent from "./components/envio/servicios/PaypalComponent.vue";
import UsdtComponent from "./components/envio/servicios/UsdtComponent.vue";
import ZinliComponent from "./components/envio/servicios/ZinliComponent.vue";
app.component("servicio-component", ServicioComponent);
app.component("servicio-paypal-component", PaypalComponent);
app.component("servicio-usdt-component", UsdtComponent);
app.component("servicio-zinli-component", ZinliComponent);

// Importacion de componentes carrusel
import CarouselComponent from "./components/envio/CarouselComponent.vue";
app.component("carousel-component", CarouselComponent);

// Importacion de componentes pago
import PagoPayPalComponent from "./components/pago/PagoPayPalComponent.vue";
app.component("pago-paypal-component", PagoPayPalComponent);

// Importacion de componentes historial
import HistorialComponent from "./components/historial/HistorialComponent.vue";
app.component("historial-component", HistorialComponent);

// Importacion de componentes menu
import MenuComponent from "./components/menu/MenuComponent.vue";
app.component("menu-component", MenuComponent);

// Importacion de componentes login
import LoginComponent from "./components/login/LoginComponent.vue";
app.component("login-component", LoginComponent);

// Importacion de componentes notificacion
import NotificacionComponent from "./components/notificacion/NotificacionComponent.vue";
app.component("notificacion-component", NotificacionComponent);

// Configura Axios globalmente
app.config.globalProperties.$axios = axios;

// Configura SweetAlert2 globalmente
app.config.globalProperties.$swal = Swal;

// Localidad de PrimeVue
app.config.globalProperties.$primevue.config.locale = esLocale;

app.mount("#app");
