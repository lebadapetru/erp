const getters = {
  getItems: (state): Object[] => state.items,
  getTotalItems: (state): number => state.totalItems,
  getActiveView: (state): string => state.activeView,
  getSelectedItems: (state): number[] => state.selectedItems,
  getActivePage: (state): number  => state.pagination.activePage,
  getItemsPerPageOptions: (state): Object[] => state.pagination.itemsPerPageOptions,
  getItemsPerPage: (state): number => state.pagination.itemsPerPage,
}

export default getters