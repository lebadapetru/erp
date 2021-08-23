const mutations = {
  setItems: (state, value: Object[]) => state.items = value,
  setTotalItems: (state, value: number) => state.totalItems = value,
  setSelectedItems: (state, value: number[]) => state.selectedItems = value,
  setActivePage: (state, value: number) => state.pagination.activePage = value,
  setItemsPerPage: (state, value: number) => state.pagination.itemsPerPage = value,
  showAddCategoryModal: (state) => state.modals.addCategory = true,
  showEditCategoryModal: (state) => state.modals.editCategory = true,
  hideAddCategoryModal: (state) => state.modals.addCategory = false,
  hideEditCategoryModal: (state) => state.modals.editCategory = false,
}

export default mutations