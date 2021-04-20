import { apiUrl } from "resources/js/api/index";

const url = apiUrl + '/variant_options'

const createVariantOption = (variant) => {
  return httpClient.post(url, variant)
}

const readVariantOptions = () => {
  return httpClient.get(url)
}

export {
  createVariantOption,
  readVariantOptions,
}