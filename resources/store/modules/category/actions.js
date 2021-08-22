import { createCategory, deleteCategory } from "resources/js/api/Category";

const actions = {
  createCategory: ({ }, data) => {
    return createCategory(data)
  },
  deleteCategory: ({ }, id) => {
    return deleteCategory(id)
  }
}

export default actions