import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import "@hennge/vue3-pagination/dist/vue3-pagination.css";

const app = createApp(App)

app.use(router)

app.mount('#app')
