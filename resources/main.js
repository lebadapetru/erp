import { createApp } from 'vue'
import App from "./App";

window.axios = require('axios')

let token = document.head.querySelector('meta[name="csrf-token"]')

if (token) {
  window.csrfToken = token.content
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content
} else {
  console.error('CSRF token not found')
}

createApp(App)
  .mount('#app');