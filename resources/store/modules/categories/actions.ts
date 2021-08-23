import { readCategories } from "resources/js/api/Category";

const actions = {
  readItems: ({ commit }, filters) => {
    return readCategories(filters).then((response) => {
      commit('setItems', response.data['hydra:member'])
      commit('setTotalItems', response.data['hydra:totalItems'])
    })
  },
}

export default actions