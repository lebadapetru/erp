import { readProducts } from "resources/js/api/Product";

const actions = {
  readItems: ({ commit }, filters) => {
    return readProducts(filters).then((response) => {
      commit('setItems', response.data['hydra:member'])
      commit('setTotalItems', response.data['hydra:totalItems'])
    })
  },
}

export default actions