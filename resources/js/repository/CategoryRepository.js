function useCategoryRepository() {
  const url = '/api/categories'

  const createCategory = async (category) => {
    return await httpClient.post(url, category)
      .then((response) => {
        console.log('added')
        console.log(response)
      })
  }

  const readCategories = () => {
    return httpClient.get(url)
      .then((response) => {
        console.log('readCategories')
        console.log(response.data)
        return response.data
      })
      .catch((error) => {
        console.log(error)
      })
  }

  return {
    createCategory,
    readCategories
  }
}

export { useCategoryRepository }