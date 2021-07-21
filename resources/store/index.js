import { createStore, createLogger } from 'vuex'
import globals from './modules/globals'
import product from './modules/product'
import products from './modules/products'
import categories from './modules/categories'

const debug = process.env.NODE_ENV !== 'production'

export default createStore({
  modules: {
    globals,
    product,
    products,
    categories,
  },
  strict: debug,
  plugins: debug ? [createLogger()] : []
})