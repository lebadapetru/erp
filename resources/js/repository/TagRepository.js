function useTagRepository() {
  const url = '/api/tags'

  const createTag = async (tag) => {
    return await httpClient.post(url, tag)
      .then((response) => {
        console.log('added')
        console.log(response)
        return response
      })
  }

  const readTags = () => {
    return httpClient.get(url)
      .then((response) => {
        console.log('readTags')
        console.log(response.data)
        return response.data
      })
      .catch((error) => {
        console.log(error)
      })
  }

  return {
    createTag,
    readTags
  }
}

export { useTagRepository }