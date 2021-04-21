import { apiUrl } from "resources/js/api/index";

const url = apiUrl + '/lookup_product_statuses'

const readLookupProductStatus = () => {
  return httpClient.get(url)
}

export {
  readLookupProductStatus,
}