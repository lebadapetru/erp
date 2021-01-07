const state = () => ({
  userPanelDisplay: false
})

const mutations = {
  toggleUserPanel: (state) => state.userPanelDisplay = !state.userPanelDisplay
}

export default {
  namespaced: true,
  state,
  mutations
}