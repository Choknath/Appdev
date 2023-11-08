import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import vuetify from './plugins/vuetify'
import { loadFonts } from './plugins/webfontloader'
import 'bootstrap/dist/css/bootstrap.min.css'
import'bootstrap/dist/js/bootstrap.min.js'
import 'font-awesome/css/font-awesome.min.css';

loadFonts()

createApp(App)
  .use(router)
  .use(vuetify)
  .mount('#app')
