import { apiUrl } from "resources/js/api/index";

const url = apiUrl + '/lookup_product_statuses'

const readLookupProductStatuses = () => {
  return httpClient.get(url)
}

export {
  readLookupProductStatuses,
}