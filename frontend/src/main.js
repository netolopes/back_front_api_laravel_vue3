import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import "@hennge/vue3-pagination/dist/vue3-pagination.css";
import store from './store'
import '@fortawesome/fontawesome-free/css/all.css'
import '@fortawesome/fontawesome-free/js/all.js'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

const app = createApp(App);
app.use(store)
app.use(VueSweetalert2)
app.use(router)

app.mount('#app')
