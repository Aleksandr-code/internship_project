import {createApp} from 'vue'
import {createPinia} from 'pinia'
import "./node_modules/bootstrap/dist/css/bootstrap.css"
import "./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js";
import "./node_modules/bootstrap-icons/font/bootstrap-icons.min.css";
import "./css/app.css";

import router from './router'
import App from './App.vue'

createApp(App).use(router).use(createPinia()).mount('#app')

console.log("Happy coding !!");
