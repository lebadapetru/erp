import { createCategory, deleteCategory, readCategory, updateCategory } from "resources/js/api/Category";

const actions = {
  createItem: ({ }, data) => {
    return createCategory(data)
  },
  updateItem: ({ }, {id, data}) => {
    return updateCategory(id, data)
  },
  deleteItem: ({ }, id: number) => {
    return deleteCategory(id)
  },
  readItem: ({ commit }, id: number) => {
    return readCategory(id).then((response) => {
      commit('setCategory', response.data)
    })
  }
}

export default actions