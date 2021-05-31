import { apiUrl } from "resources/js/api/index";

const url = apiUrl + '/products'

export const createProduct = (product) => {
  return httpClient.post(url, product)
}

export const readProducts = (filters) => {
  return httpClient.get(url, {
    params: filters
  })
}

export const readProduct = (id) => {
  return httpClient.get(url + '/' + id)
}