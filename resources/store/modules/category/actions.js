import { createCategory } from "resources/js/api/Category";

const actions = {
  createCategory: ({ }, data) => {
    return createCategory(data)
  }
}

export default actions