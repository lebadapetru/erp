import { createApp } from 'vue'
import App from "./App";
import router from "./router";
import store from './store'
import "./httpClient"; /*TODO create plugin*/
import vueClickAway from './assets/js/vendors/plugins/vue-click-away'
import vuePerfectScrollbar from "./assets/js/vendors/plugins/vue-perfect-scrollbar";

createApp(App)
  .use(store)
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