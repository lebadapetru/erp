import { apiUrl } from "resources/js/api/index";

const url = apiUrl + '/tags'

const createTag = (tag) => {
  return httpClient.post(url, tag)
}

const readTags = () => {
  return httpClient.get(url)
}

export {
  createTag,
  readTags,
}