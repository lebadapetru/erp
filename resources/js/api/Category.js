import { apiUrl } from "resources/js/api/index";

const url = apiUrl + '/categories'

const createCategory = (category) => {
  return httpClient.post(url, category)
}

const readCategories = (filters) => {
  return httpClient.get(url, {
    params: filters
  })
}

const deleteCategory = (id) => {
  return httpClient.delete(url + '/' + id)
}

export {
  createCategory,
  readCategories,
  deleteCategory,
}