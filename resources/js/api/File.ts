import { apiUrl } from "resources/js/api/index";

const url = apiUrl + '/files'

export const deleteFile = (id) => {
  return httpClient.delete(url + '/' + id)
}
