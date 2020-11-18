import { createApp } from 'vue'
import App from "./App";
import "resources/httpClient"; /*TODO create plugin*/
import 'es6-promise/auto'

createApp(App)
  .mount('#app');