import { apiUrl } from "resources/js/api/index";

const url = apiUrl + '/vendors'

const readVendor = () => {
  return httpClient.get(url)
}

export {
  readVendor,
}