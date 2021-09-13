import { apiUrl } from "resources/js/api/index";

const url = apiUrl + '/vendors'

const readVendors = () => {
  return httpClient.get(url)
}

export {
  readVendors,
}