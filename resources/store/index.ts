import { createStore, createLogger } from 'vuex'
import product from './modules/product'
import products from './modules/products'
import categories from './modules/categories'
import category from './modules/category'
import modals from "resources/store/modules/modals";

const debug = process.env.NODE_ENV !== 'production'

export default createStore({
  modules: {
    product,
    products,
    categories,
    category,
    modals,
  },
  strict: debug,
  plugins: debug ? [createLogger()] : []
})