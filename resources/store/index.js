import { createStore, createLogger } from 'vuex'
import globals from './modules/globals'
import product from './modules/product'
import products from './modules/products'

const debug = process.env.NODE_ENV !== 'production'

export default createStore({
  modules: {
    globals,
    product,
    products,
  },
  strict: debug,
  plugins: debug ? [createLogger()] : []
})