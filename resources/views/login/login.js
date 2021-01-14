import { createApp } from "vue"
import TheLoginPage from "./TheLoginPage";
import { createStore, createLogger } from "vuex"
import "resources/httpClient"; /*TODO create plugin*/

/* i dont need getters nor actions for this*/
/*actions contain the business logic and one or multiple mutations, mutations deal only with state*/
/*getters are somehow like computed props, the result is cached and re-evalute when it changes*/
/*also when multiple components use the same state, better to have a getter for it*/
const debug = process.env.NODE_ENV !== 'production'

const store = createStore({
  state() {
    return {
      activeSection: 'login'
    }
  },
  mutations: {
    setActiveSection(state, form = 'login') {
      state.activeSection = form
    }
  },
  strict: debug,
  plugins: debug ? [createLogger()] : []
})

createApp(TheLoginPage)
  //.use(httpClient)
  .use(store)
  .mount("#login")
