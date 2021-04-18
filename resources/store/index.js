import { createStore, createLogger } from 'vuex'
import globals from './modules/globals'
import product from './modules/product'

const debug = process.env.NODE_ENV !== 'production'

export default createStore({
  modules: {
    globals,
    product
  },
  strict: debug,
  plugins: debug ? [createLogger()] : []
})