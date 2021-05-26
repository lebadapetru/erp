const state = () => ({
  isUserPanelVisible: false,
  isOverlayVisible: false,
  pagination: {
    activePage: 1,
    itemsPerPage: [
      { label: 16, value: 16 },
      { label: 24, value: 24 },
      { label: 32, value: 32 },
      { label: 40, value: 40 },
    ]
  }
})

const getters = {
  getActivePage: (state) => state.pagination.activePage,
  getItemsPerPage: (state) => state.pagination.itemsPerPage,
}

const mutations = {
  showUserPanel: (state) => state.isUserPanelVisible = true,
  showOverlay: (state) => state.isOverlayVisible = true,
  closeUserPanel: (state) => state.isUserPanelVisible = false,
  closeOverlay: (state) => state.isOverlayVisible = false,
  setActivePage: (state, value) => state.pagination.activePage = value
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
}