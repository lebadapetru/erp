const getters = {
  getItems: (state) => state.items,
  getTotalItems: (state) => state.totalItems,
  getActiveView: (state) => state.activeView,
  getSelectedItems: (state) => state.selectedItems,
  getActivePage: (state) => state.pagination.activePage,
  getItemsPerPageOptions: (state) => state.pagination.itemsPerPageOptions,
  getItemsPerPage: (state) => state.pagination.itemsPerPage,
}

export default getters