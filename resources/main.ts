import { createApp } from 'vue'
import App from "./App.vue";
import router from "./router";
import store from './store'
import "./httpClient";
import vueClickAway from './assets/js/vendors/plugins/vue-click-away'
import vuePerfectScrollbar from "./assets/js/vendors/plugins/vue-perfect-scrollbar";
import 'bootstrap'
import ElementPlus from 'element-plus';
import 'element-plus/lib/theme-chalk/index.css';

createApp(App)
  .use(store)
  .use(ElementPlus)
  .use(router)
  .use(vueClickAway)
  .use(vuePerfectScrollbar, {
    options: {
      wheelSpeed: 0.3,
      swipeEasing: true,
      wheelPropagation: false,
      minScrollbarLength: 40,
      maxScrollbarLength: 300,
      suppressScrollX: true
    }
  })
  .mount('#app');