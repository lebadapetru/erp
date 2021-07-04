const state = () => ({
  isUserPanelVisible: false,
  isOverlayVisible: false,
  //TODO
  pagination: {
    activePage: 1,
    itemsPerPageOptions: [
      { label: 1, value: 1 },
      { label: 2, value: 2 },
      { label: 16, value: 16 },
      { label: 24, value: 24 },
      { label: 32, value: 32 },
      { label: 40, value: 40 },
    ],
    itemsPerPage: 1,
  }
})

const getters = {
  getActivePage: (state) => state.pagination.activePage,
  getItemsPerPageOptions: (state) => state.pagination.itemsPerPageOptions,
  getItemsPerPage: (state) => state.pagination.itemsPerPage,
}

const mutations = {
  showUserPanel: (state) => state.isUserPanelVisible = true,
  showOverlay: (state) => state.isOverlayVisible = true,
  closeUserPanel: (state) => state.isUserPanelVisible = false,
  closeOverlay: (state) => state.isOverlayVisible = false,
  setActivePage: (state, value) => state.pagination.activePage = value,
  setItemsPerPage: (state, value) => state.pagination.itemsPerPage = value,
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
}