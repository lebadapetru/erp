function useCategoryRepository() {
  const url = '/api/categories'

  const getCategories = () => {
    return httpClient.get(url)
      .then((response) => {
        console.log('getCategories')
        console.log(response.data)
        return response.data
      })
      .catch((error) => {
        console.log(error)
      })
  }

  return {
    getCategories
  }
}

export { useCategoryRepository }