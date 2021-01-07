import { createStore, createLogger } from 'vuex'
import globals from "resources/store/modules/globals";

const debug = process.env.NODE_ENV !== 'production'

export default createStore({
  modules: {
    globals
  },
  strict: debug,
  plugins: debug ? [createLogger()] : []
})