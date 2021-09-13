import { createCategory, deleteCategory, readCategory, updateCategory } from "resources/js/api/Category";

const actions = {
  create: ({}, data) => {
    return createCategory(data)
  },
  read: ({ commit }, id: number) => {
    return readCategory(id).then((response) => {
      commit('setCategory', response.data)
    })
  },
  update: ({}, { id, data }) => {
    return updateCategory(id, data)
  },
  delete: ({}, id: number) => {
    return deleteCategory(id)
  },
}

export default actions