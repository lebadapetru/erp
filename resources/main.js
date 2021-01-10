import { createApp } from 'vue'
import App from "./App";
import "resources/httpClient"; /*TODO create plugin*/
import 'es6-promise/auto'
import store from './store'
import vueClickAway from './js/vendors/plugins/vue-click-away'
import vuePerfectScrollbar from "resources/js/vendors/plugins/vue-perfect-scrollbar";

createApp(App)
  .use(store)
  .use(vueClickAway)
  .use(vuePerfectScrollbar, {
    options: {
      wheelSpeed: 0.1,
      swipeEasing: true,
      wheelPropagation: false,
      minScrollbarLength: 40,
      maxScrollbarLength: 300,
      suppressScrollX: true
    }
  })
  .mount('#app');