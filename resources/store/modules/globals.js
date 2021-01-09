const state = () => ({
  isUserPanelVisible: false,
  isOverlayVisible: false
})

const mutations = {
  showUserPanel: (state) => state.isUserPanelVisible = true,
  showOverlay: (state) => state.isOverlayVisible = true,
  closeUserPanel: (state) => state.isUserPanelVisible = false,
  closeOverlay: (state) => state.isOverlayVisible = false,
}

export default {
  namespaced: true,
  state,
  mutations
}