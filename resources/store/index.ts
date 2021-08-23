import { createStore, createLogger } from 'vuex'
import product from './modules/product'
import products from './modules/products'
import categories from './modules/categories'
import category from './modules/category'

const debug = process.env.NODE_ENV !== 'production'

export default createStore({
  modules: {
    product,
    products,
    categories,
    category,
  },
  strict: debug,
  plugins: debug ? [createLogger()] : []
})