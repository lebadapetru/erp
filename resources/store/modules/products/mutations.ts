const mutations = {
  setItems: (state, value) => state.items = value,
  setTotalItems: (state, value) => state.totalItems = value,
  setActiveView: (state, value) => state.activeView = value,
  setSelectedItems: (state, value) => state.selectedItems = value,
  setActivePage: (state, value) => state.pagination.activePage = value,
  setItemsPerPage: (state, value) => state.pagination.itemsPerPage = value,
}

export default mutations