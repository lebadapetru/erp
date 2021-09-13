import { readProducts } from "resources/js/api/Product";

const actions = {
  read: ({ commit }, filters) => {
    return readProducts(filters).then((response) => {
      commit('setItems', response.data['hydra:member'])
      commit('setTotalItems', response.data['hydra:totalItems'])
    })
  },
}

export default actions