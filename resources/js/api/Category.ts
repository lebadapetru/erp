import { apiUrl } from "resources/js/api/index";

const url = apiUrl + '/categories'

const createCategory = (data: object) => {
  return httpClient.post(url, data)
}

const readCategories = (filters) => {
  return httpClient.get(url, {
    params: filters
  })
}

const readCategory = (id: number) => {
  return httpClient.get(url + '/' + id)
}

const updateCategory = (id: number, data: object) => {
  return httpClient.patch(url + '/' + id, data)
}

const deleteCategory = (id: number) => {
  return httpClient.delete(url + '/' + id)
}

export {
  createCategory,
  readCategory,
  readCategories,
  updateCategory,
  deleteCategory
}