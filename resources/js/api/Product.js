import { apiUrl } from "resources/js/api/index";

const url = apiUrl + '/products'

const createProduct = (product) => {
  return httpClient.post(url, product)
}

const readProducts = () => {
  console.log('readProducts')
  return httpClient.get(url)
}

export {
  createProduct,
  readProducts,
}