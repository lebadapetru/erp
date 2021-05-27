import { apiUrl } from "resources/js/api/index";

const url = apiUrl + '/products'

const createProduct = (product) => {
  return httpClient.post(url, product)
}

const readProducts = (filters) => {
  console.log('readProducts', filters)
  return httpClient.get(url, {
    params: filters
  })
}

export {
  createProduct,
  readProducts,
}