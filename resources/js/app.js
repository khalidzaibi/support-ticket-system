import { createApp } from 'vue'
import router from './router'
import App from './App.vue'
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
import 'trix'
import 'trix/dist/trix.css'


createApp(App).use(router).use(ElementPlus).mount('#app')
