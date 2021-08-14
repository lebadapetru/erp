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

export {
  createCategory,
  readCategories,
}