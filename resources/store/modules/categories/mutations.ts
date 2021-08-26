const mutations = {
  setItems: (state, value: Object[]) => state.items = value,
  setTotalItems: (state, value: number) => state.totalItems = value,
  setSelectedItems: (state, value: number[]) => state.selectedItems = value,
  setActivePage: (state, value: number) => state.pagination.activePage = value,
  setItemsPerPage: (state, value: number) => state.pagination.itemsPerPage = value,
}

export default mutations