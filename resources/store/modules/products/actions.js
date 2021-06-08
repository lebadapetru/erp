import { readProducts } from "resources/js/api/Product";

const actions = {
  readProducts: ({ commit }, filters) => {
    return readProducts(filters).then((response) => {
      commit('setProducts', response.data['hydra:member'])
      commit('setTotalProducts', response.data['hydra:totalItems'])
    })
  },
}

export default actions