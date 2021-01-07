import { createApp } from 'vue'
import App from "./App";
import "resources/httpClient"; /*TODO create plugin*/
import 'es6-promise/auto'
import store from './store'

createApp(App)
  .use(store)
  .directive('click-outside', {
    beforeMount(el, binding, vnode) {
      el.clickOutsideEvent = function(event) {
        if (!(el === event.target || el.contains(event.target))) {
          binding.value(event, el);
        }
      };
      document.body.addEventListener('click', el.clickOutsideEvent);
    },
    unmounted(el) {
      document.body.removeEventListener('click', el.clickOutsideEvent);
    }
  })
  .mount('#app');