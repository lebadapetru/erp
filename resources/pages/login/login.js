import { createApp } from "vue"
import LoginPage from "./LoginPage";
import httpClient from "resources/httpClient";

window.httpClient = httpClient

createApp(LoginPage)
  //.use(httpClient)
  .mount("#login")